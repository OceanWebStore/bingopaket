<?php
// Hata ayıklama için
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// UTF-8 karakter setini belirtin
header('Content-Type: text/html; charset=utf-8');

// Veritabanı bağlantısı
require_once 'db.php';

// POST ile gelen parametreleri al
$islem = $_POST['islem'] ?? null;
$id = $_POST['id'] ?? null;

if ($islem && $id) {
    try {
        // İşleme göre sorguyu belirle
        if ($islem === 'kabul') {
            $query = "UPDATE kurye_cagir SET durum = 'Kabul Edildi' WHERE id = :id";
        } elseif ($islem === 'iptal') {
            $query = "UPDATE kurye_cagir SET durum = 'İptal Edildi' WHERE id = :id";
        } else {
            echo json_encode(['success' => false, 'message' => 'Geçersiz işlem']);
            exit;
        }

        // PDO ile sorguyu çalıştır
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Islem Basariyla Tamamlandi']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Bir hata oluştu: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Eksik parametre']);
}
?>
