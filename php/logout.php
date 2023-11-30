<?php

// Iniciando Sessao
session_start();

// Destruindo Sessao
session_destroy();

// Redirecionando
header("Location: ../index.php");

// Matando o Processo
die;

?>