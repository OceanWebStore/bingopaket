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

    // Panelden gelen sipariş verisini al
    $siparis = null;
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['siparis_id'])) {
        $siparisId = $_POST['siparis_id'];
        // Sipariş bilgilerini getir
        $stmt = $pdo->prepare("SELECT restoran_adi, musteri_adi, musteri_telefonu, musteri_adresi, siparis_tutari, odeme_yontemi FROM kurye_cagir WHERE id = :id");
        $stmt->execute([':id' => $siparisId]);
        $siparis = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>
    <meta charset="utf-8" />
    <title>Bingo Paket - Sipariş Detayı</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/vendor.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="app-wrapper">
        <header class="app-topbar">
            <div class="container-fluid">
                <h4>Sipariş Detayı</h4>
            </div>
        </header>

        <div class="page-content">
            <div class="container-fluid">
                <?php if ($siparis): ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Sipariş Detayı</h4>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Restoran Adı</th>
                                        <th>Müşteri Adı</th>
                                        <th>Telefon</th>
                                        <th>Adres</th>
                                        <th>Sipariş Tutarı</th>
                                        <th>Ödeme Yöntemi</th>
                                        <th>Aksiyon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= htmlspecialchars($siparis['restoran_adi']) ?></td>
                                        <td><?= htmlspecialchars($siparis['musteri_adi']) ?></td>
                                        <td><?= htmlspecialchars($siparis['musteri_telefonu']) ?></td>
                                        <td><?= htmlspecialchars($siparis['musteri_adresi']) ?></td>
                                        <td><?= htmlspecialchars($siparis['siparis_tutari']) ?> TL</td>
                                        <td><?= htmlspecialchars($siparis['odeme_yontemi']) ?></td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" onclick="kuryeAta()">Kurye Ata</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger">Herhangi bir sipariş seçilmedi veya sipariş bulunamadı.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        function kuryeAta() {
            alert("Kurye atanma işlemi başlatıldı.");
            // Buraya kurye atanma işlemini başlatacak kod eklenebilir.
        }
    </script>
</body>

</html>
