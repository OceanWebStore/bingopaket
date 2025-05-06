<?php
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8" />
    <title>Bingo Paket - Raporlar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kurye yönetim paneli" />
    <meta name="author" content="StackBros" />
    <meta name="keywords" content="Kurye, yönetim, liste" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="robots" content="index, follow" />
    <meta name="theme-color" content="#ffffff">

    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="assets/css/vendor.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.min.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/config.js"></script>
    <style>
        .card-full-width {
            width: 100%;
            margin-bottom: 24px;
        }
        .row.mb-4 {
            margin-bottom: 24px!important;
        }
        .soft-card {
            border: 2.5px solid #1976d2;
            border-radius: 16px;
            box-shadow: 0 4px 16px 0 rgba(25,118,210,0.06), 0 1.5px 7px 0 rgba(25,118,210,0.10);
            background: linear-gradient(90deg, #f5faff 0%, #ffffff 100%);
        }
        .soft-card-header {
            background: linear-gradient(to right, #1976d2 60%, #42a5f5 100%);
            color: #fff;
            border-radius: 13px 13px 0 0;
            border-bottom: 2px solid #1976d2;
            box-shadow: 0 2px 7px 0 rgba(25,118,210,0.10);
        }
        .kurye-header-white {
            color: #fff !important;
        }
        .restoran-header-bg {
            background: linear-gradient(90deg, #8e24aa 60%, #ce93d8 100%) !important;
            color: #fff !important;
            border-radius: 13px 13px 0 0;
            border-bottom: 2px solid #6a1b9a;
            box-shadow: 0 2px 7px 0 rgba(142,36,170,0.12);
        }
        .soft-table thead th {
            background: #e3f2fd;
            color: #1976d2;
            font-weight: 600;
            border-bottom: 2px solid #90caf9;
        }
        .soft-table tbody tr:nth-child(even) {
            background: #f5faff;
        }
        .soft-table tbody tr:hover {
            background: #e1f5fe;
        }
        .soft-table td, .soft-table th {
            border: 1px solid #bbdefb;
            padding: 8px 12px;
        }
        .soft-table .table-total {
            background: #fff3e0 !important;
            color: #f57c00;
            font-weight: bold;
        }
        .soft-table .table-success {
            background: #e8f5e9 !important;
            color: #388e3c;
            font-weight: bold;
        }
        .cell-cash { background: #fffde7; }
        .cell-online { background: #e3fced; }
        .cell-credit { background: #e3f2fd; }
        .cell-food { background: #fce4ec; }
        .cell-rapor { background: #f2f7fa; text-align:center; }
        .logout-btn {
            margin-top: 24px;
            margin-bottom: 12px;
        }
        .logout-btn a {
            font-weight: bold;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
    </style>
</head>

<body>
    <div class="app-wrapper">
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
                        <a class="nav-link active" href="rapor.php">
                            <i class="iconify" data-icon="mdi:file-chart-outline"></i> Raporlar
                        </a>
                    </li>
                </ul>
                <div class="logout-btn mt-auto">
                    <a class="nav-link btn btn-danger text-white w-100" href="logout.php"
                        onclick="return confirm('Çıkış yapmak istediğinize emin misiniz?');">
                        <span>
                            <i class="iconify" data-icon="mdi:logout-variant"></i>
                        </span>
                        Çıkış Yap
                    </a>
                </div>
            </div>
        </div>
        <!-- İçerik -->
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <h4>Rapor Sayfası</h4>
                </div>
                <!-- Kurye Raporları -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card card-full-width soft-card">
                            <div class="card-header d-flex justify-content-between align-items-center soft-card-header">
                                <h4 class="kurye-header-white" style="margin-bottom:0;">Kurye Raporları</h4>
                                <button onclick="printKuryeRaporlari()" class="btn btn-light btn-sm" style="font-weight:bold;">Yazdır</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table soft-table">
                                        <thead>
                                        <tr>
                                            <th>Kurye Adı</th>
                                            <th>PS</th>
                                            <th class="cell-cash">Nakit</th>
                                            <th class="cell-online">Online Ödeme</th>
                                            <th class="cell-credit">Kapıda Kredi Kartı</th>
                                            <th class="cell-food">Yemek Kartı</th>
                                            <th class="table-total">Toplam Tutar</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        try {
                                            $pdo = new PDO("mysql:host=localhost;dbname=oceanweb_kurye;charset=utf8mb4", "oceanweb_kuryeuser", "ko61tu61.");
                                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                            // Saat aralığı: 10:00'dan ertesi gün 04:00'a kadar
                                            $now = new DateTime('now', new DateTimeZone('Europe/Istanbul'));
                                            $hour = (int)$now->format('H');
                                            $minute = (int)$now->format('i');
                                            if ($hour >= 4 && $hour < 10) {
                                                $start = (clone $now)->modify('-1 day')->setTime(10, 0, 0);
                                                $end = (clone $now)->setTime(4, 0, 0);
                                            } else {
                                                if ($hour < 10) {
                                                    $start = (clone $now)->modify('-1 day')->setTime(10, 0, 0);
                                                } else {
                                                    $start = (clone $now)->setTime(10, 0, 0);
                                                }
                                                $end = $now;
                                            }

                                            $query = "
                                                SELECT 
                                                    k.id AS kurye_id, k.ad AS kurye_ad, k.soyad AS kurye_soyad,
                                                    COUNT(kc.id) AS paket_sayisi,
                                                    SUM(CASE WHEN kc.odeme_yontemi IN ('Nakit', 'Kapıda Nakit') THEN kc.siparis_tutari ELSE 0 END) AS nakit,
                                                    SUM(CASE WHEN kc.odeme_yontemi IN ('Online Kredi Kartı', 'Online Ödeme') THEN kc.siparis_tutari ELSE 0 END) AS online_odeme,
                                                    SUM(CASE WHEN kc.odeme_yontemi = 'Kapıda Kredi Kartı' THEN kc.siparis_tutari ELSE 0 END) AS kapida_kredi,
                                                    SUM(CASE WHEN kc.odeme_yontemi = 'Kapıda Yemek Kartı' THEN kc.siparis_tutari ELSE 0 END) AS kapida_yemek,
                                                    SUM(kc.siparis_tutari) AS toplam_tutar
                                                FROM kurye_cagir kc
                                                INNER JOIN kuryeler k ON kc.atanan_kurye_id = k.id
                                                WHERE kc.atanan_kurye_id IS NOT NULL
                                                  AND kc.created_at BETWEEN :start AND :end
                                                GROUP BY k.id, k.ad, k.soyad
                                                HAVING paket_sayisi > 0
                                                ORDER BY paket_sayisi DESC
                                            ";
                                            $stmt = $pdo->prepare($query);
                                            $stmt->execute([
                                                ':start' => $start->format('Y-m-d H:i:s'),
                                                ':end' => $end->format('Y-m-d H:i:s')
                                            ]);

                                            $total_ps = 0;
                                            $total_nakit = 0;
                                            $total_online = 0;
                                            $total_kredi = 0;
                                            $total_yemek = 0;
                                            $total_toplam = 0;

                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                $total_ps += intval($row['paket_sayisi']);
                                                $total_nakit += floatval($row['nakit']);
                                                $total_online += floatval($row['online_odeme']);
                                                $total_kredi += floatval($row['kapida_kredi']);
                                                $total_yemek += floatval($row['kapida_yemek']);
                                                $total_toplam += floatval($row['toplam_tutar']);
                                                echo "<tr>";
                                                echo "<td><strong style='color:#1976d2;'>" . htmlspecialchars($row['kurye_ad'] . ' ' . ($row['kurye_soyad'] ?? '')) . "</strong></td>";
                                                echo "<td>" . intval($row['paket_sayisi']) . "</td>";
                                                echo "<td class='cell-cash'>" . number_format($row['nakit'] ?? 0, 2) . " TL</td>";
                                                echo "<td class='cell-online'>" . number_format($row['online_odeme'] ?? 0, 2) . " TL</td>";
                                                echo "<td class='cell-credit'>" . number_format($row['kapida_kredi'] ?? 0, 2) . " TL</td>";
                                                echo "<td class='cell-food'>" . number_format($row['kapida_yemek'] ?? 0, 2) . " TL</td>";
                                                echo "<td class='table-total'><strong>" . number_format($row['toplam_tutar'] ?? 0, 2) . " TL</strong></td>";
                                                echo "</tr>";
                                            }
                                            // Toplamlar satırı
                                            echo "<tr class='table-success'>";
                                            echo "<td><strong>TOPLAM</strong></td>";
                                            echo "<td><strong>" . $total_ps . "</strong></td>";
                                            echo "<td><strong>" . number_format($total_nakit, 2) . " TL</strong></td>";
                                            echo "<td><strong>" . number_format($total_online, 2) . " TL</strong></td>";
                                            echo "<td><strong>" . number_format($total_kredi, 2) . " TL</strong></td>";
                                            echo "<td><strong>" . number_format($total_yemek, 2) . " TL</strong></td>";
                                            echo "<td class='table-total'><strong>" . number_format($total_toplam, 2) . " TL</strong></td>";
                                            echo "</tr>";
                                        } catch (PDOException $e) {
                                            echo "<tr><td colspan='7'>Kurye raporları yüklenirken hata oluştu: " . $e->getMessage() . "</td></tr>";
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Restoran Raporları -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card card-full-width soft-card">
                            <div class="card-header d-flex justify-content-between align-items-center restoran-header-bg">
                                <h4 style="margin-bottom:0; color:#fff;">Restoran Raporları</h4>
                                <button onclick="printRestoranRaporlari()" class="btn btn-light btn-sm" style="font-weight:bold;">Yazdır</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table soft-table">
                                        <thead>
                                            <tr>
                                                <th>Restoran Adı</th>
                                                <th>Paket Sayısı</th>
                                                <th class="cell-cash">Nakit</th>
                                                <th class="cell-online">Online</th>
                                                <th class="cell-credit">Kredi Kartı</th>
                                                <th class="cell-food">Yemek Kartı</th>
                                                <th class="table-total">Toplam Tutar</th>
                                                <th class="cell-rapor">Rapor İncele</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        try {
                                            $pdo = new PDO("mysql:host=localhost;dbname=oceanweb_kurye;charset=utf8mb4", "oceanweb_kuryeuser", "ko61tu61.");
                                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                            // Aynı saat aralığı kullanılır
                                            $now = new DateTime('now', new DateTimeZone('Europe/Istanbul'));
                                            $hour = (int)$now->format('H');
                                            $minute = (int)$now->format('i');
                                            if ($hour >= 4 && $hour < 10) {
                                                $start = (clone $now)->modify('-1 day')->setTime(10, 0, 0);
                                                $end = (clone $now)->setTime(4, 0, 0);
                                            } else {
                                                if ($hour < 10) {
                                                    $start = (clone $now)->modify('-1 day')->setTime(10, 0, 0);
                                                } else {
                                                    $start = (clone $now)->setTime(10, 0, 0);
                                                }
                                                $end = $now;
                                            }

                                            $query = "
                                                SELECT 
                                                    kc.restoran_adi,
                                                    COUNT(kc.id) AS paket_sayisi,
                                                    SUM(CASE WHEN kc.odeme_yontemi IN ('Nakit', 'Kapıda Nakit') THEN kc.siparis_tutari ELSE 0 END) AS nakit,
                                                    SUM(CASE WHEN kc.odeme_yontemi IN ('Online Kredi Kartı', 'Online Ödeme') THEN kc.siparis_tutari ELSE 0 END) AS online_odeme,
                                                    SUM(CASE WHEN kc.odeme_yontemi = 'Kapıda Kredi Kartı' THEN kc.siparis_tutari ELSE 0 END) AS kapida_kredi,
                                                    SUM(CASE WHEN kc.odeme_yontemi = 'Kapıda Yemek Kartı' THEN kc.siparis_tutari ELSE 0 END) AS kapida_yemek,
                                                    SUM(kc.siparis_tutari) AS toplam_tutar
                                                FROM kurye_cagir kc
                                                WHERE kc.atanan_kurye_id IS NOT NULL
                                                  AND kc.created_at BETWEEN :start AND :end
                                                GROUP BY kc.restoran_adi
                                                ORDER BY paket_sayisi DESC
                                            ";
                                            $stmt = $pdo->prepare($query);
                                            $stmt->execute([
                                                ':start' => $start->format('Y-m-d H:i:s'),
                                                ':end' => $end->format('Y-m-d H:i:s')
                                            ]);

                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                echo "<tr>";
                                                echo "<td><strong style='color:#1976d2;'>" . htmlspecialchars($row['restoran_adi']) . "</strong></td>";
                                                echo "<td>" . intval($row['paket_sayisi']) . "</td>";
                                                echo "<td class='cell-cash'>" . number_format($row['nakit'] ?? 0, 2) . " TL</td>";
                                                echo "<td class='cell-online'>" . number_format($row['online_odeme'] ?? 0, 2) . " TL</td>";
                                                echo "<td class='cell-credit'>" . number_format($row['kapida_kredi'] ?? 0, 2) . " TL</td>";
                                                echo "<td class='cell-food'>" . number_format($row['kapida_yemek'] ?? 0, 2) . " TL</td>";
                                                echo "<td class='table-total'><strong>" . number_format($row['toplam_tutar'] ?? 0, 2) . " TL</strong></td>";
                                                echo "<td class='cell-rapor'><a href='#' class='btn btn-sm btn-outline-primary'>İncele</a></td>";
                                                echo "</tr>";
                                            }
                                        } catch (PDOException $e) {
                                            echo "<tr><td colspan='8'>Restoran raporları yüklenirken hata oluştu: " . $e->getMessage() . "</td></tr>";
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Diğer kutular -->
                <div class="row mt-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Scripts -->
    <script>
        function printKuryeRaporlari() {
            var card = document.querySelectorAll('.card-body')[0];
            var printWindow = window.open('', '', 'height=400,width=600');
            printWindow.document.write('<html><head><title>Kurye Raporları</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(card.innerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }

        function printRestoranRaporlari() {
            var card = document.querySelectorAll('.card-body')[1];
            var printWindow = window.open('', '', 'height=400,width=600');
            printWindow.document.write('<html><head><title>Restoran Raporları</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(card.innerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>
