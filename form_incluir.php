<?php
header("Content-Type: text/html; charset=iso-8859-1", true);
?>
<html>
<head><title>Incluir/Editar um Pet</title></head>
<body>
<form name="form1" method="POST" action="incluir.php">
<?php
include("./config.php");
$con = mysqli_connect($host, $login, $senha, $bd);

if(isset($_GET["idPet"])){ 
?>
  <center><h3>Editar Dados do Pet</h3></center>
<?php
  $sql = "SELECT * FROM Pet WHERE idPet=".$_GET['idPet'];
  $result = mysqli_query($con, $sql);
  $vetor = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>
  <input type="hidden" name="idPet" value="<?php echo $_GET['idPet']; ?>">
<?php
}else{
?>
  <center><h3>Cadastrar Novo Pet</h3></center>
<?php
}
?>
<table border="0" align="center" width="45%">
<tr>
    <td width="30%">Nome do Pet:</td>
    <td><input type="text" name="nome_pet" value="<?php echo @$vetor['nome_pet']; ?>" maxlength="30" size="30"></td>
</tr>
<tr>
    <td>Espécie:</td>
    <td><input type="text" name="especie" value="<?php echo isset($vetor['especie']) ? $vetor['especie'] : 'Canino'; ?>" maxlength="20" size="20"></td>
</tr>
<tr>
    <td>Raça:</td>
    <td><input type="text" name="raca" value="<?php echo @$vetor['raca']; ?>" maxlength="30" size="30"></td>
</tr>
<tr>
    <td>Data de Nasc.:</td>
    <td><input type="date" name="data_Nasciment" value="<?php echo @$vetor['data_Nasciment']; ?>"></td>
</tr>
<tr>
    <td>Tutor Responsável:</td>
    <td>
      <select name="cpf">
        <option value="">Selecione um Tutor...</option>
        <?php
        // Busca os tutores para popular o combo-box do HTML
        $res_tutores = mysqli_query($con, "SELECT cpf, nome_tutor FROM Tutor ORDER BY nome_tutor");
        while($tutor = mysqli_fetch_array($res_tutores, MYSQLI_ASSOC)){
            $selecionado = (@$vetor['cpf'] == $tutor['cpf']) ? "selected" : "";
            echo "<option value='".$tutor['cpf']."' $selecionado>".$tutor['nome_tutor']." (".$tutor['cpf'].")</option>";
        }
        mysqli_close($con);
        ?>
      </select>
    </td>
</tr>
<tr><td colspan="2" align="center"><br>
      <input type="button" value="Cancelar" onclick="location.href='index.php'">
      <input type="submit" value="Gravar">
    </td>
</tr>
</table>
</form>
</body>
</html>