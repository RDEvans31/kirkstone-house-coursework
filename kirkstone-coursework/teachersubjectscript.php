<html>
<body>
<?php
if ($_POST["userid"]=="null" or $_POST["subjectid"]=="null") {
  echo("Error: No data to send.");
}else {
  include_once("connection.php");
  array_map("htmlspecialchars", $_POST);
  $stmt=$conn->prepare("INSERT INTO tblsubteacher (Userid,Subjectid) VALUES (:userid,:subjectid)");
  $stmt->bindParam(':userid', $_POST["userid"]); //assigns the input from the form to the values that will be added to the field
  $stmt->bindParam(':subjectid', $_POST["subjectid"]);
  $stmt->execute(); //executes the SQL with said contents
  $conn=null;
  echo("Data transfer successful");
}

?>
</body>
</html>
