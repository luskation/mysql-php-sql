<?php
header("Content-Type: text/html; charset=iso-8859-1", true);
?>
<html>
<head><title>PetCare</title></head>
<body>
<center><h3>PetCare - Gerenciamento de Pets</h3></center>
<form name="form1" method="POST" action="form_incluir.php">
<table border="0" align="center" width="70%">
<?php
include("./config.php");
$con = mysqli_connect($host, $login, $senha, $bd);
// Consulta unindo Pet com Tutor para mostrar o nome do dono na listagem
$sql = "SELECT P.idPet, P.nome_pet, P.especie, P.raca, T.nome_tutor FROM Pet P INNER JOIN Tutor T ON P.cpf = T.cpf ORDER BY P.nome_pet";
$tabela = mysqli_query($con, $sql);

if(mysqli_num_rows($tabela) == 0){
?>
  <tr><td align="center">Não há nenhum pet cadastrado.</td></tr>
  <tr><td align="center"><input type="submit" value="Incluir Pet"></td></tr>
<?php
}else{
?>
  <tr bgcolor="grey">
    <td width="25%">Nome do Pet</td>
    <td width="20%">Espécie</td>
    <td width="20%">Raça</td>
    <td width="20%">Tutor (Dono)</td>
    <td width="15%">Ações</td>
  </tr>
<?php
  while($dados = mysqli_fetch_row($tabela)){
?>
  <tr>
    <td><?php echo $dados[1]; ?></td>
    <td><?php echo $dados[2]; ?></td>
    <td><?php echo $dados[3]; ?></td>
    <td><?php echo $dados[4]; ?></td>
    <td align="center">
      <input type="button" value="Excluir" onclick="location.href='excluir.php?idPet=<?php echo $dados[0]; ?>'">
      <input type="button" value="Editar" onclick="location.href='form_incluir.php?idPet=<?php echo $dados[0]; ?>'">
    </td>
  </tr>
<?php
  }
?>
<tr bgcolor="grey"><td colspan="5" height="5"></td></tr>
<?php
mysqli_close($con);
?>
<tr><td colspan="5" align="center"><input type="submit" value="Incluir Novo Pet"></td></tr>
<?php
}
?>
</table>
</form>
</body>
</html>