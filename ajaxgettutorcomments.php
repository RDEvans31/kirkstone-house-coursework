<?php
include_once("connection.php");
$pupilid = intval($_GET['pupilid']);
$Year=date("Y");//this is the calendar year
$stmt=$conn->prepare("SELECT * FROM tbltutorreport WHERE Pupilid='$pupilid' AND Year='$Year'");//this selects all sets that are associated with the subject selected.
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
  echo($row["Tutorcomments"]);//this prints the tutor comments for the selected pupil
}
?>
