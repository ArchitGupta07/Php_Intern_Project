
<?php
require "dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (isset($_POST['add']) && $_POST['ques']!="" ) {
        $question = $_POST['ques'];
        $correct = $_POST['correct'];

        $sql = "INSERT INTO `quizzes` ( `cid`, `eid`, `question`, `correct`) VALUES ('1', '2', '$question', '$correct')";
        $data = mysqli_query($conn, $sql);  



    }elseif(isset($_POST['done'])){
        if (isset($_POST['ques']) && $_POST['ques']!="" ) {
        $question = $_POST['ques'];
        $correct = $_POST['correct'];

        $sql = "INSERT INTO `quizzes` ( `cid`, `eid`, `question`, `correct`) VALUES ('1', '2', '$question', '$correct')";
        $data = mysqli_query($conn, $sql);  
        }
        header("location: profile.php");

        




    }}





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
  <form action="/Php_Learning/quiz_maker.php" method="POST" enctype="multipart/form-data">
  <div class="row mb-3">
    <label for="ques" class="col-sm-2 col-form-label">Question</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="ques" id="ques">
    </div>
  </div>
  <div class="row mb-3">
    <label for="correct" class="col-sm-2 col-form-label">Correct Option</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="correct" id="correct">
    </div>
  </div>
  
  <button type="submit" name="add" id="add" class="btn btn-primary">Add</button>
  <button type="submit"  name="done" id="done"  class="btn btn-primary">Done</button>
</form>
</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>