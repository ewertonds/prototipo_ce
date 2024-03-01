<?php
$host = "localhost";
$usuario = "ewertonds";
$senha = "NearedStow2";
$banco = "id21913578_bd_prototipo";

$conn = new mysqli($host, $usuario, $senha, $banco);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);

}
$conn->set_charset("utf8");

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


