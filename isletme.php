<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8" />
    <title>Sistemde Kayıtlı Kuryeler - Kurye Yönetimi</title>
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
            <div class="container-fluid"></div>
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
                        <a class="nav-link active" href="kuryeler.php">
                            <i class="iconify" data-icon="mdi:moped-outline"></i> Kuryeler
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
                    <!-- SOL TARAF: Kuryeler Listesi -->
                    <div class="col-lg-7 col-md-12 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Kuryeler Listesi</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="kuryeler-listesi">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Adı Soyadı</th>
                                            <th>Telefon Numarası</th>
                                            <th>Mail Adresi</th>
                                            <th>İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once 'db.php';
                                        $query = "SELECT * FROM kuryeler ORDER BY id DESC";
                                        $stmt = $pdo->query($query);
                                        $sira = 1;
                                        while ($kurye = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<tr>';
                                            echo '<td>' . $sira++ . '</td>';
                                            echo '<td>' . htmlspecialchars($kurye['ad_soyad']) . '</td>';
                                            echo '<td>' . htmlspecialchars($kurye['telefon']) . '</td>';
                                            echo '<td>' . htmlspecialchars($kurye['mail']) . '</td>';
                                            echo '<td>
                                                    <button class="btn btn-danger btn-sm sil-kurye" data-id="' . $kurye['id'] . '">Sil</button>
                                                  </td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- SAĞ TARAF: Kurye Ekle -->
                    <div class="col-lg-5 col-md-12">
                        <div class="card h-100">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">Kurye Ekle</h5>
                            </div>
                            <div class="card-body">
                                <form id="kurye-ekle-form">
                                    <div class="mb-3">
                                        <label for="ad_soyad" class="form-label">Adı Soyadı</label>
                                        <input type="text" class="form-control" id="ad_soyad" name="ad_soyad" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefon" class="form-label">Telefon Numarası</label>
                                        <input type="text" class="form-control" id="telefon" name="telefon" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mail" class="form-label">Mail Adresi</label>
                                        <input type="email" class="form-control" id="mail" name="mail" required>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100">Kurye Ekle</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.js"></script>
        <script>
            // Kurye Ekleme Ajax
            document.getElementById('kurye-ekle-form').addEventListener('submit', function(e) {
                e.preventDefault();
                const ad_soyad = document.getElementById('ad_soyad').value;
                const telefon = document.getElementById('telefon').value;
                const mail = document.getElementById('mail').value;

                fetch('kurye_ekle.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ ad_soyad, telefon, mail })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        // Yeni kurye tabloya ekle
                        const tbody = document.querySelector('#kuryeler-listesi tbody');
                        const row = document.createElement('tr');
                        row.innerHTML = `<td>Yeni</td>
                                         <td>${ad_soyad}</td>
                                         <td>${telefon}</td>
                                         <td>${mail}</td>
                                         <td>
                                            <button class="btn btn-danger btn-sm sil-kurye" data-id="${data.id}">Sil</button>
                                         </td>`;
                        tbody.prepend(row);
                        document.getElementById('kurye-ekle-form').reset();
                    } else {
                        alert('Kurye eklenemedi: ' + data.message);
                    }
                });
            });

            // Kurye Silme Ajax
            document.addEventListener('click', function(event) {
                if(event.target.classList.contains('sil-kurye')) {
                    if(confirm('Kuryeyi silmek istediğinize emin misiniz?')) {
                        const kuryeId = event.target.getAttribute('data-id');
                        fetch('kurye_sil.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ id: kuryeId })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if(data.success) {
                                event.target.closest('tr').remove();
                            } else {
                                alert('Kurye silinemedi: ' + data.message);
                            }
                        });
                    }
                }
            });
        </script>
    </div>
</body>
</html>
