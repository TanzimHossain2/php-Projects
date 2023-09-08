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
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `categories` WHERE category_id =$id ";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $catName = $row['category_name'];
            $catDesc = $row['category_desc'];
        }
        ?>

     <?php
        $showAlert = false;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $th_title = $_POST['title'];
            $th_desc = $_POST['desc'];
            $th_title = str_replace("<", "&lt;", $th_title);
            $th_title = str_replace(">", "&gt;", $th_title);

            $th_desc = str_replace("<", "&lt;", $th_desc);
            $th_desc = str_replace(">", "&gt;", $th_desc);

            $sno = $_POST['sno'];


            $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `times_stamp`) VALUES ('$th_title', '$th_desc', '$id', ' $sno', current_timestamp())";
            $result = mysqli_query($conn, $sql);


            if ($result) {
                $showAlert = true;

                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your thread has been added! Please wait for community to respond.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> We are facing some technical issue and your entry ws not submitted successfully! We regret the inconvinience caused!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
        ?>




     <div class="container my-4">
         <div class="jumbotron">
             <h1 class="display-4"> <?php echo $catName; ?> Forums</h1>
             <p class="lead">
                 <?php echo $catDesc; ?>
             </p>
             <hr class="my-4">
             <p>Here are some basic rules for participating in a forum: </p>
             <ul style="list-style-type: number;">
                 <li>Be respectful: Treat others as you would like to be treated. No personal attacks or insults.</li>
                 <li>Stay on topic: Keep your posts relevant to the original topic.</li>
                 <li>Use proper grammar and spelling: Make sure your posts are easy to read and understand.</li>
                 <li>Be concise: Keep your posts short and to the point.</li>
                 <li>Use proper formatting: Use headings, bullet points, and other formatting tools to make your posts
                     easy to read.</li>
                 <li>Avoid self-promotion: Don't use the forum to promote your own products or services.</li>
                 <li>Follow the rules: Read and follow the forum's rules and guidelines.</li>

             </ul>
             <a class="btn btn-success btn-md" href="#" role="button">Learn more</a>
         </div>
     </div>

     <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '<div class="container">
        <h2 class="my-2"> Start Discussion</h2>
        <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
            <div class="mb-3">
                <label for="title" class="form-label"> Problem Title:</label>
                <input type="text" class="form-control" maxlength="180" name="title" id="title" aria-describedby="titleHelp">
                <small>
                    <div id="titleHelp" class="form-text">Keep your title as short and crisp as possible</div>
                </small>
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Elaborate Your Concern </label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>

            <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '">
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';
        } else {
            echo '<div class="container">
        <h2 class="my-2"> Start Discussion</h2>
        <p class="lead">You are not logged in. Please  login  to be able to start a Discussion</p>
    </div>';
        }
        ?>


     <div class="container">
         <h1 class="py-2">Browse Questions</h1>


         <?php
            $id = $_GET['catid'];
            $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id ";
            $result = mysqli_query($conn, $sql);
            $noResult = true;

            while ($row = mysqli_fetch_assoc($result)) {
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $thread_id = $row['thread_id'];
                $thread_time = $row['times_stamp'];
                $thread_user_id = $row['thread_user_id'];
                $noResult = false;

                $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
                $result2 = mysqli_query($conn, $sql2);

                $row2 = mysqli_fetch_assoc($result2);
                $posted_by = $row2['user_email'];




                echo ' <div class="media my-3">
             <img src="https://source.unsplash.com/64x64/?coding,programing" class="mr-3" alt=" <?php echo $catName; ?>
         ">
         <div class="media-body my-3">
             <p class="font-weight-bold my-0">' . $posted_by . ' at ' . $thread_time . '</p>
             <h5 class="mt-0">
                 <a href="thread.php?threadid=' . $thread_id . '">' . $title . '</a>
             </h5>

             <p>
                 ' . nl2br($desc) . '

             </p>
         </div>
     </div> ';
     }


     if ($noResult) {
     echo '<div class="jumbotron jumbotron-fluid">
         <div class="container">
             <h1 class="display-4">No Threads Found</h1>
             <p class="lead">Be the first person to ask a question</p>
         </div>
     </div>';
     }

     ?>
     </div>

     <?php include '../partials/_footer.php'; ?>





     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
         integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
     </script>
 </body>

 </html>