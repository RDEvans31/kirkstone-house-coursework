<html>
<body>
<?php
if ($_POST["pupilid"]=="" or $_POST["subjectidpupil"]=="") {
  echo("Error: No data to send.");
}else {
  include_once("connection.php");
  array_map("htmlspecialchars", $_POST);
  $stmt=$conn->prepare("INSERT INTO tblpupilstudies (Pupilid,Setid,Subjectid) VALUES (:pupilid,:setid,:subjectid)");
  $stmt->bindParam(':pupilid', $_POST["pupilid"]); //assigns the input from the form to the values that will be added to the field
  $stmt->bindParam(':subjectid', $_POST["subjectidpupil"]);
  $stmt->bindParam(':setid', $_POST["setidpupil"]);
  $stmt->execute(); //executes the SQL with said contents
  $conn=null;
  header("Location:formstesting.php");
}

?>
</body>
</html>
