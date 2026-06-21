<?php
header("Content-Type: text/html; charset=iso-8859-1", true);
?>
<html>
<head><title>Tutores</title></head>
<body>
<center><h3>Gerenciamento de Tutores</h3></center>

<table border="0" align="center" width="95%">
<?php
include("./config.php");

// Seleção buscando a nova coluna telefone
$sql = "SELECT cpf, nome_tutor, telefone, logradouro, numero, bairro, cidade, estado, cep FROM Tutor ORDER BY nome_tutor";
$resultado = $db->query($sql);
$dados = $resultado->fetchAll(PDO::FETCH_ASSOC);

if(count($dados) == 0){
?>
  <tr><td align="center">Nenhum tutor cadastrado.</td></tr>
  <tr><td align="center"><input type="button" value="Incluir Tutor" onclick="location.href='form_incluir.php'"></td></tr>
<?php
}else{
?>
  <tr bgcolor="grey">
    <td width="12%">CPF</td>
    <td width="15%">Nome</td>
    <td width="12%">Telefone</td>
    <td width="18%">Logradouro</td>
    <td width="6%">Nmr</td>
    <td width="10%">Bairro</td>
    <td width="12%">Cidade/UF</td>
    <td width="8%">CEP</td>
    <td width="12%">extras</td>
  </tr>
<?php
  foreach($dados as $tutor){
?>
  <tr>
    <td><?php echo $tutor['cpf']; ?></td>
    <td><?php echo $tutor['nome_tutor']; ?></td>
    <td><?php echo !empty($tutor['telefone']) ? $tutor['telefone'] : '---'; ?></td>
    <td><?php echo $tutor['logradouro']; ?></td>
    <td><?php echo $tutor['numero']; ?></td>
    <td><?php echo $tutor['bairro']; ?></td>
    <td><?php echo $tutor['cidade']; ?>/<?php echo $tutor['estado']; ?></td>
    <td><?php echo $tutor['cep']; ?></td>
    <td align="center">
      <input type="button" value="Excluir" onclick="if(confirm('Deseja realmente excluir este tutor?')) location.href='excluir.php?cpf=<?php echo $tutor['cpf']; ?>'">
      <input type="button" value="Editar" onclick="location.href='form_incluir.php?cpf=<?php echo $tutor['cpf']; ?>'">
    </td>
  </tr>
<?php
  }
?>
<tr bgcolor="grey"><td colspan="9" height="5"></td></tr>
<tr><td colspan="9" align="center"><br><input type="button" value="Incluir Novo Tutor" onclick="location.href='form_incluir.php'"></td></tr>
<?php
}
?>
</table>

</body>
</html>