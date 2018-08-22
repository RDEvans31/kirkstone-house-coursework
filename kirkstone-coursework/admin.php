<html lang="en" > <!--this declares english language as the primary -->
<head>
  <title>Admin</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css"> <!--this connects ot bootstrap.css through a CDN-->
  <style>
  .jumbotron {
    background-color: #444444;
    color: #fff;
  }
  </style>
</head>
<body>
  <script>
  function showform(formID) { //each button is assigned a form id to use with this function.
    var form=document.getElementById(formID);//locates the relevant form
    if (form.style.display=="none"){
      form.style.display="block";//this will toggle the appearence of the form if it is not visible
  } else {
      form.style.display="none";
  }
    console.log("Success");
  }
  </script>
<?php include_once("connection.php"); ?>
<nav class="navbar">
    <a class="navbar-brand" href="http://www.kirkstonehouseschool.co.uk/page/default.asp">KHS</a>
</nav>
<div class="jumbotron text-center">
  <h1>Welcome *insert user in here**</h1>
<!--these divs simply seperate the forms-->
  <div id="subjectforms">
    <p class="pull-left">Subjects:</p>
    <button class="btn btn-info pull-right" onclick="showform('addingsubject')">Add</button>
    <button class="btn btn-info pull-right" onclick="showform('teachersubject')">Assign teacher</button>
    <button class="btn btn-info pull-right" onclick="showform('pupilsubject')">Assign pupil</button><br>
    <form id="addingsubject" action="addsubjectscript.php" method="post" style="display:none;">
      <!--This form is for adding a new subject to tblsubject, it sends the these variables to addsubjectscript.php-->
      Subject:<input type="text" name="subjectname"><br>
      Content:<input type="text" name="subjectcontents"><br>
      <input class="btn" type="Submit" value="Add">
    </form>
    <form id="teachersubject" action="teachersubjectscript.php" method="post" style="display:none;">
      <!--this essentially assigns a teacher to a subject using the userid and subjectid keys-->
      Teacher:<select name="userid">
        <option value="null">Select a teacher</option>
        <?php
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
      <input class="btn" type="Submit" value="Assign">
    </form>
    <form id="pupilsubject" action="pupilsubjectscript.php" method="post" style="display:none;">

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
      <input class="btn" type="Submit" value="Assign">
    </form>
  </div>
  <br>
  <div name="users">
    <p class="pull-left">Users:</p>
    <button class="btn btn-info pull-right" onclick="showform('addinguser')">Add</button>
    <form id="addinguser" action="adduserscript.php" method="post" style="display:none;">
      <!--This is for adding a new user to tbluser -->
      First name:<input type="text" name="firstname"><br>
      Surname: <input type="text" name="surname"><br>
      Username: <input type="text" name="username"><br>
      Password: <input type="password" name="password"><br>
      Privilege:<input type="radio" name="privilege" value=0>Admin<input type="radio" name="privilege" value=1>Teacher<br>
      <input class="btn" type="Submit" value="Add">
    </form>
  </div>
  <br>
  <div name="pupil">
    <p class="pull-left">Pupils:</p>
    <button class="btn btn-info pull-right" onclick="showform('addingpupil')">Add</button><br>
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
      <input class="btn" type="submit" value="Add"><br>
    </form>
  </div>
  <br>
  <div name="tutorgroup">
    <p class="pull-left">Tutor groups:</p>
    <button class="btn btn-info pull-right" onclick="showform('tutorgroup')">Assign</button><br>
    <form id="tutorgroup" action="tutorgroupscript.php" method="post" style="display:none;">
      Tutor group:<input type="text" name="tutorgroupid"><br>
      Tutor:<select name="userid">
        <option value="null">Select a tutor</option>
        <?php
        $stmt=$conn->prepare("SELECT * FROM tblusers WHERE Privilege=1");
        $stmt->execute(); //this selects all records of teachers in tblusers
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          echo('<option value='.$row["Userid"].'>'.$row["Firstname"].' '.$row["Surname"].'</option>');//this prints them as options
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
  </div>
</div>
</body>
</html>
