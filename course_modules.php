<?php

require "dbconnect.php";
session_start();

$course = $_POST['course'];
$module = $_POST['module'];

echo $module;

$user = $_SESSION['uid'];


$sql = "SELECT * FROM courses WHERE module = '$module' AND course_code = '$course' ";
$data = mysqli_query($conn, $sql);



while ($prof = mysqli_fetch_assoc($data)) {
//   $check = "SELECT * FROM attendance WHERE uid = '$user' AND cid = '" . $prof['cid'] . "'";
  echo " <tr>
          <th scope='row'>" . $prof['session_no'] . " </th>;
          <td>" . $prof['title'] . "</td>
          <td>" . $prof['mode'] . "</td>

          
          
          <td>  <button id='" . $prof['cid'] . "' class='edit'>Download Pdf</button> </td>
          
          
          </tr>";
}

?>