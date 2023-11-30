<?php

// Iniciando Sessão
session_start();


// Verificando se o Usuário Esta Logado
if(!isset($_SESSION['usuario']) or $_SESSION['usuario'][4] != 1) {
    echo "<script>alert('você não tem acesso a essa area')</script>";
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


<!-- Inicio da estrutura HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>

    <!-- Definindo MetaTags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Titulo da Pagina -->
    <title><?php $Projeto->getNome();?> | Cadastro de Usuário - <?php echo $_SESSION['usuario'][1]?></title>
    
    <!-- Links de Estilização -->
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/style_cadastro_usuarios.css">

</head>

<!-- Inicio do Corpo da Pagina -->
<body>

    <!-- Importando Cabeçalho Padrão -->
    <?php include_once "template/header.php";?>

    <!-- Div Container -->
    <div id="container">
        
        <!-- Titulo da Div -->
        <h1>Cadastro de Usuário</h1>
        
        <!-- Inicio do Formulario -->
        <form id="form" action="./php/cadastrar-usuario.php" method="post">
            
            <!-- Div que contem todos os inputs -->
            <div id="inputs">

                <!-- Inputs -->
                <div class="input">
                    <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z"/></svg>
                    <input type="text" name="nome" placeholder="Nome" required maxlength="50">
                </div>
                <div class="input">
                    <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"/></svg>
                    <input type="text" name="login" placeholder="Login" required maxlength="30">
                </div>
                <div class="divisao">
                    <div class="input">
                        <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M280-360q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Zm0 120q-100 0-170-70T40-480q0-100 70-170t170-70q81 0 141.5 46T506-560h335l79 79-140 160-100-79-80 80-80-80h-14q-25 72-87 116t-139 44Z"/></svg>
                        <input type="password" name="senha" placeholder="Senha" required maxlength="30">
                    </div>
                    <div class="input">
                        <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M280-360q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Zm0 120q-100 0-170-70T40-480q0-100 70-170t170-70q81 0 141.5 46T506-560h335l79 79-140 160-100-79-80 80-80-80h-14q-25 72-87 116t-139 44Z"/></svg>
                        <input type="password" name="confirmSenha" placeholder="Confirmar Senha" required maxlength="30">
                    </div>
                </div>
                
                <!-- Select Para Escolher Cargo -->
                <select name="cargo">
                    <option selected value="0">Motorista</option>
                    <option value="1">Administrador</option>
                </select>
            </div>

            <!-- Input Para enviar as Informções -->
            <input class="btn" type="submit" value="Cadastrar">
        </form>
    </div>

<!-- Encerrando Estrutura HTML -->
</body>
</html>
