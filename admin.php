<html lang="en" > <!--this declares english language as the primary -->
<head>
  <title>Admin</title>
  <!--these connect to bootstrap through a cdn-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-html5-1.5.4/datatables.min.css"/>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-html5-1.5.4/datatables.min.js"></script>
</head>
<body>
<?php include_once("connection.php"); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">KHS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="admin.php">Admin<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="adminforms\adminaddterms.php">Add Terms<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Subjects
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="adminforms\adminaddsubject.php">Add</a>
          <a class="dropdown-item" href="adminforms\adminassignteachertosubject.php">Assign teacher</a>
          <a class="dropdown-item" href="adminforms\adminassignpupiltosubject.php">Assign pupil</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Users
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="adminforms\adminadduser.php">Add</a>
          <a class="dropdown-item" href="adminforms\admincreatetutorgroup.php">Create a tutor group</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Pupils
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="adminforms\adminaddpupil.php">Add</a>
          <a class="dropdown-item" href="adminforms\adminassignpupiltotutorgroup.php">Assign to tutor group</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logoutscript.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
<div class="jumbotron text-center">
<h2>Admin</h2>

<h3>Users:<h3>
<table class="table table-dark table-bordered table-striped">
    <caption>List of users</caption>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First name</th>
      <th scope="col">Last name</th>
      <th scope="col">Username</th>
      <th scope="col">Password</th>
      <th scope="col">Privilege</th>
      <th scope="col">Type</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $stmt=$conn->prepare("SELECT * FROM tblusers");//this selects all sets that are associated with the subject selected.
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      switch ($row["Privilege"]) {
        case 0:
          $type="Admin";
          break;
        case 1:
          $type="User";
          break;
        case 2:
          $type="Head";
          break;
      }
      echo('<tr>
        <th scope="row">'.$row["Userid"].'</th>
        <td>'.$row["Firstname"].'</td>
        <td>'.$row["Surname"].'</td>
        <td>'.$row["Username"].'</td>
        <td>'.$row["Password"].'</td>
        <td>'.$row["Privilege"].'</td>
        <td>'.$type.'</td>
      </tr>');
    }
    ?>
  </tbody>
</table>
<h3>Pupils:</h3>
<table class="table table-dark table-bordered table-striped">
    <caption>List of pupils</caption>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First name</th>
      <th scope="col">Last name</th>
      <th scope="col">Year group</th>
      <th scope="col">Date Of Birth</th>
      <th scope="col">Midyis Score</th>

    </tr>
  </thead>
  <tbody>
    <?php
    $stmt=$conn->prepare("SELECT * FROM tblpupil");//this selects all sets that are associated with the subject selected.
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo('<tr>
        <th scope="row">'.$row["Pupilid"].'</th>
        <td>'.$row["Firstname"].'</td>
        <td>'.$row["Surname"].'</td>
        <td>'.$row["Year"].'</td>
        <td>'.$row["DoB"].'</td>
        <td>'.$row["MidScore"].'</td>
      </tr>');
    }
    ?>
  </tbody>
</table>
<h3>Subjects:</h3>
<table class="table table-dark table-bordered table-striped">
    <caption>List of subjects</caption>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Subject</th>
      <th scope="col">Content</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $stmt=$conn->prepare("SELECT * FROM tblsubject");//this selects all sets that are associated with the subject selected.
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo('<tr>
        <th scope="row">'.$row["Subjectid"].'</th>
        <td>'.$row["Subjectname"].'</td>
        <td>'.$row["Content"].'</td>
      </tr>');
    }
    ?>
  </tbody>
</table>
</div>
</body>
</html>
