<!DOCTYPE html>
<head>
</head>
<body>
<?php
include_once("connection.php");
array_map("htmlspecialchars", $_POST);
$stmt=$conn->prepare("INSERT INTO tblsubject (Subjectid,Subjectname,Content) VALUES (null,:subject,:content)");
$stmt->bindParam(':subject', $_POST["subjectname"]);
$stmt->bindParam(':content', $_POST["subjectcontents"]);
$stmt->execute();
$conn=null;
echo("Data transfer successful")

?>
</body>
