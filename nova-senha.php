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
    <link rel="stylesheet" href="./css/style_nova_senha.css">

</head>
<body>
    <?php include_once "template/header.php";?>

    <div id="container">
        <h1>Alterar Senha</h1>
        <form action="./php/mudar-senha.php" method="post">
            <input type="hidden" name="id" value="<?php echo $_SESSION['usuario'][0]?>">
            <div class="inputs">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M280-360q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Zm0 120q-100 0-170-70T40-480q0-100 70-170t170-70q81 0 141.5 46T506-560h335l79 79-140 160-100-79-80 80-80-80h-14q-25 72-87 116t-139 44Z"/></svg>
                <input type="password" name="senha" placeholder="Digite a nova senha" required class="input">
            </div>
            <div class="inputs">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/></svg>
                <input type="password" name="confirmaSenha" placeholder="Confirme a senha" required class="input">
            </div>
            <input type="submit" value="Alterar">
        </form>
    </div>


</body>
</html>
