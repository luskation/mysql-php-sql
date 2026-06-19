<?php
  include("./config.php");
  $con = mysqli_connect($host, $login, $senha, $bd);
  
  // Captura os dados enviados pelo formulário
  $nome_pet = $_POST["nome_pet"];
  $especie = $_POST["especie"];
  $raca = $_POST["raca"];
  $data_nasc = empty($_POST["data_Nasciment"]) ? "NULL" : "'".$POST["data_Nasciment"]."'";
  $cpf = $_POST["cpf"];

  if(isset($_POST["idPet"])){
    $sql = "SELECT idPet FROM Pet WHERE idPet=".$_POST["idPet"];
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) != 0){
      $sql = "UPDATE Pet SET nome_pet='$nome_pet', especie='$especie', raca='$raca', data_Nasciment=$data_nasc, cpf='$cpf' WHERE idPet=".$_POST["idPet"];
    }
  }else{
    $sql = "INSERT INTO Pet (idPet, nome_pet, especie, raca, data_Nasciment, cpf) VALUES (null, '$nome_pet', '$especie', '$raca', $data_nasc, '$cpf')";
  }
  
  mysqli_query($con, $sql);
  mysqli_close($con);
  header("location: ./index.php");
?>