<?php
// excluir.php
include("./config.php");

if(isset($_GET["cpf"])){
    $sql = "DELETE FROM Tutor WHERE cpf=?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$_GET["cpf"]]);
}

header("location: ./index.php");
exit();
?>