<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Puedes agregar más verificaciones de rol aquí si es necesario
?>
