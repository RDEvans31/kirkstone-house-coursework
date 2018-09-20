<html>
<head>
</head>
<body>
<?php
session_start();
include_once("connection.php");
$stmt=$conn->prepare("SELECT * FROM tbluser"); //this selects all records in tbluser
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { //this loops through the table and accesses each record

  if ($_POST["username"]==$row["Username"]) { //this checks if the username used to log in matches the username of the current record
    if ($_POST["password"]==$row["Password"]) { //this checks the password
      switch ($row["Privilege"]) {
        case '0':

          break;
        case '1':

          break;
      }

      $message="accepted";
      exit();
    }else {$message="Wrong password";}


  }else {$message="Wrong username or password";}
}
if ($message!="accepted") {
  echo("
  <p> The username or password you entered was wrong </p>
  ");
}
?>
</body>
</html>
