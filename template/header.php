<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="icon" type="image/x-icon" href="assets/ico/logo.ico">


    <style>
        a{
            text-decoration: none;
        }
        header {
            padding: 10px 5%;
            background: var(--cor6);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .title-header {
            letter-spacing: 2px;
            font-size: 1.6em;
            font-weight: 600;
            color: var(--cor2);
        }

        header nav {
            display: flex;
            align-items: center;
            gap: 50px;
        }
        .link {
            display: flex;
            align-items: center;
            gap: 5px;
            color: var(--cor2);
            font-weight: 500;
            transition: all 200ms ease;
            opacity: .8;
        }
        .svg {
            fill: var(--cor2);
        }
        .link:hover {
            opacity: 1;
        }
        .img-logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        .top-header {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body>
    <header>
        <div class="top-header">
            <img class="img-logo" src="./assets/imgs/logo-roxo.png" alt="">
            <a class="title-header" href="index.php"><?php echo $Projeto->getNome();?></a>
        </div>
        <nav>
            <a href="horarios.php" class="link">
                <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200q-33 0-56.5-23.5T120-200Zm80-400h560v-160H200v160Zm213 200h134v-120H413v120Zm0 200h134v-120H413v120ZM200-400h133v-120H200v120Zm427 0h133v-120H627v120ZM200-200h133v-120H200v120Zm427 0h133v-120H627v120Z"/></svg>
                Tabela de Horários
            </a>
            <?php
            
            if(isset($_SESSION['usuario']) && $_SESSION['usuario'][4] == 1) {
                ?>
                <a href="controle-usuarios.php" class="link">
                    <svg class="svg"xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z"/></svg>
                    Controle de Usuários
                </a>
            <?php
            }
            if(!isset($_SESSION['usuario'])) {
                ?>
                
                <a href="admin.php" class="link">
                    <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M680-280q25 0 42.5-17.5T740-340q0-25-17.5-42.5T680-400q-25 0-42.5 17.5T620-340q0 25 17.5 42.5T680-280Zm0 120q31 0 57-14.5t42-38.5q-22-13-47-20t-52-7q-27 0-52 7t-47 20q16 24 42 38.5t57 14.5Zm0 80q-83 0-141.5-58.5T480-280q0-83 58.5-141.5T680-480q83 0 141.5 58.5T880-280q0 83-58.5 141.5T680-80Zm-200 0q-139-35-229.5-159.5T160-516v-244l320-120 320 120v227q-26-13-58.5-20t-61.5-7q-116 0-198 82t-82 198q0 62 23.5 112T483-81q-1 0-1.5.5t-1.5.5Z"/></svg>
                    Painel de Administração
                </a>
            
            <?php
            }

            if(isset($_SESSION['usuario'])) {
                ?>
                <a class="link" href="meu-perfil.php">
                    <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"/></svg>
                    Meu Perfil
                </a>
                <a href="http://localhost/tcc-main/php/logout.php" class="link sair">
                    <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
                    Sair
                </a>
                
                <?php
            }
                ?>
        </nav>
    </header>
</body>
</html>