<?php
// Veritabanı bağlantısı
$dsn = "mysql:host=localhost;dbname=oceanweb_kurye;charset=utf8mb4";
$username = "oceanweb_kuryeuser"; // Veritabanı kullanıcı adı
$password = "ko61tu61."; // Veritabanı şifresi

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}

// POST isteği kontrolü
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['musteriAdi'], $data['musteriTelefonu'], $data['musteriAdresi'], $data['adresTarifi'], $data['odemeYontemi'])) {
        $query = "INSERT INTO kurye_cagir (musteri_adi, musteri_telefonu, musteri_adresi, adres_tarifi, odeme_yontemi)
                  VALUES (:musteriAdi, :musteriTelefonu, :musteriAdresi, :adresTarifi, :odemeYontemi)";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':musteriAdi' => $data['musteriAdi'],
            ':musteriTelefonu' => $data['musteriTelefonu'],
            ':musteriAdresi' => $data['musteriAdresi'],
            ':adresTarifi' => $data['adresTarifi'],
            ':odemeYontemi' => $data['odemeYontemi']
        ]);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Eksik veri']);
    }
}
