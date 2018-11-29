<!DOCTYPE html>
<head>
</head>
<body>
<?php
include_once("connection.php");
array_map("htmlspecialchars", $_POST); //this is here to ensure that if SQL should be typed into the input field, it will not affect the database.
//the line below assigns the contents of the second bracket to the fields stated in the first
$stmt=$conn->prepare("INSERT INTO tblsubject (Subjectid,Subjectname,Content) VALUES (null,:subject,:content)");
$stmt->bindParam(':subject', $_POST["subjectname"]); //assigns the input from the form to the values that will be added to the field
$stmt->bindParam(':content', $_POST["subjectcontents"]);
$stmt->execute(); //executes the SQL with said contents
$conn=null;
echo("Data transfer successful");

?>
</body>
