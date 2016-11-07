<?php
require_once "model/config.php";
$config = new Config();

$mensagem = new Mensagem();

$user = new Usuario();
$usuario_logado = false;
if (isset($_COOKIE['id_usuario_logado']) && $_COOKIE['id_usuario_logado']) {
    $user->id = $_COOKIE['id_usuario_logado'];
    $usuario_logado = $user->get();
} else if (isset($_POST['logar']) && $_POST['logar']) {
    $user->usuario = $_POST['usuario'];
    $user->senha = md5($_POST['senha']);
    $usuario_logado = $user->login();

    if ($usuario_logado) {
        setcookie('id_usuario_logado', $usuario_logado['id_usuario'], time() + (60 * 60 * 24 * 30), '/');
        header('Location: ' . URL);
        die;
    }
}

if (isset($_GET['logout']) && $_GET['logout']) {
    setcookie('id_usuario_logado',null,-1,'/');
    $_COOKIE['id_usuario_logado'];
    header('Location: '.URL);
    die;
}

include "view/header.php";
?>
    <div class="container row">
        <div class="col s12 m6 l4 right-align right">
            <br/><br/>
            <?php if (isset($_COOKIE['id_usuario_logado']) && $_COOKIE['id_usuario_logado']) { ?>
                <div class="switch">
                    <label>
                        <a href="<?php echo URL ?>?logout=true">Off</a>
                        <a href="<?php echo URL ?>?logout=true">
                            <input type="checkbox" checked>
                            <span class="lever"></span>
                        </a>
                        On
                    </label>
                </div>
                <br/>
                Bem vindo(a) <?php echo $usuario_logado['nome'] ?>, <a href="<?php echo URL ?>?logout=true">sair</a>
            <?php } else { ?>
                <div class="col s10 left-align right">
                    <div class="row">
                        <form action="<?php echo URL ?>" method="post" class="form-login">
                            <input type="hidden" name="logar" value="1"/>
                            <div>Faça seu login:</div>
                            <?php if (isset($_POST['logar']) && $_POST['logar'] && !$usuario_logado) { ?>
                                <div class="box-error">
                                    Dados incorretos, tente novamente.
                                </div>
                            <?php } ?>
                            <?php if (isset($_GET['erro']) && $_GET['erro'] && $_GET['erro'] == 2) { ?>
                                <div class="box-error">
                                    Você não esta logado, efetue seu login para continuar.
                                </div>
                            <?php } ?>
                            <div class="row">
                                <div class="input-field col s12 m5">
                                    <input id="usuario" name="usuario" type="text">
                                    <label for="usuario">Usuário</label>
                                </div>
                                <div class="input-field col s12 m5">
                                    <input id="senha" name="senha" type="password">
                                    <label for="senha">Senha</label>
                                </div>
                                <div class="input-field col s12 m2">
                                    <button class="btn waves-effect waves-light" type="submit" name="action">
                                        login<i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="col s12 m6 l8 left">
            <br/><br/>
            <ul class="collection with-header">
                <?php if (isset($_COOKIE['id_usuario_logado']) && $_COOKIE['id_usuario_logado']) { ?>
                    <li class="collection-header"><h5>Minhas últimas mensagens</h5></li>
                    <?php
                    $mensagens = $mensagem->getAll(10,'id_mensagem DESC',$_COOKIE['id_usuario_logado']);
                    if($mensagens){
                        foreach($mensagens as $item){
                        ?>
                            <li class="collection-item avatar">
                                <?php
                                if($item['id_remetente'] == $_COOKIE['id_usuario_logado']){
                                    $enviadopor = 'Você mesmo';
                                }else {
                                    $usuario_mensagem = new Usuario();
                                    $usuario_mensagem->id = $item['id_remetente'];
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
                                <p><?php echo substr($item['mensagem'],0,120).'...' ?></p>
                            </li>
                        <?php } ?>
                        <li class="collection-item"><a href="<?php echo URL ?>mensagens.php">ver todas</a></li>
                    <?php }else{ ?>
                        <li class="collection-item">Nenhuma mensagem no momento.</li>
                    <?php } ?>

                <?php }else{ ?>
                    <li class="collection-header"><h5>Minhas últimas mensagens</h5></li>
                    <li class="collection-item">Nenhuma mensagem no momento.</li>
                <?php } ?>
            </ul>
            <div class="hide-on-small-only">
                <br/><br/><br/>
                <br/><br/><br/>
            </div>
        </div>
    </div>
<?php
include "view/footer.php";
?>