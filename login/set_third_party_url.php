<?php
include('config.php');
session_start();
if ($_SESSION['admin_user_email']) {
    $data = json_decode(file_get_contents('php://input'), true);
    if (!empty($data)) {
        $url = $data['url'];
        $status = $data['status'];
        $id = $data['id'];
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $query = "UPDATE countries SET url = '$url', is_enabled = $status WHERE id = $id";
            if (mysqli_query($conn, $query)) {
                echo json_encode(array("ok" => true, "message" => "Query success"));
            } else {
                echo json_encode(array("ok" => false, "message" => "Query failed"));
            }
        } else {
            echo json_encode(array("ok" => false, "message" => "Enter a valid URL"));
        }
    } else {
        echo json_encode(array("ok" => false, "message" => "Access denied"));
    }
} else {
    echo json_encode(array("ok" => false, "message" => "Access denied"));
}
