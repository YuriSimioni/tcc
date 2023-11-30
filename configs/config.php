<?php 

//Criando Classe Para Configurações do Projeto
class Projeto {
    private $nome = "RoadNav"; //Nome do Projeto

    public function getNome() { //Função Retorna o Nome do Projeto
        echo $this->nome;
    }
}

// Criando Classe Para Configurações do Banco de Dados
class BancoDeDados {
    private $host = "localhost"; // HOST do Banco de Dados
    private $user = "root";      // USUARIO do Banco de Dados
    private $pass = "";          // SENHA do Banco de Dados
    private $bd = "sistema";    // NOME DO BANCO no Banco de Dados
    
    private $pdo;          // Variável GLOBAL para a Conexão com o Banco de Dados
    public $msgErro = ""; // Variável para Mensagem de Erro Caso Ocorra
    
    public function Conectar() { // Função Para Testar a Conexão com o Banco de Dados
        
        // Chamando os Atributos
        global $pdo;
        global $msgErro;

        
        try { // Caso a Conexão Funcione
        
            $pdo = new PDO("mysql:dbname=".$this->bd.";host=".$this->host, $this->user, $this->pass); // Testando a Conexão
            return true; // Conexão foi Realizada com Sucesso
        
        } catch (PDOException $e) { // Senão
        
            $msgErro = $e->getMessage(); // Mensagem de Erro
            return false; // Conexão falhou
        
        }
    }
}

// Criando Classe Para Todas as Funções Relacionadas ao Usuário
class Usuario {

    // Atributos
    private $pdo, $msgErro;

    // Criando Função Para Logar Usuários
    public function Logar($usuario, $senha) {

        global $pdo; // Variáveis Globais

        $sql = $pdo->prepare("SELECT * FROM usuarios WHERE user = :u AND senha = :s"); // Linha de Comando MySqli
        
        // Substituindo Valores
        $sql->bindValue(":u", $usuario);
        $sql->bindValue(":s", $senha);
        
        $sql->execute(); // Executando Linha MySqli

        if($sql->rowCount() > 0) { // Verificando se Teve Resposta

            $dados = $sql->fetch(); // Pegando dados em forma de array

            $_SESSION['usuario'] = $dados; // Colocando array na sessão USUARIO

            $_SESSION['logged'] = true; // Sessao para saber se esta logado

            return true; // Retornou true

        } else {
            echo "<script>alert('Usuario ou Senha Incorretos')</script>"; //Mensagem de Erro de Dados
            return false; //Retornou False
        }
    }

    public function DeletarUsuario($id) {
        global $pdo;

        $sql = $pdo->prepare("DELETE FROM usuarios WHERE `usuarios`.`id` = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function CadastrarUsuario($nome, $login, $senha, $cargo) {
        global $pdo;
        $sql = $pdo->prepare("INSERT INTO `usuarios` (`id`, `nome`, `user`, `senha`, `cargo`) VALUES (NULL, :n, :l, :s, :c);");
        $sql->bindValue(":n", $nome);
        $sql->bindValue(":l", $login);
        $sql->bindValue(":s", $senha);
        $sql->bindValue(":c", $cargo);
        

        $sql->execute();

        if($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
        
    }

    public function ListarUsuarios() {
        global $pdo;

        $sql = $pdo->prepare("SELECT * FROM usuarios");
        $sql->execute();
        if($sql->rowCount() > 0) {
            $result = $sql->fetchAll();
            ?>
            <table>
                <thead>
                    <tr>
                        <th class="direita">Id</th>
                        <th class="direita">Nome</th>
                        <th class="direita">Login</th>
                        <th class="direita">Cargo</th>
                        <th class="esquerda funcoes">Funções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($result as $usuario) {
                            ?>
                            
                            <tr>
                                <td><?php echo $usuario[0];?></td>
                                <td><?php echo $usuario[1];?></td>
                                <td><?php echo $usuario[2];?></td>
                                <td><?php if($usuario[4] == 0) {echo "Motorista";}else{echo "Administrador";};?></td>
                                <td>
                                    <a class="btn" href="./editar-user.php?id=<?php echo $usuario[0];?>">
                                        <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M120-120v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm584-528 56-56-56-56-56 56 56 56Z"/></svg>
                                        Editar
                        </a>
                                    <div onclick="clickBtnDelet()" id="deletBtn" class="btn delet" href="./php/excluir-user.php?id=<?php echo $usuario[0];?>">
                                        <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm80-160h80v-360h-80v360Zm160 0h80v-360h-80v360Z"/></svg>
                                        Excluir
                                    </div>
                                </td>
                            </tr>

                            <?php
                        }
                    ?>
                </tbody>
            </table>
            <div id="camada">
                <div id="popup">
                    <p>Deseja realmente excluir esse usuário?</p>
                    <div id="btns">
                        <a href="http://localhost/tcc-main/php/excluir-user.php?id=<?php echo $usuario[0]?>" id="btnConfirma">
                            <svg iclass="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/></svg>
                            Confirmar
                        </a>
                        <div onclick="fechaPopup()" id="btnCancel">
                            <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                            Cancelar
                        </div>
                    </div>
                </div>
            </div>
            
            <?php
        }
    }

    public function EditarUsuario($nome, $login, $cargo, $id) {
        global $pdo;
        
        $sql = $pdo->prepare("UPDATE usuarios SET `nome` = :n, `user` = :l, `cargo` = :c WHERE `usuarios`.`id` = :id");
        $sql->bindValue(":n", $nome);
        $sql->bindValue(":l", $login);
        $sql->bindValue(":c", $cargo);
        $sql->bindValue(":id", $id);
        $sql->execute();
        if($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function BuscaEListaUsuario($nome) {
        global $pdo;
        global $msgErro;
            $sql = $pdo->prepare("SELECT * FROM usuarios WHERE (nome LIKE :l)");
            $sql->bindValue(':l', "%".$nome."%", PDO::PARAM_STR);
            $sql->execute();
            if($sql->rowCount() > 0) {
                $users = $sql->fetchAll();
                ?>
                <table>
                    <thead>
                        <tr>
                            <th class="direita">Id</th>
                            <th class="direita">Nome</th>
                            <th class="direita">Login</th>
                            <th class="direita">Cargo</th>
                            <th class="esquerda funcoes">Funções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($users as $usuario) {
                                ?>
                                
                                <tr>
                                    <td><?php echo $usuario[0];?></td>
                                    <td><?php echo $usuario[1];?></td>
                                    <td><?php echo $usuario[2];?></td>
                                    <td><?php if($usuario[4] == 0) {echo "Motorista";}else{echo "Administrador";};?></td>
                                    <td>
                                        <a class="btn" href="./editar-user.php?id=<?php echo $usuario[0];?>">
                                            <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M120-120v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm584-528 56-56-56-56-56 56 56 56Z"/></svg>
                                            Editar
                            </a>
                                        <div onclick="clickBtnDelet()" id="deletBtn" class="btn delet" href="./php/excluir-user.php?id=<?php echo $usuario[0];?>">
                                            <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm80-160h80v-360h-80v360Zm160 0h80v-360h-80v360Z"/></svg>
                                            Excluir
                                        </div>
                                    </td>
                                </tr>

                                <?php
                            }
                        ?>
                    </tbody>
                </table>
                <div id="camada">
                    <div id="popup">
                        <p>Deseja realmente excluir esse usuário?</p>
                        <div id="btns">
                            <a href="http://localhost/tcc-main/php/excluir-user.php?id=<?php echo $usuario[0]?>" id="btnConfirma">
                                <svg iclass="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/></svg>
                                Confirmar
                            </a>
                            <div onclick="fechaPopup()" id="btnCancel">
                                <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                                Cancelar
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php
            
            }else {
                $msgErro = "Não foi encotrado nenhum usuários";
                return $msgErro;
            }
            

        
    }

    public function MeusDados($id) {
        global $pdo;
        $sql = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $dados = $sql->fetch();
            ?>
            
            <div class="line-info">
                <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M364-590q22-23 51.5-36.5T480-640q35 0 64.5 13.5T596-590l202-113-279-155q-18-11-39-11t-39 11L162-703l202 113Zm76 488v-223q-52-14-86-56.5T320-480q0-11 1-21t4-19L120-635v308q0 22 11 40.5t30 29.5l279 155Zm40-298q33 0 56.5-23.5T560-480q0-33-23.5-56.5T480-560q-33 0-56.5 23.5T400-480q0 33 23.5 56.5T480-400Zm40 298 279-155q19-11 30-29.5t11-40.5v-308L635-520q3 10 4 19.5t1 20.5q0 56-34 98.5T520-325v223Z"/></svg>
                <p class="desc">
                    <span>Id:</span> <?php echo $dados[0];?>
                </p>
            </div>
            
            <div class="line-info">
                <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z"/></svg>
                <p class="desc">
                    <span>Nome:</span> <?php echo $dados[1];?>
                </p>
            </div>
            <div class="line-info">
                <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"/></svg>
                <p class="desc">
                    <span>Login:</span> <?php echo $dados[2];?>
                </p>
            </div>
            <div class="line-info">
                <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-440q58 0 99-41t41-99q0-58-41-99t-99-41q-58 0-99 41t-41 99q0 58 41 99t99 41Zm0 276q59-19 104.5-59.5T664-315q-43-22-89.5-33.5T480-360q-48 0-94.5 11.5T296-315q34 51 79.5 91.5T480-164Zm0 80q-7 0-13-1t-12-3q-135-45-215-166.5T160-516v-189q0-25 14.5-45t37.5-29l240-90q14-5 28-5t28 5l240 90q23 9 37.5 29t14.5 45v189q0 140-80 261.5T505-88q-6 2-12 3t-13 1Z"/></svg>
                <p class="desc">
                    <span>Cargo:</span> <?php if($dados[4] == 1) {echo "Administrador";} else {echo "Motorista";}?>
                </p>
            </div>
            <?php
        }
    }

    public function MudarSenha($id, $senha) {
        global $pdo;

        $sql = $pdo->prepare("UPDATE `usuarios` SET `senha` = :s WHERE `usuarios`.`id` = :id; ");
        $sql->bindValue(":s", $senha);
        $sql->bindValue(":id", $id);
        $sql->execute();
        if($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}

class Onibus {
    // Atributos
    private $pdo, $msgErro;

    // Criando Função Para Logar Usuários
    public function MostrarOnibusAdmin() {

        global $pdo; // Variáveis Globais

        $sql = $pdo->prepare("SELECT * FROM onibus");
        $sql->execute();
        $result = $sql->fetchAll();
        ?>
        <script>
            // const bola = document.querySelectorAll("div.status");
        </script>
        <?php
        foreach($result as $item) {

            
            ?>
            <div class="card <?php if($item[2] == "semRota"){echo 'borda-cinza';}?>">
                <div class="card-top <?php if($item[2] == "semRota"){echo 'fundo-cinza';}?>">
                <p class="nome-bus">
                    <svg class="svg-bgl" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-120q-17 0-28.5-11.5T200-160v-82q-18-20-29-44.5T160-340v-380q0-83 77-121.5T480-880q172 0 246 37t74 123v380q0 29-11 53.5T760-242v82q0 17-11.5 28.5T720-120h-40q-17 0-28.5-11.5T640-160v-40H320v40q0 17-11.5 28.5T280-120h-40Zm242-640h224-448 224Zm158 280H240h480-80Zm-400-80h480v-120H240v120Zm100 240q25 0 42.5-17.5T400-380q0-25-17.5-42.5T340-440q-25 0-42.5 17.5T280-380q0 25 17.5 42.5T340-320Zm280 0q25 0 42.5-17.5T680-380q0-25-17.5-42.5T620-440q-25 0-42.5 17.5T560-380q0 25 17.5 42.5T620-320ZM258-760h448q-15-17-64.5-28.5T482-800q-107 0-156.5 12.5T258-760Zm62 480h320q33 0 56.5-23.5T720-360v-120H240v120q0 33 23.5 56.5T320-280Z"/></svg>
                    <?php echo $item[1]?> 
                    <?php 
                    
                        if($item[2] != "semRota") {
                            ?>
                                | <svg class="svg-bgl" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/></svg>
                                <?php echo rtrim(rtrim($item[5], "0"), ":")?></p>
                            <?php
                        }
                        ?>
                    
                    
                    
                    
                <a href="http://localhost/tcc-main/admin/definirStatus.php?id=<?php echo $item[0]?>" class="btn-bus">Definir Status</a>
                   
                </div>
                <div class="card-content">
                    <div class="card-mid">
                        <?php
                        
                        if($item[2] == "semRota") {
                            ?>
                            
                            <p class="desc-bus <?php if($item[2] == "semRota"){echo 'text-cinza';}?>">Onibus esta sem rota ou não tem horario no momento</p>

                            <?php
                        } else {
                            ?>
                            
                            <p class="desc-bus"><?php echo $item[3]?></p>
                            <?php
                        }
                        
                        ?>
                    </div>
                    <div class="card-bottom">

                    <?php
                        if($item[2] == "emRota") {
                            $item[2] = "Transitando";
                            ?>
                            <div class="cocent"><div id="bola-status" class="status verde"></div><?php echo $item[2]?></div>                            
                            <?php
                        } elseif($item[2] == "naRodoviaria") {
                            $item[2] = "Na Rodoviária";
                            ?>
                            <div class="cocent"><div id="bola-status" class="status"></div><?php echo $item[2]?></div>
                            <?php
                        }elseif($item[2] == "atrasado") {
                            $item[2] = "Atrasado";
                            ?>
                            <div class="cocent"><div id="bola-status" class="status vermelho"></div><p class="statusText"><?php echo $item[2]?></p></div>
                            <?php
                        }
                        else{
                            $item[2] = "Sem Rota";
                            ?>
                            <div class="cocent text-cinza"><div id="bola-status" class="status cinza"></div><?php echo $item[2]?></div>
                             
                            <?php
                        }
                        ?>
                    </div>
                    
                </div>
            </div>
        
        <?php
        }
    }

    public function MostrarOnibus() {

        global $pdo; // Variáveis Globais

        $sql = $pdo->prepare("SELECT * FROM onibus");
        $sql->execute();
        $result = $sql->fetchAll();
        // echo "<script>let bola = document.getElementsByClassName('status')</script>";
        foreach($result as $item) {
            ?>

                <div class="card <?php if($item[2] == "semRota"){echo 'borda-cinza';}?>">
                <div class="card-top <?php if($item[2] == "semRota"){echo 'fundo-cinza';}?>">
                <p class="nome-bus">
                    <svg class="svg-bgl" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-120q-17 0-28.5-11.5T200-160v-82q-18-20-29-44.5T160-340v-380q0-83 77-121.5T480-880q172 0 246 37t74 123v380q0 29-11 53.5T760-242v82q0 17-11.5 28.5T720-120h-40q-17 0-28.5-11.5T640-160v-40H320v40q0 17-11.5 28.5T280-120h-40Zm242-640h224-448 224Zm158 280H240h480-80Zm-400-80h480v-120H240v120Zm100 240q25 0 42.5-17.5T400-380q0-25-17.5-42.5T340-440q-25 0-42.5 17.5T280-380q0 25 17.5 42.5T340-320Zm280 0q25 0 42.5-17.5T680-380q0-25-17.5-42.5T620-440q-25 0-42.5 17.5T560-380q0 25 17.5 42.5T620-320ZM258-760h448q-15-17-64.5-28.5T482-800q-107 0-156.5 12.5T258-760Zm62 480h320q33 0 56.5-23.5T720-360v-120H240v120q0 33 23.5 56.5T320-280Z"/></svg>
                    <?php echo $item[1]?> 
                    <?php 
                    
                        if($item[2] != "semRota") {
                            ?>
                                | <svg class="svg-bgl" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/></svg>
                                <?php echo rtrim(rtrim($item[5], "0"), ":")?></p>
                            <?php
                        }
                        ?>
                </div>
                <div class="card-content">
                    <div class="card-mid">
                        <?php
                        
                        if($item[2] == "semRota") {
                            ?>
                            
                            <p class="desc-bus <?php if($item[2] == "semRota"){echo 'text-cinza';}?>">Onibus esta sem rota ou não tem horario no momento</p>

                            <?php
                        } else {
                            ?>
                            
                            <p class="desc-bus"><?php echo $item[3]?></p>
                            <?php
                        }
                        
                        ?>
                    </div>
                    <div class="card-bottom">

                    <?php
                        if($item[2] == "emRota") {
                            $item[2] = "Transitando";
                            ?>
                            <div class="cocent"><div id="bola-status" class="status verde"></div><?php echo $item[2]?></div>                            
                            <?php
                        } elseif($item[2] == "naRodoviaria") {
                            $item[2] = "Na Rodoviária";
                            ?>
                            <div class="cocent"><div id="bola-status" class="status"></div><?php echo $item[2]?></div>
                            <?php
                        }elseif($item[2] == "atrasado") {
                            $item[2] = "Atrasado";
                            ?>
                            <div class="cocent"><div id="bola-status" class="status vermelho"></div><p class="statusText"><?php echo $item[2]?></p></div>
                            <?php
                        }
                        else{
                            $item[2] = "Sem Rota";
                            ?>
                            <div class="cocent text-cinza"><div id="bola-status" class="status cinza"></div><?php echo $item[2]?></div>
                             
                            <?php
                        }
                        ?>
                    </div>
                    
                </div>
            </div>
        
        <?php
        }
    }

    public function pegarDadosOnibus($id) {
        global $pdo;
        $sql = $pdo->prepare("SELECT * FROM onibus WHERE id = :d");
        $sql->bindValue(":d", $id);
        $sql->execute();

        if($sql->rowCount() > 0) { // Verificando se Teve Resposta

            $dados = $sql->fetch();
            
            ?>
            
            <form method="post" action="../php/definirBus.php" id="form">
                <?php
                
                if($_SESSION['usuario'][4] == 1) {
                    ?>
                        <input type="text" name="nomebus" placeholder="Nome" class="input" value="<?php echo $dados[1]?>">
                    <?php
                } else {
                    ?>
                        <p class="title-bus"><?php echo $dados[1];?></p>
                        <input type="hidden" name="nomebus" class="input" value="<?php echo $dados[1]?>">
                    <?php
                }

                ?>
                <select name="desc" class="select">
                    <?php
                    
                    if($dados[1] == "Jardim das Laranjeiras") {
                        ?>
                        
                        <option selected value="Terminal x Jardim das Laranjeiras / Santa Isabel">Terminal x Jardim das Laranjeiras / Santa Isabel</option>
                        <option selected value="Terminal x J Laranjeiras / Santa Isabel Via Esperanca">Terminal x J Laranjeiras / Santa Isabel Via Esperanca</option>

                        <?php
                    } elseif ($dados[1] == "Vila Esperanca") {
                        ?>
                        
                        <option selected value="Terminal x Vila Esperanca">Terminal x Vila Esperanca</option>

                        <?php
                    } elseif ($dados[1] == "Jardim Morumbi") {
                        ?>
                        
                        <option selected value="Terminal x Jardim Morumbi">Terminal x Jardim Morumbi</option>
                        
                        <?php
                    } elseif($dados[1] == "Cachoeira De Emas") {
                        ?>
                        
                        <option value="Terminal x Cachoeira de Emas / Santa Fe">Terminal x Cachoeira de Emas / Santa Fe</option>
                        
                        <?php
                    } elseif($dados[1] == "Santa Fe") {
                        ?>
                        
                        <option value="Terminal x Santa Fe">Terminal x Santa Fe</option>

                        <?php
                    } elseif($dados[1] == "Vila Sao Pedro") {
                        ?>
                        
                        <option selected value="Terminal x Vila Sao Pedro">Terminal x Vila Sao Pedro</option>
                        <option selected value="Terminal x Vila Sao Pedro / Cidade Jardim">Terminal x Vila Sao Pedro / Cidade Jardim</option>
                        <option selected value="Terminal x Jardim Milenium Via Vila Sao Pedro">Terminal x Jardim Milenium Via Vila Sao Pedro</option>
                        <?php
                    } elseif($dados[1] == "Taboao") {
                        ?>
                        
                        <option selected value="Terminal x Taboao">Terminal x Taboao</option>
                        
                        <?php
                    } elseif($dados[1] == "Distrito Industrial") {
                        ?>
                        
                        <option selected value="Terminal x Distrito Industrial">Terminal x Distrito Industrial</option>

                        <?php
                    } elseif($dados[1] == "AFA") {
                        ?>
                        
                        <option selected value="Terminal x AFA / Vila dos Sargentos">Terminal x AFA / Vila dos Sargentos</option>
                        <option selected value="Terminal x AFA Psicultura">Terminal x AFA Psicultura</option>
                        
                        <?php
                    } else {
                        ?>
                        <option selected value="Terminal x Jardim Morumbi">Terminal x Jardim Morumbi</option>
                        <option selected value="Terminal x Cachoeira de Emas / Santa Fe">Terminal x Cachoeira de Emas / Santa Fe</option>
                        <option selected value="Terminal x Santa Fe">Terminal x Santa Fe</option>

                        <option selected value="Terminal x Vila Esperanca">Terminal x Vila Esperanca</option>

                        <option selected value="Terminal x Jardim das Laranjeiras / Santa Isabel">Terminal x Jardim das Laranjeiras / Santa Isabel</option>
                        <option selected value="Terminal x J Laranjeiras / Santa Isabel Via Esperanca">Terminal x J Laranjeiras / Santa Isabel Via Esperanca</option>

                        <option selected value="Terminal x Vila Sao Pedro">Terminal x Vila Sao Pedro</option>
                        <option selected value="Terminal x Vila Sao Pedro / Cidade Jardim">Terminal x Vila Sao Pedro / Cidade Jardim</option>
                        <option selected value="Terminal x Jardim Milenium Via Vila Sao Pedro">Terminal x Jardim Milenium Via Vila Sao Pedro</option>
                        
                        <option selected value="Terminal x Taboao">Terminal x Taboao</option>
                        
                        <option selected value="Terminal x Distrito Industrial">Terminal x Distrito Industrial</option>

                        <option selected value="Terminal x AFA / Vila dos Sargentos">Terminal x AFA / Vila dos Sargentos</option>
                        <option selected value="Terminal x AFA Psicultura">Terminal x AFA Psicultura</option>
                        
                        
                        
                        <?php
                    }
                    
                    ?>
                </select>
                <select name="status" class="select">
                    <option value="naRodoviaria" selected>Na Rodoviária</option>
                    <option value="emRota" selected>Em Circulacão</option>
                    <option value="atrasado" selected>Atrasado</option>
                    <option value="semRota" selected>Sem Rota</option>
                </select>
                
                <select name="horario" class="select">
                    <?php
                    
                    if($dados[1] == "Jardim das Laranjeiras") {
                        ?>
                        
                        <option selected value="04:40">04:40</option>
                        <option selected value="05:30">05:30</option>
                        <option selected value="06:00">06:00</option>
                        <option selected value="06:30">06:30</option>
                        <option selected value="07:00">07:00</option>
                        <option selected value="07:30">07:30</option>
                        <option selected value="08:00">08:00</option>
                        <option selected value="08:30">08:30</option>
                        <option selected value="09:00">09:00</option>
                        <option selected value="09:30">09:30</option>
                        <option selected value="10:00">10:00</option>
                        <option selected value="11:00">11:00</option>
                        <option selected value="12:00">12:00</option>
                        <option selected value="13:00">13:00</option>
                        <option selected value="13:40">13:40</option>
                        <option selected value="14:00">14:00</option>
                        <option selected value="15:00">15:00</option>
                        <option selected value="16:00">16:00</option>
                        <option selected value="16:30">16:30</option>
                        <option selected value="17:00">17:00</option>
                        <option selected value="17:30">17:30</option>
                        <option selected value="18:00">18:00</option>
                        <option selected value="18:30">18:30</option>
                        <option selected value="21:30">21:30</option>
                        <?php
                    } elseif ($dados[1] == "Vila Esperanca") {
                        ?>
                        
                        <option selected value="06:45">06:45</option>
                        <option selected value="11:15">11:15</option>
                        <option selected value="12:30">12:30</option>
                        <option selected value="16:00">16:00</option>
                        <option selected value="16:30">16:30</option>
                        <option selected value="17:00">17:00</option>
                        <option selected value="17:30">17:30</option>
                        
                        <?php
                    } elseif ($dados[1] == "Jardim Morumbi") {
                        ?>
                        
                        <option selected value="05:30">05:30</option>
                        <option selected value="06:00">06:00</option>
                        <option selected value="06:30">06:30</option>
                        <option selected value="07:30">07:30</option>
                        <option selected value="08:00">08:00</option>
                        <option selected value="09:00">09:00</option>
                        <option selected value="11:00">11:00</option>
                        <option selected value="12:00">12:00</option>
                        <option selected value="13:30">13:30</option>
                        <option selected value="15:00">15:00</option>
                        <option selected value="16:00">16:00</option>
                        <option selected value="17:00">17:00</option>
                        <option selected value="18:15">18:15</option>
                        <?php
                    } elseif($dados[1] == "Cachoeira De Emas") {
                        ?>
                        
                        <option selected value="04:40">04:40</option>
                        <option selected value="05:35">05:35</option>
                        <option selected value="06:00">06:00</option>
                        <option selected value="06:30">06:30</option>
                        <option selected value="07:00">07:00</option>
                        <option selected value="07:30">07:30</option>
                        <option selected value="08:00">08:00</option>
                        <option selected value="08:30">08:30</option>
                        <option selected value="09:00">09:00</option>
                        <option selected value="09:30">09:30</option>
                        <option selected value="10:30">10:30</option>
                        <option selected value="11:00">11:00</option>
                        <option selected value="12:00">12:00</option>
                        <option selected value="12:30">12:30</option>
                        <option selected value="13:00">13:00</option>
                        <option selected value="13:30">13:30</option>
                        <option selected value="13:40">13:40</option>
                        <option selected value="14:00">14:00</option>
                        <option selected value="14:30">14:30</option>
                        <option selected value="15:00">15:00</option>
                        <option selected value="15:30">15:30</option>
                        <option selected value="16:00">16:00</option>
                        <option selected value="16:30">16:30</option>
                        <option selected value="17:00">17:00</option>
                        <option selected value="17:30">17:30</option>
                        <option selected value="18:00">18:00</option>
                        <option selected value="18:30">18:30</option>
                        <option selected value="19:30">19:30</option>
                        <option selected value="21:30">21:30</option>
                        <option selected value="23:10">23:10</option>

                        <?php
                    } elseif($dados[1] == "Santa Fe") {
                        ?>
                        
                        <option selected value="04:40">04:40</option>
                        <option selected value="05:35">05:35</option>
                        <option selected value="06:00">06:00</option>
                        <option selected value="06:30">06:30</option>
                        <option selected value="07:00">07:00</option>
                        <option selected value="07:30">07:30</option>
                        <option selected value="08:00">08:00</option>
                        <option selected value="08:30">08:30</option>
                        <option selected value="09:00">09:00</option>
                        <option selected value="09:30">09:30</option>
                        <option selected value="10:30">10:30</option>
                        <option selected value="11:00">11:00</option>
                        <option selected value="12:00">12:00</option>
                        <option selected value="12:30">12:30</option>
                        <option selected value="13:00">13:00</option>
                        <option selected value="13:30">13:30</option>
                        <option selected value="13:40">13:40</option>
                        <option selected value="14:00">14:00</option>
                        <option selected value="14:30">14:30</option>
                        <option selected value="15:00">15:00</option>
                        <option selected value="15:30">15:30</option>
                        <option selected value="16:00">16:00</option>
                        <option selected value="16:30">16:30</option>
                        <option selected value="17:00">17:00</option>
                        <option selected value="17:30">17:30</option>
                        <option selected value="18:00">18:00</option>
                        <option selected value="18:30">18:30</option>
                        <option selected value="19:30">19:30</option>
                        <option selected value="21:30">21:30</option>
                        <option selected value="23:10">23:10</option>

                        <?php
                    } elseif($dados[1] == "Vila Sao Pedro") {
                        ?>
                        
                        <option selected value="05:40">05:40</option>
                        <option selected value="06:30">06:30</option>
                        <option selected value="07:30">07:30</option>
                        <option selected value="08:10">08:10</option>
                        <option selected value="11:00">11:00</option>
                        <option selected value="13:00">13:00</option>
                        <option selected value="15:15">15:15</option>
                        <option selected value="16:15">16:15</option>
                        <option selected value="17:15">17:15</option>
                        
                        <?php
                    } elseif($dados[1] == "Taboao") {
                        ?>
                        
                        <option selected value="06:55">06:55</option>
                        <option selected value="13:05">13:05</option>

                        <?php
                    } elseif($dados[1] == "Distrito Industrial") {
                        ?>
                        
                        <option selected value="06:25">06:25</option>
                        
                        <?php
                    } elseif($dados[1] == "AFA") {
                        ?>
                        
                        <option selected value="05:35">05:35</option>
                        <option selected value="15:55">15:55</option>
                        <option selected value="16:10">16:10</option>
                        <?php
                    } 
                    
                    ?>
                </select>
                
                <!-- <input type="time" name="tempo" class="input" required value=""> -->
                <input type="hidden" name="autor" value="<?php echo $dados[4]?>">
                <input type="hidden" name="id" value="<?php echo $dados[0]?>">
                <input id="btn" class="btn" type="submit" value="Atualizar">
            </form>
            
            <?php
        }
    }

    public function definirBus($id) {
        global $pdo;
        
    }
}
?>