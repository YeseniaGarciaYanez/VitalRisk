<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include 'config.php';

// Leer JSON de la solicitud
$json = file_get_contents("php://input");
$data = json_decode($json, true);

if (!isset($data['clues']) || !isset($data['password'])) {
    echo json_encode(["success" => false, "message" => "Datos incompletos", "received" => $json]);
    exit;
}

$clues = $data['clues'];
$password = $data['password'];

try {
    $stmt = $pdo->prepare("SELECT * FROM hospitales WHERE clues = :clues");
    $stmt->bindParam(':clues', $clues);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        echo json_encode(["success" => true, "message" => "Inicio de sesión exitoso"]);
    } else {
        echo json_encode(["success" => false, "message" => "Credenciales incorrectas"]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error de conexión"]);
}
?>
