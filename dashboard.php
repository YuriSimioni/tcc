<?php

// Iniciando Sessão
session_start();


// Verificando se o Usuário Esta Logado
if(!isset($_SESSION['usuario'])) {
    echo "<script>alert('Faça login para acessar essa área')</script>";
    header("Location: index.php");
}

// Importando o Arquivo de Configuração
require_once "./configs/config.php";

// Criando Variável das Classes
$Projeto = new Projeto;
$BancoDeDados = new BancoDeDados;
$Usuario = new Usuario;
$Onibus = new Onibus;

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $Projeto->getNome();?> | Dashboard - <?php echo $_SESSION['usuario'][1]?></title>
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/style_dashboard.css">

</head>
<body>
    <?php include_once "template/header.php";?>

    <div id="container">
        <h1>Controle de Navegação</h1>

        <div id="box">
            
            <?php
            
            if(!$BancoDeDados->Conectar()) {

            } else {
                $BancoDeDados->Conectar();
                $Onibus->MostrarOnibusAdmin();
            }
            
            ?>

        </div>
    </div>


</body>
</html>
