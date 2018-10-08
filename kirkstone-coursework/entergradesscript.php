<html>
<body>
<?php
include_once("connection.php");
array_map("htmlspecialchars", $_POST);
$field1
$field2
$stmt=$conn->prepare("UPDATE tblpupilstudies SET Aut1A,Aut1E VALUES(:achieve,:effort)");
$stmt->bindParam(':achieve', $_POST[""]);
$stmt->bindParam('effort:', $_POST[""]);
$stmt->execute();

?>
</body>
</html>
