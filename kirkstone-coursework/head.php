<html lang="en" > <!--this declares english language as the primary -->
<head>
  <title>Teacher</title>
  <!--these connec to bootstrap through a cdn-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
<nav class="navabar">
<div class="container-fluid">

 <div class="navbar-header"><a class="navbar-brand" href="http://www.kirkstonehouseschool.co.uk/">KHS</a></div>


</nav>
<div class="jumbotron text-center">
  <h1>Welcome</h1>

</div>
</body>
</html>
