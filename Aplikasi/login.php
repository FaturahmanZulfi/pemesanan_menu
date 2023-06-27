<?php
require "db_func.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .fa-qrcode{
            color:#fc7c2a;
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-8 col-lg-8 col-md-8">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="row">
                                        <h1 class="h4 text-gray-900 mb-4 col-6 offset-5">Login Kasir!</h1>
                                        <a href="index.php" class="col-1"><i class="fas fa-qrcode fa-2x"></i></a>
                                    </div>
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" placeholder="Masukkan username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" placeholder="Masukkan Password">
                                        </div>
                                        <input type="submit" name="login" value="Login" class="btn btn-user btn-block" style="background-color:#fc7c2a;color:#fff">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script src="vendor/sweetalert/sweetalert.js"></script>

</body>

</html>

<?php

if(ISSET($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = select("user", "*","WHERE username = '$username' AND password = '$password'");
    if (empty($login)) {
        echo '<script>
        swal({
            title: "Username Atau Password Salah",
            icon: "error",
            button: "Coba Lagi!"
        });
        </script>';
    }else{
        $id = $login[0]["id_level"];
        $level = select("level", "*","WHERE id = '$id'");
        session_start();
        $_SESSION['nama'] = $login[0]["nama"];
        $_SESSION['level'] = $level[0]["level"];
        if ($level[0]["level"] == "owner") {
            header("Location:".$level[0]["level"]."/laporan.php");
        }else {
            header("Location:".$level[0]["level"]."/crudmenu.php");
        }
    }
}

?>