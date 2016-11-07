<?php
require_once("../model/config.php");
$config = new Config();

if(isset($_POST['logar']) && $_POST['logar']){
    if($_POST['usuario'] == USUARIO && $_POST['senha'] == SENHA){
        setcookie('login', 1, time() + (60 * 60 * 24 * 30), '/');
        header('Location: '.URL.'admin/home.php');
        die;
    }
}
require_once('header.php');

?>
<div class="container">
    <h4 class="truncate">Login</h4>
    <div class="row">
        <form action="<?php echo URL ?>admin/login.php" method="post" class="form-login">
            <input type="hidden" name="logar" value="1"/>
            <div>Faça seu login:</div>
            <?php if (isset($_POST['logar']) && $_POST['logar']) { ?>
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
