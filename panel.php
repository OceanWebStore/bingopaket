<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8" />
    <title>Bingo Paket - Kurye Paneli</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/vendor.min.css" />
    <link rel="stylesheet" href="assets/css/icons.min.css" />
    <link rel="stylesheet" href="assets/css/style.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="assets/js/config.js"></script>
</head>

<body>
    <div class="app-wrapper">
        <!-- Topbar -->
        <header class="app-topbar">
            <div class="container-fluid">
                
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
                        <a class="nav-link" href="siparisler.php">
                            <i class="iconify" data-icon="mdi:cart-outline"></i> Siparişler
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

        <!-- Content -->
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Panelden Gelen Siparişler</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="siparis-listesi">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Restoran</th>
                                            <th>Müşteri</th>
                                            <th>Telefon</th>
                                            <th>Adres</th>
                                            <th>Tutar</th>
                                            <th>Yöntem</th>
                                            <th>Durum</th>
                                            <th>Aksiyon</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require 'db.php'; // Veritabanı bağlantısı
                                        $query = "SELECT * FROM kurye_cagir WHERE durum = 'Beklemede' ORDER BY created_at DESC";
                                        $stmt = $pdo->query($query);

                                        while ($kurye = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<tr id="siparis-' . $kurye['id'] . '">';
                                            echo '<td>' . htmlspecialchars($kurye['restoran_adi']) . '</td>';
                                            echo '<td>' . htmlspecialchars($kurye['musteri_adi']) . '</td>';
                                            echo '<td>' . htmlspecialchars($kurye['musteri_telefonu']) . '</td>';
                                            echo '<td>' . htmlspecialchars($kurye['musteri_adresi']) . '</td>';
                                            echo '<td>' . number_format($kurye['siparis_tutari'], 2) . ' ₺</td>';
                                            echo '<td>' . htmlspecialchars($kurye['odeme_yontemi']) . '</td>';
                                            echo '<td>' . htmlspecialchars($kurye['durum']) . '</td>';
                                            echo '<td>
                                                    <button class="btn btn-success btn-kabul" data-id="' . $kurye['id'] . '">Kabul Et</button>
                                                    <button class="btn btn-danger btn-sil" data-id="' . $kurye['id'] . '">Sil</button>
                                                  </td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
        // 5 saniyede bir yeni siparişleri kontrol et
        setInterval(() => {
            fetch('fetch_new_orders.php') // Yeni siparişleri kontrol eden bir PHP dosyası
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const siparisListesi = document.querySelector('#siparis-listesi tbody');
                        data.orders.forEach(order => {
                            if (!document.getElementById(`siparis-${order.id}`)) {
                                // Yeni siparişleri ekle
                                const row = document.createElement('tr');
                                row.id = `siparis-${order.id}`;
                                row.innerHTML = `
                                    <td>${order.restoran_adi}</td>
                                    <td>${order.musteri_adi}</td>
                                    <td>${order.musteri_telefonu}</td>
                                    <td>${order.musteri_adresi}</td>
                                    <td>${order.siparis_tutari} ₺</td>
                                    <td>${order.odeme_yontemi}</td>
                                    <td>${order.durum}</td>
                                    <td>
                                        <button class="btn btn-success btn-kabul" data-id="${order.id}">Kabul Et</button>
                                        <button class="btn btn-danger btn-sil" data-id="${order.id}">Sil</button>
                                    </td>
                                `;
                                siparisListesi.appendChild(row);
                            }
                        });
                    }
                })
                .catch(error => console.error('Yeni siparişler alınırken hata oluştu:', error));
        }, 5000);

        // Kabul Et ve Sil butonları için click event
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('btn-kabul')) {
                const siparisId = event.target.dataset.id;

                fetch('accept_order.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: siparisId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`siparis-${siparisId}`).remove();
                        alert('Sipariş Kabul Edildi.');
                    } else {
                        alert('Hata: ' + data.message);
                    }
                })
                .catch(error => console.error('Kabul işlemi başarısız:', error));
            }

            if (event.target.classList.contains('btn-sil')) {
                const siparisId = event.target.dataset.id;

                fetch('delete_order.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: siparisId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`siparis-${siparisId}`).remove();
                        alert('Sipariş silindi.');
                    } else {
                        alert('Hata: ' + data.message);
                    }
                })
                .catch(error => console.error('Silme işlemi başarısız:', error));
            }
        });
    </script>
    
</body>

</html>
