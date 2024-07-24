<?php

namespace Pagup\Lktags\Controllers;

use  Pagup\Lktags\Core\Plugin ;
use  Pagup\Lktags\Core\Request ;
class MetaboxController
{
    public function add_metabox()
    {
    }
    
    public function metabox( $post )
    {
        $data = [
            'lktags_event'     => get_post_meta( $post->ID, 'lktags_event', true ),
            'lktags_eventarea' => get_post_meta( $post->ID, 'lktags_eventarea', true ),
            'text_domain'      => Plugin::domain(),
        ];
        //$meta = get_post_meta($post->ID);
        //var_dump($meta);
        return Plugin::view( 'metabox', $data );
    }
    
    public function metadata( $postid )
    {
    }

}
$metabox = new MetaboxController();