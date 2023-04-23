<?php
include('config.php');
session_start();
if (empty($_SESSION['admin_user_email'])) {
    header('Location: logout.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Database</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <section>
        <?php include('sidebar.php'); ?>
        <div class="p-5 content_box">
            <h5>Upload Database</h5>
            <form enctype="multipart/form-data" class="card p-3 url-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <label for="url">Upload File</label>
                <input name="file" required class="form-control" type="file" id="formFile">
                <?php
                if (isset($_POST['submit'])) {
                    $file = $_FILES['file'];
                    $filename = $file['name'];
                    $filetype = $file['type'];
                    $tempname = $file['tmp_name'];

                    $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                    $allowed_exts = array('mmdb');

                    if (!in_array($file_ext, $allowed_exts)) {
                        echo '<p class="error alert">Only .mmdb file is allowed</p>';
                    } else {
                        $directory = 'uploads/';
                        $new_name = 'maxmind' . '.' . $file_ext;
                        $destination = $directory . $new_name;

                        $filename = 'uploads/maxmind.mmdb';
                        if (file_exists($filename)) {
                            unlink($filename);
                        }

                        if (move_uploaded_file($tempname, $destination)) {
                            echo '<p class="success alert">File uploaded successfully</p>';
                        } else {
                            echo '<p class="error alert">Error uploading file</p>';
                        }
                    }
                }
                ?>
                <button name="submit" class="btn btn-primary">Upload <i class="fa-sharp fa-solid fa-arrow-up"></i></button>
            </form>
        </div>
    </section>

</body>

</html>