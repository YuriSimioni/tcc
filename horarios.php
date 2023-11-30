<?php

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
    <title><?php $Projeto->getNome();?> | Dashboard</title>
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/style_horarios.css">
</head>
<body>
    <?php include_once "template/header.php";?>

    
    <div class="container">
        <img src="./assets/imgs/horarios.png" alt="">
    </div>


</body>
</html>



<!-- <a href="./php/logout.php">Sair</a> -->
