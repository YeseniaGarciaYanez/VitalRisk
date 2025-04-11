<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");

include 'config.php';

$json = file_get_contents("php://input");
$data = json_decode($json, true);

if (!isset($data['clues'])) {
    echo json_encode(["success" => false, "message" => "CLUES no recibido"]);
    exit;
}

$clues = $data['clues'];

try {
    $stmt = $pdo->prepare("SELECT equipo, problema, fecha FROM mantenimientos WHERE hospital = :clues ORDER BY fecha DESC");
    $stmt->bindParam(':clues', $clues);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["success" => true, "data" => $result]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error al consultar: " . $e->getMessage()]);
}
?>
