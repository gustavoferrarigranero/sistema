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
            <a href="<?php echo URL ?>" class="brand-logo">Psicoline</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="<?php echo URL ?>admin/home.php">Página Inicial</a></li>
                <li><a href="<?php echo URL ?>admin/usuarios.php">Usuários</a></li>
                <li><a href="<?php echo URL ?>admin/usuario.php">Novo Usuário</a></li>
                <li><a href="<?php echo URL ?>admin/mensagens.php">Mensagens</a></li>
                <li><a href="<?php echo URL ?>admin/mensagem.php">Nova Mensagem</a></li>
                <?php if(isset($_COOKIE['login']) && $_COOKIE['login']){ ?>
                    <li><a href="<?php echo URL ?>admin/logout.php">Sair</a></li>
                <?php } ?>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a href="<?php echo URL ?>admin/home.php">Página Inicial</a></li>
                <li><a href="<?php echo URL ?>admin/usuarios.php">Usuários</a></li>
                <li><a href="<?php echo URL ?>admin/usuario.php">Novo Usuário</a></li>
                <li><a href="<?php echo URL ?>admin/mensagens.php">Mensagens</a></li>
                <li><a href="<?php echo URL ?>admin/mensagem.php">Nova Mensagem</a></li>
                <?php if(isset($_COOKIE['login']) && $_COOKIE['login']){ ?>
                    <li><a href="<?php echo URL ?>admin/logout.php">Sair</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</div>