<?php
require "dbconnect.php";
// echo $_GET['course'];
session_start();

$user = $_SESSION['uid'];
echo $user;
$query5 = "Select * from courses where cid = '4' ";
$result5 = mysqli_query($conn, $query5);
$core = mysqli_fetch_assoc($result5);

echo $core['down_pdf'];

?>