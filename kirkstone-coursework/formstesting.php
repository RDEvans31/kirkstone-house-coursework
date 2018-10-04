<html>
<head>
  <script>
        function showSets(id){
          var xhttp;
          if (id == "") {
            document.getElementById("selectset").innerHTML = "<option value=''> No subject selected</option>";
            return;
          }
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("selectset").innerHTML = this.responseText;//finds the html element with id "selectset" changes the contents of that element accordingly.
            }
          };
          xhttp.open("GET", "getsetsforsubject.php?subjectid="+id, true);
          xhttp.send();
        }
  </script>
</head>
<body>
<h>This page will just be for designing and testing the forms</h><br>
<?php include_once("connection.php"); ?>

<form id="addingsubject" action="addsubjectscript.php" method="post" >
  <!--This form is for adding a new subject to tblsubject, it sends the these variables to addsubjectscript.php-->
  Subject:<input type="text" name="subjectname"><br>
  Content:<input type="text" name="subjectcontents"><br>
  <input type="Submit" value="Add">
</form>


<form id="addinguser" action="adduserscript.php" method="post" >
  <!--This is for adding a new user to tbluser -->
  First name:<input type="text" name="firstname"><br>
  Surname: <input type="text" name="surname"><br>
  Username: <input type="text" name="username"><br>
  Password: <input type="password" name="password"><br>
  Privilege:<input type="radio" name="privilege" value=0>Admin<input type="radio" name="privilege" value=1>Teacher<br>
  <input type="Submit" value="Add">
</form>
<br>
<form id="addingpupil" action="addpupilscript.php" method="post" >
  <!-- this is for adding a new pupil to tblpupil-->
  First name:<input type="text" name="pupilfirstname"><br>
  Surname: <input type="text" name="pupilsurname"><br>
  Year: <input type="number" name="yeargroup"><br>
  Date of Birth: <input type="date" name='dob'><br>
  <p>Please enter their Midyis scores below:</p>
  Vocabulary:<input type="text" name="MVocab"><br>
  Mathematics:<input type="text" name="MMath"><br>
  Non-Verbal:<input type="text" name="MNonVerbal"><br>
  Skills:<input type="text" name="MSkills"><br>
  Score:<input type="text" name="MScore"><br>
  <input type="submit" value="Add"><br>
</form>
<form id="teachersubject" action="teachersubjectscript.php" method="post">
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
  Set name:<input type="text" name="setname"><br>
  <input type="Submit" value="Assign">
</form>
<div id="pupilsubject">
  <form action="pupilsubjectscript.php" method="post">

    Pupil:<select name="pupilid">
      <option value="">Select a pupil</option>
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
    Subject:<select name="subjectidpupil" onchange="showSets(this.value)">
      <option value="">Select a subject</option>
      <?php
      $stmt=$conn->prepare("SELECT * FROM tblsubject");
      $stmt->execute(); //this selects all record in tblsubject
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        echo('<option value='.$row["Subjectid"].'>'.$row["Subjectname"].'</option>');//this prints them as options
      }
      ?>
    </select><br>
    Set:<select id="selectset" name="setidpupil"></select>
  </br>
    <input class="btn" type="Submit" value="Assign">
</form>
</div>

<form id=createtutorgroup action="createtutorgroup.php" method="post">
  Tutorgroup:<input type="text" name="tutorgroupid"><br>
  Tutor:<select name="userid">
    <option value="null">Select a tutor</option>
    <?php
    $stmt=$conn->prepare("SELECT * FROM tblusers WHERE Privilege=1");
    $stmt->execute(); //this selects all record in tblpupil
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      echo('<option value='.$row["Userid"].'>'.$row["Firstname"].' '.$row["Surname"].'</option>');//this prints them as options
    }
    ?>
  </select><br>
  <button type="submit" class="btn btn-default">Create</button>
</form>

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
  <button type="submit" class="btn btn-default">Assign</button>
</form>
<form id=entergrades action="enetergradesscript.php">
  Term:<select name="term">
    <option value="null">Select a term</option>
    <option value="aut1">Autumn 1</option>
    <option value="aut2">Autumn 2</option>
    <option value="spr">Spring</option>
    <option value="sum">Summer</option>
  </select>
  Pupil:<select name="pupilid">
    <option value="null">Select a pupil</option>
    <?php
      $stmt=$conn->prepare("SELECT * FROM tblpupil "); //needs to retreive the pupils in their set it can do this by allowing the teacher to select the set first before the form
    ?>

</body>
</html>
