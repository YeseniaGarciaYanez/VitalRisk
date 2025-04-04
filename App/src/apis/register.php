<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include 'config.php';

// Leer JSON de la solicitud
$json = file_get_contents("php://input");
$data = json_decode($json, true);


if (!isset($data['clues']) || !isset($data['hospital']) || !isset($data['entidad']) || !isset($data['municipio']) || !isset($data['password'])) {
    echo json_encode(["success" => false, "message" => "Datos incompletos", "received" => $json]);
    exit;
}

$clues = $data['clues'];
$hospital = $data['hospital'];
$entidad = $data['entidad'];
$municipio = $data['municipio'];
$password = $data['password'];

// Validar si el CLUES ya existe en la base de datos
try {
    $stmt = $pdo->prepare("SELECT * FROM hospitales WHERE clues = :clues");
    $stmt->bindParam(':clues', $clues);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode(["success" => false, "message" => "El CLUES ya está registrado"]);
        exit;
    }

    // Hashear la contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la base de datos
    $stmt = $pdo->prepare("INSERT INTO hospitales (clues, nombre, entidad, municipio, password_hash) VALUES (:clues, :nombre, :entidad, :municipio, :password_hash)");
    $stmt->bindParam(':clues', $clues);
    $stmt->bindParam(':nombre', $hospital);
    $stmt->bindParam(':entidad', $entidad);
    $stmt->bindParam(':municipio', $municipio);
    $stmt->bindParam(':password_hash', $hashedPassword);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Registro exitoso"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al registrar el usuario"]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error de conexión"]);
}
?>
