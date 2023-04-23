<?php
include('config.php');
require_once __DIR__ . '/vendor/autoload.php';
use GeoIp2\Database\Reader;
$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data['ip'])) {
    $ip = $data['ip'];
    if (file_exists('login/uploads/maxmind.mmdb')) {
        $reader = new Reader('logi/uploads/maxmind.mmdb');
        $record = $reader->city($ip);
        $country = $record->country->name;

        $query = "SELECT * FROM countries WHERE name = '$country'";
        $result = mysqli_query($conn, $query) or die("Can't fetch country");
        $row = mysqli_fetch_assoc($result);
        echo json_encode(array("ok" => true, "message" => "success", "data" => $row));
    }
}
