<?php
include('config.php');
session_start();
if (!empty($_SESSION['admin_user_email'])) {
    $admin_email = $_SESSION['admin_user_email'];
    $query = "SELECT * FROM users WHERE email = '$admin_email'";
    $result = mysqli_query($conn, $query) or die('Query failed');
    if (mysqli_num_rows($result) < 1) {
        header('Location: logout.php');
    } else {
        $row = mysqli_fetch_assoc($result);
    }
} else {
    header('Location: logout.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <section>
        <?php include('sidebar.php'); ?>
        <div class="p-5 content_box">
            <h5>Profile Info</h5>
            <div class="card p-3 url-form settings-form">
                <?php
                if (isset($_POST['submit'])) {
                    $old_password = mysqli_real_escape_string($conn, trim($_POST['old_password']));
                    $new_password = mysqli_real_escape_string($conn, trim($_POST['new_password']));

                    if (empty($old_password) || empty($old_password)) {
                        echo '<p class="error alert">Enter old and new both passwords</p>';
                    } else {
                        $query2 = "SELECT * FROM users WHERE email = '$admin_email'";
                        $result = mysqli_query($conn, $query2) or die('Password query failed');
                        if (mysqli_num_rows($result) < 1) {
                            header('Location: logout.php');
                        } else {
                            $row2 = mysqli_fetch_assoc($result);
                            if (password_verify($old_password, $row['password'])) {
                                if (strlen($new_password) < 8) {
                                    echo '<p class="error alert">New password must be 8 character long</p>';
                                } else {
                                    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                                    $sql3 = "UPDATE users SET password = '$hashed_password' WHERE email = '$admin_email'";
                                    if (mysqli_query($conn, $sql3)) {
                                        echo '<p class="success alert">Password changed!</p>';
                                    } else {
                                        echo '<p class="error alert">Internal server error</p>';
                                    }
                                }
                            } else {
                                echo '<p class="error alert">Old password not correct</p>';
                            }
                        }
                    }
                }

                mysqli_close($conn);
                ?>
                <div>
                    <label class="form-label">Full Name</label>
                    <input value="<?php echo $row['full_name'] ?>" readonly class="form-control disable">
                </div>
                <div>
                    <label class="form-label">User Name</label>
                    <input value="<?php echo $row['username'] ?>" readonly class="form-control disable">
                </div>
                <div>
                    <label class="form-label">Email</label>
                    <input value="<?php echo $row['email'] ?>" readonly class="form-control disable">
                </div>

                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div>
                        <label class="form-label">Old Password</label>
                        <input name="old_password" type="password" required class="form-control">
                    </div>
                    <div>
                        <label class="form-label">New Password</label>
                        <input name="new_password" type="password" required class="form-control">
                    </div>
                    <input name="submit" value="Change Password" type="submit" class="mt-3 btn btn-primary" />
                </form>
            </div>
        </div>
    </section>
</body>

</html>