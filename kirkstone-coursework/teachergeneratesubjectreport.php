<?php
require('fpdf/fpdf.php');
include_once("connection.php");
class PDF extends FPDF
{
// Page header
function Header()
{
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(50,10,'Subject report',1,0,'C');
    // Line break
    $this->Ln(20);
}
}
//get the term
$year=date("Y");
$date=date("Y-m-d");
$getterm=$conn->prepare("SELECT * FROM tblterms");
$getterm->execute();
while ($row = $getterm->fetch(PDO::FETCH_ASSOC)) {
  if ($date>$row["Datestart"] and $date<$row["Dateend"]) {
    $term=$row["Term"];
  }
}
$pupilid=$_POST["pupilid"];
$setid=$_POST["setid"];
//this block of code will get the pupilname and year
$getpupilname=$conn->prepare("SELECT Firstname, Surname, Year FROM tblpupil WHERE Pupilid='$pupilid'");
$getpupilname->execute();
while ($row = $getpupilname->fetch(PDO::FETCH_ASSOC)) {
    $pupilname=$row["Firstname"].' '.$row["Surname"];
    $pupilyear=$row["Year"];//this stores the pupilname of the pupil we are dealing with in this row of the table.
}
//this block of code will  get all the information about the subject required for the report.
$stmt=$conn->prepare("SELECT Subjectid FROM tblset WHERE Setid='$setid'");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $subjectid=$row["Subjectid"];
}
$getsubjectinfo=$conn->prepare("SELECT Subjectname, Content FROM tblsubject WHERE Subjectid='$subjectid'");
$getsubjectinfo->execute();
while ($row = $getsubjectinfo->fetch(PDO::FETCH_ASSOC)) {
    $subject=$row["Subjectname"];
    $coursecontent=$row["Content"];
}
//this block of code will retreive their attainment and effort for the current term from tblpupilstudies
$attainmentcolumn=$term."A";
$effortcolumn=$term."E";
echo("SELECT $attainmentcolumn AS A, $effortcolumn AS E FROM tblpupilstudies WHERE Setid=:setid AND Pupilid=:pupilid");
$getperformance=$conn->prepare("SELECT $attainmentcolumn AS A, $effortcolumn AS E FROM tblpupilstudies WHERE Setid=:setid AND Pupilid=:pupilid");
$getperformance->execute();
while ($row = $getperformance->fetch(PDO::FETCH_ASSOC)) {
    $attainment=$row[A];
    $effort=$row[E];
}
echo("Attainment:".$attainment);
echo("<br>");
echo("Effort: ".$effort);

//this generates and formats the pdf with the given distribution.
/*
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->SetXY (10,30);
$pdf->Write(5,'Term: '.$term.' '.$year);


$pdf->SetXY (10,40);
$pdf->SetFontSize(10);
$pdf->Write(5,'Name: '.$pupilname);

$pdf->SetXY (160,30);
$pdf->SetFontSize(10);
$pdf->Write(5,'Subject: '.$subject);

$pdf->SetXY (160,40);
$pdf->SetFontSize(10);
$pdf->Write(5,'Year: '.$pupilyear);

$pdf->SetXY (10,70);
$pdf->Cell(175,50,$coursecontent,1,0,'C');

$pdf->SetXY (10,130);
$pdf->Cell(20,10,'Attainment:'.$attainment,1,0,'C');
$pdf->SetXY (10,140);
$pdf->Cell(20,10,'Effort:'.$effort,1,0,'C');

$pdf->Output();
*/
?>
