<?php
if(!ISSET($_COOKIE['scan'])){
    header("Location:index.php");
}

if (ISSET($_POST["submit"])) {
    session_start();
    $_SESSION["nama_pelanggan"] = $_POST["nama"];

    header("Location:menu.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplikasi Pemesanan Cafe</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow" style="background-color:#fc7c2a;">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav m-auto">

                        <div class="row">
                            <div class="col-1">
                                <img src="../img/logo.png" alt="" width="150">
                            </div>
                        </div>

                    </ul>

                </nav>

                <!-- Begin Page Content -->
                <div class="container">

                    <!-- Outer Row -->
                    <div class="row justify-content-center">

                        <div class="col-xl-10 col-lg-12 col-md-9">

                            <div class="card o-hidden border-0 shadow-lg my-5">
                                <div class="card-body p-0">
                                    <!-- Nested Row within Card Body -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="p-5">
                                                <div class="text-center">
                                                    <h1 class="h4 text-gray-900 mb-4">Halo Selamat Datang!</h1>
                                                </div>
                                                <form class="user" method="post">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-user" name="nama" id="name" placeholder="Masukkan Nama Kamu">
                                                    </div>
                                                    <hr>
                                                    <input type="submit" class="btn btn-user btn-block" style="background-color:#fc7c2a; color:#fff;" name="submit" value="OK">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- /.container -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; 2022</span>
                    </div>
                </div>
            </footer> -->
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="../vendor/sweetalert/sweetalert.js"></script>
    <?php
    if(isset($_COOKIE['scan'])){
        if ($_COOKIE['alert'] == 0) {
            echo '<script>
                swal({
                    title: "Yeay, sekarang isi nama",
                    icon: "success",
                    button: "Coba Lagi!"
                });
                document.cookie = "alert =1";
                </script>';
        }
    }else{
        echo "silahkan scan dlu";
        header("Location:index.php");
    }
    ?>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>