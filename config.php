<?php
$host = 'localhost';
$username = 'root';
$password = '';
$db = 'betina_db';
$conn = mysqli_connect($host, $username, $password, $db);

if (!$conn) {
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
}
