<?php
if (isset($_POST["date"])) {
	$date = $_POST["date"];
	$date = new DateTime($date);
	$year = $date->format('Y');
} else {
	redirect();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $year == '2011' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	echo'
	<script type="text/javascript">
		$(\'.msg\').hide();
		$(\'.msg1\').html(\'Congrats! <br/> The secret message is "2011 is the year when Cosmic Development was founded"\');
		$(\'.msg1\').show();
	</script>
	';
	exit;
} else {
	redirect();
}

function redirect(){
	header('Location: https://www.cosmicdevelopment.com/404');
	exit;
}
