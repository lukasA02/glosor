<?php
session_start();
session_destroy();
header('Location: test2ty.php');
exit();
?>