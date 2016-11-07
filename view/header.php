<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Psicoline</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" href="<?php echo URL ?>view/img/icon.png">
    <link rel="stylesheet" href="<?php echo URL ?>view/css/materialize.min.css"/>
    <link rel="stylesheet" href="<?php echo URL ?>view/css/stylesheet.css"/>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="<?php echo URL ?>view/js/jquery.min.js"></script>
    <script src="<?php echo URL ?>view/js/materialize.min.js"></script>
    <script src="<?php echo URL ?>view/js/global.js"></script>
</head>
<body>
<div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper cyan darken-2">
            <a href="<?php echo URL ?>" class="brand-logo">Psiconline</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="<?php echo URL ?>">Página Inicial</a></li>
                <li><a href="<?php echo URL ?>consulta.php">Consulta</a></li>
                <li><a href="<?php echo URL ?>mensagem.php">Enviar mensagem</a></li>
                <li><a href="<?php echo URL ?>mensagens.php">Minhas mensagens</a></li>
                <li><a href="<?php echo URL ?>cadastro.php">Cadastro</a></li>
                <li><a href="<?php echo URL ?>">Sobre</a></li>
                <li><a href="<?php echo URL ?>">Contato</a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a href="<?php echo URL ?>">Página Inicial</a></li>
                <li><a href="<?php echo URL ?>consulta.php">Consulta</a></li>
                <li><a href="<?php echo URL ?>mensagem.php">Enviar mensagem</a></li>
                <li><a href="<?php echo URL ?>mensagens.php">Minhas mensagens</a></li>
                <li><a href="<?php echo URL ?>cadastro.php">Cadastro</a></li>
                <li><a href="<?php echo URL ?>">Sobre</a></li>
                <li><a href="<?php echo URL ?>">Contato</a></li>
            </ul>
        </div>
    </nav>
</div>