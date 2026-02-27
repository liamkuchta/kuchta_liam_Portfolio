<?php

//   admin logout
//   clears session and sends user back to login
 

session_start();
session_destroy();
header('Location: login_form.php');
exit();
?>
