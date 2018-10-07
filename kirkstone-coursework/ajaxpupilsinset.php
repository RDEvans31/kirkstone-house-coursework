<html>
<head>
</head>
<body>
<?php
include_once("connection.php");
$setid = $_GET['setid'];
$pupilsinset=array();
$stmt=$conn->prepare("SELECT Pupilid FROM tblpupilstudies WHERE Setid='$setid'");//this selects all sets that are associated with the subject selected.
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
 array_push($pupilsinset,$row["Pupilid"]);
}
foreach ($pupilsinset as $x) {
  $stmt=$conn->prepare("SELECT Surname,Firstname FROM tblpupil WHERE Pupilid='$x'"); //returns sets taught by teacher that logged in
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo("<option value=".$x.">".$row["Firstname"]." ".$row["Surname"]."</option>");
  }
}
?>
</body>
</html>
