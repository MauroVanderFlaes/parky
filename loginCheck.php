<?php 

//if user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
} else {
    //let session continue
    $user_id = $_SESSION['user_id'];

}

?>