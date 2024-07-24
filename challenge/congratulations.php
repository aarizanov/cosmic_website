<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     die("Oops! It's not as simple as it looks :) <br/> Keep trying!");
} else {
	header('Location: https://www.cosmicdevelopment.com/404');
	exit;
}
