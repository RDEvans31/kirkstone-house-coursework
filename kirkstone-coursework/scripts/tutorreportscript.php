<html>
<body>
<?php
//header("Location:teacher.php");//redirects them back to the teacher page
include_once("connection.php");
session_start();
array_map("htmlspecialchars", $_POST);
$Year=date("Y");
$tutor=$_SESSION["userid"];
echo($_POST["pupilidreport"]);
$stmt=$conn->prepare("INSERT INTO tbltutorreport (Pupilid,Userid,Year,Tutorcomments) VALUES(:pupilid,:userid,:year,:tutorcomments) ON DUPLICATE KEY UPDATE Tutorcomments=:tutorcomments");
$stmt->bindParam(':pupilid', $_POST["pupilidreport"]);
$stmt->bindParam(':userid', $tutor);
$stmt->bindParam(':year', $Year);
$stmt->bindParam(':tutorcomments', $_POST["tutorcomments"]);
$stmt->execute();
echo("Successful");
?>
</body>
</html>
