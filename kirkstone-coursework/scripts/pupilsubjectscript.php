<html>
<body>
<?php
if ($_POST["pupilid"]=="" or $_POST["subjectidpupil"]=="") {
  echo("Error: No data to send.");
}else {
  //header("Location:../adminforms/adminassignpupiltosubject.php");
  include_once("connection.php");
  array_map("htmlspecialchars", $_POST);
  $stmt=$conn->prepare("INSERT INTO tblpupilstudies (Pupilid,Setid) VALUES (:pupilid,:setid)");
  $stmt->bindParam(':pupilid', $_POST["pupilid"]); //assigns the input from the form to the values that will be added to the field
  $stmt->bindParam(':setid', $_POST["setidpupil"]);
  $stmt->execute(); //executes the SQL with said contents
  $conn=null;
}

?>
</body>
</html>
