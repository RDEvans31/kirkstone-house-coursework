<html>
<body>
<?php
if ($_POST["userid"]=="null" or $_POST["subjectid"]=="null") {
  echo("Error: Missing data.");
}else {
  include_once("connection.php");
  array_map("htmlspecialchars", $_POST);
  $getsubjects=$conn->prepare("SELECT * FROM tblsubject");
  $getsubjects->execute();
  while ($row = $getsubjects->fetch(PDO::FETCH_ASSOC))
  {
    if ($row["Subjectid"]==$_POST["subjectid"]) {
      $subjectname=str_replace(' ','',$row["Subjectname"]);//this removes the space in the subject name
    }
  }
  $setname=$_POST["setname"];
  $Year=date("Y");//this gets the year in long form eg. 2018
  $year=date("y"); //this gets the year in short form ie. 2018=18
  $setid=$setname.$subjectname.$year;
//this sends the relevant data to tblsubteacher, assigning a teacher to a subject
  $stmt=$conn->prepare("INSERT INTO tblsubteacher (Userid,Subjectid) VALUES (:userid,:subjectid)");
  $stmt->bindParam(':userid', $_POST["userid"]); //assigns the input from the form to the values that will be added to the field
  $stmt->bindParam(':subjectid', $_POST["subjectid"]);
  $stmt->execute(); //executes the SQL with said contents
  echo("Teacher assigned to ".$subjectname);
//this will send the relevant data to tblset to store which set was taugt by which teacher, in which year.
  $stmt2=$conn->prepare("INSERT INTO tblset(Setid,Setname,Subjectname,Year,Userid) VALUES (:setid,:name,:subject,:year,:userid)");
  $stmt2->bindParam(':setid', $setid);
  $stmt2->bindParam(':name', $setname);
  $stmt2->bindParam(':subject', $subjectname);
  $stmt2->bindParam(':year', $Year);
  $stmt2->bindParam(':userid', $_POST["userid"]);
  $stmt2->execute();
  $conn=null;
  echo("The set has been created and the teacher assigned to it.");
}
?>
</body>
</html>
