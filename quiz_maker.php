<?php
require "dbconnect.php";
session_start();

if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 1;
    $count = $_SESSION['count'];
}





if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    if (isset($_POST['add']) && $_POST['ques'] != "") {

        
        $course = $_POST['course'];
        $module = $_POST['module'];
        $eid = $_POST['eid'];
        $question = $_SESSION['count'];
        $correct = $_POST['correct'];

        $sql = "INSERT INTO `quizzes` ( `course`,`module`,`eid`, `question`, `correct`) VALUES ('$course', '$module','$eid', '$question', '$correct')";
        $data = mysqli_query($conn, $sql);
        $_SESSION['count']=$_SESSION['count']+1;


    } elseif (isset($_POST['done'])) {


        $course = $_POST['course'];
        $module = $_POST['module'];
        $eid = $_POST['eid'];
        if (isset($_POST['ques']) && $_POST['ques'] != "") {
            
            $question = $_SESSION['count'];
            $correct = $_POST['correct'];

            $sql = "INSERT INTO `quizzes` ( `course`,`module`,`eid`, `question`, `correct`) VALUES ('$course', '$module','$eid', '$question', '$correct')";
            $data = mysqli_query($conn, $sql);
            $_SESSION['count']=$_SESSION['count']+1;
        }
        header("location: profile.php");
    }
}





?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" integrity="sha384-PJsj/BTMqILvmcej7ulplguok8ag4xFTPryRq8xevL7eBYSmpXKcbNVuy+P0RMgq" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

</head>

<body>

    <div class="container p-3 border rounded bg-info-subtle mt-5">
        <form action="/Php_Learning/quiz_maker.php?course=<?php echo $_GET['course']; ?>&module=<?php echo $_GET['module']; ?>&eid=<?php echo $_GET['eid']; ?>" method="POST" enctype="multipart/form-data">
        
            <input type="hidden" name="course" value="<?php echo $_GET['course']; ?>">
            <input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">
            <input type="hidden" name="eid" value="<?php echo $_GET['eid']; ?>">
            <div class="row mb-3">
                <h4><label for="ques" class="col-sm-2 col-form-label">
                    <?php echo $_SESSION['count']; ?> Question</label></h4>
                <div class="col-sm-10">
                    <input type="hidden" class="form-control" name="ques" id="ques" value="<?php echo $_SESSION['count']; ?>">
                </div>
            </div>
            <!-- <div class="row mb-3">
                <label for="correct" class="col-sm-2 col-form-label">Correct Option</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="correct" id="correct">
                </div>
            </div> -->
            <div class="row mb-3">
            <fieldset>
    <legend>Please select correct answer to the question:</legend>
    <div style="padding: 30px;">

    <div class="col-md-6">
    <input type="radio" id="correct" name="correct" value="a" />
      <label for="contactChoice1">A</label>
    </div>

    <div class="col-md-6">

      <input type="radio" id="correct" name="correct" value="b" />
      <label for="contactChoice2">B</label>
      </div>
      <div class="col-md-6">
      <input type="radio" id="correct" name="correct" value="c" />
      <label for="contactChoice3">C</label>
      </div>
      <div class="col-md-6">
      <input type="radio" id="correct" name="correct" value="d" />
      <label for="contactChoice3">D</label>
      </div>
    </div>
  
  </fieldset>
            </div>

            <button type="submit" name="add" id="add" class="btn btn-primary">Add</button>
            <button type="submit" name="done" id="done" class="btn btn-primary">Done</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>