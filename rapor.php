<!DOCTYPE html>
<html lang="tr">

<head>
    <?php
    session_start();
    ?>
    <meta charset="utf-8" />
    <title>Bingo Paket - Raporlar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kurye yönetim paneli" />
    <meta name="author" content="StackBros" />
    <meta name="keywords" content="Kurye, yönetim, liste" />
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
    <div class="app-wrapper">
        <!-- Topbar -->
        <header class="app-topbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="d-flex align-items-center gap-2">
                        <div class="topbar-item">
                            <button type="button" class="button-toggle-menu topbar-button">
                                <iconify-icon icon="solar:hamburger-menu-outline" class="fs-24 align-middle"></iconify-icon>
                            </button>
                        </div>
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
        <!-- Sidebar -->
        <div class="app-sidebar">
            <div class="scrollbar" data-simplebar>
                <div class="logo-box">
                    <a href="panel.php" class="logo-dark">
                        <img src="assets/images/logo-sm.png" class="logo-sm" alt="Logo Small">
                        <img src="assets/images/logo-dark.png" class="logo-lg" alt="Logo Dark">
                    </a>
                    <a href="panel.php" class="logo-light">
                        <img src="assets/images/logo-sm.png" class="logo-sm" alt="Logo Small">
                        <img src="assets/images/logo-light.png" class="logo-lg" alt="Logo Light">
                    </a>
                </div>
                <ul class="navbar-nav">
                   <li class="menu-title">MENÜ</li>
                    <li class="nav-item">
                        <a class="nav-link" href="panel.php">
                            <i class="iconify" data-icon="mdi:view-dashboard-outline"></i> Panel
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="isletmeler.php">
                            <i class="iconify" data-icon="mdi:storefront-outline"></i> İşletmeler
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kuryeler.php">
                            <i class="iconify" data-icon="mdi:moped-outline"></i> Kuryeler
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rapor.php">
                            <i class="iconify" data-icon="mdi:file-chart-outline"></i> Raporlar
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- İçerik -->
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <h4>Rapor Sayfası</h4>
                </div>
                <div class="row">
                    <!-- Sol Üst - Kurye Raporları -->
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Kurye Raporları</h4>
                                <!-- Print Button -->
                                <button onclick="printKuryeRaporlari()" class="btn btn-primary btn-sm">Yazdır</button>
                            </div>
                            <div class="card-body">
                                <p>Burada kurye raporları yer alacak. Dinamik veriler eklendi.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Sağ Üst - Restoran Raporları -->
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Restoran Raporları</h4>
                                <!-- Print Button -->
                                <button onclick="printRestoranRaporlari()" class="btn btn-primary btn-sm">Yazdır</button>
                            </div>
                            <div class="card-body">
                                <?php
                                try {
                                    $pdo = new PDO("mysql:host=localhost;dbname=oceanweb_kurye;charset=utf8mb4", "oceanweb_kuryeuser", "ko61tu61.");
                                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    // Günlük Paket Sayısı
                                    $queryPaket = "SELECT COUNT(*) as gunluk_paket FROM siparisler WHERE DATE(siparis_tarihi) = CURDATE()";
                                    $stmtPaket = $pdo->query($queryPaket);
                                    $gunlukPaket = $stmtPaket->fetch(PDO::FETCH_ASSOC)['gunluk_paket'];

                                    // Kapıda Nakit Siparişlerin Toplamı
                                    $queryNakit = "SELECT SUM(tutar) as kapida_nakit FROM siparisler WHERE DATE(siparis_tarihi) = CURDATE() AND odeme_yontemi = 'Kapıda Nakit'";
                                    $stmtNakit = $pdo->query($queryNakit);
                                    $kapidaNakit = $stmtNakit->fetch(PDO::FETCH_ASSOC)['kapida_nakit'];

                                    echo "<p>Günlük Paket Sayısı: <strong>" . htmlspecialchars($gunlukPaket) . "</strong></p>";
                                    echo "<p>Kapıda Nakit Sipariş Tutarı: <strong>" . htmlspecialchars($kapidaNakit) . " TL</strong></p>";
                                } catch (PDOException $e) {
                                    echo "Restoran raporları yüklenirken hata oluştu: " . $e->getMessage();
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <!-- Sol Alt - Gelir Raporları -->
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Gelir Raporları</h4>
                            </div>
                            <div class="card-body">
                                <p>Burada gelir raporlarını görüntüleyebilirsiniz. Dinamik veriler eklenecek.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Sağ Alt - Gider Raporları -->
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Gider Raporları</h4>
                            </div>
                            <div class="card-body">
                                <p>Burada gider raporlarını görüntüleyebilirsiniz. Dinamik veriler eklenecek.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Print Scripts -->
    <script>
        function printKuryeRaporlari() {
            const content = document.querySelector(".card-body").innerHTML;
            const printWindow = window.open("", "_blank");
            printWindow.document.write("<html><head><title>Kurye Raporları</title></head><body>");
            printWindow.document.write(content);
            printWindow.document.write("</body></html>");
            printWindow.document.close();
            printWindow.print();
        }

        function printRestoranRaporlari() {
            const content = document.querySelector(".card-body").innerHTML;
            const printWindow = window.open("", "_blank");
            printWindow.document.write("<html><head><title>Restoran Raporları</title></head><body>");
            printWindow.document.write(content);
            printWindow.document.write("</body></html>");
            printWindow.document.close();
            printWindow.print();
        }
    </script>
    <!-- Vendor JS -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>
