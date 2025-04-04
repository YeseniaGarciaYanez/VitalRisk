<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include 'config.php'; // Incluye la conexión a la base de datos

// Leer JSON de la solicitud
$json = file_get_contents("php://input");
$data = json_decode($json, true);

// Validación de datos recibidos
if (!isset($data['equipment']) || !isset($data['problem']) || !isset($data['date']) || !isset($data['clues'])) {
    echo json_encode(["success" => false, "message" => "Datos incompletos", "received" => $json]);
    exit;
}

$equipo = $data['equipment'];
$problema = $data['problem'];
$fecha = $data['date'];
$hospital = $data['clues'];

try {
    // Preparar la consulta para insertar el mantenimiento
    $stmt = $pdo->prepare("INSERT INTO mantenimientos (equipo, problema, fecha, hospital) VALUES (:equipo, :problema, :fecha, :hospital)");
    $stmt->bindParam(':equipo', $equipo);
    $stmt->bindParam(':problema', $problema);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':hospital', $hospital); // Se asegura de usar el nombre de campo correcto

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Mantenimiento registrado exitosamente"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al guardar el mantenimiento"]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error de conexión", "error" => $e->getMessage()]);
}
?>
