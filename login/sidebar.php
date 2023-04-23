<?php
$url = $_SERVER['REQUEST_URI'];
$path = parse_url($url, PHP_URL_PATH);
$end_url = basename($path, '.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <aside class="h-100 fixed-top">
        <div class="profile border-bottom pb-3 pt-4 text-center text-white">
            <i class="fa fa-user"></i>
            <label class="d-none d-lg-inline" for="">Rank Made</label>
        </div>
        <div class="p-sm-4 mt-2">
            <a href="country.php" class="link <?php if ($end_url === 'country') {
                                                    echo 'active';
                                                } ?>">
                <i class="text-white fa-sharp fa-solid fa-earth-americas"></i>
                <label class="text-white d-none d-lg-inline underline-none">Countires</label>
            </a>
            <a href="url.php" class="link <?php if ($end_url === 'url') {
                                                echo 'active';
                                            } ?>">
                <i class="text-white fa-sharp fa-solid fa-link"></i>
                <label class="text-white underline-none d-none d-lg-inline">Third Party Url</label>
            </a>
            <a href="database.php" class="link <?php if ($end_url === 'database') {
                                                    echo 'active';
                                                } ?>">
                <i class="fa-solid fa-database text-white"></i>
                <label class="text-white underline-none d-none d-lg-inline">Upload Database</label>
            </a>
            <a href="settings.php" class="link <?php if ($end_url === 'settings') {
                                                    echo 'active';
                                                } ?>">
                <i class="fa fa-gear text-white"></i>
                <label class="text-white underline-none d-none d-lg-inline">Settings</label>
            </a>
            <a href="logout.php" class="link">
                <i class="fa fa-sign-out text-white"></i>
                <label class="text-white underline-none d-none d-lg-inline">Logout</label>
            </a>
        </div>
    </aside>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>