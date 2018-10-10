<html>
<body>
<?php
include_once("connection.php");
array_map("htmlspecialchars", $_POST);
$achievefield=$_POST["term"]."A";
$effortfield=$_POST["term"]."E";
$setid=$_POST["set"];
$pupilid=$_POST["pupilid"];
$stmt=$conn->prepare("UPDATE tblpupilstudies SET $achievefield=:achieve,$effortfield=:effort  WHERE Setid='$setid' AND Pupilid='$pupilid' ");
$stmt->bindParam(':achieve', $_POST["achieve"]);
$stmt->bindParam(':effort', $_POST["effort"]);
$stmt->execute();
echo "Data transfer successful";
?>
</body>
</html>
