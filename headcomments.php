<html lang="en" > <!--this declares english language as the primary -->
<head>
  <title>Teacher</title>
  <!--these connec to bootstrap through a cdn-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script>
        function showtutorcomments(pupilid){//shows the tutor coimment of the selected pupil
          var xhttp;
          if (pupilid == "") {
            document.getElementById("tutorcomments").innerHTML = "<p> No pupil selected</p>";
            return;
          }
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("tutorcomments").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", "ajaxgettutorcomments.php?pupilid="+pupilid, true);
          xhttp.send();
        }
  </script>
  <style>
  .jumbotron {
    background-color: #444444;
    color: #fff;
  }
  select {color:#000;}
  input {color:#000;}
  </style>
  <?php
  include_once("connection.php");
  session_start();
  $userid=$_SESSION["userid"];
  ?>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="#">KHS</a>
        <li class="nav-item">
          <a class="nav-link" href="logoutscript.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
<div class="jumbotron text-center">
  <h1>Welcome</h1>
<a href="head.php" class="btn">Select another year</a>
  <div id="headcommments">
    <form action="headcommentscript.php" method="post">
      Pupil:<select onchange="showtutorcomments(this.value)" name="pupilid">
        <option value="">Select a pupil</option>
        <?php
        $year=$_POST["Year"];
        $stmt=$conn->prepare("SELECT Pupilid,Firstname,Surname,Year FROM tblpupil WHERE Year='$year' ORDER BY Surname ASC"); //returns subjectid's of subjetcs taught by teacher that logged in
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo("<option value=".$row["Pupilid"].">".$row["Firstname"]." ".$row["Surname"]."</option>");
        }
        ?>
      </select><br>
      Tutorcomments:<br>
      <p id="tutorcomments"></p>
      Comments:<input name="headcomments" type="text">
      <br>
      <input type="Submit" value="Save">
    </form>
  </div>
</div>
</body>
</html>
