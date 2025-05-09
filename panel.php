<?php
require 'db.php';
?>
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
    <style>
        .btn-onay-bekliyor {
            background: #dc3545 !important;
            color: #fff !important;
        }
        .btn-kurye-yolda {
            background: #28a745 !important;
            color: #fff !important;
        }
        .btn-teslim-alindi {
            background: #0d6efd !important;
            color: #fff !important;
        }
        .btn-teslim-edildi {
            background: #1a1a1a !important;
            color: #fff !important;
        }
    </style>
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
                <!-- Panelden Gelen Siparişler -->
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

                <!-- ATAMA BEKLEYEN SİPARİŞLER -->
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-warning">
                                <h5>Atama Bekleyen Siparişler</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="atama-bekleyen-listesi">
                                    <thead class="table-warning">
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
                                        $query2 = "SELECT * FROM kurye_cagir WHERE durum = 'Kabul Edildi' AND (atanan_kurye_id IS NULL OR atanan_kurye_id = 0) ORDER BY created_at DESC";
                                        $stmt2 = $pdo->query($query2);

                                        while ($siparis = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<tr id="atama-siparis-' . $siparis['id'] . '">';
                                            echo '<td>' . htmlspecialchars($siparis['restoran_adi']) . '</td>';
                                            echo '<td>' . htmlspecialchars($siparis['musteri_adi']) . '</td>';
                                            echo '<td>' . htmlspecialchars($siparis['musteri_telefonu']) . '</td>';
                                            echo '<td>' . htmlspecialchars($siparis['musteri_adresi']) . '</td>';
                                            echo '<td>' . number_format($siparis['siparis_tutari'], 2) . ' ₺</td>';
                                            echo '<td>' . htmlspecialchars($siparis['odeme_yontemi']) . '</td>';
                                            echo '<td>' . htmlspecialchars($siparis['durum']) . '</td>';
                                            echo '<td>
                                                    <a href="#" 
                                                       class="btn btn-success btn-sm btn-kurye-atama"
                                                       data-siparis-id="' . $siparis['id'] . '"
                                                       style="background-color:#28a745;color:#fff;font-weight:bold;border:none;">
                                                       KURYE
                                                    </a>
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
                <!-- ATAMA BEKLEYEN SİPARİŞLER SON -->

                <!-- SİPARİŞ AKSİYON ALANI -->
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h5>Sipariş Aksiyon Alanı</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="siparis-aksiyon-listesi">
                                    <thead class="table-info">
                                        <tr>
                                            <th>Restoran</th>
                                            <th>Müşteri</th>
                                            <th>Telefon</th>
                                            <th>Adres</th>
                                            <th>Tutar</th>
                                            <th>Yöntem</th>
                                            <th>Kurye</th>
                                            <th>Durum</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Kurye adı-ismi için LEFT JOIN ile çekiyoruz
                                        $aksiyon = $pdo->query("
                                            SELECT kc.id, kc.restoran_adi, kc.musteri_adi, kc.musteri_telefonu, kc.musteri_adresi, kc.siparis_tutari, kc.odeme_yontemi, kc.siparis_durumu,
                                                   k.ad AS kurye_adi, k.soyad AS kurye_soyad
                                            FROM kurye_cagir kc
                                            LEFT JOIN kuryeler k ON kc.atanan_kurye_id = k.id
                                            WHERE kc.atanan_kurye_id IS NOT NULL AND kc.atanan_kurye_id <> 0
                                            ORDER BY kc.created_at DESC
                                        ");
                                        $durumlar = [
                                            'Onay Bekliyor' => 'btn-onay-bekliyor',
                                            'Kurye Yolda'   => 'btn-kurye-yolda',
                                            'Teslim Alındı' => 'btn-teslim-alindi',
                                            'Teslim Edildi' => 'btn-teslim-edildi'
                                        ];
                                        while ($row = $aksiyon->fetch(PDO::FETCH_ASSOC)):
                                            $aktifDurum = $row['siparis_durumu'] ?? 'Onay Bekliyor';
                                            $kuryeAdSoyad = trim(($row['kurye_adi'] ?? '') . ' ' . ($row['kurye_soyad'] ?? ''));
                                        ?>
                                        <tr data-siparis-id="<?= $row['id'] ?>">
                                            <td><?= htmlspecialchars($row['restoran_adi']) ?></td>
                                            <td><?= htmlspecialchars($row['musteri_adi']) ?></td>
                                            <td><?= htmlspecialchars($row['musteri_telefonu']) ?></td>
                                            <td><?= htmlspecialchars($row['musteri_adresi']) ?></td>
                                            <td><?= number_format($row['siparis_tutari'], 2) ?> ₺</td>
                                            <td><?= htmlspecialchars($row['odeme_yontemi']) ?></td>
                                            <td><?= $kuryeAdSoyad ? htmlspecialchars($kuryeAdSoyad) : '<span class="text-danger">Atama Yok</span>' ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle durum-btn <?= $durumlar[$aktifDurum] ?? 'btn-secondary' ?>" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <?= $aktifDurum ?>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <?php foreach ($durumlar as $isim => $renk): ?>
                                                            <li><a class="dropdown-item durum-sec" href="#" data-durum="<?= $isim ?>"><?= $isim ?></a></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- SİPARİŞ AKSİYON ALANI SONU -->

            </div>
        </div>
    </div>

    <!-- Kurye Seç Modal -->
    <div class="modal fade" id="kuryeSecModal" tabindex="-1" aria-labelledby="kuryeSecModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="kuryeSecModalLabel">Kurye Seç</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
          </div>
          <div class="modal-body">
            <ul class="list-group" id="kurye-listesi"></ul>
          </div>
        </div>
      </div>
    </div>

    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ---- SİPARİŞ AKSİYON ALANI DURUM DEĞİŞTİRME ----
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('#siparis-aksiyon-listesi').forEach(function(table){
                table.addEventListener('click', function(e){
                    if(e.target.classList.contains('durum-sec')) {
                        e.preventDefault();
                        var durum = e.target.getAttribute('data-durum');
                        var tr = e.target.closest('tr');
                        var siparisId = tr.getAttribute('data-siparis-id');
                        var btn = tr.querySelector('.durum-btn');
                        fetch('siparis_durum_guncelle.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: 'siparis_id=' + encodeURIComponent(siparisId) + '&yeni_durum=' + encodeURIComponent(durum)
                        })
                        .then(resp => resp.json())
                        .then(data => {
                            if(data.success) {
                                btn.textContent = durum;
                                btn.classList.remove('btn-onay-bekliyor','btn-kurye-yolda','btn-teslim-alindi','btn-teslim-edildi','btn-secondary');
                                if(durum == 'Onay Bekliyor')   btn.classList.add('btn-onay-bekliyor');
                                if(durum == 'Kurye Yolda')     btn.classList.add('btn-kurye-yolda');
                                if(durum == 'Teslim Alındı')   btn.classList.add('btn-teslim-alindi');
                                if(durum == 'Teslim Edildi')   btn.classList.add('btn-teslim-edildi');
                            } else {
                                alert('Güncelleme başarısız: ' + (data.message || ''));
                            }
                        });
                    }
                });
            });
        });

        // Sesli bildirim için gerekli değişken ve fonksiyonlar
        let lastOrderCount = null;

        function playNotificationSound() {
            const audio = document.getElementById('notificationSound');
            if (audio) audio.play().catch(()=>{});
        }

        // Tarayıcı otomatik oynatmayı engellemesin diye ilk tıklamada ses izni
        document.addEventListener('click', function once() {
            const audio = document.getElementById('notificationSound');
            if (audio) audio.play().catch(()=>{});
            document.removeEventListener('click', once);
        });

        setInterval(() => {
            fetch('fetch_new_orders.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const siparisListesi = document.querySelector('#siparis-listesi tbody');
                        // --- Üstte olmayan verileri Atama Bekleyen Siparişler'den sil ---
                        const aktifUstIDler = data.orders.map(order => String(order.id));
                        const atamaSatirlari = document.querySelectorAll('#atama-bekleyen-listesi tbody tr');
                        atamaSatirlari.forEach(row => {
                            const idMatch = row.id.match(/^atama-siparis-(\d+)/);
                            if (idMatch) {
                                const id = idMatch[1];
                                if (aktifUstIDler.includes(id)) {
                                    row.remove();
                                }
                            }
                        });
                        // --- Panelden Gelen Siparişler tablosuna yeni sipariş ekle ---
                        data.orders.forEach(order => {
                            if (!document.getElementById(`siparis-${order.id}`)) {
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

                        // --- SESLİ BİLDİRİM KONTROLÜ ---
                        if (Array.isArray(data.orders)) {
                            if (lastOrderCount !== null && data.orders.length > lastOrderCount) {
                                playNotificationSound();
                            }
                            lastOrderCount = data.orders.length;
                        }
                    }
                })
                .catch(error => console.error('Yeni siparişler alınırken hata oluştu:', error));
        }, 5000);

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
                        // Üstteki satırı sil
                        document.getElementById(`siparis-${siparisId}`).remove();
                        alert('Sipariş Kabul Edildi.');

                        // Alt tabloya yeni satır ekle
                        const atamaListesi = document.querySelector('#atama-bekleyen-listesi tbody');
                        const siparis = data.siparis;
                        const newRow = document.createElement('tr');
                        newRow.id = `atama-siparis-${siparis.id}`;
                        newRow.innerHTML = `
                            <td>${siparis.restoran_adi}</td>
                            <td>${siparis.musteri_adi}</td>
                            <td>${siparis.musteri_telefonu}</td>
                            <td>${siparis.musteri_adresi}</td>
                            <td>${Number(siparis.siparis_tutari).toFixed(2)} ₺</td>
                            <td>${siparis.odeme_yontemi}</td>
                            <td>${siparis.durum}</td>
                            <td>
                                <a href="#" 
                                   class="btn btn-success btn-sm btn-kurye-atama"
                                   data-siparis-id="${siparis.id}"
                                   style="background-color:#28a745;color:#fff;font-weight:bold;border:none;">
                                   KURYE
                                </a>
                            </td>
                        `;
                        atamaListesi.prepend(newRow);
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

            // Kurye Atama MODAL açma
            if (event.target.classList.contains('btn-kurye-atama')) {
                event.preventDefault();
                const siparisId = event.target.getAttribute('data-siparis-id');
                const myModal = new bootstrap.Modal(document.getElementById('kuryeSecModal'));
                myModal.show();

                fetch('kuryeleri_getir.php')
                    .then(response => response.json())
                    .then(data => {
                        const kuryeListesi = document.getElementById('kurye-listesi');
                        kuryeListesi.innerHTML = '';
                        if (data.success && data.kuryeler.length > 0) {
                            data.kuryeler.forEach(kurye => {
                                const li = document.createElement('li');
                                li.className = 'list-group-item list-group-item-action';
                                li.style.cursor = "pointer";
                                li.textContent = kurye.ad + ' ' + kurye.soyad + ' (' + kurye.telefon + ')';
                                li.onclick = function() {
                                    fetch('kurye_ata.php', {
                                        method: 'POST',
                                        headers: { 'Content-Type': 'application/json' },
                                        body: JSON.stringify({
                                            siparis_id: siparisId,
                                            kurye_id: kurye.id
                                        })
                                    })
                                    .then(resp => resp.json())
                                    .then(respData => {
                                        if (respData.success) {
                                            alert('Kurye atandı!');
                                            myModal.hide();
                                            location.reload();
                                        } else {
                                            alert('Hata: ' + (respData.message || 'Kurye atanamadı!'));
                                        }
                                    });
                                };
                                kuryeListesi.appendChild(li);
                            });
                        } else {
                            kuryeListesi.innerHTML = '<li class="list-group-item">Aktif kurye bulunamadı.</li>';
                        }
                    });
            }
        });
    </script>
    <audio id="notificationSound" src="assets/sounds/notification.mp3" preload="auto"></audio>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
