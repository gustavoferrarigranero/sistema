<?php
require_once "model/config.php";
$config = new Config();

$user = new Usuario();
$usuario_logado = false;
if (isset($_COOKIE['id_usuario_logado']) && $_COOKIE['id_usuario_logado']) {
    $user->id = $_COOKIE['id_usuario_logado'];
    $usuario_logado = $user->get();
}

if (!$usuario_logado) {
    header('Location: ' . URL.'index.php?erro=2');
    die;
}

include "view/header.php";
?>
    <div class="container row">
        <div class="col s12 m10 l8 offset-m1 offset-l2">
            <h3>Minhas mensagens</h3>
            <?php
            $mensagem = new Mensagem();
            $destinatarios = $mensagem->getDestinatarios(35,'dataenvio DESC',$_COOKIE['id_usuario_logado']);
            if($destinatarios){
                foreach($destinatarios as $destinatario){
                    $mensagens = $mensagem->getDestinatariosMensagens(10,'dataenvio DESC',$destinatario['id_remetente'],$_COOKIE['id_usuario_logado']);
                    if($mensagens){
                        $dest = new Usuario();
                        $dest->id = $destinatario['id_remetente'];
                        $dest = $dest->get();
                        ?>

                        <ul class="collection with-header">
                            <li class="collection-header"><h5><?php echo $dest['nome'] ?></h5></li>
                            <?php foreach($mensagens as $msg){?>
                                <li class="collection-item avatar">
                                    <?php
                                    if($msg['id_remetente'] == $_COOKIE['id_usuario_logado']){
                                        $enviadopor = 'Você mesmo';
                                    }else {
                                        $usuario_mensagem = new Usuario();
                                        $usuario_mensagem->id = $msg['id_remetente'];
                                        $usuario_mensagem = $usuario_mensagem->get();
                                        if ($usuario_mensagem) {
                                            $enviadopor = $usuario_mensagem['nome'];
                                        } else {
                                            $enviadopor = 'Desconhecido';
                                        }
                                    }
                                    ?>
                                    <img src="<?php echo URL ?>view/img/msg.png" alt="mensagem de <?php echo $enviadopor ?>" class="circle">
                                    <span class="title"><strong>Enviado por:</strong> <?php echo $enviadopor ?></span>
                                    <p><?php echo strlen($msg['mensagem']) > 120 ? substr($msg['mensagem'],0,120).'...' : $msg['mensagem'] ?></p>
                                    <?php if($msg['id_remetente'] != $_COOKIE['id_usuario_logado']){ ?>
                                        <a href="<?php echo URL ?>mensagem.php?id_destinatario=<?php echo $msg['id_remetente'] ?>">responder esta mensagem</a>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>

                <?php } ?>
            <?php } ?>

        </div>

    </div>
<?php
include "view/footer.php";
?>