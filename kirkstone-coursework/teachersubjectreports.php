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
</head>
<body>
<?php include_once("connection.php");
session_start();
$userid=$_SESSION["userid"];
?>
<nav class="navbar">
<div class="container-fluid">

  <div class="navbar-header"><a class="navbar-brand" href="..\Index.php">KHS</a></div>
  <a class="navbar-brand" href="logoutscript.php">Logout</a>

</nav>
<div class="jumbotron text-center">
  <div id="subjectreport">
  <form id="subjectreportform" action="subjectreportscript.php" method="post">
   Set:<select onchange="showPupilsinset(this.value)" name="setid">
     <option value="">Select a set</option>
     <?php
     $stmt=$conn->prepare("SELECT Setid FROM tblset WHERE Userid='$userid'"); //returns sets taught by teacher that logged in
     $stmt->execute();
     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
       echo("<option value=".$row["Setid"].">".$row["Setid"]."</option>");
     }
     ?>
   </select>
   <br>
   Pupil: <select id="selectpupil" name="pupilid">
     <option>Select a set</option>
   </select><br>
   Adherence to deadlines:<br>
   <input type="radio" name="deadline" value="a"> A
   <input type="radio" name="deadline" value="b"> B
   <input type="radio" name="deadline" value="c"> C
   <input type="radio" name="deadline" value="d"> D
   <br>
   Presentation of work:<br>
   <input type="radio" name="presentation" value="a"> A
   <input type="radio" name="presentation" value="b"> B
   <input type="radio" name="presentation" value="c"> C
   <input type="radio" name="presentation" value="d"> D
   <br>
   Participation in lessons:<br>
   <input type="radio" name="participation" value="a"> A
   <input type="radio" name="participation" value="b"> B
   <input type="radio" name="participation" value="c"> C
   <input type="radio" name="participation" value="d"> D
   <br>
   Organisational skills:<br>
   <input type="radio" name="organisation" value="a"> A
   <input type="radio" name="organisation" value="b"> B
   <input type="radio" name="organisation" value="c"> C
   <input type="radio" name="organisation" value="d"> D
   <br>
   Comments:<input type="text" name="teachercomments">
   <input type="Submit" value="Save">

  </form>
  </div>
</body>
</html>
