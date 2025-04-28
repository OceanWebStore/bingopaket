<?php
// Veritabanı bağlantı ayarları
$servername = "localhost";
$username = "oceanweb_kuryeuser";
$password = "ko61tu61.";
$database = "oceanweb_kurye";

// Veritabanına bağlan
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanına bağlanılamadı: " . $conn->connect_error);
}

// UTF-8 karakter seti ayarı
$conn->set_charset("utf8");

// Bağlantı başarılı mesajı (geliştirme aşamasında kullanılabilir, canlıda kaldırabilirsiniz)
// echo "Veritabanına başarıyla bağlanıldı!";
?>
