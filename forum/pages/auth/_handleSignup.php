<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){

    include '../../db/_dataBase.php';

    $user_email = $_POST['signupEmail'];
    $user_pass = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Check whether this email exists

    $existSql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);

    if($numRows > 0){
        $showError = "Email already in use";
    }
    else{
        if($user_pass == $cpassword){
            $hash = password_hash($user_pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `time_stamp`) VALUES ('$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result){
                $showAlert = true;
                header("Location: /php/forum/index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showError = "Passwords do not match";
            
        }
    }
    // header("Location: /forum/index.php?signupsuccess=false&error=$showError");
}

?>