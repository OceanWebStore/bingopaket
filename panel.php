<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8" />
    <title>Bingo Paket - Sıcak Sıcak Kapında!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/vendor.min.css" />
    <link rel="stylesheet" href="assets/css/icons.min.css" />
    <link rel="stylesheet" href="assets/css/style.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="app-wrapper">
        <header class="app-topbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="button-toggle-menu topbar-button">
                            <iconify-icon icon="solar:hamburger-menu-outline" class="fs-24 align-middle"></iconify-icon>
                        </button>
                        <form class="app-search d-none d-md-block me-auto">
                            <input type="search" class="form-control" placeholder="Arama Yap" autocomplete="off" value="">
                        </form>
                    </div>
                </div>
            </div>
        </header>

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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Kurye Talep Ekranı</h4>
                            </div>
                            <div class="card-body">
                                <div id="kurye-bilgileri" class="table-responsive">
                                    <!-- Dinamik Olarak Yüklenen Tablo -->
                                    <table class="table table-bordered table-striped">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Müşteri Adı</th>
                                                <th>Telefon</th>
                                                <th>Adres</th>
                                                <th>Adres Tarifi</th>
                                                <th>Ödeme Yöntemi</th>
                                                <th>Aksiyon</th>
                                            </tr>
                                        </thead>
                                        <tbody id="kurye-table-body">
                                            <!-- Veriler Dinamik Olarak Buraya Eklenecek -->
                                        </tbody>
                                    </table>
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
        // Dinamik verileri tabloya yükle
        function fetchKuryeBilgileri() {
            fetch('restopanel.php?fetch_kurye_requests=true')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById('kurye-table-body');
                    tableBody.innerHTML = ''; // Önce mevcut veriyi temizle

                    data.forEach((item, index) => {
                        const row = document.createElement('tr');
                        row.className = (index % 2 === 0) ? 'table-light' : 'table-secondary'; // Satır renkleri
                        row.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${item.musteri_adi}</td>
                            <td>${item.telefon}</td>
                            <td>${item.adres}</td>
                            <td>${item.adres_tarifi}</td>
                            <td>${item.odeme_yontemi}</td>
                            <td>
                                <button class="btn btn-success btn-sm btn-kabul" data-id="${item.id}">Kabul Et</button>
                                <button class="btn btn-danger btn-sm btn-iptal" data-id="${item.id}">İptal Et</button>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });
                })
                .catch(error => console.error('Hata:', error));
        }

        // Kabul Et ve İptal Et butonlarına tıklama işlemi
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
                        alert(data.message);
                        fetchKuryeBilgileri(); // Listeyi yenile
                    } else {
                        alert('Hata: ' + data.message);
                    }
                })
                .catch(error => console.error('Hata:', error));
            }
        });

        // İlk yüklemede ve her 5 saniyede bir verileri yenile
        fetchKuryeBilgileri();
        setInterval(fetchKuryeBilgileri, 5000);
    </script>
</body>
</html>
