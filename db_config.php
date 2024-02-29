<?php
define("HOST", "localhost:3306");
define("USUARIO", "ewertonds");
define("SENHA", "NearedStow2");
define("BANCO", "id21913578_bd_prototipo");

$conn = new mysqli(HOST, USUARIO, SENHA, BANCO);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
$conn->set_charset("utf8");
?>
