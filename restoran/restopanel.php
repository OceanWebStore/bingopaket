<!DOCTYPE html>
<html lang="tr">

<head>
    <?php
    session_start();

    // Giriş kontrolü devredışı bırakıldı
    // if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    //     header('Location: giris-yap.php');
    //     exit;
    // }
    ?>
    <!-- Title Meta -->
    <meta charset="utf-8" />
    <title>Bingo Paket - Sıcak Sıcak Kapında !</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Taplox: An advanced, fully responsive admin dashboard template packed with features to streamline your analytics and management needs." />
    <meta name="author" content="StackBros" />
    <meta name="keywords" content="Taplox, admin dashboard, responsive template, analytics, modern UI, management tools" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="robots" content="index, follow" />
    <meta name="theme-color" content="#ffffff">

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Google Font Family link -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">

    <!-- Vendor css -->
    <link href="assets/css/vendor.min.css" rel="stylesheet" type="text/css" />

    <!-- Icons css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="assets/css/style.min.css" rel="stylesheet" type="text/css" />

    <!-- Theme Config js -->
    <script src="assets/js/config.js"></script>
</head>

<body>
    <!-- START Wrapper -->
    <div class="app-wrapper">

        <!-- Topbar Başlangıç -->
        <header class="app-topbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="d-flex align-items-center gap-2">
                        <!-- Menü Düğmesi -->
                        <div class="topbar-item">
                            <button type="button" class="button-toggle-menu topbar-button">
                                <iconify-icon icon="solar:hamburger-menu-outline" class="fs-24 align-middle"></iconify-icon>
                            </button>
                        </div>

                        <!-- Arama -->
                        <form class="app-search d-none d-md-block me-auto">
                            <div class="position-relative">
                                <input type="search" class="form-control" placeholder="Arama Yap" autocomplete="off" value="">
                                <iconify-icon icon="solar:magnifer-outline" class="search-widget-icon"></iconify-icon>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <!-- Topbar Bitiş -->

        <!-- Sol Menü -->
        <div class="app-sidebar">
            <div class="scrollbar" data-simplebar>
                <!-- Logo -->
                <div class="logo-box">
                    <a href="panel.html" class="logo-dark">
                        <img src="assets/images/logo-sm.png" class="logo-sm" alt="Logo Small">
                        <img src="assets/images/logo-dark.png" class="logo-lg" alt="Logo Dark">
                    </a>
                    <a href="panel.html" class="logo-light">
                        <img src="assets/images/logo-sm.png" class="logo-sm" alt="Logo Small">
                        <img src="assets/images/logo-light.png" class="logo-lg" alt="Logo Light">
                    </a>
                </div>

                <ul class="navbar-nav">
                    <li class="menu-title">MENÜ</li>
                    <li class="nav-item"><a class="nav-link" href="panel.html">Panel</a></li>
                    <li class="nav-item"><a class="nav-link" href="siparisler.html">Siparişler</a></li>
                    <li class="nav-item"><a class="nav-link" href="isletmeler.html">İşletmeler</a></li>
                    <li class="nav-item"><a class="nav-link" href="kuryeler.html">Kuryeler</a></li>
                    <li class="nav-item"><a class="nav-link" href="rapor.html">Raporlar</a></li>
                </ul>
            </div>
        </div>
        <!-- Sol Menü Bitiş -->

        <!-- Sayfa İçeriği -->
        <div class="page-content">
            <div class="container-fluid">

                <!-- Sayfa Başlığı -->
                <div class="page-title-box">
                    <h4>Panel</h4>
                </div>

                <!-- Kurye Talep Ekranı -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Kurye Talep Ekranı</h4>
                            </div>
                            <div class="card-body">
                                Kurye Çağrıları Bu Alana Gelecek
                            </div>
                        </div>
                    </div>

                    <!-- Son Eklenen İşletmeler -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Son Eklenen İşletmeler</h4>
                            </div>
                            <div class="card-body">
                                Son Eklenen İşletmeler Bu Alana Gelecek
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Eklenen Kuryeler ve Siparişler -->
                <div class="row">
                    <!-- Son Eklenen Kuryeler -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Son Eklenen Kuryeler</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Tarih</th>
                                            <th>İsim</th>
                                            <th>Hesap</th>
                                            <th>Kullanıcı Adı</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>26 Nisan 2025</td>
                                            <td>Ahmet YILMAZ</td>
                                            <td>Doğrulandı</td>
                                            <td>@ayilmaz</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Son Siparişler -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Son Siparişler</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Restaurant</th>
                                            <th>Tarih</th>
                                            <th>Müşteri Adı</th>
                                            <th>Telefon</th>
                                            <th>Adres</th>
                                            <th>Ödeme Yöntemi</th>
                                            <th>Durum</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#TZ5625</td>
                                            <td>29 April 2024</td>
                                            <td>Anna M. Hines</td>
                                            <td>(+1)-555-1564-261</td>
                                            <td>Burr Ridge/Illinois</td>
                                            <td>Credit Card</td>
                                            <td>Teslim Edildi</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Sayfa İçeriği Bitiş -->

    </div>
    <!-- Wrapper Bitiş -->

    <!-- Vendor Javascript -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>
