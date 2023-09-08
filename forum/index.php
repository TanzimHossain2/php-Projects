<?php include './db/_dataBase.php'; ?>



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
    <?php include 'partials/_navbar.php'; ?>

    <?php require './utils/_carosul.php' ?>
    <div class="container my-3">
        <h2 class="text-center my-2">iDiscuss - Categories</h2>
        <div class="row my-3">

            <?php 
      $sql = "SELECT * FROM `categories`";
      $result = mysqli_query($conn, $sql);

      while($row = mysqli_fetch_assoc($result)) {
       echo '<div class="col-md-4 my-1">
        <div class="card" style="width: 18rem;">
          <img src="http://source.unsplash.com/300x200/?coding,'.$row['category_name'].'" class="card-img-top" alt="
          '.$row['category_name'].'
          ">
          <div class="card-body">

            <h5 class="card-title"><a href="pages/threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></h5>
            
            <p class="card-text">'.substr($row['category_desc'], 0, 90).'...</p>
            <a href="pages/threadlist.php?catid='.$row['category_id'].'" class="btn btn-primary">View Threads</a>
          </div>
        </div>
      </div>';
      } 
      ?>


        </div>
    </div>

    <?php include 'partials/_footer.php'; ?>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>