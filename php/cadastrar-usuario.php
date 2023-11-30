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

$nome = $_POST['nome'];
$login = $_POST['login'];
$senha = $_POST['senha'];
$confirmSenha = $_POST['confirmSenha'];
$cargo = $_POST['cargo'];

if(!$BancoDeDados->Conectar()) {

} else {
    if($senha == $confirmSenha) {
        if($Usuario->CadastrarUsuario($nome, $login, $senha, $cargo) == "true") {
            header("Location: ../controle-usuarios.php");
        } else {
            header("Location: ../novo-usuario.php");
        }
    } else {
        header("Location: ../novo-usuario.php");
    }
}