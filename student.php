<?php
require "dbconnect.php";
require_once 'config.php';
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

        h2 {
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

    <div class="check" style="display: flex;">
        <div class="container1 bg-secondary border rounded p-3 float-right" style="width: 300px; margin:auto">
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
                    <?php
                   echo ' <label for="cars">Choose a car:</label>
                    <select name="cars" id="cars">
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="mercedes">Mercedes</option>
                        <option value="audi">Audi</option>
                    </select>';

                    ?>
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

        <div class="container ">

            <table class="table " id="myTable">
                <thead>
                    <tr>
                        <th scope="col">Type</th>
                        <th scope="col">Submit</th>
                        <th scope="col">Start</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Marks</th>
                        <th scope="col">Documents</th>







                    </tr>
                </thead>
                <tbody>
                    <?php
                    $user = $_SESSION['username'];
                    $sql = "Select * from evaluation";
                    $data = mysqli_query($conn, $sql);
                    while ($prof = mysqli_fetch_assoc($data)) {
                        echo " <tr>
                                        <th scope='row'>" . $prof['type'] . " </th>;
                                        <td>  <button class='submit' id= '" . $prof['eid'] . "' href='/edit'>Edit</button> </td>
                                        <td>" . $prof['start_date'] . "</td>
                                        <td>" . $prof['deadline'] . "</td>
                                        <td>18</td>
                                        
                                        <td>  <button class='down_assign' id= '" . $prof['eid'] . "' href='/edit'>down_assign</button> </td>
                                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"> </script>

    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        // jQuery.noConflict();
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    
    
    
    
    <script>
    
    edits = document.getElementsByClassName('down_assign');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("down_assign");

        var ex = e.target.id;
        console.log(ex);

        $('#editModal').modal('toggle');


      });

    });

      

    </script>


</body>

</html>