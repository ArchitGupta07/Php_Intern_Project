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
            $questions = "Select * from quizzes where eid = $c ";
            $result = mysqli_query($conn, $questions);

            $count = 1;
            

            while ($ques = mysqli_fetch_assoc($result)) {
            echo '<form action="/Php_Learning/extras.php?student=' . $_SESSION['uid'] . '&eid='.$c.'" method="POST" enctype="multipart/form-data">
                        <div class="col-12">
                        <p class="fw-bold mt-5">'.$count.') </p>
                            <div>
                                <div class="row">
                                    <div class="col-md-6"> <input type="radio" name="'.$ques['qid'].'" id="'.$ques['qid'].'" value="a"> <label for="five" class="box fifth w-100">
                                            <div class="course"> <span class="circle"></span> <span class="subject">(a)</span> </div>
                                        </label> </div>
                                    <div class="col-md-6"> <input type="radio" name="'.$ques['qid'].'" id="'.$ques['qid'].'" value="b"> <label for="six" class="box sixth w-100">
                                            <div class="course"> <span class="circle"></span> <span class="subject"> (b) </span> </div>
                                        </label> </div>
                                    <div class="col-md-6"> <input type="radio" name="'.$ques['qid'].'" id="'.$ques['qid'].'" value="c"> <label for="seven" class="box seveth w-100">
                                            <div class="course"> <span class="circle"></span> <span class="subject"> (c) </span> </div>
                                        </label> </div>
                                    <div class="col-md-6"> <input type="radio" name="'.$ques['qid'].'" id="'.$ques['qid'].' value="d" <label for="eight" class="box eighth w-100">
                                            <div class="course"> <span class="circle"></span> <span class="subject"> (d) </span> </div>
                                        </label> </div>
                            </div>
                    </div>
                    </div>
                    ' ;
                    
                $count = $count+1;   
                }
                
                
                
                
                
                ?>


<div class="col-12">
<div class="d-flex justify-content-center"> <button class="btn btn-primary px-4 py-2 fw-bold" name="quiz_end" id="quiz_end"> continue</button> </div>
</div>
</form>
        
        </div>
    </div>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>