<?php 
session_start();
require_once 'config/koneksi2.php';

if(!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$page = @$_GET['p'];
$aksi = @$_GET['aksi'];

// masih bug
// di halaman tambah transaksi
// di halaman transaksi/perpanjang.php
?>
<!-- <pre>
<?php var_dump($_SESSION['login']);  ?>
</pre> -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>
            <?php
            if($page == 'buku') {
                if($aksi == 'tambah') {
                    echo "Tambah Buku";
                } else if($aksi == 'ubah') {
                    echo "Ubah Buku";
                } else {
                    echo "Halaman Buku";
                }
                
            } else if($page == 'anggota') {
                if($aksi == 'tambah') {
                    echo "Tambah Anggota";
                } else if($aksi == 'ubah') {
                    echo "Ubah Anggota";
                } else {
                    echo "Halaman Anggota";
                }
            } else if($page == 'transaksi') {
                if($aksi == 'tambah') {
                    echo "Peminjaman Buku";
                } else {
                    echo "Riwayat Peminjaman";
                }
            } else {
                header("Location: ?p=transaksi");
                exit;
            }
            
            // if(isset($page)) { 
            //     if($_GET['p'] == 'buku') {
            //         echo "Halaman Buku";
            //     } else if($_GET['p'] == 'anggota') {
            //         echo "Halaman Anggota";
            //     } else if($_GET['p'] == 'transaksi') {
            //         echo "Halaman Transaksi";
            //     }
            // } else {
            //     echo "Dashboard";
            // }
            ?>
        </title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/fontawesomeall.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark padding-10" style="background-color: #092448;">
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <a class="navbar-brand" href="?p=transaksi" style="font-size: 30px;"><strong>Book-ing</strong></a>
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" style="background-color: #17376D;" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="?p=anggota">
                                <div class="sb-nav-link-icon"><i class="fa fa-users" aria-hidden="true"></i></div>
                                Data Anggota
                            </a>
                            <a class="nav-link" href="?p=transaksi">
                                <div class="sb-nav-link-icon"><i class="fa fa-handshake" aria-hidden="true"></i></div>
                                Riwayat Peminjaman
                            </a>
                            <a class="nav-link" href="?p=transaksi&aksi=tambah">
                                <div class="sb-nav-link-icon"><i class="fa fa-book" aria-hidden="true"></i></div>
                                Peminjaman Buku
                            </a>
                            <a class="nav-link" href="logout.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-arrow-right" aria-hidden="true"></i></div>
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer" style="background-color: #576CBD">
                            <div class="small">Logged in as:</div>
                            <b><?= $_SESSION['login']['username']; ?></b>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <marquee behavior="scroll" class="btn btn-dark" style="background-color: #576CBD">Selamat Datang <b><?= $_SESSION['login']['fullname']; ?></b> di Book-ing: Aplikasi Administratif Peminjaman Buku</marquee>
                    <div class="container-fluid">
                        <!-- <h1 class="mt-4">Static Navigation</h1> -->
                    <?php 

                    if($page == 'buku') {
                        if($aksi == '') {
                            require_once 'page/buku/buku.php';
                        } else if($aksi == 'tambah') {
                            require_once 'page/buku/tambah.php';
                        } else if($aksi == 'ubah') {
                            require_once 'page/buku/ubah.php';
                        } else if($aksi == 'hapus') {
                            require_once 'page/buku/hapus.php';
                        }
                    } else if($page == 'anggota') {
                        if($aksi == '') {
                            require_once 'page/anggota/anggota.php';
                        } else if($aksi == 'tambah') {
                            require_once 'page/anggota/tambah.php';
                        } else if($aksi == 'ubah') {
                            require_once 'page/anggota/ubah.php';
                        } else if($aksi == 'hapus') {
                            require_once 'page/anggota/hapus.php';
                        }
                    } else if($page == 'transaksi') {
                        if($aksi == '') {
                            require_once 'page/transaksi/transaksi.php';
                        } else if($aksi == 'tambah') {
                            require_once 'page/transaksi/tambah.php';
                        } else if($aksi == 'kembali') {
                            require_once 'page/transaksi/kembali.php';
                        } else if($aksi == 'perpanjang') {
                            require_once 'page/transaksi/perpanjang.php';
                        }
                    } else {
                        echo "Halaman Transaksi";
                    }
                    ?>
                        
                    </div>
                </main>
                <!-- <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer> -->
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> -->
        <!-- <script src="assets/demo/chart-area-demo.js"></script> -->
        <!-- <script src="assets/demo/chart-bar-demo.js"></script> -->
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
