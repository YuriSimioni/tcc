<?php


// Iniciando Sessão
session_start();


// Verificando se o Usuário Esta Logado
if(!isset($_SESSION['usuario']) or $_SESSION['usuario'][4] != 1) {
    echo "<script>alert('você não tem acesso a essa area')</script>";
    header("Location: index.php");
}

// Importando o Arquivo de Configuração
require_once "../configs/config.php";

// Criando Variável das Classes
$Projeto = new Projeto;
$BancoDeDados = new BancoDeDados;
$Usuario = new Usuario;
$Onibus = new Onibus;

if(!$BancoDeDados->Conectar()) {

} else {
    if($Usuario->EditarUsuario($_POST['nome'], $_POST['login'], $_POST['cargo'], $_POST['id'])) {
        header("Location: ../controle-usuarios.php");
    } else {
        echo "<script>alert('Ocorreu um erro'); window.location.href = '../controle-usuarios.php'</script>";
    }
}