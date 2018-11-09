<?php
Header('Location:headcomments.php');
include_once("connection.php");
array_map("htmlspecialchars", $_POST);
$Year=date("Y");//this is the calendar year
$pupilid=$_POST["pupilid"];
$stmt=$conn->prepare("UPDATE tbltutorreport SET Headcomments=:comment WHERE Pupilid='$pupilid' AND Year='$Year' ");
$stmt->bindParam(':comment', $_POST["headcomments"]);
$stmt->execute();
echo("Comment saved.");
?>
