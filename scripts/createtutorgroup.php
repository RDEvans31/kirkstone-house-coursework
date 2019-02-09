<html>
<body>
<?php
if ($_POST["userid"]=="null" or strlen($_POST["tutorgroupid"])==0) {
  echo "<script type='text/javascript'>
      alert('One or more fields are empty.');
      window.location.replace(\"../adminforms/admincreatetutorgroup.php\");
  </script>";//this is a simple validation check to make sure none of the fields are empty
}else {
  include_once("../connection.php");
  array_map("htmlspecialchars", $_POST);
  $stmt=$conn->prepare("INSERT INTO tbltutorgroup (Tutorgroupid,Userid) VALUES (:tutorgroupid,:userid)");
  $stmt->bindParam(':tutorgroupid',$_POST["tutorgroupid"]);
  $stmt->bindParam(':userid', $_POST["userid"]); //assigns the input from the form to the values that will be added to the field
  $stmt->execute(); //executes the SQL with said contents
  $conn=null;
  echo "<script type='text/javascript'>
      alert('Submitted.');
      window.location.replace(\"../adminforms/admincreatetutorgroup.php\");
  </script>";
}

?>
</body>
</html>
