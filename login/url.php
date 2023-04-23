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
    <title>Third Party URL</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <section>
        <?php include('sidebar.php'); ?>
        <div class="p-5 content_box">
            <h5>Third Party Url</h5>
            <div>
                <form class="card p-3 url-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <?php
                    if (isset($_POST['submit'])) {
                        $url = mysqli_real_escape_string($conn, trim($_POST['url']));
                        if (empty($url)) {
                            echo '<p class="error alert">Enter a URL</p>';
                        } else {
                            if (filter_var($url, FILTER_VALIDATE_URL)) {
                                $query = "UPDATE countries SET url = '$url', is_enabled = 1";
                                if (mysqli_query($conn, $query)) {
                                    echo '<p class="success alert">URL Updated!</p>';
                                } else {
                                    echo '<p class="error alert">Internal server error</p>';
                                }
                            } else {
                                echo '<p class="error alert">URL is not valid</p>';
                            }
                        }
                    }
                    mysqli_close($conn);
                    ?>
                    <label for="url">Enter url:</label>
                    <input required name="url" type="url" class="form-control">
                    <input value="Save Url" type="submit" name="submit" class="btn btn-primary" />
                </form>
            </div>
    </section>
</body>

</html>