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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Kurye Talep Ekranı</h4>
                            </div>
                            <div class="card-body">
                                <!-- Kurye Çağır Butonu -->
                                <button class="btn btn-primary btn-lg w-100" data-bs-toggle="modal" data-bs-target="#kuryeCagirModal">
                                    Kurye Çağır
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Sayfa İçeriği Bitiş -->

    </div>
    <!-- Wrapper Bitiş -->

    <!-- Modal (Pop-up) -->
    <div class="modal fade" id="kuryeCagirModal" tabindex="-1" aria-labelledby="kuryeCagirModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kuryeCagirModalLabel">Kurye Çağır</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="kuryeCagirForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="musteriAdi" class="form-label">Müşteri Adı</label>
                            <input type="text" class="form-control" id="musteriAdi" placeholder="Müşteri Adı" required>
                        </div>
                        <div class="mb-3">
                            <label for="musteriTelefonu" class="form-label">Müşteri Telefonu</label>
                            <input type="tel" class="form-control" id="musteriTelefonu" placeholder="Telefon Numarası" required>
                        </div>
                        <div class="mb-3">
                            <label for="musteriAdresi" class="form-label">Müşteri Adresi</label>
                            <textarea class="form-control" id="musteriAdresi" rows="2" placeholder="Müşteri Adresi" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="adresTarifi" class="form-label">Adres Tarifi</label>
                            <textarea class="form-control" id="adresTarifi" rows="2" placeholder="Adres Tarifi"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="odemeYontemi" class="form-label">Ödeme Yöntemi</label>
                            <select class="form-select" id="odemeYontemi" required>
                                <option value="">Ödeme Yöntemi Seçin</option>
                                <option value="Online Ödeme">Online Ödeme</option>
                                <option value="Nakit">Nakit</option>
                                <option value="Kapıda Kredi Kartı">Kapıda Kredi Kartı</option>
                                <option value="Kapıda Yemek Kartı">Kapıda Yemek Kartı</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Kurye Çağır</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Vendor Javascript -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.js"></script>

    <!-- Form Submit Handler -->
    <script>
        document.getElementById('kuryeCagirForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const musteriAdi = document.getElementById('musteriAdi').value;
            const musteriTelefonu = document.getElementById('musteriTelefonu').value;
            const musteriAdresi = document.getElementById('musteriAdresi').value;
            const adresTarifi = document.getElementById('adresTarifi').value;
            const odemeYontemi = document.getElementById('odemeYontemi').value;

            console.log('Kurye Çağrısı Yapıldı:', {
                musteriAdi,
                musteriTelefonu,
                musteriAdresi,
                adresTarifi,
                odemeYontemi
            });

            alert('Kurye çağrısı başarıyla oluşturuldu!');
            const modal = bootstrap.Modal.getInstance(document.getElementById('kuryeCagirModal'));
            modal.hide();
        });
    </script>
</body>

</html>
