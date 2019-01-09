<?php
require('fpdf/fpdf.php');
include_once("connection.php");

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    //$this->Image('logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(100);
    // Title
    $this->Cell(40,10,'Tutor Report',1,0,'C');
    // Line break
    $this->Ln(20);
}
}
$year=date("Y");
$pupilid=$_POST["pupilid"];
$tutorgroup=$_POST["tutorgroup"];
//this block of code will get the pupilname
$getpupilname=$conn->prepare("SELECT Firstname, Surname FROM tblpupil WHERE Pupilid='$pupilid'");
$getpupilname->execute();
$row = $getpupilname->fetch(PDO::FETCH_ASSOC);
$pupilname=$row["Firstname"].' '.$row["Surname"];//this stores the name of the pupil we are dealing with in this row of the table.
//this will get the number of commendations, merits, debits, and detentions
$totalcommendations=0;
$totalmerits=0;
$totaldebits=0;
$totaldetentions=0;
$getawards=$conn->prepare("SELECT * FROM tblpupilawards WHERE Pupilid='$pupilid'");
$getawards->execute();
while ($row = $getawards->fetch(PDO::FETCH_ASSOC)) {
  $totalcommendations=$totalcommendations+$row["Commendations"];
  $totalmerits=$totalmerits+$row["Merits"];
  $totaldebits=$totaldebits+$row["Debits"];
  $totaldetentions=$totaldetentions+$row["Detentions"];
}
//this will get the tutor comment
$getcomments=$conn->prepare("SELECT * FROM tbltutorreport WHERE Pupilid='$pupilid' AND Year='$year'");
$getcomments->execute();
$row=$getcomments->fetch(PDO::FETCH_ASSOC);
$headcomm=$row["Headcomments"];
$tutorcomm=$row["Tutorcomments"];
//this generates and formats the pdf with the given information.
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Times','',14);
$pdf->SetXY (150,30);
$pdf->Write(5,'Summer Term '.$year);


$pdf->SetXY (10,30);
$pdf->Write(5,'Name: '.$pupilname);

$pdf->SetXY (70,40);
$pdf->SetFontsize (16);
$pdf->Write(5,'Report Summary Sheet');

$pdf->SetFontsize(12);

$pdf->SetXY (42,50);
$pdf->Cell(25,10,'Merits: '.$totalmerits,1,0,'L');
$pdf->SetXY (82,50);
$pdf->Cell(25,10,'Debits: '.$totaldebits,1,0,'L');
$pdf->SetXY (122,50);
$pdf->Cell(25,10,'Detentions: '.$totaldetentions,1,0,'L');

$pdf->SetXY (10,60);
$pdf->Write(5,'Tutor comments:');
$pdf->SetXY (10,65);
$pdf->Cell(175,50,$tutorcomm,1,0,'L');

$pdf->SetXY (10,175);
$pdf->Write(5,"Head's  comments:");
$pdf->SetXY (10,180);
$pdf->Cell(180,50,$headcomm,1,0,'L');

$pdf->SetXY (10,240);
$pdf->Write(5,'Tutor:');
$pdf->SetXY (10,250);
$pdf->Write(5,'Headmistress:');
$pdf->SetXY (10,260);
$pdf->Write(5,'Principal:');
$pdf->SetXY (10,270);
$pdf->Write(5,'Autumn Term commences:');

$pdf->AddPage('L','A4');
$pdf->SetFont('Arial','',10);
$pdf->SetXY (10,40);
$pdf->Cell(40,5,'Name: '.$pupilname,1,0,'L');
$pdf->SetXY (50,40);
$pdf->Cell(40,5,'Tutor group: '.$tutorgroup,1,0,'L');

$pdf->SetXY (50,45);
$pdf->SetFont('Arial','',7);
$xcoord=50;
$terms=array('Autumn 1','Autumn 2','Spring 1','Spring 2','Summer 1','Summer 2');
foreach ($terms as $i) {
  $pdf->Cell(40,5,$i,1,0,'C');
  $xcoord=$xcoord+40;
  $pdf->SetXY ($xcoord,45);
}

$pdf->SetXY (10,50);
$headers=array('Subject','Target','Grade','Effort','Grade','Effort','Grade','Effort','Grade','Effort','Grade','Effort','Grade','Effort');
$xcoord=10;
//this creates the table headers
foreach ($headers as $i) {
  $pdf->Cell(20,5,$i,1,0,'C');
  $xcoord=$xcoord+20;
  $pdf->SetXY ($xcoord,50);
}
//this creates the rest of the table by looping through each row , and then I used a loop to create the cells for each row.
$pdf->SetXY (10,55);
$xcoord=10;
$ycoord=55;
$stmt=$conn->prepare("SELECT * FROM tblpupilstudies WHERE Pupilid='$pupilid'");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // for each of these records, I will print out the data but also get the subjectname based on the subject id of the record
    $setid=$row["Setid"];
    $getsubjectid=$conn->prepare("SELECT Subjectid FROM tblset WHERE Setid='$setid'");
    $getsubjectid->execute();
    $subjectid = $getsubjectid->fetch(PDO::FETCH_COLUMN);
    $getsubjectname=$conn->prepare("SELECT Subjectname FROM tblsubject WHERE Subjectid='$subjectid'");
    $getsubjectname->execute();
    $row2 = $getsubjectname->fetch(PDO::FETCH_ASSOC);
    $subjectname=$row2["Subjectname"];
    //this creates an array with the contents of the row.
    $tablerow=array($subjectname,$row["Target"],$row["Autumn1A"],$row["Autumn1E"],$row["Autumn2A"],$row["Autumn2E"],
    $row["Spring1A"],$row["Spring1E"],$row["Spring2A"],$row["Spring2E"],
    $row["Summer1A"],$row["Summer1E"],$row["Summer2A"],$row["Summer2E"]);
    //this loops through each element in the array and outputs it as a cell
    foreach ($tablerow as $data) {
      $pdf->Cell(20,5,$data,1,0,'C');
      $xcoord=$xcoord+20;
      $pdf->SetXY ($xcoord,$ycoord);
    }
    $xcoord=10;
    $ycoord=$ycoord+5;
    $pdf->SetXY ($xcoord,$ycoord);
  }
//this gets the commendations, merits, debits, and Detentions
$commendations=array('Autumn1'=>0,'Autumn2'=>0,'Spring1'=>0,'Spring2'=>0,'Summer1'=>0,'Summer2'=>0);
$merits=array('Autumn1'=>0,'Autumn2'=>0,'Spring1'=>0,'Spring2'=>0,'Summer1'=>0,'Summer2'=>0);
$debits=array('Autumn1'=>0,'Autumn2'=>0,'Spring1'=>0,'Spring2'=>0,'Summer1'=>0,'Summer2'=>0);
$detentions=array('Autumn1'=>0,'Autumn2'=>0,'Spring1'=>0,'Spring2'=>0,'Summer1'=>0,'Summer2'=>0);
$stmt=$conn->prepare("SELECT * FROM tblpupilawards WHERE Pupilid='$pupilid'");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $term=$row["Term"];
  $commendations[$term]=$row["Commendations"];
  $detentions[$term]=$row["Detentions"];
  $merits[$term]=$row["Debits"];
  $debits[$term]=$row["Merits"];
}
$cmdd=array('Merits','Commendations','Debits','Detentions');
// X and Y coords are already set from previous
foreach ($cmdd as $i) {
  $pdf->Cell(20,5,$i,1,0,'C');
  $ycoord=$ycoord+5;
  $pdf->SetXY ($xcoord,$ycoord);
}
//next column
$xcoord=$xcoord+20;
$ycoord=$ycoord-20;
$pdf->SetXY ($xcoord,$ycoord);
for ($i=1; $i<5 ; $i++) {
  $pdf->Cell(20,5,'',1,0,'C');
  $ycoord=$ycoord+5;
  $pdf->SetXY ($xcoord,$ycoord);
}
$xcoord=$xcoord+20;
$ycoord=$ycoord-20;
$pdf->SetXY ($xcoord,$ycoord);
//
foreach ($merits as $i) {
  $pdf->Cell(40,5,$i,1,0,'C');
  $xcoord=$xcoord+40;
  $pdf->SetXY ($xcoord,$ycoord);
}
$xcoord=$xcoord-240;
$ycoord=$ycoord+5;
$pdf->SetXY ($xcoord,$ycoord);
foreach ($commendations as $i) {
  $pdf->Cell(40,5,$i,1,0,'C');
  $xcoord=$xcoord+40;
  $pdf->SetXY ($xcoord,$ycoord);
}
$xcoord=$xcoord-240;
$ycoord=$ycoord+5;
$pdf->SetXY ($xcoord,$ycoord);
foreach ($debits as $i) {
  $pdf->Cell(40,5,$i,1,0,'C');
  $xcoord=$xcoord+40;
  $pdf->SetXY ($xcoord,$ycoord);
}
$xcoord=$xcoord-240;
$ycoord=$ycoord+5;
$pdf->SetXY ($xcoord,$ycoord);
foreach ($detentions as $i) {
  $pdf->Cell(40,5,$i,1,0,'C');
  $xcoord=$xcoord+40;
  $pdf->SetXY ($xcoord,$ycoord);
}

$pdf->Output();

?>
