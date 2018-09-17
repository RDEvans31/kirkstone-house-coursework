<html>
<body>
<?php
if ($_POST["pupilid"]=="null" or $_POST["subjectid"]=="null") {
  echo("Error: No data to send.");
}else {
  include_once("connection.php");
  array_map("htmlspecialchars", $_POST);
  $stmt=$conn->prepare("INSERT INTO tblpupilstudies (Pupilid,Setid,Subjectid) VALUES (:pupilid,:setid,:subjectid)");
  $stmt->bindParam(':pupilid', $_POST["pupilid"]); //assigns the input from the form to the values that will be added to the field
  $stmt->bindParam(':subjectid', $_POST["subjectid"]);
  $stmt->bindParam(':setid', $_POST["setid"]);
  $stmt->execute(); //executes the SQL with said contents
  $conn=null;
  echo("Data transfer successful");
}

?>
</body>
</html>
