<html lang="en" > <!--this declares english language as the primary -->
<head>
  <title>Teacher</title>
  <!--these connec to bootstrap through a cdn-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
  <h3>Enter grades for each pupil</h3>
<div id="entergrades">
  <form name="entergradesform" action="scripts/entergradesscript.php" method="post">
    Set:<select onchange="showPupilsinset(this.value)" name="set">
    <option value="">Select a set</option>
    <?php
    $stmt=$conn->prepare("SELECT Setid FROM tblset WHERE Userid='$userid'"); //returns sets taught by teacher that logged in
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo("<option value=".$row["Setid"].">".$row["Setid"]."</option>");
    }
    ?>
    </select><br>
    Pupil: <select id="selectpupil" name="pupilid"></select><br>
    Term:<select name="term">
      <option value="Autumn1">Autumn 1</option>
      <option value="Autumn2">Autumn 2</option>
      <option value="Spring1">Spring 1</option>
      <option value="Spring2">Spring 2</option>
      <option value="Summer1">Summer 1</option>
      <option value="Summer2">Summer 2</option>
    </select><br>
    Target:<input type="text" name="target" placeholder="fill only if neccessary"><br>
    Effort:<input type="text" name="effort"><br>
    Achieve:<input type="text" name="achieve"><br>
    <input type="Submit" value="Assign">
  </form>
</div>

</body>
</html>
