<html lang="en" > <!--this declares english language as the primary -->
<head>
  <title>Admin</title>
  <!--these connec to bootstrap through a cdn-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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
          xhttp.open("GET", "../ajaxgetsetsforsubject.php?subjectid="+id, true);
          xhttp.send();
        }
  </script>
</head>
<body>
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
  <h3>Assign a pupil to a subject</h3>
  <form action="..\scripts\pupilsubjectscript.php" method="post">

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
