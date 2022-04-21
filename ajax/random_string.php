<?php

function generateRandomString($length = 32){
	$characters = '0123456789abcdefABCDEF';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

$keyPHP = generateRandomString();;
$ivPHP = generateRandomString();

?>