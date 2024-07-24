<?php
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
header('Location: http://www.cosmicdevelopment.com/challenge/');
exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-49007218-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-49007218-1');
</script>
<title>Cosmic Challenge</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="./assets/style.css">
</head>

<body>
	<div class="page-wrapper">
		<div class="challenge-elements">
		        <p class="hack">Hack the page</p>
			<p class="heading">Click the button to find the secret message</p>
			<p class="msg"></p>
			<p class="msg1"></p>
			<div class="controls"> 
				<input type="password" placeholder="Password" class="password">
				<button type="button" class="button" >Show the message</button>
			</div>
		</div>
	</div>	

<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="./assets/console_block.js"></script>
<script type="text/javascript">
(function(xhr) {
	let words = ['Oops', 'Sorry', 'Ouch', 'Argh', 'Grr'];
	$('.button').on('click', function(){
		let password = $('.password').val();
		if (password === "cosmic2011") {
			$('.button').prop('disabled', true);
			window.XMLHttpRequest = xhr;
			$.ajax({
			    url: '/challenge/congratulations.php',  
			    type: 'POST', 
			    data: {date: new Date().toISOString()} 
		    })
		    .done(function(data){
				$('.msg').html(data);
		    })
		    .always(function(data){
				$('.button').prop('disabled', false);
		    });
		    window.XMLHttpRequest = null;
		} else {
			let word = words[Math.floor(Math.random()*words.length)];
			$('.msg').text(word + '! That didn\'t work. Try again.');
		}
	});
	challengeInit(xhr);
})(window.XMLHttpRequest);
window.XMLHttpRequest = null;

</script>
</body>
</html>
