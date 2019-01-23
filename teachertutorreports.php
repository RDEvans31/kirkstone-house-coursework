<html lang="en" > <!--this declares english language as the primary -->
<head>
  <title>Subject report</title>
  <!--these connectt to bootstrap through a cdn-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
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
  <style>
  .jumbotron {
    background-color: #444444;
    color: #fff;
  }
  </style>
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
  <div id="tutorreport">
    <form name="tutorreportform" action="scripts/tutorreportscript.php" method="post">
      Pupil:<select name="pupilidreport">
        <option value="null">Select a tutee</option>
        <<?php
         //produces list of pupils within tutor group
         //makes use of the varibales in tutorgroup div
         $pupilidsintutorgroup=$_SESSION["tutorgrouppupils"];
         foreach ($pupilidsintutorgroup as $x) {
           $stmt=$conn->prepare("SELECT Surname,Firstname FROM tblpupil WHERE Pupilid='$x'");
           $stmt->execute();
           while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
             echo ("<option value=".$x.">".$row["Firstname"].' '.$row["Surname"]."</option>");
             }
         }
        ?>
      </select><br>
      Tutor Comments:<input type="text" name="tutorcomments"><br>
      <input type="Submit" value="Enter">
    </form>
  </div>
</div>
</body>
</html>
