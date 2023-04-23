<?php
    include('config.php');
    session_start();
    if(empty($_SESSION['admin_user_email'])){
        header('Location: logout.php');
    }else{
        if (isset($_GET['country_id'])) {
            $id = $_GET['country_id'];
            $query = "UPDATE countries SET is_blocked = 0 WHERE id = $id";
            mysqli_query($conn, $query) or die("Unblock query failed");
            mysqli_close($conn);
            header('Location: country.php');
        }else{
            header('Location: country.php');
        }
    }
