<?php

require "dbconnect.php";







?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <style>
        /* -------comment section---------------- */

.comment-box,
.post-comment .list{
  /* background-color: #fff; */
  background: linear-gradient(45deg, #2891e7, #d93df1);
  border-radius: 6px;
  box-shadow: 0 2px 2px #0002;
}

.comment-session{
  width: 600px;
  height: auto;
  margin: 0 auto;
  /* background: #009cff; */

}
.post-comment{
  position: relative;
  
}
.post-comment::before{
  content: "";
  background-color: grey;
  position: absolute;
  min-height: 100%;
  width: 1px;
  left: -10px;

}
/* .post-comment:not(:first-child){
  margin-left: 3rem;
  margin-top: 1rem;
} */


.post-comment .list{
  width: 100%;
  margin-bottom: 12px;
}
.post-comment .list .user{
  display: flex;
  padding: 8px;
  overflow: hidden;

}

.post-comment .list .user img{
  height: 38px;
  width: 38px;
  margin-right: 10px;
  border-radius: 50%;
}

.comment-session .name{
  text-transform: uppercase;
  font-weight: 500;
}
.post-comment .list .day{
  font-size: 12px;

}
.post-comment .comment-post{
  padding: 0 0 15px 58px;
}


.comment-box{
  padding: 10px;
  overflow: hidden;
}

.comment-box .user{
  display: flex;
  width: min-content;

}

.comment-box .image img{
  width: 24px;
  height: 24px;
  margin-right: 10px;
  border-radius: 50%;

}

.comment-box textarea{
  background: #83ece0;
  width: -webkit-fill-available;
  height: 152px;
  margin: 10px 0;
  padding: 10px;
  resize: inherit;
  border-radius: 5px;
  border: none;
  box-shadow: 0 0 0  1px #0003;
}


.comment-box textarea:focus-visible{
  box-shadow: inset 0 0 0 1px #009cff;
  outline: none;

}

.comment-box .comment-submit{
  float: right;
  padding: 6px 10px;
  border: none;
  background-color: #009cff;
  color: #eee;
  cursor: pointer;
  border-radius: 3px;
  
}

.comment-box .comment-submit:hover{
  background: #0076bf;
}

  /* -------------------replies to comments-------------- */
  
.reply-com {
  display: grid;
  justify-content: end;
 

}

.reply-com .content{
  width: 100%;
  background: transparent;
  display: grid;
  align-items: end;

}


.reply-com .content textarea{
  border-radius: 5px;

}
.replies{
  background:linear-gradient(45deg, #edc466, #18a0ea); ;
  margin-left: 30px;
  border-radius: 5px;
  display: grid;
  /* justify-content: end; */
  padding: 10px;
  /* overflow: hidden; */
  position: relative;
}

.replies::before{
  content: "";
  background-color: grey;
  position: absolute;
  min-height: 100%;
  width: 1px;
  left: -10px;

}
.replies .user{
  display: flex;
  /* width: min-content; */
  /* display: flex; */
  padding: 8px;
  overflow: hidden;
}
.replies .user img{
  height: 38px;
  width: 38px;
  margin-right: 10px;
  border-radius: 50%;
}


.collapsible {
  background-color: transparent;
  color: rgb(247, 234, 234);
  cursor: pointer;
  padding: 18px;
  /* width: 100%; */
  border: none;
  text-align: right;
  outline: none;
  font-size: 15px;
}

.active, .collapsible:hover {
  color: #58413a;
  /* background-color: #555; */
}

.content {
  padding: 0 18px;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
  background-color: #f1f1f1;
}
/* comment box media query------------ */


@media only screen and (max-width: 650px){
     .comment-session{
      width: 100%;
      /* background: #d73e14; */
     }
}

    </style>
  </head>
  <body>
  <div class="comment-session">

  <?php

$sql = "Select * from discussions";
$comments = mysqli_query($conn, $sql);

// $proj = mysqli_fetch_assoc($p_data);
while ($comm = mysqli_fetch_assoc($comments)) {
    $sql1 = "SELECT * FROM discussions WHERE parent_id = '{$comm['com_id']}'";
    $replies = mysqli_query($conn, $sql1);


  
  
//   {% for c in comm  %}
 echo '<div class="post-comment">
    <div class="list">
      <div class="user">
        <div class="user-image"><img src="" alt=""></div>
        <div class="user-meta">
        <div class="name">' . $comm['commenter'] . '</div>
        <div class="day">' . $comm['date'] . '</div>

        </div>
      </div>
      <div class="comment-post">' . $comm['com_id'] . '</div>

      <div class="reply-com">
        <button class="collapsible">Reply</button>       
        <div class="content" >         
          <form action="" method="post">
            {% csrf_token %}
            <textarea id="comment" name="comment" cols="30" rows="2" placeholder="Your message"></textarea>
            <input type="hidden" name="parent_id" value="{{c.id}}">
          
            <button type="submit" name="com" class="comment-submit">Post a Reply</button>
          </form>       
        </div>
      </div>
    
    </div>';
    while ($rep = mysqli_fetch_assoc($replies)) {
    // {% for r in replydict|get_val:c.id  %}
    echo '<div class="replies">
          

          <div class="user">
            <div class="user-image"><img src="../static/images/avatar.jpg" alt=""></div>
            <div class="user-meta">
              <div class="name">{{r.username}}</div>
              <div class="day"> {{r.date}}</div>
    
            </div>
          </div>
          <div class="comment-post"><a href="" style="color: rgb(19, 122, 232);">@{{r.parent.username}}</a> {{r.comment}}</div>                
             
            <hr>  
            
         
          
          
    </div>
    <br>
    {% endfor %}
}
   
  </div>
  <br>

  {% endfor %}
  ';
}}
?>
  <div class="comment-box">
    <div class="user">
      <div class="image"><img src="../static/images/avatar.jpg" alt=""></div>
      <div class="name">{{user.username}}</div>

    </div>
    <form action="" method="post">
      {% csrf_token %}
      <textarea id="comment" name="comment" cols="30" rows="10" placeholder="Your message"></textarea>
      <input type="hidden" name="parent_id" value="">
      <button type="submit" name="com" {{c.id}}class="comment-submit">Post Comment</button>
    </form>
  </div>

  


 </div>
 <br>
 <br>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>