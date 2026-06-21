<?php
include("./config.php");
$sql = "DELETE FROM Tutor WHERE cpf=?";
$stmt = $db->prepare($sql);
$stmt->execute([$_GET["cpf"]]);
header("location: ./index.php");
?>