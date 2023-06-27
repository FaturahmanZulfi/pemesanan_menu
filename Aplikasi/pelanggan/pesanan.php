<?php
require "../db_func.php";
session_start();

if(!ISSET($_SESSION['kodepesanan'])){
    header("Location:menu.php");
}
$kodepesanan = $_SESSION['kodepesanan'];

if (ISSET($_GET['hapus'])) {
    if (delete("pesanan","WHERE kode_pesanan = '$kodepesanan'") === true) {
        unset($_SESSION['kodepesanan']);
        header("Location:menu.php");
    }
}

if (ISSET($_GET['pesanlagi'])) {
    unset($_SESSION['kodepesanan']);
    header("Location:menu.php");
}

$pesanan = select("pesanan","*","WHERE kode_pesanan = '$kodepesanan'");
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
    <style>
        @media only screen and (max-width: 540px) {
            *{
                font-size:10px;
            }
            .navbar{
                height:70px;
            }
            .no-hp{
                font-size:8px;
            }
        }
    </style>
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
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container">

                    <!-- Outer Row -->
                    <div class="row justify-content-center">

                        <div class="col-12">

                            <div class="card o-hidden border-0 shadow-lg my-5 px-5">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="text-center col-12">
                                             <h1 class="h4 text-gray-900 mb-4">Pemesanan Menu</h1>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                             <h6 class="text-gray-900 mb-4">Nama Pemesan : <?= $_SESSION['nama_pelanggan'] ?></h6>
                                             <h6 class="text-gray-900 mb-4">Status Pemesanan : <?= $pesanan[0]['status'] ?></h6>
                                             <h6 class="text-gray-900 mb-4">Kode Pemesanan : <?= $pesanan[0]['kode_pesanan'] ?></h6>
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="col-3 font-weight-bold" style="color:#000">Nama Menu</div>
                                            <div class="col-3 font-weight-bold" style="color:#000">Harga Satuan</div>
                                            <div class="col-3 font-weight-bold" style="color:#000">Jumlah Dipesan</div>
                                            <div class="col-3 font-weight-bold" style="color:#000">Total Harga</div>
                                        </div>
                                        <br>
                                    <?php
                                    foreach ($pesanan as $pesan) {
                                        $menu = select("menu","*","WHERE id = $pesan[id_menu]")[0];?>
                                        
                                        <div class="row">
                                            <div class="col-3"><?= $menu['menu'] ?></div>
                                            <div class="col-3"><?= $menu['harga'] ?></div>
                                            <div class="col-3"><?= $pesan['qty'] ?></div>
                                            <div class="col-3"><?= $pesan['total_harga'] ?></div>
                                        </div>
                                    <?php } ?>
                                        <div class="row">
                                            <hr class='col-12'>
                                        </div>
                                        <div class="row">
                                            <div class="col-3 font-weight-bold no-hp" style="color:#000">Total Harga Pesanan</div>
                                            <?php $harga = select("pesanan","SUM(total_harga)","WHERE kode_pesanan = '$kodepesanan'")[0]['SUM(total_harga)']; ?>
                                            <div class="col-3 offset-6 font-weight-bold" style="color:#000"><?= $harga ?></div>
                                        </div>
                                        <div class="row mt-3">
                                        <?php
                                        if ($pesanan[0]['status'] == "belum dibayar") {
                                        ?>
                                            <a href="pesanan.php?hapus=true" class="btn btn-danger btn-user">Batalkan Pesanan</a>
                                        <?php
                                        }else{
                                        ?>
                                            <a href="pesanan.php?pesanlagi=true" class="btn btn-primary btn-user">Pesan Lagi</a>
                                        <?php
                                        }
                                        ?>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php
    // if(isset($_COOKIE['scan'])){
    //     echo '<script>
    //     swal({
    //         title: "Yeay, sekarang isi nama",
    //         icon: "success",
    //         button: "Coba Lagi!"
    //     });
    // </script>';
    // }else{
    //     echo "silahkan scan dlu";
    //     header("Location:index.php");
    // }
    ?>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>