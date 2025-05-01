<!DOCTYPE html>
<html lang="tr">

<head>
    <?php
    session_start();
    $dsn = "mysql:host=localhost;dbname=oceanweb_kurye;charset=utf8mb4";
    $username = "oceanweb_kuryeuser";
    $password = "ko61tu61.";
    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Veritabanı hatası: " . $e->getMessage());
    }

    // Sipariş Silme İşlemi
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sil'])) {
        $siparisId = $_POST['siparis_id'] ?? null;
        if ($siparisId) {
            $stmt = $pdo->prepare("DELETE FROM kurye_cagir WHERE id = :id");
            $stmt->execute([':id' => $siparisId]);
            echo "<center><div class='alert alert-success'>Sipariş başarıyla silindi!</div></center>";
        } else {
            echo "<div class='alert alert-danger'>Sipariş silinirken bir hata oluştu!</div>";
        }
    }
    ?>
    <meta charset="utf-8" />
    <title>Bingo Paket - Siparişler</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/vendor.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.min.css" rel="stylesheet" type="text/css" />
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
                    <li class="nav-item"><a class="nav-link active" href="siparisler.php">Siparişler</a></li>
                    <li class="nav-item"><a class="nav-link" href="isletmeler.php">İşletmeler</a></li>
                    <li class="nav-item"><a class="nav-link" href="kuryeler.php">Kuryeler</a></li>
                    <li class="nav-item"><a class="nav-link" href="rapor.php">Raporlar</a></li>
                </ul>
            </div>
        </div>

        <!-- Content -->
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <h4>Siparişler</h4>
                </div>

                <!-- Sipariş Tablosu -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Panelden Gelen Siparişler</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                $query = "SELECT * FROM kurye_cagir WHERE durum != 'Atandı' ORDER BY created_at DESC";
                                $stmt = $pdo->query($query);
                                ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Restoran Adı</th>
                                            <th>Müşteri Adı</th>
                                            <th>Telefon</th>
                                            <th>Adres</th>
                                            <th>Sipariş Tutarı</th>
                                            <th>Ödeme Yöntemi</th>
                                            <th>Durum</th>
                                            <th>Kurye Ata</th>
                                            <th>Sil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                            <tr data-siparis-id="<?= $row['id'] ?>">
                                                <td><?= htmlspecialchars($row['restoran_adi']) ?></td>
                                                <td><?= htmlspecialchars($row['musteri_adi']) ?></td>
                                                <td><?= htmlspecialchars($row['musteri_telefonu']) ?></td>
                                                <td><?= htmlspecialchars($row['musteri_adresi']) ?></td>
                                                <td><?= htmlspecialchars($row['siparis_tutari']) ?> TL</td>
                                                <td><?= htmlspecialchars($row['odeme_yontemi']) ?></td>
                                                <td><?= htmlspecialchars($row['durum']) ?></td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#kuryeAtaModal" data-siparis-id="<?= $row['id'] ?>">Kurye Ata</button>
                                                </td>
                                                <td>
                                                    <form action="" method="POST" style="display:inline-block;">
                                                        <input type="hidden" name="siparis_id" value="<?= $row['id'] ?>">
                                                        <button type="submit" name="sil" class="btn btn-danger btn-sm">Sil</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Diğer Alanlar Korunmuştur -->
            </div>
        </div>
    </div>

    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        document.addEventListener('click', function (event) {
            if (event.target.matches('[data-bs-target="#kuryeAtaModal"]')) {
                const siparisId = event.target.getAttribute('data-siparis-id');
                document.getElementById('siparisIdInput').value = siparisId;
            }
        });
    </script>
</body>

</html>
