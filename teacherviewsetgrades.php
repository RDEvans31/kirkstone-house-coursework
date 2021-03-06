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
  <?php
  include_once("connection.php");
  session_start();
  $userid=$_SESSION["userid"];
  ?>
</head>
<body>
  <script>
    $(function() {
      $("#navigation").load("teachernavbar.php");
      });
  </script>
  <div id="navigation"></div>
<div class="jumbotron text-center">
  <h3>Sets and grades:</h3>
<div id="setsgrades"><!--this will display the grades of each pupil in each set-->
  <?php
  $setstaught=$_SESSION["sets"];
  foreach ($setstaught as $x) { //loops through each set taught by teacher
          echo(
        '<table class="table table-dark">
          <caption>Set:'.$x.'</caption>
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Target</th>
            <th scope="col">Aut1A</th>
            <th scope="col">Aut1E</th>
            <th scope="col">Aut2A</th>
            <th scope="col">Aut2E</th>
            <th scope="col">Spr1A</th>
            <th scope="col">Spr1E</th>
            <th scope="col">Spr2A</th>
            <th scope="col">Spr2E</th>
            <th scope="col">Sum1A</th>
            <th scope="col">Sum1E</th>
            <th scope="col">Sum2A</th>
            <th scope="col">Sum2E</th>

          </tr>
        </thead>
        <tbody>
          ');
          $stmt=$conn->prepare("SELECT * FROM tblpupilstudies WHERE Setid='$x'");
          $stmt->execute();
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // for each of these records, I will print out the data but also get the pupilname based on the pupil id of the record
              $pupilid=$row["Pupilid"];
              $getpupilname=$conn->prepare("SELECT Firstname, Surname FROM tblpupil WHERE Pupilid='$pupilid'");
              $getpupilname->execute();
              while ($row2 = $getpupilname->fetch(PDO::FETCH_ASSOC)) {
                  $pupilname=$row2["Firstname"].' '.$row2["Surname"];//this stores the pupilname of the pupil we are dealing with in this row of the table.
                }
              echo('
              <tr>
                <th scope="row">'.$pupilname.'</th>
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
                <td>
                <form action="teachergeneratesubjectreport.php" method="post" target="teachergeneratesubjectreport.php">
                  <input type="hidden" name="pupilid" value="'.$pupilid.'">
                  <input type="hidden" name="setid" value="'.$x.'">
                  <input class="btn" type="Submit" value="Subject report">
                </form>
                </td>
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
