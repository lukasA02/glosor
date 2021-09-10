<?php session_start();

session_destroy();
header('Location: test2.php');
exit();
?>