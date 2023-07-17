<?php

require "dbconnect.php";
require_once 'config.php';



// // authenticate code from Google OAuth Flow
// if (isset($_GET['code'])) {
//     $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
//     $client->setAccessToken($token['access_token']);

//     // get profile info
//     $google_oauth = new Google_Service_Oauth2($client);
//     // $googleService = new Google\Service\Oauth2($client);
//     $google_account_info = $google_oauth->userinfo->get();
//     // $email =  $google_account_info->email;
//     // $name =  $google_account_info->name;

//     $userinfo = [

//         'email' => $google_account_info['email'],
//         'first_name'=> $google_account_info['givenName'],
//         'last_name'=> $google_account_info['givenName'],
//         'username' => $google_account_info['givenName'],
//         'password' => $google_account_info['givenName'],
//         'verifiedEmail' => $google_account_info['verifiedEmail'],
//         // 'email' => $google_account_info->getEmail(),
//         // 'first_name' => $google_account_info->getGivenName()
//         // 'last_name' => $google_account_info->getGivenName()
//         // 'first_name' => $google_account_info->getGivenName()
//         // 'first_name' => $google_account_info->getGivenName()



//     ];
//     $sql2 = "Select * from profile where email = '{$userinfo['email']}'"; 
//     $res2 = mysqli_query($conn,$sql2);

//     if (mysqli_num_rows($res2)>0){
//       $log = mysqli_fetch_assoc($res2);

//       $login = true;

//       session_start();
//       $_SESSION['loggedin'] = true;
//       $_SESSION['username'] = $log['username'];
//       // echo $val['uid'];
//       $_SESSION['uid'] = $log['uid'];
//       $_SESSION['role'] = $log['role'];



//     }else{

//       $sql_g = "INSERT INTO `profile` ( `first_name`, `last_name`, `username`, `email`, `password`, `location`) VALUES ( '{$userinfo['first_name']}', '{$userinfo['last_name']}', '{$userinfo['username']}', '{$userinfo['email']}', '{$userinfo['password']}', 'India')";
//       $res_g = mysqli_query($conn,$sql_g);

//       $sql2 = "Select * from profile where email = '{$userinfo['email']}'"; 

//       $res2 = mysqli_query($conn,$sql2);
//       $log = mysqli_fetch_assoc($res2);

//       $login = true;

//       session_start();
//       $_SESSION['loggedin'] = true;
//       $_SESSION['username'] = $log['username'];
//       // echo $val['uid'];
//       $_SESSION['uid'] = $log['uid'];
//       $_SESSION['role'] = $log['role'];
//     }



//     // now you can use this profile info to create account in your website and make user logged in.
//   }else{
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: index.php ");
  exit;
}




echo $_SESSION['username'];
$user = $_SESSION['username'];

$sql = "Select * from profile where username = '$user'";
$data = mysqli_query($conn, $sql);
$prof = mysqli_fetch_assoc($data);




if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  if (isset($_POST['uidEdit'])) {
    echo 'yes1';
    $username = $_POST['usernameEdit'];
    $uid = $_POST['uidEdit'];
    $email = $_POST['emailEdit'];
    $mobile_no = $_POST['mobileEdit'];

    $sql = "UPDATE `profile` SET `username` = '$username' , `email` = '$email' , `mobile_no` = '$mobile_no' WHERE `profile`.`uid` = $uid";
    $res = mysqli_query($conn, $sql);

    if ($user != $username) {
      header("location: login_admin.php ");
    } else {
      header("location: profile.php ");
    }
  } elseif (isset($_POST['course_upload'])) {
    echo 'yes2';

    $course_code = $_POST['course_code'];
    $title = $_POST['title'];
    $session_no = $_POST['session'];
    $mode = $_POST['mode'];
    $module = $_POST['module'];
    $file_name = $_FILES['myfile']['name'];
    $file_tmp_name = $_FILES['myfile']['tmp_name'];

    move_uploaded_file($file_tmp_name, "files/material/" . $file_name);


    // $sql = "UPDATE `profile` SET `username` = '$username' , `email` = '$email' , `mobile_no` = '$mobile_no' WHERE `profile`.`uid` = $uid";
    $sql = "INSERT INTO `courses` (`course_code`, `module`, `session_no`, `title`, `creator`, `mode`, `date`, `down_pdf`) VALUES ('$course_code', '$module', '$session_no', '$title', '$user', '$mode', current_timestamp(), '$file_name')";
    $res = mysqli_query($conn, $sql);


  }elseif (isset($_POST['new_eval'])) {
    
    $course = $_POST['courses'];
    $module = $_POST['modules'];
    
    
    $deadline =  date('Y-m-d',strtotime($_POST['date'])) ; 
    echo $_POST['date'];
    echo $deadline;
    $type = $_POST['type'];
    $file_name = $_FILES['myfile']['name'];
    $file_tmp_name = $_FILES['myfile']['tmp_name'];

    move_uploaded_file($file_tmp_name, "files/evaluation/" . $file_name);

    $sql = "INSERT INTO `evaluation` (`course`, `module`, `type`, `start_date`, `deadline`, `documents`) VALUES ('$course', '$module','$type', current_timestamp(), $deadline, '$file_name')";
    $res = mysqli_query($conn, $sql);
    if ($res) {
      $insertedRowId = mysqli_insert_id($conn);
  
      // Fetch the inserted row
      $fetchSql = "SELECT * FROM `evaluation` WHERE `id` = $insertedRowId";
      $fetchRes = mysqli_query($conn, $fetchSql);
  
      if ($fetchRes && mysqli_num_rows($fetchRes) > 0) {
          $prod = mysqli_fetch_assoc($fetchRes);
          // Now you can work with the fetched row
          // ...
      }
    }
    $eid = $prod['eid'];



    if($_POST['type'] =='quiz') {
      header("location: quiz_maker.php?course=$course&module=$module&eid=$eid");


    }






  }

}



?>



<!-- -------------------------------------------------------------------------------- -->

<!doctype html>
<html lang="ar" dir="rtl">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" integrity="sha384-PJsj/BTMqILvmcej7ulplguok8ag4xFTPryRq8xevL7eBYSmpXKcbNVuy+P0RMgq" crossorigin="anonymous">





  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <title>Document</title>

  <style>
    /* $body: #09000b;
    $nunito: "Nunito", sans-serif;
    $dark: #0a0a0a; */

    body {
      background-color: whitesmoke;
      font-family: "Nunito", sans-serif;
    }

    .container1 {
      padding: 100px 0;

    }

    .profile {
      max-width: 300px;
      margin: 0 auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 10px;
      position: relative;
      display: grid;
      justify-content: start;
    }

    h2 {
      color: #0a0a0a;
    }

    p {
      color: rgba(#0a0a0a, 0.8)
    }

    .image {
      width: 75px;
      height: 75px;
      background: white;
      border-radius: 50%;
      margin: 0 auto;
      position: absolute;
      right: 15px;
      top: 15px;
      transform-origin: bottom left;
      box-shadow: 0 3px 15px rgba(#0a0a0a, 0.1);
      transition: all 0.3s ease-in-out;

      /* background-image: url("https://images.unsplash.com/photo-1479936343636-73cdc5aae0c3?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=200&q=80"); */
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center center;
    }

    /* &:hover {
        .image {
        transform: scale(1.5);
        border-radius: 10px;
        }
    } */
  </style>
</head>

<body>
  <!-- Button trigger modal -->
  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

  <!-- Modal -->
  <div class="modal fade" tabindex="-1" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/Php_Learning/profile.php" method="POST">
            <input type="hidden" type="text" name="uidEdit" id="uidEdit">
            <div class="username">
              <label for="">username</label>
              <input type="text" name="usernameEdit" id="usernameEdit">
            </div>
            <div class="email">
              <label for="">email</label>
              <input type="text" name="emailEdit" id="emailEdit">
            </div>
            <div class="mobile">
              <label for="">mobile_no</label>
              <input type="text" name="mobileEdit" id="mobileEdit">
            </div>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>


  <!-- -------------------------profile-------------------------------- -->

  <div class="container1">
    <div class="profile">
      <!-- <div class="image"></div> -->

      <?php
      if ($_SESSION['role'] == 'admin') {

        echo '<a href="./admin.php">Go to Admin Page</a>';
      }
      ?>
      <h2><?php echo $_SESSION['username'] ?></h2>
      <h5> <?php echo $prof['email'] ?> </h5>
      <h5><?php echo $prof['mobile_no'] ?></h5>
      <h5> <?php echo $prof['role'] ?></h5>
      <h5> <?php echo $prof['uid'] ?></h5>
      <h5> Courses: -
        <?php
        // session_start();

        $uid1 = $_SESSION['uid'];
        $use = $_SESSION['username'];
        $sql1 = "Select distinct(course_code) from courses where creator = '$use'";
        $p_data = mysqli_query($conn, $sql1);
        // $proj = mysqli_fetch_assoc($p_data);
        while ($prod = mysqli_fetch_assoc($p_data)) {
          // echo $prod['title'] ; 
          // echo '<a href="./course.php?name=$prod['creator']">' . $prod['title'] . '</a>';
          echo '<a href="./course.php?course=' . $prod['course_code'] . '">' . $prod['course_code'] . '</a>';

          echo ", ";
        }
        ?>
      </h5>

      <!-- <h5>email</h5> -->
      <button class="edit" id="<?php echo $prof['uid']; ?>" href="/edit">Edit</button>

    </div>
  </div>
  <div class="forms d-flex">
    <div class="container1 bg-secondary border rounded p-3" style="width: 300px; margin:auto">
      <form action="/Php_Learning/profile.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="formGroupExampleInput" class="form-label">Course Code</label>
          <input type="text" class="form-control" id="course_code" name="course_code" placeholder="">
        </div>
        <div class="mb-3">
          <label for="formGroupExampleInput2" class="form-label">Module</label>
          <input type="text" class="form-control" id="module" name="module" placeholder="">
        </div>
        <div class="mb-3">
          <label for="formGroupExampleInput2" class="form-label">Session No</label>
          <input type="text" class="form-control" id="session" name="session" placeholder="">
        </div>
        <div class="mb-3">
          <label for="formGroupExampleInput2" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="">
        </div>
        <div class="mb-3">
          <label for="formGroupExampleInput2" class="form-label">Mode</label>
          <input type="text" class="form-control" id="mode" name="mode" placeholder="">
        </div>
        <div>
          <input type="file" name='myfile'>

        </div>
        <button type="submit" name="course_upload" id="course_upload">Submit</button>
      </form>


    </div>
    <div class="container1 bg-secondary border rounded p-3" style="width: 300px; margin:auto">
      <form action="/Php_Learning/profile.php" method="POST" enctype="multipart/form-data">


       
        <div class="col-md-6">
          <label for="courses" class="form-label">Course</label>
          <select id="courses" name="courses" class="form-select">

            <option selected disabled>Choose...</option>
            <?php
            $use = $_SESSION['username'];
            $courses = "Select distinct(course_code) from courses where creator = '$use'";
            $p_data = mysqli_query($conn, $courses);
            // $proj = mysqli_fetch_assoc($p_data);
            while ($core = mysqli_fetch_assoc($p_data)) {


              echo "<option id='".$core['course_code']."' value='".$core['course_code']."'>" . $core['course_code'] . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="col-md-6 py-3">
          <label for="modules" class="form-label">Module</label>
          <select id="modules" name="modules" class="form-select">

            <option selected>Choose...</option>;
            <?php
            $sql1 = "SELECT * FROM courses WHERE course_code = '" . $core['course_code'] . "'";
            $c = mysqli_query($conn, $sql1);
            // $proj = mysqli_fetch_assoc($p_data);
            while ($module = mysqli_fetch_assoc($c)) {
              echo "<option>" . $module['module'] . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="col-md-6 py-3">
          <label for="type" class="form-label">Type</label>
          <select id="type" name="type" class="form-select">

            <option selected>Choose...</option>;         
            <option>assignment</option>";   
            <option>quiz</option>";   
            
          </select>
        </div>
        <div class="col-md-2 py-3">
          <label for="date">Deadline:</label>
          <input type="date" id="date" name="date">
          
        </div>
        <div class="col-md-2 py-3">
        <input type="file" name='myfile'>
        </div>
       
        <div class="col-12">
          <button type="submit" name="new_eval" id="new_eval" class="btn btn-primary">Submit</button>
        </div>


      </form>


    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit", );
        tr = e.target.parentNode;
        username = tr.getElementsByTagName("h2")[0].innerText;
        email = tr.getElementsByTagName("h5")[0].innerText;
        mobile = tr.getElementsByTagName("h5")[1].innerText;
        console.log(username, email, mobile)

        usernameEdit.value = username;
        emailEdit.value = email;
        mobileEdit.value = mobile;
        uidEdit.value = e.target.id;
        console.log(e.target.id)

        $('#editModal').modal('toggle');


      })
    })
  </script>
<script type="text/javascript">
		$(document).ready(function(){
			$("#courses").change(function(){
				var cid = $("#courses").val();
        console.log(cid)
				$.ajax({
					url: 'related_dropdown.php',
					method: 'post',
					data: 'cid=' + cid
				}).done(function(modules){
					console.log(modules);
					modules = JSON.parse(modules);
					$('#modules').empty();
					modules.forEach(function(module){
						$('#modules').append('<option>' + module.module + '</option>')
					})
				})
			})
		})
	</script>


</body>

</html>
<!-- -------------------------------------------------------------------------------- -->



<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

<style>
    /* $body: #09000b;
    $nunito: "Nunito", sans-serif;
    $dark: #0a0a0a; */

    body {
    background-color: #09000b;
    font-family: "Nunito", sans-serif;
    }

    .container {
    padding: 100px 0;
    }

    .profile {
    max-width: 300px;
    margin: 0 auto;
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    position: relative;
    }
    h2{
        color: #0a0a0a;
    }
    
    p {
        color: rgba(#0a0a0a, 0.8)
    }
    
    .image {
        width: 75px;
        height: 75px;
        background: red;
        border-radius: 50%;
        margin: 0 auto;
        position: absolute;
        right: 15px;
        top: 15px;
        transform-origin: bottom left;
        box-shadow: 0 3px 15px rgba(#0a0a0a, 0.1);
        transition: all 0.3s ease-in-out;

        background-image: url("https://images.unsplash.com/photo-1479936343636-73cdc5aae0c3?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=200&q=80");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
    }
    
    /* &:hover {
        .image {
        transform: scale(1.5);
        border-radius: 10px;
        }
    } */
    
</style>
</head>
<body>
<div class="container">
<div class="profile">
<div class="image"></div>

<h5>email</h5>
</div>
</div>
   
</body>
</html> -->