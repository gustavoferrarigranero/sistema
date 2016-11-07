<?php

require_once("../model/config.php");
$config = new Config();

if(!isset($_COOKIE['login']) || !$_COOKIE['login']){
    header('Location: '.URL.'admin/login.php?erro=2');
    die;
}

$usuarios = new Usuario();

$itens = $usuarios->lista();
require_once('header.php');

?>
<div class="container">
    <h4 class="truncate">Usuários</h4>
    <?php if($itens){ ?>
        <?php foreach($itens as $item){ ?>
            <div class="row">
                <div class="card-panel hoverable" style="position:relative;">
                    <strong>Nome:</strong> <?php echo $item['nome'] ?> - <strong>E-mail:</strong> <?php echo $item['email'] ?> - <strong>CPF:</strong> <?php echo $item['cpf'] ?>
                    <div class="fixed-action-btn horizontal" style="bottom: 0; right: 0;position:absolute;">
                        <a class="btn-floating btn-large red">
                            <i class="large material-icons">toc</i>
                        </a>
                        <ul>
                            <li><a class="btn-floating red" href="<?php echo URL ?>admin/usuario.php?delete=<?php echo $item['id_usuario'] ?>"><i class="material-icons">delete</i></a></li>
                            <li><a class="btn-floating blue" href="<?php echo URL ?>admin/usuario.php?id_usuario=<?php echo $item['id_usuario'] ?>"><i class="material-icons">mode_edit</i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php }else{ ?>
        <div class="row">
            <div class="card-panel hoverable">Nenhum item cadastrado até o momento.</div>
        </div>
    <?php } ?>
</div>
