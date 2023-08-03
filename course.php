<!--  -->



<?php
require "dbconnect.php";

session_start();


$user = $_SESSION['uid'];



?>
<!DOCTYPE html>
<html>

<head>
  <title>Login Form Design</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

  <title></title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"> </script>

  <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

  <script>
    jQuery.noConflict();
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {

        console.log("edit");
        var ex = e.target.id;
        $('#editModal').modal('toggle');
        attends = document.getElementsByClassName('attend');
        Array.from(attends).forEach((element) => {
          element.addEventListener("click", (e) => {
            console.log("edit1");

            // Get form data
            var pres = $('#present').val();
            var res = $('#reason').val();

            console.log(pres);

            // Send an AJAX request to the server
            jQuery.ajax({
              url: './course_check.php?course=<?php echo $_GET['course']; ?>',
              type: 'POST',
              data: {
                attendance: pres,
                reason: res,
                cid: ex
              },
              success: function(data) {
                // Handle the response from the server
                console.log('data');
                console.log(data);
              }
            });

            if (pres == 1) {
              // Open the modal
              $('#attend1').modal('toggle');


              feed = document.getElementsByClassName('feedback');
              Array.from(feed).forEach((element) => {
                element.addEventListener("click", (e) => {
                  console.log("edit2");
                  var f = $('#feedB').val();

                  // Send an AJAX request to the server
                  jQuery.ajax({
                    url: './course_check.php?course=<?php echo $_GET['course']; ?>',
                    type: 'POST',
                    data: {
                      feedback: f,
                      cid: ex

                    },
                    success: function(data) {
                      // Handle the response from the server
                      console.log(data);
                    }
                  });
                  window.location.href = 'course_check.php?course=' + ex;
                })
              })

            } else {
              window.location.href = 'course_check.php?course=' + ex;
            }

            // Prevent the default form submission
            return false;
          })
        })
      })
    })
  </script>
  <!-- -------------------modal2 javascript ------------------- -->
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->






  <!-- <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> -->

  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js" integrity="sha384-gdQErvCNWvHQZj6XZM0dNsAoY4v+j5P1XDpNkcM3HJG1Yx04ecqIHk7+4VBOCHOG" crossorigin="anonymous"></script>
  <!-- <script src="dashboard.js"></script> -->



</head>

<body>

  <!-- Modal 2 -->
  <div class="modal fade" tabindex="-1" id="attend1" tabindex="-1" aria-labelledby="attend1Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="attend1Label">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- <form action="/Php_Learning/courses.php" method="POST">
            <input type="hidden" type="text" name="uidEdit" id="uidEdit">
            <div class="username">
              <label for="">username</label>
              <input type="text" name="usernameEdit" id="usernameEdit">
            </div>
            <div class="email">
              <label for="">email</label>
              <input type="text" name="emailEdit" id="emailEdit">
            </div>
            <div class="mobile">
              <label for="">mobile_no</label>
              <input type="text" name="mobileEdit" id="mobileEdit">
            </div> -->
          <form action="" method="post">

            <textarea id="feedB" name="feedB" cols="30" rows="2" placeholder="Your message"></textarea>



            <button type="submit" class="btn btn-primary feedback" data-dismiss="modal" name="feedback" id="feedback">Save changes</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>
  <!-- Modal 1 -->
  <div class="modal fade" tabindex="-1" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="./course.php?course=<?php echo $_GET['course']; ?> " method="POST">
            <!-- <input type="hidden" type="text" name="attendance" id="attendance"> -->
            <div class="present">
              <label for="">Attendance</label>
              <input type="text" name="present" id="present">
            </div>
            <div class="reason">
              <label for="">Reason for absent</label>
              <input type="text" name="reason" id="reason">
            </div>

            <button type="submit" class="attend btn btn-primary" name="attendance" id="attendance" data-dismiss="modal">Save changes</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>


  <?php
  include "./fixed_assets/navbar.php";
  ?>

  <!-- -------------------modules----------------------------- -->

  <div id="modules">



    <?php
    // require dbconnect.php;



    $course_code = $_GET['course'];



    $c_name = "Select distinct(module) from courses where course_code = '$course_code'";
    $c_data = mysqli_query($conn, $c_name);
    while ($c = mysqli_fetch_assoc($c_data)) {
      echo '<div class="card">
    <div class="card-header" id="headingOne">
      <h5 id="' . $course_code . '" class="mb-0">
        <button id="' . $c['module'] . '" class="module btn btn-link" data-toggle="collapse" data-target="#collapse' . $c['module'] . '" aria-expanded="false" aria-controls="collapse' . $c['module'] . '">
        Module ' . $c['module'] . '

        </button>
      </h5>
    </div>

    <div id="collapse' . $c['module'] . '" class="collapse" aria-labelledby="heading' . $c['module'] . '" data-parent="#accordion">
      <div class="card-body">
      <table class="table table-striped table-dark" id="mytable">
        <thead>
            <tr>
            <th scope="col">Session No.</th>
            <th scope="col">Title</th>
            <th scope="col">Mode</th>
            <div style="display: grid;"><div><th scope="col">Course Material</th></div>
            <div><th scope="col">Course Material</th>
            <th scope="col">Course Material</th>
            <th scope="col">Course Material</th></div></div>
            <!-- <th scope="col">Handle</th> -->
            </tr>
        </thead>
        <tbody id="sessions">';

      require "dbconnect.php";



      $course_code = $_GET['course'];
      $user = $_SESSION['uid'];


      $sql = "SELECT * FROM courses WHERE module = '{$c['module']}' AND course_code = '$course_code' ";
      $data = mysqli_query($conn, $sql);



      while ($prof = mysqli_fetch_assoc($data)) {
        $check = "SELECT * FROM attendance WHERE uid = '$user' AND cid = '" . $prof['cid'] . "'";
        echo " <tr>
                <th scope='row'>" . $prof['session_no'] . " </th>;
                <td>" . $prof['title'] . "</td>
                <td>" . $prof['mode'] . "</td>

                
                
                <td>  <button id='" . $prof['cid'] . "' class='edit'>Download Pdf</button> </td>
                
                
                </tr>";
      }



      echo '
        </tbody>
    </table>
      </div>
    </div>
  </div>';
    }
    ?>
    <!-- <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Collapsible Group Item #2
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
 
  </div> -->
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- <script>
      document.getElementById('myButton').addEventListener('click', function(event) {
    event.preventDefault();
  });
    </script>

    <script>
      document.getElementById('myButton1').addEventListener('click', function(event) {
    event.preventDefault();
  });
    </script> -->


  <!-- ------------------load module data from ajax-------------- -->
  <script>
    // jQuery.noConflict();
    // sess = document.getElementsByClassName("module");
    // Array.from(sess).forEach((element) => {
    //   element.addEventListener("click", (e) => {

    //     console.log(e.target.parentNode.id)

    //     var course_id = e.target.parentNode.id;
    //     var module_no = e.target.id;


    //     $("#sessions").load("course_modules.php",{

    //       course: course_id,
    //       module: module_no

    //     });





    //   })


    // });






    // <!-- -------------------modal1 javascript ------------------- -->






</body>

</html>