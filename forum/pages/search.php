<?php include '../db/_dataBase.php'; ?>

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
    <style>
    .result {
        min-height: 433px;
    }
    </style>
</head>

<body>

    <?php include '../partials/_navbar.php'; ?>

    <?php
if(isset($_GET['search'])){
    $search = $_GET['search'];
    $sql = "SELECT * FROM `threads` WHERE match (thread_title, thread_desc) against ('$search')";
    $result = mysqli_query($conn, $sql);
    $noResult = true;
    while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_id = $row['thread_id'];
        $url = "/php/forum/pages/thread.php?threadid=". $thread_id;
        echo '<div class="container my-2">
        <h1>Search Results for <em>"'. $search .'"</em> </h1>
        <div class="result">
        <h3> <a href="'. $url .'" class="text-dark">'. $title .'</a> </h3>
        <p>'. $desc .'</p>
        </div>
    </div>';
    }
    if($noResult){
        echo '<div class="container my-2">
        <h1>Search Results for <em>"'. $search .'"</em> </h1>
        <div class="result">
        <h3> <a href="#" class="text-dark">No Results Found</a> </h3>
        <p> Suggestions: <ul>
        <li>Make sure that all words are spelled correctly.</li>
        <li>Try different keywords.</li>
        <li>Try more general keywords.</li>
        </ul></p>
        </div>
    </div>';
    }
} else {
    echo 'No search query specified.';
}
?>

    <?php include '../partials/_footer.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>