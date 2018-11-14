<html>
<body>
<?php
header("Location:../teacher.php");//redirects them back to the teacher page
include_once("connection.php");
array_map("htmlspecialchars", $_POST);
$setid=$_POST["set"];
$pupilid=$_POST["pupilid"];
$achievefield=$_POST["term"]."A";
$effortfield=$_POST["term"]."E";
if ($_POST["target"]!="") { //checks if target is not empty, assigns the input value to the approriate record
  $stmt=$conn->prepare("UPDATE tblpupilstudies SET Target=:target WHERE Setid='$setid' AND Pupilid='$pupilid' ");
  $stmt->bindParam(':target', $_POST["target"]);
  $stmt->execute();
}
$stmt=$conn->prepare("UPDATE tblpupilstudies SET $achievefield=:achieve,$effortfield=:effort  WHERE Setid='$setid' AND Pupilid='$pupilid' ");
$stmt->bindParam(':achieve', $_POST["achieve"]);
$stmt->bindParam(':effort', $_POST["effort"]);
$stmt->execute();
?>
</body>
</html>
