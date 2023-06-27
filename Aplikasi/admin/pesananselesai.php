<?php
require "../db_func.php";
session_start();
$pesanan = select('pesanan','kode_pesanan,nama,SUM(total_harga) as total_harga','WHERE status = "sudah dibayar" GROUP BY kode_pesanan;');

if (ISSET($_SESSION['level'])) {
    if (!$_SESSION['level'] == "admin") {
        header("location:../login.php");
    }
}else {
    header("location:../login.php");
}

if(ISSET($_GET['logout'])){
    session_destroy();
    header("location:../login.php");
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
    
    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        h6, p, a, b{
            color:#fc6c14;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color:#fc7c2a;" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon">
                    <img src="../img/logo.png" alt="" width="150">
                </div>
                <!-- <div class="sidebar-brand-text mx-3">Logo/Name</div> -->
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="crudmenu.php">
                    <i class="fa fa-fw fa-hamburger"></i>
                    <span>Menu</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="crudpesanan.php">
                    <i class="fa fa-fw fa-list"></i>
                    <span>Pesanan</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="pesananselesai.php">
                    <i class="fas fa-fw fa-check"></i>
                    <span>Pesanan Selesai</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cruduser.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>User</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="laporan.php">
                    <i class="fas fa-fw fa-clipboard"></i>
                    <span>Laporan Penjualan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['level'] ?></span>
                                <div class="topbar-divider d-none d-sm-block"></div>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['nama'] ?></span>
                                <img class="img-profile rounded-circle"
                                    src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->

                    <div class="row">
                        <div class="card shadow mb-4 col-12">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold">Daftar Pesanan Selesai</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>Kode Pesanan</th>
                                                <th>Nama Pemesan</th>
                                                <th>Total</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>NO</th>
                                                <th>Kode Pesanan</th>
                                                <th>Nama Pemesan</th>
                                                <th>Total</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php $i=1; foreach ($pesanan as $pesan) { ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= $pesan["kode_pesanan"]; ?></td>
                                                    <td><?= $pesan["nama"]; ?></td>
                                                    <td><?= $pesan["total_harga"]; ?></td>
                                                    <td>
                                                        <button class="btn btn-success" data-toggle="modal" data-target="#confirmModal<?= $pesan["kode_pesanan"] ?>">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php $i++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Detail Modal -->
    <?php foreach ($pesanan as $pesan) { ?>

<div class="modal fade" id="confirmModal<?= $pesan["kode_pesanan"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Yakin Ingin Konfirmasi Pesanan Ini ?</h3>
            </div>
            <div class="modal-body">

            <div class="row">
                <div class="col-12 text-primary"><?= "Kode Pesanan: ".$pesan['kode_pesanan'] ?></div>
                <div class="col-12 text-primary"><?= "Nama : ".$pesan['nama'] ?></div>
            </div>
            
            <br>

            <?php
                $kode_pesanan = $pesan["kode_pesanan"];
                $menus = select("pesanan","id_menu, qty","WHERE kode_pesanan = '$kode_pesanan' ");
                
            ?>
            <div class="row">
                <div class="col-3 text-primary">Menu</div>
                <div class="col-3 text-primary">Harga Satuan</div>
                <div class="col-3 text-primary">Jumlah Dipesan</div>
                <div class="col-3 text-primary">Total Harga</div>
            </div>
            <br>
            <?php

                foreach ($menus as $menu) {
                $idmenu = $menu['id_menu'];
                $qty = $menu['qty'];
                $menu2 = select("menu","*","WHERE id = $idmenu")[0];
            ?>
                            
                <div class="row">
                    <div class="col-3 text-primary"><?=$menu2['menu']?></div>
                    <div class="col-3 text-primary"><?=$menu2['harga']?></div>
                    <div class="col-3 text-primary"><?=$menu['qty']?></div>
                    <div class="col-3 text-primary"><?=$menu['qty'] * $menu2['harga']?></div>
                </div>
                <br>
            <?php } ?>
            
            <br>

            <div class="row">
                <div class="col-6 text-primary">Total Harga :</div>
                <div class="col-3 offset-3 text-primary"><?= $pesan['total_harga'] ?></div>
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?php } ?>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->

    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="post" class="user" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="exampleModalLabel">Yakin Ingin Logout ?</h3>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="<?= $menu["id"] ?>">
                        <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">Batal</button>
                        <a href="crudmenu.php?logout=true" class="btn btn-danger btn-user">Logout</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

    <!-- <script src="bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="bootstrap/js/popper.min.js"></script> -->

</body>

</html>