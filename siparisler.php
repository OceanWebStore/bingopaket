<!DOCTYPE html>
<html lang="tr">

<head>
    <?php
    session_start();
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
                    <li class="nav-item"><a class="nav-link" href="panel.php">Panel</a></li>
                    <li class="nav-item"><a class="nav-link" href="siparisler.php">Siparişler</a></li>
                    <li class="nav-item"><a class="nav-link" href="isletmeler.php">İşletmeler</a></li>
                    <li class="nav-item"><a class="nav-link" href="kuryeler.php">Kuryeler</a></li>
                    <li class="nav-item"><a class="nav-link" href="rapor.php">Raporlar</a></li>
                </ul>
            </div>
        </div>
        <!-- Sol Menü Bitiş -->

        <!-- Sayfa İçeriği -->
        <div class="page-content">
            <div class="container-fluid">

                <!-- Sayfa Başlığı -->
                <div class="page-title-box">
                    <h4>Siparişler</h4>
                </div>

                <!-- Panel.php Verilerini Göster -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Panelden Gelen Veriler</h4>
                            </div>
                            <div class="card-body">
                                <div id="panel-verileri">
                                    <?php
                                    // Veritabanı bağlantısı
                                    $dsn = "mysql:host=localhost;dbname=oceanweb_kurye;charset=utf8mb4";
                                    $username = "oceanweb_kuryeuser";
                                    $password = "ko61tu61.";

                                    try {
                                        $pdo = new PDO($dsn, $username, $password);
                                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                        // Verileri al ve göster
                                        $query = "SELECT * FROM kurye_cagir ORDER BY created_at DESC";
                                        $stmt = $pdo->query($query);

                                        echo '<table style="width: 100%; border-collapse: collapse;">';
                                        echo '<tr>
                                                <th style="border: 1px solid #ddd; padding: 8px;">Müşteri Adı</th>
                                                <th style="border: 1px solid #ddd; padding: 8px;">Telefon</th>
                                                <th style="border: 1px solid #ddd; padding: 8px;">Adres</th>
                                                <th style="border: 1px solid #ddd; padding: 8px;">Adres Tarifi</th>
                                                <th style="border: 1px solid #ddd; padding: 8px;">Ödeme Yöntemi</th>
                                                <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Kurye Ata</th>
                                            </tr>';

                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<tr>';
                                            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . htmlspecialchars($row['musteri_adi']) . '</td>';
                                            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . htmlspecialchars($row['musteri_telefonu']) . '</td>';
                                            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . htmlspecialchars($row['musteri_adresi']) . '</td>';
                                            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . htmlspecialchars($row['adres_tarifi']) . '</td>';
                                            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . htmlspecialchars($row['odeme_yontemi']) . '</td>';

                                            // Kurye Ata butonu
                                            echo '<td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                                    <form action="kurye_ata.php" method="POST">
                                                        <input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">
                                                        <button type="submit" class="btn btn-success" style="background-color: #28a745; color: white; border: none; padding: 10px 15px; border-radius: 5px; cursor: pointer;">Kurye Ata</button>
                                                    </form>
                                                </td>';
                                            echo '</tr>';
                                        }

                                        echo '</table>';
                                    } catch (PDOException $e) {
                                        echo "Veritabanı hatası: " . $e->getMessage();
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Yeni Alanlar: Kurye Ekle ve Kuryeler Listesi -->
                <div class="row mt-4">
                    <!-- Kuryeler Listesi -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header" style="background-color: #007bff; color: white;">
                                <h4 style="color: white;">Kuryeler Listesi</h4>
                            </div>
                            <div class="card-body">
                                <div style="overflow-y: auto; max-height: 400px;">
                                    <ul class="list-group">
                                        <?php
                                        // Kuryeler veritabanından çekiliyor
                                        $kuryeQuery = "SELECT * FROM kuryeler";
                                        $kuryeStmt = $pdo->query($kuryeQuery);

                                        while ($kurye = $kuryeStmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                                            echo '<span><strong>Ad Soyad:</strong> ' . htmlspecialchars($kurye['ad_soyad']) . '</span>';
                                            echo '<span><strong>Telefon:</strong> ' . htmlspecialchars($kurye['telefon']) . '</span>';
                                            echo '<span><strong>Email:</strong> ' . htmlspecialchars($kurye['email']) . '</span>';
                                            echo '</li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kurye Ekle -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header" style="background-color: #007bff; color: white;">
                                <h4 style="color: white;">Kurye Ekle</h4>
                            </div>
                            <div class="card-body">
                                <form action="kurye_ekle.php" method="POST">
                                    <div class="mb-3">
                                        <label for="kuryeAdi" class="form-label">Adı Soyadı</label>
                                        <input type="text" class="form-control" id="kuryeAdi" name="kuryeAdi" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kuryeTelefon" class="form-label">Telefon Numarası</label>
                                        <input type="text" class="form-control" id="kuryeTelefon" name="kuryeTelefon" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kuryeMail" class="form-label">Mail Adresi</label>
                                        <input type="email" class="form-control" id="kuryeMail" name="kuryeMail" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Kurye Ekle</button>
                                </form>
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
