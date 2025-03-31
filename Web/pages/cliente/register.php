<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include 'config.php';

// Leer JSON de la solicitud
$json = file_get_contents("php://input");
$data = json_decode($json, true);

// DEBUG: Mostrar lo que se recibe
file_put_contents("debug.txt", $json); // Guarda la entrada en un archivo para depuración

if (!isset($data['clues']) || !isset($data['password'])) {
    echo json_encode(["success" => false, "message" => "Datos incompletos", "received" => $json]);
    exit;
}

$clues = $data['clues'];
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
    $stmt = $pdo->prepare("INSERT INTO hospitales (clues, password_hash) VALUES (:clues, :password_hash)");
    $stmt->bindParam(':clues', $clues);
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
