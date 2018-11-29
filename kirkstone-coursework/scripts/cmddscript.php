<?php
include_once("connection.php");
array_map("htmlspecialchars", $_POST); //this is here to ensure that if SQL should be typed into the input field, it will not affect the database.
$column=$_POST["award"];
$pupilid=$_POST["pupilid"];
$date=date("Y-m-d");
$getterm=$conn->prepare("SELECT * FROM tblterms");
$getterm->execute();
while ($row = $getterm->fetch(PDO::FETCH_ASSOC)) {
  if ($date>$row["Datestart"] and $date<$row["Dateend"]) {
    $term=$row["Term"];
  }
}
echo($pupilid."<br>".$term."<br>".$column);
//$stmt=$conn->prepare("INSERT INTO tblpupilawards (Pupilid, Term, $column) VALUES ($pupilid, $term, 1) ON DUPLICATE KEY UPDATE $column=$column+1");
//this either creates a new record in the table and inserts a 1 into the targeted column or if the record already exists, increments the targeted column by 1.
//$stmt->execute();
?>
