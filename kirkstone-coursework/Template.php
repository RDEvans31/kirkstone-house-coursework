<html lang="en" > <!--this declares english language as the primary -->
<head>
  <title>Admin</title>
  <!--these connec to bootstrap through a cdn-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <style>
  .jumbotron {
    background-color: #444444;
    color: #fff;
  }
  </style>
</head>
<body>
<?php include_once("connection.php"); ?>
<script>
$(document).ready(function(){
  $("a").click(function(){ //already tried $(".nav-link")//what this should do is hide any other visible forms, but show the one that is being targeted by the button
    $(".form-table").hide("fast"); //this should hide all the elements that the button does not target
    var datatarget = this.attr("data-target"); //assigns the value of the attribute "data-target" of the element that called the function to the varibale datatarget
    $("#" + datatarget).show("fast");//this should show the element that is being targeted by the button
    alert(datatarget);//this is to see if the data-target is being picked up
  });
});
</script>
<nav class="navabar">
<div class="container-fluid">

 <div class="navbar-header"><a class="navbar-brand" href="http://www.kirkstonehouseschool.co.uk/">KHS</a></div>

<ul class="nav navbar-nav">
  <li class="dropdown"><a class="dropdown-toggle" id="subjectsDropdown" role="button" data-toggle="dropdown">Subjects</a><!--this is the dropdown menu title-->
    <ul class="dropdown-menu"><!--this is adds options to the dropdown menu-->
      <li><a class="nav-link" data-toggle="collapse" data-target="#addingsubject">Add</a></li>
      <li><a class="nav-link" data-toggle="collapse" data-target="#teachersubject">Assign teacher</a></li>
      <li><a class="nav-link" data-toggle="collapse" data-target="#pupilsubject">Assign pupil</a></li>
    </ul>
  </li>
  <li class="dropdown"><a class="dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown">Users</a>
    <ul class="dropdown-menu"><!--this is adds options to the dropdown menu-->
      <li><a class="nav-link" data-toggle="collapse" data-target="#addinguser">Add</a></li>
    </ul>
  </li>
  <li class="dropdown"><a class="dropdown-toggle" id="pupilDropdown" role="button" data-toggle="dropdown">Pupil</a>
    <ul class="dropdown-menu"><!--this is adds options to the dropdown menu-->
      <li><a class="nav-link" data-toggle="collapse" data-target="#addingpupil">Add</a></li>
    </ul>
  </li>
  <li class="dropdown"><a class="dropdown-toggle" id="tutorDropdown" role="button" data-toggle="dropdown">Tutor Groups</a>
    <ul class="dropdown-menu"><!--this is adds options to the dropdown menu-->
      <li><a class="nav-link" data-toggle="collapse" data-target="#tutorgroup">Assign</a></li>
    </ul>
  </li>
</ul>
</div>
</nav>
<div class="jumbotron text-center">
  <h1>Welcome *insert user in here*</h1>
</div>
</body>
</html>
