<?php
require "../db_func.php";
session_start();

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
            <li class="nav-item">
                <a class="nav-link" href="pesananselesai.php">
                    <i class="fas fa-fw fa-check"></i>
                    <span>Pesanan Selesai</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cruduser.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>User</span></a>
            </li>
            <li class="nav-item active">
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

                        <div class="col-xl-12 col-lg-12">
                            <?php
                                $pesanan = select('pesanan','kode_pesanan,nama,SUM(total_harga) as total_harga','WHERE status = "sudah dibayar" GROUP BY kode_pesanan;');
                                
                            ?>
                            <!-- Area Chart -->
                            <div class="card shadow mb-5">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold">Laporan Pemesanan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="dropdown mb-4">
                                        <?php
                                            if (!ISSET($_GET['thn'])) {
                                                $currentyear = select("pesanan","MAX(substr(pesanan_selesai, 1, 4)) as max","WHERE status = 'sudah dibayar'")[0]['max'];
                                            }else {
                                                $currentyear = $_GET['thn'];
                                            }
                                            $reports = select("pesanan","substr(pesanan_selesai, 1, 7) as bulan, SUM(total_harga) as total"," WHERE pesanan_selesai LIKE '$currentyear%' GROUP BY bulan");
                                            $totalpertahun = select("pesanan","substr(pesanan_selesai, 1, 7) as bulan, SUM(total_harga) as total"," WHERE pesanan_selesai LIKE '$currentyear%'")[0]['total'];
                                            $years = select("pesanan","DISTINCT (substr(pesanan_selesai, 1,4)) as tahun","ORDER BY tahun ASC");
                                            $perbulan = [0,0,0,0,0,0,0,0,0,0,0,0];
                                            foreach ($reports as $report) {
                                                $perbulan[intval(substr($report['bulan'], 5))-1] = $report['total'];
                                            }
                                        ?>
                                        <button class="btn dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <b><?= $currentyear ?></b>
                                        </button>
                                        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                            <?php
                                                foreach ($years as $year) {
                                            ?>
                                                <a class="dropdown-item" href="laporan.php?thn=<?= $year['tahun'] ?>"><?= $year['tahun'] ?></a>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                    <hr>
                                    <p>Total pendapatan pada tahun <?= $currentyear ?> adalah <b class='text-warnings'><?= $totalpertahun?></b></p>
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

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
        }

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ],
            datasets: [{
            label: "Pendapatan",
            lineTension: 0.3,
            backgroundColor: "#FFE9DC",
            borderColor: "#fc7c2a",
            pointRadius: 3,
            pointBackgroundColor: "#FFE9DC",
            pointBorderColor: "#fc7c2a",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "#FFE9DC",
            pointHoverBorderColor: "#fc7c2a",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: [
                <?= implode($perbulan,',') ?>
            ],
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
            },
            scales: {
            xAxes: [{
                time: {
                unit: 'date'
                },
                gridLines: {
                display: false,
                drawBorder: false
                }
            }],
            yAxes: [{
                ticks: {
                maxTicksLimit: 5,
                padding: 10,
                // Include a dollar sign in the ticks
                callback: function(value, index, values) {
                    return 'Rp. ' + number_format(value);
                }
                },
                gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
                }
            }],
            },
            legend: {
            display: false
            },
            tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ': Rp. ' + number_format(tooltipItem.yLabel);
                }
            }
            }
        }
        });
    </script>
    <script src="../js/demo/chart-pie-demo.js"></script>
    <script src="../js/demo/chart-bar-demo.js"></script>
    
    <?php 

    ?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>

</body>

</html>