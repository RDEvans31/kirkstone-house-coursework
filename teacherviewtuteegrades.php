<html lang="en" > <!--this declares english language as the primary -->
<head>
  <title>Teacher</title>
  <!--these connec to bootstrap through a cdn-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-html5-1.5.4/datatables.min.css"/>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-html5-1.5.4/datatables.min.js"></script>
  <script>
        function showPupilsinset(setid){//shows pupils in the selected set
          var xhttp;
          if (setid == "") {
            document.getElementById("selectpupil").innerHTML = "<option value=''> No pupil selected</option>";
            return;
          }
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("selectpupil").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", "ajaxpupilsinset.php?setid="+setid, true);
          xhttp.send();
        }
  </script>
  <?php
  include_once("connection.php");
  session_start();
  $userid=$_SESSION["userid"];
  $pupilidsintutorgroup=$_SESSION["tutorgrouppupils"];
  $tutorgroup=$_SESSION["tutorgroup"];
  ?>
</head>
<body>
  <script>
    $(function() {
      $("#navigation").load("teachernavbar.php");
      });
  </script>
  <div id="navigation"></div>
<div class="jumbotron">
  <?php echo("<h3>Tutor group: ".$tutorgroup."</h3>")?>
<div id="tutorgroupgrades" class="mt-5"><!--this will display the grades of each tutee-->
  <?php

  foreach ($pupilidsintutorgroup as $x) {
    $stmt=$conn->prepare("SELECT Surname,Firstname FROM tblpupil WHERE Pupilid='$x'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $name=$row["Firstname"].' '.$row["Surname"];//this gets the name of the pupil that we will output the grades for
    echo(
  '
  <form action="teachergeneratetutorreport.php" method="post" target="teachergeneratetutorreport.php">
    <input type="hidden" name="pupilid" value="'.$x.'">
    <input type="hidden" name="tutorgroup" value="'.$tutorgroup.'">
    <input class="btn btn-dark" type="Submit" value="Tutor report">
  </form>
  <table id="tuteetable" class="table table-dark display">
  <thead>
    <tr>
      <th>Name:</th>
      <th>'.$name.'</th>
    </tr>
    <tr>
      <th>Subject</th>
      <th></th>
      <th colspan= "2" scope="colgroup">Autumn</th>
      <th colspan= "2" scope="colgroup">Autumn</th>
      <th colspan= "2" scope="colgroup">Spring</th>
      <th colspan= "2" scope="colgroup">Spring</th>
      <th colspan= "2" scope="colgroup">Summer</th>
      <th colspan= "2" scope="colgroup">Summer</th>
    </tr>
    <tr>
      <th scope="col"></th>
      <th scope="col">Target</th>
      <th scope="col">1A</th>
      <th scope="col">1E</th>
      <th scope="col">2A</th>
      <th scope="col">2E</th>
      <th scope="col">1A</th>
      <th scope="col">1E</th>
      <th scope="col">2A</th>
      <th scope="col">2E</th>
      <th scope="col">1A</th>
      <th scope="col">1E</th>
      <th scope="col">2A</th>
      <th scope="col">2E</th>
    </tr>
  </thead>
  <tbody>

    ');
    $stmt=$conn->prepare("SELECT * FROM tblpupilstudies WHERE Pupilid='$x'");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // for each of these records, I will print out the data but also get the subjectname based on the subject id of the record
        $setid=$row["Setid"];
        $getsubjectid=$conn->prepare("SELECT Subjectid FROM tblset WHERE Setid='$setid'");
        $getsubjectid->execute();
        $subjectid = $getsubjectid->fetch(PDO::FETCH_COLUMN);
        $getsubjectname=$conn->prepare("SELECT Subjectname FROM tblsubject WHERE Subjectid='$subjectid'");
        $getsubjectname->execute();
        $row2 = $getsubjectname->fetch(PDO::FETCH_ASSOC);
        $subjectname=$row2["Subjectname"];//this stores the subjectname of the subject we are dealing with in this row of the table.
      echo('
      <tr>
        <th scope="row">'.$subjectname.'</th>
        <td>'.$row["Target"].'</td>
        <td>'.$row["Autumn1A"].'</td>
        <td>'.$row["Autumn1E"].'</td>
        <td>'.$row["Autumn2A"].'</td>
        <td>'.$row["Autumn2E"].'</td>
        <td>'.$row["Spring1A"].'</td>
        <td>'.$row["Spring1E"].'</td>
        <td>'.$row["Spring2A"].'</td>
        <td>'.$row["Spring2E"].'</td>
        <td>'.$row["Summer1A"].'</td>
        <td>'.$row["Summer1E"].'</td>
        <td>'.$row["Summer2A"].'</td>
        <td>'.$row["Summer2E"].'</td>

      </tr>
    ');
      }
  echo("
  </tbody>
  ");
  }
  ?>
</div>
</body>
</html>
