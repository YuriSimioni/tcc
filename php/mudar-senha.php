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


$senha = $_POST['senha'];
$confirmSenha = $_POST['confirmaSenha'];
$id = $_POST['id'];

if(!$BancoDeDados->Conectar()) {

} else {
    if($senha == $confirmSenha) {
        $Usuario->MudarSenha($id, $senha);
        header("Location: ./logout.php");
    } else {
        echo "<script>alert('As senhas não coincidem'); window.location.href = '../nova-senha.php'</script>";
    }
}