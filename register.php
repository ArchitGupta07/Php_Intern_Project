<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Registration Form | CodingLab </title>
    <link rel="stylesheet" href="./files/css/register.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
    
<?php

echo "hello world";

$servername = "localhost";
$username = "root";
$password = "";
$database = "scratch";

$conn = mysqli_connect($servername,$username,$password,$database);

$last_name ="";
$email ="";
$location ="";
$first ="check1";

$username ="";


$password ="check1";


if($_SERVER["REQUEST_METHOD"] == 'POST'){
  $first =$_POST['first_name'];
  $last_name =$_POST['last_name'];
  $username =$_POST['username'];
  $email =$_POST['email'];
  $location =$_POST['location'];
  $password =$_POST['password'];
  // $image =$_POST['image'];


}

if(!$conn){

  die("Sorry we failed to connect: ". mysqli_connect_errno());
}
else{
  echo "Connection was Successfull<br>";


  $sql = "INSERT INTO `profile` (`first_name`, `last_name`, `username`, `email`, `password`, `location`) VALUES ( '$first', '$last_name', '$username', '$email', '$password', '$location')";

  $result = mysqli_query($conn,$sql);

  if($result){
    echo "The record has been inserted successfully!<br>";
  }
  else{
    echo "<br>the record was not inserted successfully because of this error ---> ".mysqli_error($conn);
  }


  

}
?>



  <div class="container">
    <div class="title">Registration</div>
    <div class="content">
      <form method="POST" action="register.php" enctype="multipart/form-data">
       
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name</span>            
            <input type="text" class="form-control" name="first_name"  placeholder="First Name" required>
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" name="username" class="form-control" placeholder="Username" required>
          </div>
          <div class="input-box">
            <span class="details">Location</span>
            <input type="text" name="location"  class="form-control" placeholder="Location" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email"  name="email"  class="form-control" placeholder="Email" required>
          </div>
          <!-- <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" placeholder="Enter your number" required>
          </div> -->

          <div class="input-box">
            <span class="details">Password</span>
            <input type="text" class="form-control" name="password" placeholder="Password" required>
          </div>
          <!-- <div class="input-group custom-file-button mb-3">	
            <span class="details" style="font-weight: 500;"> Profile Pic : </span>
            <input type="file" id="inputGroupFile" name="image" >
        </div> -->
          
        </div>
      
      </form>
    </div>
  </div>

</body>
</html>