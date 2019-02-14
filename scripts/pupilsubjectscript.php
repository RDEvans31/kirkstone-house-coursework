<?php
include_once("../connection.php");
if ($_POST["pupilid"]=="" or $_POST["subjectidpupil"]=="") {
  echo "<script type='text/javascript'>
      alert('Error: Fields are empty.');
      window.location.replace(\"../adminforms/adminassignpupiltosubject.php\");
  </script>";
}else {
  array_map("htmlspecialchars", $_POST);
  $stmt=$conn->prepare("INSERT INTO tblpupilstudies (Pupilid,Setid) VALUES (:pupilid,:setid)");
  $stmt->bindParam(':pupilid', $_POST["pupilid"]); //assigns the input from the form to the values that will be added to the field
  $stmt->bindParam(':setid', $_POST["setidpupil"]);
  $stmt->execute(); //executes the SQL with said contents
  $conn=null;
  echo "<script type='text/javascript'>
      alert('Submitted.');
      window.location.replace(\"../adminforms/adminassignpupiltosubject.php\");
  </script>";
}

?>
