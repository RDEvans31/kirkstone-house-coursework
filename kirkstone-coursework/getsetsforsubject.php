<html>
<head>
</head>
<body>
<?php
include_once("connection.php");
$subjectid = intval($_GET['subjectid']);
$stmt=$conn->prepare("SELECT * FROM tblset WHERE Subjectid='$subjectid'");//this selects all sets that are associated with the subject selected.
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
  echo('<option value='.$row["Setid"].'>'.$row["Setid"].'</option>');//this prints them as options
}
?>
</body>
</html>
