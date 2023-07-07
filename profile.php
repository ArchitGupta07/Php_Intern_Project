
<?php

require "dbconnect.php";
require_once 'config.php';



// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);
  
    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    // $googleService = new Google\Service\Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    // $email =  $google_account_info->email;
    // $name =  $google_account_info->name;

    $userinfo = [

        'email' => $google_account_info['email'],
        'first_name'=> $google_account_info['givenName'],
        'last_name'=> $google_account_info['givenName'],
        'username' => $google_account_info['givenName'],
        'password' => $google_account_info['givenName'],
        'verifiedEmail' => $google_account_info['verifiedEmail'],
        // 'email' => $google_account_info->getEmail(),
        // 'first_name' => $google_account_info->getGivenName()
        // 'last_name' => $google_account_info->getGivenName()
        // 'first_name' => $google_account_info->getGivenName()
        // 'first_name' => $google_account_info->getGivenName()
        
        
       
    ];
    $sql2 = "Select * from profile where emmail = '{$userinfo['email']}'"; 
    $res2 = mysqli_query($conn,$sql2);
    
    
  
    // now you can use this profile info to create account in your website and make user logged in.
  } 
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php ");
    exit;


}




echo $_SESSION['username'];
$user = $_SESSION['username'];

$sql = "Select * from profile where username = '$user'";
$data = mysqli_query($conn, $sql);
$prof = mysqli_fetch_assoc($data);




if($_SERVER["REQUEST_METHOD"] == 'POST'){
    if(isset($_POST['uidEdit'])){
        echo 'yes';
        $username =$_POST['usernameEdit'];  
        $uid =$_POST['uidEdit'];  
        $email =$_POST['emailEdit'];
        $mobile_no =$_POST['mobileEdit'];

        $sql = "UPDATE `profile` SET `username` = '$username' , `email` = '$email' , `mobile_no` = '$mobile_no' WHERE `profile`.`uid` = $uid";
        $res = mysqli_query($conn,$sql);

        if ($user!=$username){
            header("location: login_admin.php ");

        }
        else{header("location: profile.php ");}
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
    background-color: red;
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
    
    echo '<a href="./admin.php">Go to Admin Page</a>' ;
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
$sql1 = "Select * from courses where creator = '$use'";
$p_data = mysqli_query($conn, $sql1);
// $proj = mysqli_fetch_assoc($p_data);
while($prod = mysqli_fetch_assoc($p_data)){
        echo $prod['title'] ; 
        // echo '<a href="./course.php?name=$prod['creator']">' . $prod['title'] . '</a>';
        echo '<a href="./course.php?course=' . $prod['title'] . '">' . $prod['title'] . '</a>';

        echo ", "  ;
      }
?>
</h5>

<!-- <h5>email</h5> -->
<button class="edit" id= "<?php echo $prof['uid']; ?>" href="/edit">Edit</button>

</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element)=>{
        element.addEventListener("click", (e)=>{
            console.log("edit",);
            tr = e.target.parentNode;
            username = tr.getElementsByTagName("h2")[0].innerText;
            email = tr.getElementsByTagName("h5")[0].innerText;
            mobile = tr.getElementsByTagName("h5")[1].innerText;
            console.log(username,email,mobile)

            usernameEdit.value = username;
            emailEdit.value = email;
            mobileEdit.value = mobile;
            uidEdit.value  = e.target.id;
            console.log(e.target.id)

            $('#editModal').modal('toggle');

          
        })
    })
</script>

  
  </body>s
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