<?php
include("./config.php");
$con = mysqli_connect($host, $login, $senha, $bd);
$sql = "DELETE FROM Pet WHERE idPet=".$_GET["idPet"];
mysqli_query($con, $sql);
mysqli_close($con);
header("location: ./index.php");
?>