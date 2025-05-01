
text/x-generic panel.php ( HTML document, UTF-8 Unicode text )
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

                                        // Güncel alanlara göre sorgu ve başlıklar
                                        $query = "SELECT * FROM kurye_cagir WHERE durum NOT IN ('Kabul Edildi', 'İptal Edildi') ORDER BY created_at DESC";
                                        $stmt = $pdo->query($query);

                                        echo '<table class="table table-striped">';
                                        echo '<thead class="table-dark">
                                                <tr>
                                                    <th>Restoran Adı</th>
                                                    <th>Müşteri Adı</th>
                                                    <th>Telefon</th>
                                                    <th>Adres</th>
                                                    <th>Sipariş Tutarı</th>
                                                    <th>Ödeme Yöntemi</th>
                                                    <th>Durum</th>
                                                    <th>Tarih</th>
                                                    <th>Aksiyon</th>
                                                </tr>
                                              </thead>';
                                        echo '<tbody>';

                                        while ($kurye = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<tr id="siparis-' . $kurye['id'] . '">';
                                            echo '<td>' . htmlspecialchars($kurye['restoran_adi']) . '</td>';
                                            echo '<td>' . htmlspecialchars($kurye['musteri_adi']) . '</td>';
                                            echo '<td>' . htmlspecialchars($kurye['musteri_telefonu']) . '</td>';
                                            echo '<td>' . htmlspecialchars($kurye['musteri_adresi']) . '</td>';
                                            echo '<td>' . number_format($kurye['siparis_tutari'], 2) . ' ₺</td>';
                                            echo '<td>' . htmlspecialchars($kurye['odeme_yontemi']) . '</td>';
                                            echo '<td>' . htmlspecialchars($kurye['durum']) . '</td>';
                                            echo '<td>' . htmlspecialchars($kurye['created_at']) . '</td>';
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
            </div>
        </div>
    </div>
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        // Siparişleri her 5 saniyede bir yenile
        setInterval(() => {
            fetch('panel.php')
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newContent = doc.querySelector('#kurye-bilgileri').innerHTML;

                    // Yeni içeriği DOM'a ekle
                    document.getElementById('kurye-bilgileri').innerHTML = newContent;
                })
                .catch(error => console.error('Hata:', error));
        }, 5000);

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-iptal')) {
                const id = e.target.getAttribute('data-id');

                if (confirm('Bu siparişi tamamen silmek istediğinizden emin misiniz?')) {
                    fetch('sil.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id }),
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
            }
        });
    </script>
</body>

</html>
