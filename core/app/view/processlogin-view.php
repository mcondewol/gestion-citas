<?php

// define('LBROOT',getcwd()); // LegoBox Root ... the server root
// include("core/controller/Database.php");

if(Session::getUID()=="") {
$user = $_POST['mail'];
$pass = sha1(md5($_POST['password']));

$base = new Database();
$con = $base->connect();
 $sql = "select * from user where (email= \"".$user."\" or username= \"".$user."\") and password= \"".$pass."\" and is_active=1";
//print $sql;
$query = $con->query($sql);
$found = false;
$userid = null;
$userEmail = null;
$username = null;
$lastname = null;
while($r = $query->fetch_array()){
	$found = true ;
	$userid = $r['id'];
	$userEmail = $r['email'];
	$username = $r['name'];
	$lastname = $r['lastname'];
}

if($found==true) {
//	print $userid;
	$_SESSION['user_id']=$userid ;
	$_SESSION['email']=$userEmail ;
	$_SESSION['username']=$username ;
	$_SESSION['lastname']=$lastname ;
	setcookie('username',$username);
	setcookie('lastname',$lastname);
	setcookie('userEmail',$userEmail);
	setcookie('userid',$userid);
//	setcookie('userid',$userid);
//	print $_SESSION['userid'];
	print "Cargando ... $user";
	print "<script>window.location='index.php?view=home';</script>";
}else {
	print "<script>window.location='index.php?view=login';</script>";
}

}else{
	print "<script>window.location='index.php?view=home';</script>";
	
}
?>