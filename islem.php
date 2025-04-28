<?php
require_once 'db.php';

// Hem GET hem de POST parametrelerini kontrol edin
$islem = $_POST['islem'] ?? $_GET['islem'] ?? null; // Önce POST, sonra GET parametresini kontrol eder
$id = $_POST['id'] ?? $_GET['id'] ?? null; // Önce POST, sonra GET parametresini kontrol eder

if ($islem && $id) {
    if ($islem === 'kabul') {
        // Kabul Et işlemi
        $query = "UPDATE kurye_cagir SET durum = 'Kabul Edildi' WHERE id = :id";
    } elseif ($islem === 'iptal') {
        // İptal Et işlemi
        $query = "UPDATE kurye_cagir SET durum = 'İptal Edildi' WHERE id = :id";
    } else {
        echo json_encode(['success' => false, 'message' => 'Geçersiz işlem']);
        exit;
    }

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'İşlem başarıyla tamamlandı']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Eksik parametre']);
}
?>
