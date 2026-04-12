<?php
session_start();

setcookie("remember_username", "", time() - 36000);
setcookie("remember", "", time() - 3600);

session_unset();
session_destroy();
header("location:index.php");
?>
