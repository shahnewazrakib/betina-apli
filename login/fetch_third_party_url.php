<?php
include('config.php');
session_start();
if ($_SESSION['admin_user_email']) {
    $data = json_decode(file_get_contents('php://input'), true);
    if (!empty($data)) {
        $id = $data['id'];
        $query = "SELECT * FROM countries WHERE id = $id";
        if ($result = mysqli_query($conn, $query)) {
            $row = mysqli_fetch_assoc($result);
            echo json_encode(array("ok" => true, "message" => "Query success", 'data' => $row));
        } else {
            echo json_encode(array("ok" => false, "message" => "Query failed"));
        }
    } else {
        echo json_encode(array("ok" => false, "message" => "Access denied"));
    }
} else {
    echo json_encode(array("ok" => false, "message" => "Access denied"));
}
