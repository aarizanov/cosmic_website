<?php
/**
 * @author    ThemePunch <info@themepunch.com>
 * @link      http://www.themepunch.com/essential/
 * @copyright 2023 ThemePunch
 */
 
if( !defined( 'ABSPATH') ) exit();

class Essential_Grid_LoadBalancer {

	/**
	 * @var array 
	 */
	public $servers = array();
	 
	
	/**
	 * set the server list on construct
	 **/
	public function __construct(){
		$this->servers = get_option('essgrid_servers', array());
		$this->servers = (empty($this->servers)) ? array('themepunch.tools') : $this->servers;
		
	}
	
	/**
	 * get the url depending on the purpose, here with key, you can switch do a different server
	 **/
	public function get_url($purpose, $key = 0, $force_http = false){
		$url	 = ($force_http) ? 'http://' : 'https://';
		$use_url = (!isset($this->servers[$key])) ? reset($this->servers) : $this->servers[$key];
		switch($purpose){
			case 'updates':
				$url .= 'updates.';
				break;
			case 'templates':
				$url .= 'templates.';
				break;
			case 'library':
				$url .= 'library.';
				break;
			default:
				return false;
		}
		$url .= $use_url;
		
		return $url;
	}
	
	/**
	 * refresh the server list to be used, will be done once in a month
	 **/
	public function refresh_server_list($force = false){
		$esg_rsl = isset($_GET['esg_refresh_server']);
		// If there is no option in the database, boolean `false` is returned
		$last_check = get_option('essgrid_server_refresh');
		
		if($force || $esg_rsl || $last_check === false || time() - $last_check > 60 * 60 * 24 * 14){
			$data = array(
				'item' => urlencode(ESG_PLUGIN_SLUG),
				'version' => urlencode(ESG_REVISION)
			);
			$url = apply_filters('essgrid_loadbalancer_get_server_list_url', 'https://updates.themepunch.tools/get_server_list.php');
			$request = $this->call_url($url, $data);
			if(!is_wp_error($request)){
				if($response = maybe_unserialize($request['body'])){
					$list = json_decode($response, true);
					update_option('essgrid_servers', $list);
					update_option('essgrid_server_refresh', time());
				}
			}
		}
	}
	
	/**
	 * move the server list, to take the next server as the one currently seems unavailable
	 **/
	public function move_server_list(){
		$servers = $this->servers;
		$a = array_shift($servers);
		$servers[] = $a;
		
		$this->servers = $servers;
		update_option('essgrid_servers', $servers);
	}
	
	/**
	 * call themepunch URL and retrieve data
	 * 
	 * @param string $url can be full URL or just a file name. In this case url is built using $subdomain param
	 * @param array $data
	 * @param string $subdomain
	 * @param bool $force_http
	 * @return array|WP_Error The response or WP_Error on failure.
	 **/
	public function call_url($url, $data = array(), $subdomain = 'updates', $force_http = false){
		global $wp_version;
		
		//add version if not passed
		$data['version'] = (!isset($data['version'])) ? urlencode(ESG_REVISION) : $data['version'];
		
		$done	= false;
		$count	= 0;
		
		do {
			if (!preg_match("/^https?:\/\//i", $url)) {
				//just a filename passed, lets build an url
				$server	 = $this->get_url($subdomain, 0, $force_http);
				$url = $server . '/' . ltrim($url, '/');
			} else {
				//full URL passed, lets check if we need to force http 
				if ($force_http) {
					$url = preg_replace("/^https:\/\//i", "http://", $url);
				}
			}
			
			$request = wp_remote_post($url, array(
				'user-agent' => 'WordPress/'.$wp_version.'; '.get_bloginfo('url'),
				'body'		 => $data,
				'timeout'	 => 45
			));
			
			$response_code = wp_remote_retrieve_response_code($request);
			if($response_code == 200){
				$done = true;
			}else{
				$this->move_server_list();
			}
			
			$count++;
		}while($done == false && $count < 5);
		
		return $request;
	}
}
