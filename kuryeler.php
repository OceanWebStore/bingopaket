<!DOCTYPE html>
<html lang="tr">

<head>
    <?php
    session_start();
    ?>
    <meta charset="utf-8" />
    <title>Bingo Paket - Kuryeler</title>
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
                    <li class="nav-item"><a class="nav-link" href="panel.php">Panel</a></li>
                    <li class="nav-item"><a class="nav-link" href="siparisler.php">Siparişler</a></li>
                    <li class="nav-item"><a class="nav-link" href="isletmeler.php">İşletmeler</a></li>
                    <li class="nav-item"><a class="nav-link active" href="kuryeler.php">Kuryeler</a></li>
                    <li class="nav-item"><a class="nav-link" href="rapor.php">Raporlar</a></li>
                </ul>
            </div>
        </div>
        <!-- İçerik -->
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <h4>Tüm Kuryeler</h4>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Sistemde Kayıtlı Tüm Kuryeler</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                // Veritabanı bağlantısı
                                $dsn = "mysql:host=localhost;dbname=oceanweb_kurye;charset=utf8mb4";
                                $username = "oceanweb_kuryeuser";
                                $password = "ko61tu61.";

                                try {
                                    $pdo = new PDO($dsn, $username, $password);
                                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                 // Tüm kuryeleri getir, id yerine kurye_id kullan!
                                    $query = "SELECT * FROM kuryeler ORDER BY id DESC LIMIT 10";
                                    $stmt = $pdo->query($query);

                                    echo '<table class="table table-bordered">';
                                    echo '<thead>
                                            <tr>
                                                    <th>ID</th>
                                            <th>Ad Soyad</th>
                                            <th>Telefon</th>
                                            <th>Mail</th>
                                            <th>Adres</th>
                                            <th>Durum</th>
                                            <th>Kayıt Tarihi</th>
                                            </tr>
                                          </thead>';
                                    echo '<tbody>';

                                   while ($kurye = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<tr>';
                                      echo '<td>' . htmlspecialchars($kurye['kurye_id']) . '</td>';
                                        echo '<td>' . htmlspecialchars($kurye['ad_soyad']) . '</td>';
                                        echo '<td>' . htmlspecialchars($kurye['telefon']) . '</td>';
                                        echo '<td>' . htmlspecialchars($kurye['mail']) . '</td>';
                                        echo '<td>' . htmlspecialchars($kurye['adres']) . '</td>';
                                        echo '<td>' . htmlspecialchars($kurye['durum']) . '</td>';
                                        echo '<td>' . htmlspecialchars($kurye['kayit_tarihi']) . '</td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody></table>';
                                } catch (PDOException $e) {
                                    echo "<div class='alert alert-danger'>Veritabanı hatası: " . htmlspecialchars($e->getMessage()) . "</div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>
