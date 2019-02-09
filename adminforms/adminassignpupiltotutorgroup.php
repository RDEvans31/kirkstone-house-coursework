<html lang="en" > <!--this declares english language as the primary -->
<head>
  <title>Admin</title>
  <!--these connec to bootstrap through a cdn-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<?php include_once("../connection.php"); ?>
<script>
  $(function() {
    $("#navigation").load("adminformsnavbar.php");
    });
</script>
<div id="navigation"></div>
<div class="jumbotron text-center">
  <h3>Assign a pupil to a tutor group:</h3>
  <form id=pupiltutorgroup action="..\script\addpupiltotutorgroup.php" method="post">
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
</div>
</body>
</html>
