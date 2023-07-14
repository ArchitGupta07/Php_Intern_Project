<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <h1></h1>
    <div class="container mb-5">
        <div class="row">

            <?php
            require "dbconnect.php";
            echo $_GET['quiz'];
            session_start();

            $c = $_GET['quiz'];

            $user = $_SESSION['uid'];
            echo $user;
            $questions = "Select * from quizzes where qid = $c ";
            $result = mysqli_query($conn, $questions);
            $core = mysqli_fetch_assoc($result);

            while ($c = mysqli_fetch_assoc($c_data)) {
            echo ' <div class="col-12">
                    <p class="fw-bold mt-5">2. Complete the following sentences:Alice couldnt _______ the humilation any longer and stormed out of the room red as a bed</p>
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
            </div>
        </div>';
            }





            ?>
        </div>
    </div>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>