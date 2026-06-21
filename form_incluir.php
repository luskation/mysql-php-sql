<?php
// Alterado para UTF-8 para salvar dados acentuados corretamente
header("Content-Type: text/html; charset=utf-8", true);
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
    
    // Se vier vazio, o MySQL assume o DEFAULT configurado na tabela ('Lavras' / 'MG')
    $cidade = !empty($_POST['cidade']) ? $_POST['cidade'] : null;
    $estado = !empty($_POST['estado']) ? $_POST['estado'] : null;
    $cep = $_POST['cep'];

    if(isset($_GET['cpf'])){
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
    echo "<center><font color='red'><b>Erro ao salvar no banco MySQL:</b> " . $e->getMessage() . "</font></center>";
  }
}
?>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $titulo; ?> Tutor</title>
</head>
<body>
<center><h3><?php echo $titulo; ?> Tutor</h3></center>
<form method="POST">
<table border="0" align="center" width="50%">
  <tr>
    <td>CPF:</td>
    <td><input type="text" name="cpf" value="<?php echo htmlspecialchars($cpf); ?>" <?php if(isset($_GET['cpf'])) echo "readonly"; ?> required></td>
  </tr>
  <tr>
    <td>Nome:</td>
    <td><input type="text" name="nome_tutor" value="<?php echo htmlspecialchars($nome_tutor); ?>" required></td>
  </tr>
  <tr>
    <td>Telefone (Unique):</td>
    <td><input type="text" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>"></td>
  </tr>
  <tr>
    <td>Logradouro:</td>
    <td><input type="text" name="logradouro" value="<?php echo htmlspecialchars($logradouro); ?>" required></td>
  </tr>
  <tr>
    <td>Nmr:</td>
    <td><input type="number" name="numero" value="<?php echo htmlspecialchars($numero); ?>" required></td>
  </tr>
  <tr>
    <td>Bairro:</td>
    <td><input type="text" name="bairro" value="<?php echo htmlspecialchars($bairro); ?>"></td>
  </tr>
  <tr>
    <td>Cidade:</td>
    <td><input type="text" name="cidade" value="<?php echo htmlspecialchars($cidade); ?>" placeholder="Padrão: Lavras"></td>
  </tr>
  <tr>
    <td>Estado:</td>
    <td><input type="text" name="estado" value="<?php echo htmlspecialchars($estado); ?>" placeholder="Padrão: MG" maxlength="2"></td>
  </tr>
  <tr>
    <td>CEP:</td>
    <td><input type="text" name="cep" value="<?php echo htmlspecialchars($cep); ?>" required></td>
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