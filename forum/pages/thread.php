 <!-- <?php include '../db/_dataBase.php'; ?> -->


 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
         integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
         crossorigin="anonymous" referrerpolicy="no-referrer" />

     <title>iDiscuss - Coding Forums</title>
 </head>

 <body>
     <?php include '../partials/_navbar.php'; ?>

     <?php
        $showAlert = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comment = $_POST['comment'];
            $comment = str_replace("<", "&lt;", $comment);
            $comment = str_replace(">", "&gt;", $comment);
            $id = $_GET['threadid'];
            $sno = $_POST['sno'];
            

            $sql = "INSERT INTO `comments` (`comment_comment`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp())";
            $result = mysqli_query($conn, $sql);

            $showAlert = true;
            if ($showAlert) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your comment has been added! Please wait for community to respond.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
        }

        ?>



     <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `threads` WHERE thread_id=$id ";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            $time = $row['times_stamp'];
            $thread_user_id = $row['thread_user_id'];
        }

        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);

        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_email'];

       

        ?>


     <div class="container my-4">
         <div class="jumbotron">
             <h1 class="display-4"> <?php echo $title; ?> Forums</h1>
             <p class="lead">
                 <?php echo nl2br($desc); ?>

             </p>
             <hr class="my-4">
             <p class="text-left">Posted by: <em> <?php echo $posted_by; ?> </em></p> <span>
                 <?php echo $time; ?>
             </span>

         </div>
     </div>





     <?php
    
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '<div class="container">
        <h2 class="my-2"> Post a Comment</h2>
        <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
            <div class="mb-3">
                <label for="comment" class="form-label">Type your comment </label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="sno" value="'. $_SESSION["sno"]. '">
            </div>
            <button type="submit" class="btn btn-success">Post Comment</button>
        </form>
    </div>';
        } else {
            echo '<div class="container">
        <h2 class="my-2"> Post a Comment</h2>
        <p class="lead">You are not logged in. Please login to be able to start a Comment</p>
    </div>';
        }
        ?>




     <div class="container">
         <h1 class="py-2">Discussions</h1>
         <?php

            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `comments` WHERE thread_id=$id ";
            $result = mysqli_query($conn, $sql);
            $noResult = true;

            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['comment_id'];
                $content = $row['comment_comment'];
                $comment_time = $row['comment_time'];
                $thread_user_id = $row['comment_by'];

                $noResult = false;


                $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
                $result2 = mysqli_query($conn, $sql2);

                $row2 = mysqli_fetch_assoc($result2);


                $user = $row2['user_email'];


                echo ' <div class="media my-3">
             <img src="https://source.unsplash.com/64x64/?coding,programing" class="mr-3" alt="...">
             <div class="media-body my-3">
                    <p class="font-weight-bold my-0">' . $user . ' at - ' . $comment_time . '</p>
                    ' . $content . '
             </div>
         </div> ';
            }



            if ($noResult) {
                echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <p class="display-4">No Comments Found</p>
                  <p class="lead"> Be the first person to comment</p>
                  </div>
                  </div>
                  ';
            }
            ?>
     </div>



     <?php include '../partials/_footer.php'; ?>

     ?>



     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
         integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
     </script>
 </body>

 </html>