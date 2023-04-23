<?php
include('config.php');
session_start();
if (empty($_SESSION['admin_user_email'])) {
    header('Location: logout.php');
} else {
    $query = "UPDATE countries SET is_blocked = 0";
    mysqli_query($conn, $query) or die("Block query failed");
    mysqli_close($conn);
    header('Location: country.php');
}
