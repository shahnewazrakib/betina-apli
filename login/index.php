<?php
include('config.php');
session_start();
if (!empty($_SESSION['admin_user_email'])) {
    header('Location: country.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8 col-lg-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_POST['submit'])) {
                            $email = mysqli_real_escape_string($conn, trim($_POST['email']));
                            $password = mysqli_real_escape_string($conn, trim($_POST['password']));

                            if (empty($email) || empty($password)) {
                                echo '<p class="error alert">Fill all the details</p>';
                            } else {
                                $sql = "SELECT *  FROM users WHERE email = '$email'";
                                $checkEmail = mysqli_query($conn, $sql) or die('Query Unsuccessfull');

                                if (mysqli_num_rows($checkEmail) > 0) {
                                    $row = mysqli_fetch_assoc($checkEmail);

                                    $verifyPassword = password_verify($password, $row['password']);
                                    if (!$verifyPassword) {
                                        echo '<p class="error alert">Email or password is incorrect</p>';
                                    } else {
                                        $_SESSION['admin_user_email'] = $row['email'];
                                        $_SESSION['admin_user_name'] = $row['full_name'];
                                        header('Location: country.php');
                                    }
                                } else {
                                    echo '<p class="error alert">Email or password is incorrect</p>';
                                }
                            }
                        }

                        mysqli_close($conn);
                        ?>
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="form-group mb-3">
                                <label for="email">Email address</label>
                                <input required type="email" class="form-control" name="email" placeholder="Enter email" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input required type="password" class="form-control" name="password" placeholder="Password" />
                            </div>
                            <input name="submit" value="Login" type="submit" class="btn btn-primary btn-block" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

</body>

</html>