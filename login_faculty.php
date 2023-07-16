<?php

// require "dbconnect.php";


$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    include "dbconnect.php";
   
    $username =$_POST['username'];  
    $password =$_POST['password'];


    $sql = "Select * from profile where username='$username' AND password = '$password' AND role = 'faculty'"; 
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    $val = mysqli_fetch_assoc($result);
    if ($num==1){
        $login = true;

        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $val['role'];
        $_SESSION['uid'] = $val['uid'];


        echo "check1";

        if($val['role']=='faculty'){
            header("location: profile.php");
        }elseif($val['role']=='student'){
            header("location: student.php");
        }

    }
    else{
        $showError = "Invalid credentials";
    }
     
  }






?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Form Design</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link rel="stylesheet" href="./files/css/style.css">
</head>
<body> 

<?php

if($login){
    echo '<div>You are logged in </div>';
}


?>
    <div class="container">
        <div class="myCard">
            <div class="row">
                <div class="col-md-6">
                    <div class="myLeftCtn"> 
                        <form method="POST" action="/Php_learning/login_faculty.php" class="myForm text-center">
                            
                            <header>WELCOME</header>
                            <p>Sign-in by entering the information below</p>
                            <div class="form-group">
                                <i class="fas fa-user"></i>
                                <input class="myInput" type="text" name="username" placeholder="Username" id="username" > 
                            </div>

                            <!-- <div class="form-group">
                                <i class="fas fa-envelope"></i>
                                <input class="myInput" placeholder="Email" type="text" id="email" required> 
                            </div> -->

                            <div class="form-group">
                                <i class="fas fa-lock"></i>
                                <input class="myInput" type="password" id="password" placeholder="Password" name="password" > 
                            </div>

                           

                           

                            <button type="submit" name="in" class=" butt" >SIGN-IN</button>
                            <br></br>
                           
                         
                            <!-- <button class="w-100 btn btn-lg btn-primary" name='in' type="submit">Sign in</button>
      <button class="w-100 btn btn-lg btn-primary" name='up' type="submit">Sign up</button> -->
                            <!-- <input type="submit" class="butt" value="SIGN-UP"> -->
                            
                        </form>
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="myRightCtn">
                            <div class="box"><header>Hello Developer!</header>
                            
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                                sed do eiusmod tempor incididunt ut labore et dolore magna 
                                aliqua. Ut enim ad minim veniam.</p>
                                <input type="button" class="butt_out" value="Learn More"/>
                            </div>
                                
                    </div>
                </div>
            </div>
        </div>
</div>
      
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
</body>
</html>