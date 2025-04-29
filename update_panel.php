<?php
// Veritabanı bağlantısı
$dsn = "mysql:host=localhost;dbname=oceanweb_kurye;charset=utf8mb4";
$username = "oceanweb_kuryeuser"; // Veritabanı kullanıcı adı
$password = "ko61tu61."; // Veritabanı şifresi

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => "Veritabanı bağlantı hatası: " . $e->getMessage()]);
    exit;
}

// POST isteği kontrolü
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Yeni alanlarla kontrol
    if (
        isset(
            $data['restoranAdi'],
            $data['musteriAdi'],
            $data['musteriTelefonu'],
            $data['musteriAdresi'],
            $data['siparisTutari'],
            $data['odemeYontemi']
        )
        && $data['restoranAdi'] !== ''
        && $data['musteriAdi'] !== ''
        && $data['musteriTelefonu'] !== ''
        && $data['musteriAdresi'] !== ''
        && $data['siparisTutari'] !== ''
        && $data['odemeYontemi'] !== ''
    ) {
        $query = "INSERT INTO kurye_cagir (
            restoran_adi, 
            musteri_adi, 
            musteri_telefonu, 
            musteri_adresi, 
            siparis_tutari, 
            odeme_yontemi, 
            created_at
        ) VALUES (
            :restoranAdi, 
            :musteriAdi, 
            :musteriTelefonu, 
            :musteriAdresi, 
            :siparisTutari, 
            :odemeYontemi, 
            NOW()
        )";

        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':restoranAdi'      => $data['restoranAdi'],
            ':musteriAdi'       => $data['musteriAdi'],
            ':musteriTelefonu'  => $data['musteriTelefonu'],
            ':musteriAdresi'    => $data['musteriAdresi'],
            ':siparisTutari'    => $data['siparisTutari'],
            ':odemeYontemi'     => $data['odemeYontemi']
        ]);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Eksik veya hatalı veri.']);
    }
}
