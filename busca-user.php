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



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $Projeto->getNome();?> | Busca de Usuário - <?php echo $_SESSION['usuario'][1]?></title>
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/style_busca_user.css">

</head>
<body>
    <?php include_once "template/header.php";?>

    <div id="container">
        <h1>Busca de Usuarios</h1>
        <div class="opc">
            <p class="info">Usuários com "<?php echo "<span>".$_POST['nome']."</span>"?>" no nome</p>
            <form class="form-busca" action="busca-user.php" method="post">
                <div id="input">
                    <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M380-320q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l224 224q11 11 11 28t-11 28q-11 11-28 11t-28-11L532-372q-30 24-69 38t-83 14Zm0-80q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                    <input class="input" type="text" name="nome" placeholder="Busque pelo nome do usuário..." required>
                </div>
                <input class="btn-submit" type="submit" value="Buscar">
            </form>
        </div>
        <div id="box">
            
            <?php
            
            if(!$BancoDeDados->Conectar()) {

            } else {
                $BancoDeDados->Conectar();
                $Usuario->BuscaEListaUsuario($_POST['nome']);
            }
            
            ?>

        </div>
    </div>

    <script>

            let camadaVisible = false;
            function clickBtnDelet() {
                let camada = document.getElementById("camada");
                let popup = document.getElementById("popup");
                camada.style.display = "block";
                camada.style.opacity = "1";
                popup.style.display = "flex";
                popup.style.opacity = "1";

            }

            function fechaPopup() {
                let camada = document.getElementById("camada");
                let popup = document.getElementById("popup");
                camada.style.display = "none";
                camada.style.opacity = "0";
                popup.style.display = "none";
                popup.style.opacity = "0";
            }
     
    </script>


</body>
</html>
