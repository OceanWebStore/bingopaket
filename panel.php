<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8" />
    <title>Bingo Paket - Sıcak Sıcak Kapında !</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Taplox: An advanced, fully responsive admin dashboard template packed with features to streamline your analytics and management needs." />
    <meta name="author" content="StackBros" />
    <meta name="keywords" content="Taplox, admin dashboard, responsive template, analytics, modern UI, management tools" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="robots" content="index, follow" />
    <meta name="theme-color" content="#ffffff">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" href="assets/css/vendor.min.css" />
    <link rel="stylesheet" href="assets/css/icons.min.css" />
    <link rel="stylesheet" href="assets/css/style.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="assets/js/config.js"></script>
</head>

<body>
    <div class="app-wrapper">
        <!-- Topbar Başlangıç -->
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
        <!-- Topbar Bitiş -->

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
                    <li class="nav-item"><a class="nav-link" href="kuryeler.php">Kuryeler</a></li>
                    <li class="nav-item"><a class="nav-link" href="rapor.php">Raporlar</a></li>
                </ul>
            </div>
        </div>

        <div class="page-content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <h4>Panel</h4>
                </div>

                <!-- Kurye Talep Ekranı -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Kurye Talep Ekranı</h5>
                                <div id="kurye-bilgileri">
                                    <?php
                                    $dsn = "mysql:host=localhost;dbname=oceanweb_kurye;charset=utf8mb4";
                                    $username = "oceanweb_kuryeuser";
                                    $password = "ko61tu61.";

                                    try {
                                        $pdo = new PDO($dsn, $username, $password);
                                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                        $query = "SELECT * FROM kurye_cagir WHERE durum NOT IN ('Kabul Edildi', 'İptal Edildi') ORDER BY created_at DESC";
                                        $stmt = $pdo->query($query);

                                        echo '<table class="table table-striped">';
                                        echo '<thead class="table-dark">
                                                <tr>
                                                    <th>Müşteri Adı</th>
                                                    <th>Telefon</th>
                                                    <th>Adres</th>
                                                    <th>Adres Tarifi</th>
                                                    <th>Ödeme Yöntemi</th>
                                                    <th>Aksiyon</th>
                                                </tr>
                                              </thead>';
                                        echo '<tbody>';

                                        while ($kurye = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<tr id="siparis-' . $kurye['id'] . '">';
                                            echo '<td>' . htmlspecialchars($kurye['musteri_adi']) . '</td>';
                                            echo '<td>' . htmlspecialchars($kurye['musteri_telefonu']) . '</td>';
                                            echo '<td>' . htmlspecialchars($kurye['musteri_adresi']) . '</td>';
                                            echo '<td>' . htmlspecialchars($kurye['adres_tarifi']) . '</td>';
                                            echo '<td>' . htmlspecialchars($kurye['odeme_yontemi']) . '</td>';
                                            echo '<td>
                                                    <button class="btn btn-success btn-kabul" data-id="' . $kurye['id'] . '">Kabul Et</button>
                                                    <button class="btn btn-danger btn-iptal" data-id="' . $kurye['id'] . '">İptal Et</button>
                                                  </td>';
                                            echo '</tr>';
                                        }

                                        echo '</tbody>';
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

                <!-- Kurye Listesi -->
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Eklenen Son 10 Kurye</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                try {
                                    // Tüm kuryeleri getir, id yerine kurye_id kullan!
                                    $query = "SELECT * FROM kuryeler ORDER BY kurye_id DESC";
                                    $stmt = $pdo->query($query);

                                    echo '<table class="table table-bordered">';
                                    echo '<thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Kurye Adı</th>
                                                <th>Telefon</th>
                                                <th>Mail</th>
                                                <th>Adres</th>
                                                <th>Durum</th>
                                            </tr>
                                          </thead>';
                                    echo '<tbody>';

                                    while ($kurye = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<tr>';
                                        echo '<td>' . htmlspecialchars($kurye['kurye_id']) . '</td>';
                                        echo '<td>' . htmlspecialchars($kurye['kurye_adi']) . '</td>';
                                        echo '<td>' . htmlspecialchars($kurye['telefon']) . '</td>';
                                        echo '<td>' . htmlspecialchars($kurye['mail_adresi']) . '</td>';
                                        echo '<td>' . htmlspecialchars($kurye['kurye_adresi']) . '</td>';
                                        echo '<td>' . htmlspecialchars($kurye['durum']) . '</td>';
                                        echo '</tr>';
                                    }

                                    echo '</tbody>';
                                    echo '</table>';
                                } catch (PDOException $e) {
                                    echo "Veritabanı hatası: " . $e->getMessage();
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kurye Ekle -->
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Kurye Ekle</h4>
                            </div>
                            <div class="card-body">
                                <form action="kurye-ekle.php" method="POST">
                                    <div class="mb-3">
                                        <label for="kuryeAdi" class="form-label">Kurye Adı</label>
                                        <input type="text" class="form-control" id="kuryeAdi" name="kuryeAdi" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefon" class="form-label">Telefon</label>
                                        <input type="text" class="form-control" id="telefon" name="telefon" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mailAdresi" class="form-label">Mail Adresi</label>
                                        <input type="email" class="form-control" id="mailAdresi" name="mailAdresi" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kuryeAdresi" class="form-label">Adres</label>
                                        <textarea class="form-control" id="kuryeAdresi" name="kuryeAdresi" rows="2" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ekle</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-kabul') || e.target.classList.contains('btn-iptal')) {
                const id = e.target.getAttribute('data-id');
                const islem = e.target.classList.contains('btn-kabul') ? 'kabul' : 'iptal';

                fetch('islem.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `id=${id}&islem=${islem}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`siparis-${id}`).remove();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Hata:', error));
            }
        });

        // 5 saniyede bir Kurye Talep Ekranı verilerini yenile
        setInterval(() => {
            fetch('panel.php')
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newContent = doc.querySelector('#kurye-bilgileri').innerHTML;

                    document.getElementById('kurye-bilgileri').innerHTML = newContent;
                })
                .catch(error => console.error('Hata:', error));
        }, 5000);
    </script>
</body>

</html>
