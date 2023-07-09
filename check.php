<?php
require "dbconnect.php";
echo $_GET['course'];
session_start();

$c = $_GET['course'];

$user = $_SESSION['uid'];
echo $user;
$query5 = "Select * from courses where cid = $c ";
$result5 = mysqli_query($conn, $query5);
$core = mysqli_fetch_assoc($result5);

echo $core['down_pdf'];

$file = "files/material/".$core['down_pdf']; 
// $file = "check.txt"; 

echo $file;

header('Content-Description: File Transfer');

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file) . '"');

echo basename($file);

header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
// header('Content-Length: ' . filesize($file));

echo "  ";

echo filesize($file);



readfile($file, true);
exit; 

?>