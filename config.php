<?php
// config.php

$host    = '127.0.0.1'; 
$db_name = 'petcare';   
$usuario = 'root';      
$senha   = '';          

try {
    // Conexão PDO explicitando UTF-8 para o MySQL
    $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $usuario, $senha);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados MySQL: " . $e->getMessage());
}
?>