<!DOCTYPE html>
<html>
<head>
  <title>Educatio - CEFET-MG </title>
  <meta charset="utf-8">
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="gerencia-web-estilos-rodape.css" rel="stylesheet">
  <link href="BLT-Web-Emprestimos.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script> 
 </head>
</html>





<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdNome = "educatio";

// Create connection
$conn = new mysqli($servername, $username, $password, $bdNome);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$dataDevolucao = $_POST['datadevolucao'];
$IDacervo = $_POST['IDAcervo'];





$sql = "SELECT dataPrevisaoDevolucao, multa FROM emprestimos WHERE idAcervo = '$IDacervo'";
$result = $conn->query($sql);
$multa= 0;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

      $dataPrazo= date_create($row["dataPrevisaoDevolucao"]);
      $dataEntrega= date_create($dataDevolucao);
      $diff=date_diff($dataEntrega,$dataPrazo);
      if($diff->format("%R%a")>=0){
        echo "Entregue no prazo!";
      }else{
        $multa = $diff->format("%a")*$row["multa"];
      }


        $sql = "UPDATE emprestimos SET ativo='N' WHERE idAcervo='$IDacervo'";
        if ($conn->query($sql) === TRUE) {
          echo "<div class=\"corpo\">";
          echo "<div class=\"titulo\">";
          echo "<h1>";
          echo "<b>Livro Removido com sucesso!</b>";
          echo "<br><br><h3>Multa a ser paga: ".$multa."R$</h3>";
          echo "</h1>";
          echo "<div class=\"row\">
                <div class=\"col-md-12 mb-3\">
                <button type=\"button\" class=\"btn btn-outline-info btn-block \" onclick=\"window.location.href='BLT-Web-Emprestimos.html'\">Criar</button>
                </div>
                </div>";
          echo "</div>";
          echo "</div>";
        } else {
          echo "Error updating record: " . $conn->error;
        }

    }



} else {
    echo "0 results";
}

$conn->close();
?>