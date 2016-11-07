<?php

require_once("../model/config.php");
$config = new Config();

if(!isset($_COOKIE['login']) || !$_COOKIE['login']){
    header('Location: '.URL.'admin/login.php?erro=2');
    die;
}

$mensagens = new Mensagem();

$itens = $mensagens->lista();
require_once('header.php');

?>
<div class="container">
    <h4 class="truncate">Mensagens</h4>
    <?php if($itens){ ?>
        <?php foreach($itens as $item){ ?>
            <div class="row">
                <div class="card-panel hoverable" style="position:relative;">
                    <strong>De:</strong> <?php echo $item['de'] ?> - <strong>Para:</strong> <?php echo $item['para'] ?>
                    <br/><strong>MSG:</strong> <?php echo $item['mensagem'] ?>
                    <div class="fixed-action-btn horizontal" style="bottom: 0; right: 0;position:absolute;">
                        <a class="btn-floating btn-large red">
                            <i class="large material-icons">toc</i>
                        </a>
                        <ul>
                            <li><a class="btn-floating red" href="<?php echo URL ?>admin/mensagem.php?delete=<?php echo $item['id_mensagem'] ?>"><i class="material-icons">delete</i></a></li>
                            <li><a class="btn-floating blue" href="<?php echo URL ?>admin/mensagem.php?id_mensagem=<?php echo $item['id_mensagem'] ?>"><i class="material-icons">mode_edit</i></a></li>
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
