<?php
require "dbconnect.php";
require_once 'config.php';
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: index.php ");
    exit;
}

// echo $_SESSION['username'];
$user = $_SESSION['username'];

$sql = "Select * from profile where username = '$user'";
$data = mysqli_query($conn, $sql);
$prof = mysqli_fetch_assoc($data);



if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    echo "Quiz";
    if (isset($_POST['quiz_end'])) {

        echo "Quiz";

        $postData = $_POST;
        foreach ($postData as $key => $value) {
            // Process each key-value pair as needed
            echo $key . ': ' . $value . '<br>';
        }
    }
}


?>



<!DOCTYPE html>
<html>

<head>
    <title>Login Form Design</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="./files/css/font.css">

    <title></title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"> </script>

    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        // jQuery.noConflict();
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#courses").change(function() {
                var cid = $("#courses").val();
                console.log(cid)
                $.ajax({
                    url: 'related_dropdown.php',
                    method: 'post',
                    data: 'cid=' + cid
                }).done(function(modules) {
                    console.log(modules);
                    modules = JSON.parse(modules);
                    $('#modules').empty();
                    $('#modules').append('<option>Choose...</option>')
                    modules.forEach(function(module) {

                        $('#modules').append('<option>' + module.module + '</option>')
                    })
                })
            })
        })
    </script>


    <style>
        /* $body: #09000b;
    $nunito: "Nunito", sans-serif;
    $dark: #0a0a0a; */

        body {
            background-color: white;
            font-family: "Nunito", sans-serif;
        }

        .container1 {
            padding: 100px 0;

        }

        .profile {
            max-width: 800px;
            margin: 0 auto;
            background-color: #b073ed;
            background-color: #27d1bd;
            padding: 30px;
            border-radius: 30px;
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


    /* ----------------UPdates--------------------- */
    
    </style>
</head>

<body>
    <?php include "./fixed_assets/navbar.php"; ?>

    <!-- ------------------------Quiz Modal---------------------------------- -->

    <!-- <div class="modal fade" tabindex="-1" id="quizModal" tabindex="-1" aria-labelledby="quizModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="quizModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="./student.php ?> " method="POST">

                        <div class="container mb-5">
                            <div class="row">
                                <div class="col-12">
                                    <p class="fw-bold mt-5">2. Complete the following sentences:Alice couldn't _______ the humilation any longer and stormed out of the room red as a bed</p>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-6"> <input type="radio" name="box" id="five"> <label for="five" class="box fifth w-100">
                                                    <div class="course"> <span class="circle"></span> <span class="subject">is</span> </div>
                                                </label> </div>
                                            <div class="col-md-6"> <input type="radio" name="box" id="six"> <label for="six" class="box sixth w-100">
                                                    <div class="course"> <span class="circle"></span> <span class="subject"> was </span> </div>
                                                </label> </div>
                                            <div class="col-md-6"> <input type="radio" name="box" id="seven"> <label for="seven" class="box seveth w-100">
                                                    <div class="course"> <span class="circle"></span> <span class="subject"> will </span> </div>
                                                </label> </div>
                                            <div class="col-md-6"> <input type="radio" name="box" id="eight"> <label for="eight" class="box eighth w-100">
                                                    <div class="course"> <span class="circle"></span> <span class="subject"> None of the above </span> </div>
                                                </label> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p class="fw-bold mt-5">2. Complete the following sentences:Alice couldn't _______ the humilation any longer and stormed out of the room red as a bed</p>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-6"> <input type="radio" name="box" id="five"> <label for="five" class="box fifth w-100">
                                                    <div class="course"> <span class="circle"></span> <span class="subject">is</span> </div>
                                                </label> </div>
                                            <div class="col-md-6"> <input type="radio" name="box" id="six"> <label for="six" class="box sixth w-100">
                                                    <div class="course"> <span class="circle"></span> <span class="subject"> was </span> </div>
                                                </label> </div>
                                            <div class="col-md-6"> <input type="radio" name="box" id="seven"> <label for="seven" class="box seveth w-100">
                                                    <div class="course"> <span class="circle"></span> <span class="subject"> will </span> </div>
                                                </label> </div>
                                            <div class="col-md-6"> <input type="radio" name="box" id="eight"> <label for="eight" class="box eighth w-100">
                                                    <div class="course"> <span class="circle"></span> <span class="subject"> None of the above </span> </div>
                                                </label> </div>
                                        </div>
                                    </div>
                                </div>
                                
                               
                                <div class="col-12">
                                    <div class="d-flex justify-content-center"> <button class=" quiz_submit btn btn-primary px-4 py-2 fw-bold"> continue</button> </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div> -->

   

    <!-- -----------------------------Profile------------------------------ -->

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


            <!-- <h5>email</h5> -->
            <button class="edit" id="<?php echo $prof['uid']; ?>" href="/edit">Edit</button>

        </div>
    </div>

    <hr>
     <!-- -------------Updates------------------- -->
     <div class="my-3 p-3 bg-body border rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">Recent updates</h6>
        <div class="d-flex text-body-secondary pt-3">
          <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
          <p class="pb-3 mb-0 small lh-sm border-bottom">
            <strong class="d-block text-gray-dark">@username</strong>
            Some representative placeholder content, with some information about this user. Imagine this being some sort of status update, perhaps?
          </p>
        </div>
        <div class="d-flex text-body-secondary pt-3">
          <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#e83e8c"/><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text></svg>
          <p class="pb-3 mb-0 small lh-sm border-bottom">
            <strong class="d-block text-gray-dark">@username</strong>
            Some more representative placeholder content, related to this other user. Another status update, perhaps.
          </p>
        </div>
        <div class="d-flex text-body-secondary pt-3">
          <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#6f42c1"/><text x="50%" y="50%" fill="#6f42c1" dy=".3em">32x32</text></svg>
          <p class="pb-3 mb-0 small lh-sm border-bottom">
            <strong class="d-block text-gray-dark">@username</strong>
            This user also gets some representative placeholder content. Maybe they did something interesting, and you really want to highlight this in the recent updates.
          </p>
        </div>
        <small class="d-block text-end mt-3">
          <a href="#">All updates</a>
        </small>
      </div>
    <hr>
    <hr>
    <center>
        <h3>Your Evaluations</h3>
    </center>
    <hr>

    <div class="check" style="display: flex; padding:20px">
        <div class="container1  p-3 float-right" style="width: 300px; margin:auto; background-color: #8ba9ed; border-radius: 20px;">
            <form action="/Php_Learning/student.php" method="POST" enctype="multipart/form-data">
                <div class="col-md-6">
                    <label for="courses" class="form-label">Course</label>
                    <select id="courses" name="courses" class="form-select">

                        <option selected disabled>Choose...</option>
                        <?php
                        $use = $_SESSION['username'];
                        $courses = "Select distinct(course_code) from courses";
                        $p_data = mysqli_query($conn, $courses);
                        // $proj = mysqli_fetch_assoc($p_data);
                        while ($core = mysqli_fetch_assoc($p_data)) {


                            echo "<option id='" . $core['course_code'] . "' value='" . $core['course_code'] . "'>" . $core['course_code'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 py-3">
                    <label for="modules" class="form-label">Module</label>
                    <select id="modules" name="modules" class="form-select">

                        <option selected>Choose...</option>;

                    </select>
                </div>

                <center>

                    <button type="submit" name="eval_select" id="eval_select">Submit</button>
                </center>
            </form>


        </div>

        <div class="container" style="border: hidden ; border-radius: 20px; padding:20px; margin:20px; background-color: #caa2f1;">

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

                    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                        echo "Quiz";
                        if (isset($_POST['eval_select'])) {
                            $course = $_POST['courses'];
                            $module = $_POST['modules'];



                            $user = $_SESSION['uid'];
                            $sql = "Select * from evaluation where course='$course' AND module='$module'";
                            $data = mysqli_query($conn, $sql);
                        }
                    } else {
                        $user = $_SESSION['uid'];
                        $sql = "Select * from evaluation";
                        $data = mysqli_query($conn, $sql);
                    }



                    $currentDate = date('Y-m-d');
                    // echo $currentDate;
                    while ($prof = mysqli_fetch_assoc($data)) {

                        $sql5 = "Select * from marks where student_id='$user' and eid='" . $prof['eid'] . "'";
                        $data5 = mysqli_query($conn, $sql5);
                        $marks = mysqli_fetch_assoc($data5);
                        $num = mysqli_num_rows($data5);



                        echo " <tr>
                                <th scope='row'>" . $prof['type'] . " </th>";

                        if ($prof['deadline'] > $currentDate || (isset($marks['action']) && $marks['action'] == 'submitted')) {

                            if ($prof['type'] == 'Assignment') {

                                if (isset($marks['action']) && $marks['action'] == 'submitted') {
                                    echo "<td>" . $marks['action'] . "</td>";
                                } else {
                                    echo  "<td>  <button class='assign' id= '" . $prof['eid'] . "' href='/edit'>Submit</button> </td>";
                                }
                            } else {

                                if (isset($marks['action']) && $marks['action'] == 'submitted') {
                                    echo "<td>" . $marks['action'] . "</td>";
                                } else {

                                    echo  "<td>  <button class='quiz' id= '" . $prof['eid'] . "' href='/edit'>Submit</button> </td>";
                                }
                            }
                        } else {
                            echo    "<td> missed</td>";
                        }




                        echo    "<td>" . $prof['start_date'] . "</td>
                                <td>" . $prof['deadline'] . "</td>";
                        if (isset($marks['marks'])) {
                            echo "<td>" . $marks['marks'] . "</td>";
                        } else {
                            echo "<td>Pending</td>";
                        }
                        echo " <td>  <button class='down_assign' id= '" . $prof['eid'] . "' href='/edit'>down_assign</button> </td>
                                </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>












    <script>
        //  ----------------------------------Download documents regarding evaluation----------------
        down = document.getElementsByClassName('down_assign');
        Array.from(down).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("down_assign");

                var ex = e.target.id;
                console.log(ex);


                window.location.href = 'assign_check.php?course=' + ex;


            });

        });


        // --------------------------------------submit assignment button----------------------

        assigns = document.getElementsByClassName('assign');
        Array.from(assigns).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("assigns");

                var as = e.target.id;
                console.log(as);
            });

        });


        // --------------------------------------submit quiz button----------------------


        quizzes = document.getElementsByClassName('quiz');
        Array.from(quizzes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("quizzes");

                var qu = e.target.id;
                console.log(qu);

                // $('#quizModal').modal('toggle');
                window.location.href = 'quiz.php?quiz=' + qu;
            });

        });

        // --------------------------------------submit quiz modal button----------------------


        quiz_sub = document.getElementsByClassName('quiz_submit');
        Array.from(quiz_sub).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("quizzes");

                var qu = e.target.id;
                console.log(qu);
                $('#quizModal').modal('toggle');
            });

        });
    </script>


</body>

</html>