<?php
require "../db_func.php";

session_start();

if(!ISSET($_SESSION["nama_pelanggan"])){
    header("Location:nama.php");
}

$menus = select("menu");

if(ISSET($_POST['pesan'])){
    $pelanggan = $_SESSION['nama_pelanggan'];
    $kodepesananmax = select("pesanan", "MAX(CAST(SUBSTRING(kode_pesanan FROM 4) AS UNSIGNED)) as max")[0]["max"];
    if (empty($kodepesananmax)) {
        $kodepesanan = 'PSN1';
    }else{
        $kodepesanan = $kodepesananmax;
        $kodepesanan++;
        $kodepesanan = 'PSN'.$kodepesanan;
    }
    
    $_SESSION['kodepesanan'] = $kodepesanan;
    foreach ($_POST as $key => $value) {
        if (ISSET($value['idmenu'])) {
            $idmenu = $value['idmenu'];
            $qty = $value['qty'];
            $harga = select("menu", "harga", "WHERE id = $idmenu")[0]['harga'];
            $total = $qty * $harga;
            $insert = insert("pesanan","(null, '$kodepesanan','$pelanggan', $idmenu,'$qty',$total,'belum dibayar','null')");
            if($insert === true){
                $status = true;
                continue;
            }else{
                $status = $insert;
                break;
            }
        }
    }

    if ($status == true) {
        header("Location: pesanan.php");
    }else{
        echo $status;
    }

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

                        <div class="col-12">

                            <div class="card o-hidden border-0 shadow-lg my-5">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="text-center col-12">
                                             <h1 class="h4 text-gray-900 mb-4">Hallo <?= $_SESSION['nama_pelanggan'] ?> Sekarang Pilih Menu!</h1>
                                        </div>
                                    </div>
                                    <form method="post">
                                    <div class="row">
                                        <?php foreach ($menus as $menu) { ?>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card shadow mb-3">
                                                <div class="card-header pt-3">
                                                    <div class="custom-control custom-checkbox small row">
                                                        <input type="checkbox" name="menu<?= $menu['id'] ?>[idmenu]" class="custom-control-input col-1" id="customCheck<?= $menu['id'] ?>" value="<?= $menu['id'] ?>">
                                                        <label class="custom-control-label col-11" for="customCheck<?= $menu['id'] ?>"><h6 class="font-weight-bold" style="color:#fc7c2a"><?= $menu['menu'] ?></h6></label>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <img src="../uploaded_image/<?= $menu['gambar'] ?>" class="col-12" style="height:150px" alt="">
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-4"><?= $menu['harga'] ?></div>
                                                        <div class="form-group col-8">
                                                            <input type="hidden" class="form-control form-control-user" name="menu<?= $menu['id'] ?>[harga]" placeholder="Jumlah" value="<?= $menu['harga'] ?>">
                                                            <input type="number" class="form-control form-control-user" name="menu<?= $menu['id'] ?>[qty]" placeholder="Jumlah">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row">
                                        <input type="submit" value="Pesan" class="col-12 btn" style="background-color:#fc7c2a;color:#fff" name="pesan">
                                    </div>
                                    </form>
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

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>