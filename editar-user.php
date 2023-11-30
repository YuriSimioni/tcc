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

$host = "localhost"; // HOST do Banco de Dados
$user = "root";      // USUARIO do Banco de Dados
$pass = "";          // SENHA do Banco de Dados
$bd = "sistema";
    
$pdo = new PDO("mysql:dbname=".$bd.";host=".$host, $user, $pass);

$id = $_GET['id'];


$sql = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
$sql->bindValue(":id", $id);
$sql->execute();
if($sql->rowCount() > 0) {
    $dadosUser = $sql->fetch();
}else {
}

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $Projeto->getNome();?> | Editar Usuário - <?php echo $_SESSION['usuario'][1]?></title>
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/style_cadastro_usuarios.css">

</head>
<body>
    <?php include_once "template/header.php";?>

    <div id="container">
        <h1>Editar Dados do Usuário</h1>
        <form id="form" action="./php/editar-usuario.php" method="post">
            <div id="inputs">
                <div class="input">
                    <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z"/></svg>
                    <input value="<?php echo $dadosUser[1];?>" type="text" name="nome" placeholder="Nome" required maxlength="50">
                </div>
                <div class="input">
                    <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"/></svg>
                    <input value="<?php echo $dadosUser[2];?>" type="text" name="login" placeholder="Login" required maxlength="30">
                </div>
                <select name="cargo">
                    <option selected value="0">Motorista</option>
                    <option <?php if($dadosUser[4] == "1"){echo "selected";}?> value="1">Administrador</option>
                </select>
                <input type="hidden" name="id" value="<?php echo $dadosUser[0];?>">
            </div>
            <input class="btn" type="submit" value="Editar">
        </form>
    </div>


</body>
</html>
