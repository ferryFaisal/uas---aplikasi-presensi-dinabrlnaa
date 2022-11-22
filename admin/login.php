<!DOCTYPE html>
<html lang="en">
<?php
require "connect_db.php";

error_reporting(0);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    $sql = "SELECT * FROM user where email ='$email' and password ='$password'";
    $result = mysqli_query($conn, $sql);
    $cek = mysqli_num_rows($result);

    if ($cek > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($row['role'] == "Admin") {
            // buat session login dan username
            $_SESSION['login'] = $row['email'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = "Admin";
            // alihkan ke halaman dashboard admin
            header("location:index.php");

            // cek jika user login sebagai pegawai
        } 
        else if ($row['role'] == "Dosen") {
            // buat session login dan email
            $_SESSION['login'] = $row['email'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = "Sales";
            // alihkan ke halaman dashboard pegawai
            header("location:indexSales.php");

            // cek jika user login sebagai pengurus
        }
    } else {
        echo "gagal login";
    }
}

?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Landing Page - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="email" id="inputEmail" class="form-control" placeholder="Email address"
                                required="required" autofocus="autofocus" name="email">
                            <label for="inputEmail">Email address</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="password" id="inputPassword" class="form-control" placeholder="Password"
                                required="required" name="password">
                            <label for="inputPassword">Password</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="remember-me">
                                Remember Password
                            </label>
                        </div>
                    </div>
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-block">
                </form>
                <div class="text-center">
                    <a class="d-block small mt-3" href="register.php">Register an Account</a>
                    <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>