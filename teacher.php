<html lang="en" > <!--this declares english language as the primary -->
<head>
  <title>Teacher</title>
  <!--these connec to bootstrap through a cdn-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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
  <h3>Welcome</h3>
  <h5>Teacher page</h5>
<div id="tutorgroup" class="panel-group"><!--this will display the tutor group of the teacher that has logged in-->
  <?php
  //this code creates session variables that contain information about the tutor group of the user
  $pupilidsintutorgroup=array();
  $stmt=$conn->prepare("SELECT * FROM tbltutorgroup WHERE Userid='$userid'");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $tutorgroup=$row["Tutorgroupid"];
  $stmt=$conn->prepare("SELECT * FROM tbltutorpupil WHERE Tutorgroupid='$tutorgroup'");
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($row["Tutorgroupidid"]=$tutorgroup) {
      array_push($pupilidsintutorgroup,$row["Pupilid"]);
    }
  }
  $_SESSION["tutorgroup"]=$tutorgroup;
  $_SESSION["tutorgrouppupils"]=$pupilidsintutorgroup;

  ?>
  <div class="panel panel-default">
    <div class="panel-body">
      <?php
      //this code displays a list of the names in the tutor group -no longger required
      /*
      $stmt=$conn->prepare("SELECT * FROM tblusers");//this selects all sets that are associated with the subject selected.
      $stmt->execute();
      foreach ($pupilidsintutorgroup as $x) {
        $stmt=$conn->prepare("SELECT Surname,Firstname FROM tblpupil WHERE Pupilid='$x'");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo('<li>'.$row["Firstname"].' '.$row["Surname"].'</li>');
          }
      }*/
      ?>
    </div>
</div>
</div>
<div id="showsetstaught"><!--this used to show a list of pupils taught, seperated by set but this will be displayed on another page-not the homepage-->
  <?php
    $setstaught=array();
    $stmt=$conn->prepare("SELECT Setid FROM tblset WHERE Userid='$userid'"); //returns sets taught by teacher that logged in
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      array_push($setstaught,$row["Setid"]); //adds the set id to an array of sets taught
    }
    $_SESSION["sets"]=$setstaught;
    //this code below displayed the pupil names - not required anymore
    /*foreach ($setstaught as $x) { //loops through each set taught by teacher
      echo("Set: ".$x);
      $pupilsinset=array(); // initialise here because needs to be cleared and re-initiated at the end of this loop.
      $stmt=$conn->prepare("SELECT Pupilid FROM tblpupilstudies WHERE Setid='$x'"); //fetches all the pupil id's in the set
      $stmt->execute();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($pupilsinset,$row["Pupilid"]); //adds the pupil id's of pupils in the set to an array
      }
      foreach ($pupilsinset as $y) {
        $stmt=$conn->prepare("SELECT Surname,Firstname FROM tblpupil WHERE Pupilid='$y'"); //loops through the pupils in the set, fetches their name.
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo ("<li>".$row["Firstname"].' '.$row["Surname"]."</li>"); //prints name as list item.
        }
       //clears all the students in this set from array so that it can be repopulated with students from the next set.
       unset($pupilsinset);
      }
    }*/
  ?>
</div>
</div>
</body>
</html>
