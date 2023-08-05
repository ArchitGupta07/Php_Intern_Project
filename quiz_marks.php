


<?php
require "dbconnect.php";
$student= $_GET['student'];
$eval = $_GET['eid'];
echo $eval;


if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // echo "Quiz";
    
    // $sql1 = "UPDATE `evaluation` SET `marks` = 1  WHERE `evaluation`.`eid` = 2";
    // $p_data = mysqli_query($conn, $sql1);
   
    if (isset($_POST['quiz_end'])) {      

        // echo "Quiz";    
        
        // Process the selected option as needed
        $marks = 0;
        $questions = "Select * from quizzes where eid = $eval ";
        $result = mysqli_query($conn, $questions);
        

        while ($row = mysqli_fetch_assoc($result)) {
            $qid = $row['qid'];
            $correct = $row['correct'];
            $correctArray[$qid] = $correct; // Assign 'correct' value to the corresponding 'qid' key
        }

        $postData = $_POST;
        foreach ($postData as $key => $value) {
            // Process each key-value pair as neede
            if($key!='quiz_end'){
            if($postData[$key]==$correctArray[$key]){
                $marks+=1;            
            }}}

        echo "your marks:-". $marks;
        
        
        
        $sql1 ="INSERT INTO `marks` (`cid`, `eid`, `student_id`, `marks`, `action`) VALUES ('1', '$eval', '$student', '$marks','submitted')";
        $p_data = mysqli_query($conn, $sql1);



    }}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br>
    <a href="./student.php">DashBoard</a>
</body>
</html>




