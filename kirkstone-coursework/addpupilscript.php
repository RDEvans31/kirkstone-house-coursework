<html>
<body>
<?php
include_once("connection.php");
array_map("htmlspecialchars", $_POST);
$stmt=$conn->prepare("INSERT INTO tblpupil (Pupilid,Surname,Firstname,Year,TutorGroup,DoB,MidVocab,MidMaths,MidNonVerbal,MidSkills,MidScore) VALUES (null,:surname,:firstname,:year,:tutorgroup,:DoB,:vocab,:math,:nonverbal,:skills,:score)");
$stmt->bindParam(':surname', $_POST["pupilsurname"]); //assigns the input from the form to the values that will be added to the field
$stmt->bindParam(':firstname', $_POST["pupilfirstname"]);
$stmt->bindParam(':tutorgroup', $_POST["tutorgroup"]);
$stmt->bindParam(':year', $_POST["yeargroup"]);
$stmt->bindParam(':DoB', $_POST["dob"]);
$stmt->bindParam(':vocab', $_POST["MVocab"]);
$stmt->bindParam(':math', $_POST["MMath"]);
$stmt->bindParam(':nonverbal', $_POST["MNonVerbal"]);
$stmt->bindParam(':skills', $_POST["MSkills"]);
$stmt->bindParam(':score', $_POST["MScore"]);
$stmt->execute(); //executes the SQL with said contents
$conn=null;
echo("Data transfer successful")
?>
</body>
</html>
