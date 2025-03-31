<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$host = "localhost";
$dbname = "hospital_db";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "error" => "Error de conexión a la base de datos"]));
}

$data = json_decode(file_get_contents("php://input"), true);
$clues = $data["clues"];
$password = $data["password"];

if (empty($clues) || empty($password)) {
    echo json_encode(["success" => false, "error" => "Faltan datos"]);
    exit;
}

// Buscar hospital por CLUES
$query = $conn->prepare("SELECT password FROM hospitales WHERE clues = ?");
$query->bind_param("s", $clues);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password = $row["password"];

    if (password_verify($password, $hashed_password)) {
        echo json_encode(["success" => true, "message" => "Login exitoso"]);
    } else {
        echo json_encode(["success" => false, "error" => "Contraseña incorrecta"]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Hospital no encontrado"]);
}

$conn->close();
?>
