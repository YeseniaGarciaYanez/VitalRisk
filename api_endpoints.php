<?php
// Configuración de conexión
$dsn = "mysql:host=localhost;dbname=vitaldb;charset=utf8mb4";
$user = 'root';
$pass = '';

try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Función para obtener información de tablas y columnas
function getTables($pdo) {
    $sql = "SELECT TABLE_NAME, COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE, COLUMN_KEY, EXTRA 
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_SCHEMA = 'vitaldb'
            ORDER BY TABLE_NAME, ORDINAL_POSITION";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $tables = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $tableName = $row['TABLE_NAME'];
        if (!isset($tables[$tableName])) {
            $tables[$tableName] = [];
        }
        $tables[$tableName][] = [
            'COLUMN_NAME' => $row['COLUMN_NAME'],
            'COLUMN_TYPE' => $row['COLUMN_TYPE'],
            'IS_NULLABLE' => $row['IS_NULLABLE'],
            'COLUMN_KEY'  => $row['COLUMN_KEY'],
            'EXTRA'       => $row['EXTRA']
        ];
    }
    return $tables;
}

// Función para obtener triggers
function getTriggers($pdo) {
    $sql = "SELECT TRIGGER_NAME, EVENT_MANIPULATION, EVENT_OBJECT_TABLE, ACTION_TIMING, ACTION_STATEMENT 
            FROM INFORMATION_SCHEMA.TRIGGERS 
            WHERE TRIGGER_SCHEMA = 'vitaldb'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener procedimientos y funciones
function getRoutines($pdo) {
    $sql = "SELECT ROUTINE_NAME, ROUTINE_TYPE, ROUTINE_DEFINITION 
            FROM INFORMATION_SCHEMA.ROUTINES 
            WHERE ROUTINE_SCHEMA = 'vitaldb'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Se puede definir manualmente la parte de las APIs si no cambia
$apis = [
    [
        "nombre" => "hospitales",
        "url" => "https://sheet2api.com/v1/OOb2tXvPROOB/ola",
        "rol_permitido" => "admin"
    ],
    [
        "nombre" => "empresas_vendedoras",
        "url" => "https://sheet2api.com/v1/I4xIqLkaSRe4/empresas-vendedores-de-equipos-medicos",
        "rol_permitido" => "admin"
    ],
    [
        "nombre" => "normativas",
        "url" => "https://sheet2api.com/v1/OOb2tXvPROOB/normativas",
        "rol_permitido" => "tecnico"
    ],
    [
        "nombre" => "equiposmedicos",
        "url" => "https://sheet2api.com/v1/I4xIqLkaSRe4/equiposmedicos",
        "rol_permitido" => "tecnico"
    ]
];

// Recopilar la información en un arreglo
$schema = [
    "database" => "vitaldb",
    "tables"    => getTables($pdo),
    "apis"      => $apis,
    "triggers"  => getTriggers($pdo),
    "routines"  => getRoutines($pdo)
];

// Convertir a JSON y guardarlo en un archivo
$jsonSchema = json_encode($schema, JSON_PRETTY_PRINT);
file_put_contents('schema.json', $jsonSchema);

// También se puede retornar el JSON en el endpoint
header('Content-Type: application/json');
echo $jsonSchema;
?>
