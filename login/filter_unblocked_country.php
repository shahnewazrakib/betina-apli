<?php
include('config.php');
session_start();
if ($_SESSION['admin_user_email']) {
    $query = "SELECT * FROM countries WHERE is_blocked = 0";
    if ($result = mysqli_query($conn, $query)) {
        $row = mysqli_fetch_all($result);
        echo json_encode(array("ok" => true, "message" => "Query success", 'data' => $row));
    } else {
        echo json_encode(array("ok" => false, "message" => "Query failed"));
    }
} else {
    echo json_encode(array("ok" => false, "message" => "Access denied"));
}
