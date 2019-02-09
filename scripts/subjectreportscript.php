<?php
include_once("../connection.php");
array_map("htmlspecialchars", $_POST);
//this decides what term it is for the report
$date=date("Y-m-d");
$getterm=$conn->prepare("SELECT * FROM tblterms");
$getterm->execute();
while ($row = $getterm->fetch(PDO::FETCH_ASSOC)) {
  if ($date>$row["Datestart"] and $date<$row["Dateend"]) {
    $term=$row["Term"];
  }
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
echo "<script type='text/javascript'>
    alert('Submitted.');
    window.location.replace(\"../teachersubjectreports.php\");
</script>";
?>
