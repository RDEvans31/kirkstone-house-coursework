<?php
header("Location:teachersubjectreports.php");//redirects them back to the teacher page
include_once("connection.php");
array_map("htmlspecialchars", $_POST);
//this decides what term it is for the report
switch (date("m")) {
  case '01':
  case '02':
  case '03':
    $term="Spr";
    break;
  case '04':
  case '05':
  case '06':
    $term="Sum";
    break;
  case '09':
  case '10':
  case '11':
  case '12':
    $term="Aut";
    break;
}

$setid=$_POST["setid"];
$year=date("Y");
//this will get the subject id based on the set id that had been sent through
$getsubject=$conn->prepare("SELECT Subjectid FROM tblset WHERE Setid='$setid'");
$getsubject->execute();
while ($row = $getsubject->fetch(PDO::FETCH_ASSOC)) {
  $subjectid=$row["Subjectid"];
}
$stmt=$conn->prepare("INSERT INTO tblsubjectreport (Pupilid,Subjectid,Term,Year,Deadlines,Presentation,Organisation,Participation,Teachercomments) VALUES (:pupilid,:subject,:term,:year,:deadline,:presentation,:organisation,:participation,:teachercomments) ");
$stmt->bindParam(':pupilid', $_POST["pupilid"]);
$stmt->bindParam(':subject', $subjectid);
$stmt->bindParam(':term', $term);
$stmt->bindParam(':year', $year);
$stmt->bindParam(':deadline', $_POST["deadline"]);
$stmt->bindParam(':presentation', $_POST["presentation"]);
$stmt->bindParam(':organisation', $_POST["organisation"]);
$stmt->bindParam(':participation', $_POST["participation"]);
$stmt->bindParam(':organisation', $_POST["organisation"]);
$stmt->bindParam(':teachercomments', $_POST["teachercomments"]);
$stmt->execute();
?>
