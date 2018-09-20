<html>
<head>
</head>
<body>
<h>This page will just be for designing and testing the forms</h><br>
<?php include_once("connection.php"); ?>

<form id="addingsubject" action="addsubjectscript.php" method="post" style="display:none;">
  <!--This form is for adding a new subject to tblsubject, it sends the these variables to addsubjectscript.php-->
  Subject:<input type="text" name="subjectname"><br>
  Content:<input type="text" name="subjectcontents"><br>
  <input type="Submit" value="Add">
</form>


<form id="addinguser" action="adduserscript.php" method="post" style="display:none;">
  <!--This is for adding a new user to tbluser -->
  First name:<input type="text" name="firstname"><br>
  Surname: <input type="text" name="surname"><br>
  Username: <input type="text" name="username"><br>
  Password: <input type="password" name="password"><br>
  Privilege:<input type="radio" name="privilege" value=0>Admin<input type="radio" name="privilege" value=1>Teacher<br>
  <input type="Submit" value="Add">
</form>
<br>
<form id="addingpupil" action="addpupilscript.php" method="post" style="display:none;">
  <!-- this is for adding a new pupil to tblpupil-->
  First name:<input type="text" name="pupilfirstname"><br>
  Surname: <input type="text" name="pupilsurname"><br>
  Year: <input type="number" name="yeargroup"><br>
  Tutor group:<input type="text" name="tutorgroup"><br>
  Date of Birth: <input type="date" name='dob'><br>
  <p>Please enter their Midyis scores below:</p>
  Vocabulary:<input type="text" name="MVocab"><br>
  Mathematics:<input type="text" name="MMath"><br>
  Non-Verbal:<input type="text" name="MNonVerbal"><br>
  Skills:<input type="text" name="MSkills"><br>
  Score:<input type="text" name="MScore"><br>
  <input type="submit" value="Add"><br>
</form>
<form id="teachersubject" action="teachersubjectscript.php" method="post" style="display:none">
  <!--this essentially assigns a teacher to a subject using the userid and subjectid keys-->
  Teacher:<select name="userid">
    <option value="null">Select a teacher</option>
    <?php
    include_once("connection.php");
    $stmt=$conn->prepare("SELECT * FROM tblusers WHERE privilege=1");
    $stmt->execute(); //this selects all record in tblusers that have privilege 1, meaning they are a teacher
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      echo('<option value='.$row["Userid"].'>'.$row["Firstname"].' '.$row["Surname"].'</option>');//this prints them as options
    }
    ?>
  </select><br>
  <br>
  Subject:<select name="subjectid">
    <option value="null">Select a subject</option>
    <?php
    $stmt=$conn->prepare("SELECT * FROM tblsubject");
    $stmt->execute(); //this selects all record in tblsubject
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      echo('<option value='.$row["Subjectid"].'>'.$row["Subjectname"].'</option>');//this prints them as options
    }
    ?>
  </select><br>
  <br>
  Set name:<input type="text" name="setid"><br>
  <input type="Submit" value="Assign">
</form>
<div id="pupilsubject" class="collapse">
  <form action="pupilsubjectscript.php" method="post" style="display:none">

    Pupil:<select name="pupilid">
      <option value="null">Select a pupil</option>
      <?php
      $stmt=$conn->prepare("SELECT * FROM tblpupil");
      $stmt->execute(); //this selects all record in tblpupil

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        echo('<option value='.$row["Pupilid"].'>'.$row["Firstname"].' '.$row["Surname"].'</option>');//this prints them as options
      }
      ?>
    </select><br>
    <br>
    Subject:<select name="subjectid">
      <option value="null">Select a subject</option>
      <?php
      $stmt=$conn->prepare("SELECT * FROM tblsubject");
      $stmt->execute(); //this selects all record in tblsubject
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        echo('<option value='.$row["Subjectid"].'>'.$row["Subjectname"].'</option>');//this prints them as options
      }
      ?>
    </select><br>
    Set name:<input type="text" name="setid"><br>
    <input class="btn" type="Submit" value="Assign">
</form>
</div>
<form id=pupiltutorgroup action="addpupiltotutorgroup.php" method="post">
  Tutorgroup:
  <select name="tutorgroupid">
    <option value="null">Select a tutor group</option>
    <?php
    $stmt=$conn->prepare("SELECT * FROM tbltutorgroup");
    $stmt->execute(); //this selects all record in tbltutorgroup
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      echo('<option value='.$row["Tutorgroupid"].'>'.$row["Tutorgroupid"].'</option>');//this prints them as options
    }
    ?>
  </select><br>
  Pupil:<select name="pupilid">
    <option value="null">Select a pupil</option>
    <?php
    $stmt=$conn->prepare("SELECT * FROM tblpupil");
    $stmt->execute(); //this selects all record in tblpupil
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      echo('<option value='.$row["Pupilid"].'>'.$row["Firstname"].' '.$row["Surname"].'</option>');//this prints them as options
    }
    ?>
  </select><br>
  <input class="btn" type="Submit" value="Assign">
</form>
</body>
</html>
