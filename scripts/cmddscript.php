<?php
include_once("connection.php");
$column=$_POST["award"];
$pupilid=$_POST["pupilid"];
$getname=$conn->prepare("SELECT Firstname,Surname FROM tblpupil");
$getname->execute();
$row = $getname->fetch(PDO::FETCH_ASSOC);
$name=$row["Firstname"].' '.$row["Surname"];
$message = 'Added '.$column.' to '.$name;

echo "<SCRIPT type='text/javascript'>
    alert('$message');
    window.location.replace(\"../teacheraddcmdd.php\");
</SCRIPT>";
array_map("htmlspecialchars", $_POST); //this is here to ensure that if SQL should be typed into the input field, it will not affect the database.

$date=date("Y-m-d");
$getterm=$conn->prepare("SELECT * FROM tblterms");
$getterm->execute();
while ($row = $getterm->fetch(PDO::FETCH_ASSOC)) {
  if ($date>$row["Datestart"] and $date<$row["Dateend"]) {
    $term=$row["Term"];
  }
}
$stmt=$conn->prepare("INSERT INTO tblpupilawards (Pupilid, Term, ".$column.") VALUES ($pupilid, '$term', 1) ON DUPLICATE KEY UPDATE ".$column."=".$column."+1");
//this either creates a new record in the table and inserts a 1 into the targeted column or if the record already exists, increments the targeted column by 1.
$stmt->execute();
?>
