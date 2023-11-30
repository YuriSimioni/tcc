<?php

// Iniciando Sessao
session_start();

// Importando o Arquivo de Configuração
require_once "./configs/config.php";

// Criando Variável das Classes
$Projeto = new Projeto;
$BancoDeDados = new BancoDeDados;
$Usuario = new Usuario;

if(isset($_SESSION['logged'])) { // Verificando se o Usuário Ja Esta Logado

    // Redirecionando
    header("Location: ./dashboard.php");

} else { // Caso o Usuário Não Esteja Logado

    if(isset($_POST['usuario']) && isset($_POST['senha'])) { // Verificando se os Campos USUÁRIO e SENHA existem
        
        if($BancoDeDados->Conectar()) { // Testando Conexão Com o Banco de Dados
            
            if($Usuario->Logar($_POST['usuario'], $_POST['senha']) == true) {// Logando o Usuário 
                // Redirecionando
                header("Location: ./dashboard.php");
            }
        } else { // Caso Falhe a Conexão Com o Banco de Dados

            echo "<script>alert('Algo de errado aconteceu!! Tente novamente')</script>"; // Mostrando Mensagem de Erro
            
        
        }
    }
}

?>

<!-- Criando a Estrutura HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>

    <!-- Definindo Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Definindo Titulo do Pagina -->
    <title><?php $Projeto->getNome()?></title>

    <!-- Linkando os Arquivos de Estilização -->
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/style_index.css">


</head>
<!-- Inicio do Corpo da Pagina -->
<body>
    
    <!-- Criando Formulario de Login -->
    <form action="" method="post" id="formulario">

        <!-- DIV Para o Topo do Formulário -->
        <div id="top-form">
            
            <!-- SVG_LOCK_FILL -->
            <svg class="svg-title" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/></svg>
            
            <!-- Definindo titulo da Pagina -->
            <h1 id="title-top-form">Acesso ao Sistema</h1>

        </div>
        

        <!-- DIV Para o Meio do Formulário -->
        <div id="mid-form">
            
            <!-- Criando a DIV Para o INPUT do Usuário -->
            <div class="div-input">

                <!-- SVG_PERSON_FILL -->
                <svg class="svg-input" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z"/></svg>
            
                <!-- Criando o INPUT do Usuário-->
                <input class="input" type="text" name="usuario" placeholder="Usuário" required maxlength="30">

            </div>

            <!-- Criando a DIV Para o INPUT da Senha -->
            <div class="div-input">

                <!-- SVG_KEY_FILL -->
                <svg class="svg-input" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M280-360q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Zm0 120q-100 0-170-70T40-480q0-100 70-170t170-70q81 0 141.5 46T506-560h335l79 79-140 160-100-79-80 80-80-80h-14q-25 72-87 116t-139 44Z"/></svg>
            
                <!-- Criando o INPUT da Senha-->
                <input class="input" type="password" name="senha" placeholder="Senha" required maxlength="30">

            </div>
        </div>

        <!-- DIV Para o Final do Formulário -->
        <div id="bottom-form">

            <!-- Criando Botão Para Enviar os Dados -->
            <input id="btn" type="submit" value="Acessar">
        
        </div>
    </form>

<!-- Encerrando Estrutura HTML -->
</body>
</html>