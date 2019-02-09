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
  <h3>Add a commendation, merit, debit, or detention</h3>
<div>
  <form name="cmddform" action="scripts/cmddscript.php" method="post">
      Pupil:<select name="pupilid">
        <?php
        $stmt=$conn->prepare("SELECT * FROM tblpupil ORDER BY Surname ASC");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo("<option value=".$row["Pupilid"].">".$row["Surname"].", ".$row["Firstname"]."</option>");
        }
        ?>
      </select>
      <br><!--select a pupil, all pupils are available for selection as any teacher may want to give any pupil an award (or punishemnt)-->
      <input type="radio" id="commendation" name="award" value="Commendations">
       <label for="commendation">Commendation</label>
      <input type="radio" id="merit" name="award" value="Merits">
       <label for="merit">Merit</label>
      <input type="radio" id="debit" name="award" value="Debits">
       <label for="debit">Debit</label>
      <input type="radio" id="detention" name="award" value="Detentions">
       <label for="detention">Detention</label>
      <br>
  <input type="Submit" value="Add">
  </form>
</div>

</body>
</html>
