<?php
if ($_POST["userid"]=="null" or $_POST["subjectid"]=="null") {
  echo "<script type='text/javascript'>
      alert('Error: Empty fields');
      window.location.replace(\"../adminforms/adminassignteachertosubject.php\");
  </script>";
}else {
  include_once("../connection.php");
  array_map("htmlspecialchars", $_POST);
  $userid=$_POST["userid"];
  $getsubjects=$conn->prepare("SELECT * FROM tblsubject");
  $getsubjects->execute();
  while ($row = $getsubjects->fetch(PDO::FETCH_ASSOC))
  {
    if ($row["Subjectid"]==$_POST["subjectid"]) {
      $subjectid=$row["Subjectid"];
      $subjectname=str_replace(' ','',$row["Subjectname"]);//this removes the space in the subject name
    }
  }
  $setname=$_POST["setname"];
  $Year=date("Y");//this gets the year in long form eg. 2018
  $year=date("y"); //this gets the year in short form ie. 2018=18
  $setid=$setname.$subjectname.$year;
//this will send the relevant data to tblset to store which set was taugt by which teacher, in which year.
  $stmt2=$conn->prepare("INSERT INTO tblset(Setid,Setname,Subjectid,Year,Userid) VALUES (:setid,:name,:subject,:year,:userid)");
  $stmt2->bindParam(':setid', $setid);
  $stmt2->bindParam(':name', $setname);
  $stmt2->bindParam(':subject', $subjectid);
  $stmt2->bindParam(':year', $Year);
  $stmt2->bindParam(':userid', $_POST["userid"]);
  $stmt2->execute();
  $conn=null;
  echo "<script type='text/javascript'>
      alert('Submitted.');
      window.location.replace(\"../adminforms/adminassignteachertosubject.php\");
  </script>";

}

?>
