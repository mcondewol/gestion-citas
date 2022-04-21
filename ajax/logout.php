<?php
   session_start();
   session_unset();
   $_SESSION['name'] = null;
   $_SESSION['email'] = null;
   $_SESSION['url_foto'] = null;
   $_SESSION['fb_user_id'] = null; 
   $_SESSION['fb_access_token'] = null;
   header("Location: ../index.php");        
?>