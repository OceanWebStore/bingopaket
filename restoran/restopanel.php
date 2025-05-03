<!DOCTYPE html>
<html lang="tr">

<head>
    <?php
    session_start();

    // Giriş kontrolü aktifleştirildi
    if (!isset($_SESSION['isletme_mail']) || empty($_SESSION['isletme_mail'])) {
        header('Location: index.php');
        exit;
    }

    // Veritabanı bağlantısı ve isletme bilgilerini çekme
    $restoranAdi = "";
    $restoranIletisim = "";
    $restoranAdres = "";

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=oceanweb_kurye;charset=utf8mb4", "oceanweb_kuryeuser", "ko61tu61.");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Giriş yapan mail adresine sahip işletmeyi çek
        $stmt = $pdo->prepare("SELECT * FROM isletmeler WHERE mail = ? LIMIT 1");
        $stmt->execute([$_SESSION['isletme_mail']]);
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $restoranAdi = htmlspecialchars($row['ad']);
            $restoranIletisim = htmlspecialchars($row['telefon']);
            $restoranAdres = htmlspecialchars($row['adres']);
        }
    } catch (PDOException $e) {
        // Bağlantı hatası: inputlar boş bırakılır
    }
    ?>
    <!-- Title Meta -->
    <meta charset="utf-8" />
    <title>Bingo Paket - Sıcak Sıcak Kapında !</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Taplox: An advanced, fully responsive admin dashboard template packed with features to streamline your analytics and management needs." />
    <meta name="author" content="StackBros" />
    <meta name="keywords" content="Taplox, admin dashboard, responsive template, analytics, modern UI, management tools" />
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
    <!-- Bootstrap Icons CDN for motor icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- START Wrapper -->
    <div class="app-wrapper">

        <!-- Topbar Başlangıç -->
        <header class="app-topbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="d-flex align-items-center gap-2">
                        <!-- Menü Düğmesi -->
                        <div class="topbar-item">
                            <button type="button" class="button-toggle-menu topbar-button">
                                <iconify-icon icon="solar:hamburger-menu-outline" class="fs-24 align-middle"></iconify-icon>
                            </button>
                        </div>

                        <!-- Arama -->
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

        <!-- Sol Menü -->
        <div class="app-sidebar">
            <div class="scrollbar" data-simplebar>
                <!-- Logo -->
                <div class="logo-box">
                    <a href="panel.html" class="logo-dark">
                        <img src="assets/images/logo-sm.png" class="logo-sm" alt="Logo Small">
                        <img src="assets/images/logo-dark.png" class="logo-lg" alt="Logo Dark">
                    </a>
                    <a href="panel.html" class="logo-light">
                        <img src="assets/images/logo-sm.png" class="logo-sm" alt="Logo Small">
                        <img src="assets/images/logo-light.png" class="logo-lg" alt="Logo Light">
                    </a>
                </div>

                <ul class="navbar-nav">
                    <li class="menu-title">MENÜ</li>
                    <li class="nav-item"><a class="nav-link" href="panel.html">Panel</a></li>
                    <li class="nav-item"><a class="nav-link" href="siparisler.html">Siparişler</a></li>
                    <li class="nav-item"><a class="nav-link" href="isletmeler.html">İşletmeler</a></li>
                    <li class="nav-item"><a class="nav-link" href="kuryeler.html">Kuryeler</a></li>
                    <li class="nav-item"><a class="nav-link" href="rapor.html">Raporlar</a></li>
                </ul>
            </div>
        </div>
        <!-- Sol Menü Bitiş -->

        <!-- Sayfa İçeriği -->
        <div class="page-content">
            <div class="container-fluid">

                <!-- Sayfa Başlığı -->
                <div class="page-title-box">
                    <h4>Panel</h4>
                </div>

                <!-- Kurye Talep Ekranı ve Restoran Bilgileri -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Kurye Talep Ekranı</h4>
                            </div>
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <div class="mb-3 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#007bff" class="bi bi-truck-front" viewBox="0 0 16 16">
                                      <path d="M4 9a1 1 0 1 0 0 2 1 1 0 0 0 0-2Zm8 1a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm-9-2V8c0-1.35.79-2.5 2-3.16V2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2.84A3.001 3.001 0 0 1 13 8v1h1.5a.5.5 0 0 1 .5.5V12a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2H7a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2V9.5a.5.5 0 0 1 .5-.5H3zm1-1h8v-1a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v1zm-1 3.5v.5a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-.5H4zm8 0v.5a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-.5h-3z"/>
                                    </svg>
                                </div>
                                <button class="btn btn-primary btn-lg px-5 d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#kuryeCagirModal" style="font-size: 1.5rem;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-truck-front me-2" viewBox="0 0 16 16">
                                      <path d="M4 9a1 1 0 1 0 0 2 1 1 0 0 0 0-2Zm8 1a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm-9-2V8c0-1.35.79-2.5 2-3.16V2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2.84A3.001 3.001 0 0 1 13 8v1h1.5a.5.5 0 0 1 .5.5V12a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2H7a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2V9.5a.5.5 0 0 1 .5-.5H3zm1-1h8v-1a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v1zm-1 3.5v.5a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-.5H4zm8 0v.5a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-.5h-3z"/>
                                    </svg>
                                    Kurye Çağır
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Restoran Bilgileri -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Restoran Bilgileri</h4>
                            </div>
                            <div class="card-body">
                                <form id="restoranBilgileriForm">
                                    <div class="mb-3">
                                        <label for="restoranAdi" class="form-label">Restoran Adı</label>
                                        <input type="text" class="form-control" id="restoranAdi" name="restoranAdi" placeholder="Restoran Adı" required value="<?php echo $restoranAdi; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="restoranIletisim" class="form-label">Restoran İletişim No</label>
                                        <input type="text" class="form-control" id="restoranIletisim" name="restoranIletisim" placeholder="İletişim Numarası" required value="<?php echo $restoranIletisim; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="restoranAdres" class="form-label">Restoran Adresi</label>
                                        <textarea class="form-control" id="restoranAdres" name="restoranAdres" rows="2" placeholder="Adres" required><?php echo $restoranAdres; ?></textarea>
                                    </div>
                                    <button type="submit" class="btn" style="background-color:#007bff; color:#fff;">Kaydet</button>
                                </form>
                                <div id="restoranKayitSonuc" style="margin-top:10px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <!-- Siparişler Tablosu -->
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Müşteri Adı</th>
                <th>Telefon</th>
                <th>Adres</th>
                <th>Sipariş Tutarı</th>
                <th>Ödeme Yöntemi</th>
                <th>Durum</th>
            </tr>
        </thead>
        <tbody id="siparisTablosu">
            <!-- Bu alan JS ile doldurulacak -->
        </tbody>
    </table>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    function siparisleriGetir() {
        fetch('../siparisler.php')
            .then(response => response.json())
            .then(data => {
                const tablo = document.getElementById('siparisTablosu');
                tablo.innerHTML = ''; // Tabloyu temizle

                data.forEach(siparis => {
                    const tr = document.createElement('tr');

                    tr.innerHTML = `
                        <td>${siparis.musteri_adi}</td>
                        <td>${siparis.musteri_telefonu}</td>
                        <td>${siparis.musteri_adresi}</td>
                        <td>${siparis.siparis_tutari}</td>
                        <td>${siparis.odeme_yontemi}</td>
                        <td>${siparis.durum ? siparis.durum : 'Beklemede'}</td>
                    `;

                    tablo.appendChild(tr);
                });
            })
            .catch(error => console.error('Hata:', error));
    }

    // İlk tabloyu yükle
    siparisleriGetir();

    // Tabloyu düzenli olarak güncelle (örneğin her 10 saniyede bir)
    setInterval(siparisleriGetir, 10000);
});
</script>
    <!-- Wrapper Bitiş -->

    <!-- Modal (Pop-up) -->
    <div class="modal fade" id="kuryeCagirModal" tabindex="-1" aria-labelledby="kuryeCagirModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kuryeCagirModalLabel">Kurye Çağır</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="kuryeCagirForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Restoran Adı</label>
                            <input type="text" class="form-control" id="modalRestoranAdi" value="<?php echo $restoranAdi; ?>" readonly style="background:#f8f9fa;">
                        </div>
                        <div class="mb-3">
                            <label for="musteriAdi" class="form-label">Müşteri Adı</label>
                            <input type="text" class="form-control" id="musteriAdi" placeholder="Müşteri Adı" required>
                        </div>
                        <div class="mb-3">
                            <label for="musteriTelefonu" class="form-label">Müşteri Telefonu</label>
                            <input type="tel" class="form-control" id="musteriTelefonu" placeholder="Telefon Numarası" required>
                        </div>
                        <div class="mb-3">
                            <label for="musteriAdresi" class="form-label">Müşteri Adresi</label>
                            <textarea class="form-control" id="musteriAdresi" rows="2" placeholder="Müşteri Adresi" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="siparisTutari" class="form-label">Sipariş Tutarı</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="siparisTutari" placeholder="₺" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block">Ödeme Yöntemi</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="odemeYontemi" id="odemeNakit" value="Nakit" required>
                                <label class="form-check-label" for="odemeNakit">Nakit</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="odemeYontemi" id="odemeOnlineKredi" value="Online Kredi Kartı" required>
                                <label class="form-check-label" for="odemeOnlineKredi">Online Kredi Kartı</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="odemeYontemi" id="odemeKapidaKredi" value="Kapıda Kredi Kartı" required>
                                <label class="form-check-label" for="odemeKapidaKredi">Kapıda Kredi Kartı</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="odemeYontemi" id="odemeKapidaYemek" value="Kapıda Yemek Kartı" required>
                                <label class="form-check-label" for="odemeKapidaYemek">Kapıda Yemek Kartı</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Kurye Çağır</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Vendor Javascript -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Kurye Çağır Formu JS -->
    <script>
        document.getElementById('kuryeCagirForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const restoranAdi = document.getElementById('modalRestoranAdi').value;
            const musteriAdi = document.getElementById('musteriAdi').value;
            const musteriTelefonu = document.getElementById('musteriTelefonu').value;
            const musteriAdresi = document.getElementById('musteriAdresi').value;
            const siparisTutari = document.getElementById('siparisTutari').value;
            const odemeYontemi = document.querySelector('input[name="odemeYontemi"]:checked') ? document.querySelector('input[name="odemeYontemi"]:checked').value : "";

            fetch('../update_panel.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    restoranAdi,
                    musteriAdi,
                    musteriTelefonu,
                    musteriAdresi,
                    siparisTutari,
                    odemeYontemi
                })
            })
            .then(response => response.json())
            .then(data => {
                // Modalı öncelikle kapat
                const modalElement = document.getElementById('kuryeCagirModal');
                let modalInstance = bootstrap.Modal.getInstance(modalElement);
                if (!modalInstance) {
                    modalInstance = new bootstrap.Modal(modalElement);
                }
                modalInstance.hide();

                // Modal tamamen kapandıktan sonra bildirimi göster
                function handler() {
                    if (data.success) {
                        const msg = new SpeechSynthesisUtterance(`Bingo Kurye Çağrısı Oluşturuldu. Kısa Süre İçerisinde Kuryemiz Kapınızda !!`);
                        window.speechSynthesis.speak(msg);
                        alert('Kurye çağrısı başarıyla oluşturuldu!');
                    } else {
                        alert('Bir hata oluştu.');
                    }
                    modalElement.removeEventListener('hidden.bs.modal', handler);
                }
                modalElement.addEventListener('hidden.bs.modal', handler);
            })
            .catch(error => {
                // Modalı hata olsa da kapat
                const modalElement = document.getElementById('kuryeCagirModal');
                let modalInstance = bootstrap.Modal.getInstance(modalElement);
                if (!modalInstance) {
                    modalInstance = new bootstrap.Modal(modalElement);
                }
                modalInstance.hide();

                function handler() {
                    alert('Bir hata oluştu.');
                    modalElement.removeEventListener('hidden.bs.modal', handler);
                }
                modalElement.addEventListener('hidden.bs.modal', handler);
            });
        });
    </script>

    <!-- Restoran Bilgileri Formu JS -->
    <script>
    document.getElementById('restoranBilgileriForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const restoranAdi = document.getElementById('restoranAdi').value;
        const restoranIletisim = document.getElementById('restoranIletisim').value;
        const restoranAdres = document.getElementById('restoranAdres').value;

        fetch('../restoran_kaydet.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                restoranAdi,
                restoranIletisim,
                restoranAdres
            })
        })
        .then(response => response.json())
        .then(data => {
            const sonucDiv = document.getElementById('restoranKayitSonuc');
            if(data.success){
                sonucDiv.innerHTML = '<span style="color:green;">Restoran başarıyla kaydedildi.</span>';
            } else {
                sonucDiv.innerHTML = '<span style="color:red;">' + (data.message || 'Kayıt sırasında hata oluştu.') + '</span>';
            }
        })
        .catch(() => {
            document.getElementById('restoranKayitSonuc').innerHTML = '<span style="color:red;">Bir hata oluştu.</span>';
        });
    });
    </script>
</body>
</html>
