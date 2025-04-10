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
    $stmt = $pdo->prepare("SELECT clues, nombre, entidad, municipio FROM hospitales WHERE clues = :clues");
    $stmt->bindParam(':clues', $clues);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC); // Usamos fetch en lugar de fetchAll

    if ($result) {
        echo json_encode(["success" => true, "hospital" => $result]); // Devolvemos un objeto 'hospital'
    } else {
        echo json_encode(["success" => false, "message" => "No se encontró información del hospital"]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error al consultar: " . $e->getMessage()]);
}
?>