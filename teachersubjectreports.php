<html lang="en" > <!--this declares english language as the primary -->
<head>
  <title>Subject report</title>
  <!--these connect to bootstrap through a cdn-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
  <div id="subjectreport">
  <form id="subjectreportform" action="scripts/subjectreportscript.php" method="post">
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
   Adherence to deadlines:
   <div class="btn-group btn-group-toggle" data-toggle="buttons">
      <label class="btn btn-secondary">
        <input type="radio" name="deadline" value="a"> A
      </label>
      <label class="btn btn-secondary">
        <input type="radio" name="deadline" value="b"> B
      </label>
      <label class="btn btn-secondary">
        <input type="radio" name="deadline" value="c"> C
      </label>
      <label class="btn btn-secondary">
        <input type="radio" name="deadline" value="d"> D
      </label>
    </div></br>

   Presentation of work:
  <div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-secondary">
    <input type="radio" name="presentation" value="a"> A
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="presentation" value="b"> B
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="presentation" value="c"> C
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="presentation" value="d"> D
  </label>
  </div></br>

   Participation in lessons:
  <div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-secondary">
    <input type="radio" name="participation" value="a"> A
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="participation" value="b"> B
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="participation" value="c"> C
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="participation" value="d"> D
  </label>
</div></br>

   Organisational skills:
  <div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-secondary">
    <input type="radio" name="organisation" value="a"> A
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="organisation" value="b"> B
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="organisation" value="c"> C
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="organisation" value="d"> D
  </label>
  </div></br>
   Comments:<input type="text" name="teachercomments"><br>
   <input type="Submit" value="Save">

  </form>
  </div>
</div>
</body>
</html>
