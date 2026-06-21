<?php
header("Content-Type: text/html; charset=iso-8859-1", true);
include("./config.php");

$titulo = "Incluir";
$cpf = "";
$nome_tutor = "";
$telefone = "";
$logradouro = "";
$numero = "";
$bairro = "";
$cidade = "";
$estado = "";
$cep = "";

if(isset($_GET['cpf'])){
  $titulo = "Editar";
  $sql = "SELECT * FROM Tutor WHERE cpf=?";
  $resultado = $db->prepare($sql);
  $resultado->execute([$_GET['cpf']]);
  $tutor = $resultado->fetch(PDO::FETCH_ASSOC);
  
  if($tutor){
    $cpf = $tutor['cpf'];
    $nome_tutor = $tutor['nome_tutor'];
    $telefone = isset($tutor['telefone']) ? $tutor['telefone'] : '';
    $logradouro = $tutor['logradouro'];
    $numero = $tutor['numero'];
    $bairro = $tutor['bairro'];
    $cidade = $tutor['cidade'];
    $estado = $tutor['estado'];
    $cep = $tutor['cep'];
  }
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  try {
    $cpf = $_POST['cpf'];
    $nome_tutor = $_POST['nome_tutor'];
    $telefone = !empty($_POST['telefone']) ? $_POST['telefone'] : null;
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $bairro = !empty($_POST['bairro']) ? $_POST['bairro'] : null;
    
    // Se vier vazio no POST, definimos como NULL para ativar o DEFAULT do MySQL
    $cidade = !empty($_POST['cidade']) ? $_POST['cidade'] : null;
    $estado = !empty($_POST['estado']) ? $_POST['estado'] : null;
    $cep = $_POST['cep'];

    if(isset($_GET['cpf'])){
      // No UPDATE do MySQL usamos COALESCE para manter o DEFAULT caso venha nulo
      $sql = "UPDATE Tutor SET nome_tutor=?, telefone=?, logradouro=?, numero=?, bairro=?, cidade=COALESCE(?, 'Lavras'), estado=COALESCE(?, 'MG'), cep=? WHERE cpf=?";
      $stmt = $db->prepare($sql);
      $stmt->execute([$nome_tutor, $telefone, $logradouro, $numero, $bairro, $cidade, $estado, $cep, $cpf]);
    } else {
      $sql = "INSERT INTO Tutor (cpf, nome_tutor, telefone, logradouro, numero, bairro, cidade, estado, cep) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $db->prepare($sql);
      $stmt->execute([$cpf, $nome_tutor, $telefone, $logradouro, $numero, $bairro, $cidade, $estado, $cep]);
    }
    
    header("location: index.php");
    exit();
    
  } catch(PDOException $e) {
    echo "Erro ao salvar no banco MySQL: " . $e->getMessage();
  }
}
?>
<html>
<head><title><?php echo $titulo; ?> Tutor</title></head>
<body>
<center><h3><?php echo $titulo; ?> Tutor</h3></center>
<form method="POST">
<table border="0" align="center" width="50%">
  <tr>
    <td>CPF:</td>
    <td><input type="text" name="cpf" value="<?php echo $cpf; ?>" <?php if(isset($_GET['cpf'])) echo "readonly"; ?> required></td>
  </tr>
  <tr>
    <td>Nome:</td>
    <td><input type="text" name="nome_tutor" value="<?php echo $nome_tutor; ?>" required></td>
  </tr>
  <tr>
    <td>Telefone (Unique):</td>
    <td><input type="text" name="telefone" value="<?php echo $telefone; ?>"></td>
  </tr>
  <tr>
    <td>Logradouro:</td>
    <td><input type="text" name="logradouro" value="<?php echo $logradouro; ?>" required></td>
  </tr>
  <tr>
    <td>Nmr:</td>
    <td><input type="number" name="numero" value="<?php echo $numero; ?>" required></td>
  </tr>
  <tr>
    <td>Bairro:</td>
    <td><input type="text" name="bairro" value="<?php echo $bairro; ?>"></td>
  </tr>
  <tr>
    <td>Cidade:</td>
    <td><input type="text" name="cidade" value="<?php echo $cidade; ?>" placeholder="Padrão: Lavras"></td>
  </tr>
  <tr>
    <td>Estado:</td>
    <td><input type="text" name="estado" value="<?php echo $estado; ?>" placeholder="Padrão: MG" maxlength="2"></td>
  </tr>
  <tr>
    <td>CEP:</td>
    <td><input type="text" name="cep" value="<?php echo $cep; ?>" required></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <br>
      <input type="submit" value="Salvar no Banco">
      <input type="button" value="Cancelar" onclick="location.href='index.php'">
    </td>
  </tr>
</table>
</form>
</body>
</html>