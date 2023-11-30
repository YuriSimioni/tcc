<?php
session_start();
if(isset($_SESSION['usuario'])) {
    $host = "localhost"; // HOST do Banco de Dados
    $user = "root";      // USUARIO do Banco de Dados
    $pass = "";          // SENHA do Banco de Dados
    $bd = "sistema";
    
    $pdo = new PDO("mysql:dbname=".$bd.";host=".$host, $user, $pass);
    
    $nome = $_POST['nomebus'];
    $desc = $_POST['desc'];
    $tempo = $_POST['horario'].":00";
    $status = $_POST['status'];
    $autor = $_POST['autor']; 
    $id = $_POST['id'];
    
    $sql = $pdo->query("UPDATE onibus SET nome = '$nome', status = '$status', regiao = '$desc', ultimaAtualizacao = '$autor', horario = '$tempo' WHERE onibus.id = '$id';");
    $sql->execute();
    
    header("Location: ../dashboard.php");
}  else {
    echo "<script>alert('Acesso Negado')</script>";
    header("Location: ../index.php");
}

?>