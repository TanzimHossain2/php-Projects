<?php 
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
  $loggedin = true;
}
else{
  $loggedin = false;
}

echo '<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
<div class="container-fluid">
  <a class="navbar-brand" href="/php/forum">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/php/forum">Home</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/php/forum/pages/about.php">About</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
         Top Catagories
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

        $sql = "SELECT category_name, category_id FROM `categories` LIMIT 3";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
          echo '<li><a class="dropdown-item" href="/php/forum/pages/threadList.php?catid='. $row['category_id'] .'">'. $row['category_name'] .'</a></li>';          
        }

        echo '</ul>
      <li class="nav-item">
        <a class="nav-link " href="/php/forum/pages/contact.php" >Contact</a>
      </li>
    </ul>
    ';

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      echo ' <form class="d-flex" role="search" method="get" action="/php/forum/pages/search.php">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-outline-success btn-sm" type="submit" >Search</button>
        </form>
        <p class="text-light me-2 ms-2">' . $_SESSION['useremail'] . ' </p> 
        <a href="/php/forum/pages/auth/_logout.php" class="btn btn-outline-success btn-sm">Logout</a>';
     } else {
      echo '<form class="d-flex" role="search" method="get" action="/php/forum/pages/search.php">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-outline-success btn-sm" type="submit">Search</button>
      </form> 
      
      <div class="mx-2">
        <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
      </div>
      ';
  }
  
    echo '
  </div>
</div>
</nav>';

include __DIR__ . '\..\partials\auth\_loginModul.php';
include __DIR__ . '\..\partials\auth\_signupModul.php';


// include 'partials/auth/_loginModul.php';
// include 'partials/auth/_signupModul.php';

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> You can now login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
} 

?>