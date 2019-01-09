<html>
<body>
<?php //this script adds pupils to a tutor group
  include_once("connection.php");
  header("Location:../adminforms/adminaddpupiltotutorgroup.php");
  array_map("htmlspecialchars", $_POST);
  $stmt=$conn->prepare("INSERT INTO tbltutorpupil (Tutorgroupid,Pupilid) VALUES (:tutorgroupid,:pupilid)");
  $stmt->bindParam(':tutorgroupid',$_POST["tutorgroupid"]);
  $stmt->bindParam(':pupilid', $_POST["pupilid"]); //assigns the input from the form to the values that will be added to the field
  $stmt->execute(); //executes the SQL with said contents
  $conn=null;
  echo("Data transfer successful");
?>
</body>
</html>
