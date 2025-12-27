<?php session_start();
needlogged();

session_destroy();
header("Location: login.php");

?>