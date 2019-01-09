<?php
include_once("connection.php");
$setid = $_GET['setid'];
$pupilsinset=array();
$stmt=$conn->prepare("SELECT Pupilid FROM tblpupilstudies WHERE Setid='$setid'");//this selects all sets that are associated with the subject selected.
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
 array_push($pupilsinset,$row["Pupilid"]);//this adds the pupil id into an array
}
foreach ($pupilsinset as $x) {
  $stmt=$conn->prepare("SELECT Surname,Firstname FROM tblpupil WHERE Pupilid='$x'"); //returns names of pupils in the set
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo("<option value=".$x.">".$row["Firstname"]." ".$row["Surname"]."</option>");
  }
}
?>
