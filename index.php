<?php
  session_start();
  require_once('facebook-php-sdk-v4-5.0-dev/src/Facebook/autoload.php');
  require_once 'FacebookLogin.php';

  $handler = new FacebookLogin();
  header("Location:".$handler->getLoingURL());
  exit();

?>