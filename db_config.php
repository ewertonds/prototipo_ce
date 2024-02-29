<?php
$host = "localhost:3306";
$usuario = "ewertonds";
$senha = "NearedStow2";
$banco = "id21913578_bd_prototipo";

$conn = new mysqli($host, $usuario, $senha, $banco);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

?>