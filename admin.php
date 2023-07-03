<?php

require "dbconnect.php";
session_start();
// echo $_SESSION['role'];

if(!isset($_SESSION['role']) || $_SESSION['role']!='admin'){
  // echo "Welcome ".$_SESSION['username'];
  header("location: profile.php");
    // exit;
}
// else{
//   header("location: profile.php");
// }

if($_SERVER["REQUEST_METHOD"] == 'POST'){
  if(isset($_POST['uidEdit'])){
      echo 'yes';
      $first_name =$_POST['firstEdit'];  
      $last_name =$_POST['lastEdit'];  
      $uid =$_POST['uidEdit'];  
      $email =$_POST['emailEdit'];
      $role =$_POST['roleEdit'];

      $sql = "UPDATE `profile` SET `first_name` = '$first_name',`last_name` = '$last_name' , `email` = '$email' , `role` = '$role' WHERE `profile`.`uid` = $uid";
      $res = mysqli_query($conn,$sql);

      header("location: admin.php ");
}

else{
  if(isset($_POST['firstsort'])){
  $first_name = $_POST['firstsort'];



  

  // $sql = "Select * from profile where first_name == '$first_name'";
  // $fetch = mysqli_query($conn, $sql); 
  // }
  // else{
  //   $user = $_SESSION['username'];
  //   $sql = "Select * from profile where username != '$user'";
  //   $fetch = mysqli_query($conn, $sql);
    

  }
}
}



?>

<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" integrity="sha384-PJsj/BTMqILvmcej7ulplguok8ag4xFTPryRq8xevL7eBYSmpXKcbNVuy+P0RMgq" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <title></title>
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
        <form action="/Php_Learning/admin.php" method="POST">
            <input type="hidden" type="text" name="uidEdit" id="uidEdit">
            <div class="first_name">
                <label for="">First Name</label>
                <input type="text" name="firstEdit" id="firstEdit">
            </div>
            <div class="last_name">
                <label for="">Last name</label>
                <input type="text" name="lastEdit" id="lastEdit">
            </div>
            <div class="email">
            <label for="">email</label>
                <input type="text" name="emailEdit" id="emailEdit">
            </div>
            <div class="role">
            <label for="">Role</label>
                <input type="text" name="roleEdit" id="roleEdit">
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
    
<!-- ---------------------Table -------------------- -->
  <div class="container">
   
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.no</th>
          <th scope="col">First_Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
          <th scope="col">Actions</th>
          
        </tr>
      </thead>
      <tbody>
      <?php

    $user = $_SESSION['username'];

    $sql = "Select * from profile where username != '$user'";
    $data = mysqli_query($conn, $sql);

    while($prof = mysqli_fetch_assoc($data)){
    echo " <tr>
    <th scope='row'>" . $prof['uid'] ." </th>;
    <td>" . $prof['first_name'] . "</td>
    <td>" . $prof['last_name'] . "</td>
    <td>" . $prof['email'] . "</td>
    <td>" . $prof['role'] . "</td>
    <td>  <button class='edit' id= '".$prof['uid']."' href='/edit'>Edit</button> </td>
    </tr>" ;


    
      
    }



    ?>
      
      
      
      </tbody>
    </table>
</div>

<hr>
<br>
<br>
<br>
<hr>

<!-- ----------------------fetching data by name--------------------------- -->
  <div class="container bg-secondary border rounded">
  <form action="/Php_Learning/admin.php" method="POST">
   
    <table class="table" id="myTable2">
      <thead>
        <tr>
          <th scope="col">S.no</th>
          <th scope="col">First_Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
          <!-- <th scope="col">Actions</th> -->
          
        </tr>
      </thead>
      <tbody>
      <?php      
       if((isset($_POST['firstsort'])) && ($_POST['firstsort']!='') && ($_POST['criteria']!='')){

        $criteria = $_POST['criteria'];
        $first_name = $_POST['firstsort'];

        echo $first_name;
      
      
        
      
        $sql = "Select * from profile where $criteria = '$first_name'";
        $fetch = mysqli_query($conn, $sql); 
        }
        else{
          $user = $_SESSION['username'];
          $sql = "Select * from profile where username != '$user'";
          $fetch = mysqli_query($conn, $sql);
          
      
        }

        while($prof1 = mysqli_fetch_assoc($fetch)){
        echo " <tr>
        <th scope='row'>" . $prof1['uid'] ." </th>;
        <td>" . $prof1['first_name'] . "</td>
        <td>" . $prof1['last_name'] . "</td>
        <td>" . $prof1['email'] . "</td>
        <td>" . $prof1['role'] . "</td>
        
        </tr>" ;    
      }
      ?>     
      </tbody>
    </table>
    <form action="/Php_Learning/admin.php" method="POST">

    <h5>Sort By</h5>
        <div class="criteria">
            <label for="">Criteria</label>
            <input type="text" name="criteria" id="criteria">
        </div>

        <div class="first_name">
            <label for="">Value</label>
            <input type="text" name="firstsort" id="firstsort">
        </div>
        <button type="submit" class="btn btn-primary">Sort</button>
    </form>
</div>
    
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
   

    <script>

      $(document).ready(function(){
        $('#myTable').DataTable();
      });

    </script>
    <!-- <script>

      $(document).ready(function(){
        $('#myTable2').DataTable();
      });

    </script> -->



    <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element)=>{
        element.addEventListener("click", (e)=>{
            console.log("edit",e.target.parentNode.parentNode);
            tr = e.target.parentNode.parentNode;
            first_name = tr.getElementsByTagName("td")[0].innerText;
            last_name = tr.getElementsByTagName("td")[1].innerText;
            email = tr.getElementsByTagName("td")[2].innerText;
            role = tr.getElementsByTagName("td")[3].innerText;
            console.log(first_name,last_name,email,role)

            firstEdit.value = first_name;
            lastEdit.value = last_name;
            emailEdit.value = email;
            roleEdit.value = role;
            uidEdit.value  = e.target.id;
            console.log(e.target.id)

            $('#editModal').modal('toggle');          
        })
    })
</script>


    
  </body>
</html>


