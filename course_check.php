<?php
require "dbconnect.php";
echo $_GET['course'];
session_start();

$c = $_GET['course'];


if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    echo 'yes';
    if (isset($_POST['attendance'])) {
      
      echo 'yes1';
      $attendance = $_POST['attendance'];
      $cid = $_POST['cid'];
      $reason = $_POST['reason'];
  
  
      $query1 = "Select * from attendance where student_id = '$user' AND cid = '$cid' ";
      $result1 = mysqli_query($conn, $query1);
  
      
      
  
      if (mysqli_num_rows($result1) == 0) {
        // The query result is empty
        echo 'Query result is empty.';
        $query2 = "INSERT INTO `attendance` (`cid`, `student_id`, `attended`, `reason`) VALUES ('$cid', '$user', '$attendance', '$reason')";
        $result2 = mysqli_query($conn, $query2);
        // $query3 = "Select * from attendance where student_id = '$user' AND cid = '$cid' ";     
        // $result3 = mysqli_query($conn, $query3); 
    //     if($attendance!=1) {     
    //       $query5 = "SELECT * FROM courses WHERE cid = '$cid'";
    //       $result5 = mysqli_query($conn, $query5);
    //       $core = mysqli_fetch_assoc($result5);
  
    //       echo $core['down_pdf'];
  
         
    //       $file = "files/material/".$core['down_pdf']; 
    //       // $file = "check.txt"; 
  
    //       echo $file;
  
    //       header('Content-Description: File Transfer');
  
    //       header('Content-Type: application/octet-stream');
    //       header('Content-Disposition: attachment; filename="' . basename($file) . '"');
  
    //       echo basename($file);
  
    //       header('Expires: 0');
    //       header('Cache-Control: must-revalidate');
    //       header('Pragma: public');
    //       header('Content-Length: ' . filesize($file));
    //       // header('Content-Length: ' . filesize($file));
  
    //       echo "  ";
  
    //       echo filesize($file);
    //       readfile($file);
    //       ini_set('display_errors', 1);
    //       ini_set('display_startup_errors', 1);
    //       error_reporting(E_ALL);
    //       exit; 
    //     }
  
  
       
  
  
      } 
    } elseif(isset($_POST['feedback'])) {
      echo 'yes2';
      $feedback = $_POST['feedback'];
      $cid = $_POST['cid'];
  
      $query3 = "INSERT INTO `feedback` (`uid`, `cid`, `feedback`) VALUES ('$user', '$cid', '$feedback')";
      $result3 = mysqli_query($conn, $query3);
  
  
      
  
  
  
    }
  }






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