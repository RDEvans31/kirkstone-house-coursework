<?php
include_once("../connection.php");
header("Location:../adminforms/adminaddterms.php");
array_map("htmlspecialchars", $_POST); //this is here to ensure that if SQL should be typed into the input field, it will not affect the database.
//the line below assigns the contents of the second bracket to the fields stated in the first
$stmt=$conn->prepare("INSERT INTO tblterms (Term,Datestart,Dateend) VALUES (:term,:start,:enddate)");
$stmt->bindParam(':term', $_POST["term"]); //assigns the input from the form to the values that will be added to the field
$stmt->bindParam(':start', $_POST["start"]);
$stmt->bindParam(':enddate', $_POST["end"]);
$stmt->execute(); //executes the SQL with said contents
$conn=null;
?>
