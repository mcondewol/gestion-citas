<?php
/**
* BookMedik
* @author evilnapsis
* @url http://evilnapsis.com/about/
**/

if(count($_POST)>0){
	$is_admin=0;
	if(isset($_POST["is_admin"])){$is_admin=1;}
	if(isset($_POST["is_editor"])){$is_editor=1;}
	$user = new UserData();
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];
	$user->username = $_POST["username"];
	$user->email = $_POST["email"];
	$user->is_admin=$is_admin; 
	$user->is_editor=$is_edirot;
	$user->password = sha1(md5($_POST["password"]));
	$user->idubicacion = $_POST["idubicacion"];
	$user->add();

print "<script>window.location='index.php?view=users';</script>";


}


?>