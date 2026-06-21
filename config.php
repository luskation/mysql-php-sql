<?php
// config.php

$host    = '127.0.0.1'; // IP local
$db_name = 'petcare';   // Nome do banco já criado no phpMyAdmin
$usuario = 'root';      // Usuário padrão
$senha   = '';          // Senha padrão (vazio no XAMPP)

try {
    // Abre a conexão com o MySQL e define o charset para evitar erros de acentuação
    $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $usuario, $senha);
    
    // Ativa o modo de erros do PDO (essencial para debugar)
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados MySQL: " . $e->getMessage());
}
?>