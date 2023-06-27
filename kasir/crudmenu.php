<?php
require "../db_func.php";
session_start();
$menus = select('menu');

if (ISSET($_SESSION['level'])) {
    if (!$_SESSION['level'] == "kasir") {
        header("location:../login.php");
    }
}else {
    header("location:../login.php");
}

if(ISSET($_GET['logout'])){
    session_destroy();
    header("location:../login.php");
}

if(ISSET($_POST['tambah'])){
    $menu = $_POST['menu'];
    $harga = $_POST['harga'];
    $gambar = $_FILES["gambar"]["name"];

    $file = "../uploaded_image/".basename($_FILES["gambar"]["name"]);
    move_uploaded_file($_FILES["gambar"]["tmp_name"], $file);
    
    if(insert("menu", "(null, '$menu', '$gambar', '$harga')")){
        header("location:crudmenu.php");
    }
}

if(ISSET($_POST['ubah'])){
    $id = $_POST['id'];
    $menu = $_POST['menu'];
    $harga = $_POST['harga'];
    $gambar = $_FILES["gambar"]["name"];

    $file = "../uploaded_image/".basename($_FILES["gambar"]["name"]);
    move_uploaded_file($_FILES["gambar"]["tmp_name"], $file);

    if(update("menu", "menu = '$menu', gambar = '$gambar', harga = '$harga'", "WHERE id = $id")){
        header("location:crudmenu.php");
    }
    
}

if(ISSET($_POST['hapus'])){
    $id = $_POST['id'];

    if(delete("menu", "WHERE id = $id")){
        header("location:crudmenu.php");
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
                    <i class="fas fa-mug-hot"></i>
                </div>
                <!-- <div class="sidebar-brand-text mx-3">Logo/Name</div> -->
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="crudmenu.php">
                    <i class="fa fa-fw fa-hamburger"></i>
                    <span>Menu</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="crudpesanan.php">
                    <i class="fa fa-fw fa-list"></i>
                    <span>Pesanan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pesananselesai.php">
                    <i class="fas fa-fw fa-check"></i>
                    <span>Pesanan Selesai</span></a>
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
                                <h6 class="m-0 font-weight-bold">Table Menu</h6>
                            </div>
                            <div class="row mt-3">
                                <div class="col-4">
                                    <button class="btn btn-user" data-toggle="modal" data-target="#insertModal" style="background-color:#fc6c14; color:#fff;">
                                    Tambah Menu
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>Menu</th>
                                                <th>Gambar</th>
                                                <th>Harga</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>NO</th>
                                                <th>Menu</th>
                                                <th>Gambar</th>
                                                <th>Harga</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php $i=1; foreach ($menus as $menu) { ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= $menu["menu"]; ?></td>
                                                    <td><img class="offset-2 col-8" height="150px" src="../uploaded_image/<?= $menu['gambar']; ?>" alt=""></td>
                                                    <td><?= $menu["harga"]; ?></td>
                                                    <td>
                                                        <button class="btn btn-warning btn-circle" data-toggle="modal" data-target="#updateModal<?= $menu["id"] ?>">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteModal<?= $menu["id"] ?>">
                                                            <i class="fas fa-trash"></i>
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

    <!-- Insert Modal -->
    <div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" class="user" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Menu</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="menu">Nama Menu :</label>
                            <input type="text" class="form-control form-control-user" name="menu" id="menu">
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar Menu :</label>
                            <input type="file" class="form-control-file form-control-user" name="gambar" id="gambar">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga Menu :</label>
                            <input type="number" class="form-control form-control-user" name="harga" id="harga">
                        </div>
                        <hr>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">Batal</button>
                        <input type="submit" value="Tambah Data" class="btn btn-primary btn-user" name="tambah">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <?php $i=1; foreach ($menus as $menu) { ?>

    <div class="modal fade" id="updateModal<?= $menu["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" class="user" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="exampleModalLabel">Ubah Data Menu</h3>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $menu["id"] ?>">
                        <div class="form-group">
                            <label for="menu">Nama Menu :</label>
                            <input type="text" class="form-control form-control-user" name="menu" id="menu" value="<?= $menu["menu"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar Menu :</label>
                            <input type="file" class="form-control-file form-control-user" name="gambar" id="gambar" value="<?= $menu["gambar"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga Menu :</label>
                            <input type="number" class="form-control form-control-user" name="harga" id="harga" value="<?= $menu["harga"] ?>">
                        </div>
                        <hr>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">Batal</button>
                        <input type="submit" value="Ubah Data" class="btn btn-warning btn-user" name="ubah">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php $i++; } ?>

    <!-- Delete Modal -->
    <?php $i=1; foreach ($menus as $menu) { ?>

    <div class="modal fade" id="deleteModal<?= $menu["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="post" class="user" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="exampleModalLabel">Yakin Ingin Hapus Menu Ini ?</h3>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="<?= $menu["id"] ?>">
                        <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">Batal</button>
                        <input type="submit" value="Hapus Data" class="btn btn-danger btn-user" name="hapus">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php $i++; } ?>

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