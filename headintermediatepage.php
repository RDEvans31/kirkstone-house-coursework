<?php
session_start();
$_SESSION["Yearselectedfortutorreport"]=$_POST["Year"];
header("Location: headcomments.php");
?>
