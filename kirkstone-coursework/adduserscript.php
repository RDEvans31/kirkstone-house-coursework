<html>
<body>
<?php
include_once("connection.php");
array_map("htmlspecialchars", $_POST);
$firstname=$_POST["firstname"];
$surname=$_POST["surname"];
$username=$_POST["username"];
$password=$_POST["password"];
$privilege=$_POST["privilege"]; //0 for admin, 1 for teacher
if ($username=='') { //if the username field is left blank then firstname and lastname will be combined to generate a username
  $username=$firstname.$surname;
}
$stmt=$conn->prepare("INSERT INTO tblusers (Userid,Surname,Firstname,Username,Password,Privilege) VALUES (null,:surname,:firstname,:username,:password,:privilege)");
$stmt->bindParam(':surname', $surname); //assigns the input from the form to the values that will be added to the field
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':privilege', $privilege);
$stmt->execute(); //executes the SQL with said contents
$conn=null;
echo("Data transfer successful")
?>
</body>
</html>
