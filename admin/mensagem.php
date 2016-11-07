<?php

require_once("../model/config.php");
$config = new Config();

if(!isset($_COOKIE['login']) || !$_COOKIE['login']){
    header('Location: '.URL.'admin/login.php?erro=2');
    die;
}

if (isset($_GET['delete']) && $_GET['delete']) {
    $mensagem = new Mensagem();
    $mensagem->id = $_GET['delete'];
    if($mensagem->delete()){
        header('Location: ' . URL.'admin/mensagens.php');
        die;
    }
}

if (isset($_POST['cadastrar']) && $_POST['cadastrar']) {
    $mensagem = new Mensagem();
    $mensagem->id_remetente = $_POST['id_remetente'];
    $mensagem->id_destinatario = $_POST['id_destinatario'];
    $mensagem->mensagem = $_POST['mensagem'];
    $mensagem->dataenvio = date('Y-m-d');

    if($mensagem->insert()){
        header('Location: ' . URL.'admin/mensagens.php');
        die;
    }else{
        header('Location: ' . URL.'admin/mensagens.php');
        die;
    }
}

if (isset($_POST['alterar']) && $_POST['alterar']) {
    $mensagem = new Mensagem();
    $mensagem->id = $_POST['id_mensagem'];
    $mensagem_atual = $mensagem->get();
    $mensagem->id_remetente = $_POST['id_remetente'];
    $mensagem->id_destinatario = $_POST['id_destinatario'];
    $mensagem->mensagem = $_POST['mensagem'];
    $mensagem->dataenvio = $mensagem_atual['dataenvio'];
    if($mensagem->update()){
        header('Location: ' . URL.'admin/mensagem.php?ok=1&id_mensagem='.$_POST['id_mensagem']);
        die;
    }else{
        header('Location: ' . URL.'admin/mensagem.php?erro=1&id_usuario='.$_POST['id_usuario']);
        die;
    }
}

require_once('header.php');
$usuarios = new Usuario();
?>
<div class="container">
    <h4 class="truncate">Mensagem</h4>
    <?php if(isset($_GET['id_mensagem']) && $_GET['id_mensagem']){ ?>
        <?php

        $mensagem = new Mensagem();
        $mensagem->id = $_GET['id_mensagem'];
        $mensagem = $mensagem->get();
        ?>
        <?php if (isset($_GET['ok']) && $_GET['ok']) { ?>
            <div class="box-success">
                Dados cadastrados com sucesso.
            </div>
        <?php } ?>
        <?php if (isset($_GET['erro']) && $_GET['erro']) { ?>
            <div class="box-error">
                Não foi possível efetuar seu cadastro, tente novamente.
            </div>
        <?php } ?>
        <form action="<?php echo URL ?>/admin/mensagem.php" method="post">
            <input name="alterar" type="hidden" value="1"/>
            <input name="id_mensagem" type="hidden" value="<?php echo $mensagem['id_mensagem'] ?>"/>
            <div class="row">
                <div class="input-field col s12 m6 select-wrapper">
                    <select name="id_remetente" id="id_remetente" class="validate" required="required">
                        <option value="" selected="selected">Selecione</option>
                        <?php
                        $users = $usuarios->lista();
                        if($users){
                            foreach($users as $user){
                            ?>
                                <option value="<?php echo $user['id_usuario'] ?>"<?php echo $user['id_usuario'] == $mensagem['id_remetente'] ? ' selected="selected"' : '' ?>><?php echo $user['nome'] ?></option>
                            <?php
                            }
                        }
                        ?>
                    </select>
                    <label>Remetente</label>
                </div>
                <div class="input-field col s12 m6 select-wrapper">
                    <select name="id_destinatario" id="id_destinatario" class="validate" required="required">
                        <option value="" selected="selected">Selecione</option>
                        <?php
                        $users = $usuarios->lista();
                        if($users){
                            foreach($users as $user){
                                ?>
                                <option value="<?php echo $user['id_usuario'] ?>"<?php echo $user['id_usuario'] == $mensagem['id_destinatario'] ? ' selected="selected"' : '' ?>><?php echo $user['nome'] ?></option>
                            <?php
                            }
                        }
                        ?>
                    </select>
                    <label>Destinatário</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea name="mensagem" id="mensagem" class="materialize-textarea" length="250"><?php echo $mensagem['mensagem'] ?></textarea>
                    <label for="mensagem">Mensagem</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <button class="btn waves-effect waves-light" type="submit" name="action">
                        Salvar<i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    <?php }else{ ?>
        <?php if (isset($_GET['ok']) && $_GET['ok']) { ?>
            <div class="box-success">
                Dados cadastrados com sucesso.
            </div>
        <?php } ?>
        <?php if (isset($_GET['erro']) && $_GET['erro']) { ?>
            <div class="box-error">
                Não foi possível efetuar seu cadastro, tente novamente.
            </div>
        <?php } ?>
        <form action="<?php echo URL ?>/admin/mensagem.php" method="post">
            <input name="cadastrar" type="hidden" value="1"/>
            <div class="row">
                <div class="input-field col s12 m6 select-wrapper">
                    <select name="id_remetente" id="id_remetente" class="validate" required="required">
                        <option value="" selected="selected">Selecione</option>
                        <?php
                        $users = $usuarios->lista();
                        if($users){
                            foreach($users as $user){
                                ?>
                                <option value="<?php echo $user['id_usuario'] ?>"><?php echo $user['nome'] ?></option>
                            <?php
                            }
                        }
                        ?>
                    </select>
                    <label>Remetente</label>
                </div>
                <div class="input-field col s12 m6 select-wrapper">
                    <select name="id_destinatario" id="id_destinatario" class="validate" required="required">
                        <option value="" selected="selected">Selecione</option>
                        <?php
                        $users = $usuarios->lista();
                        if($users){
                            foreach($users as $user){
                                ?>
                                <option value="<?php echo $user['id_usuario'] ?>"><?php echo $user['nome'] ?></option>
                            <?php
                            }
                        }
                        ?>
                    </select>
                    <label>Destinatário</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea name="mensagem" id="mensagem" class="materialize-textarea" length="250"></textarea>
                    <label for="mensagem">Mensagem</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <button class="btn waves-effect waves-light" type="submit" name="action">
                        Salvar<i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    <?php } ?>
</div>
<script>
    $(document).ready(function() {
        $('select').material_select();
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 90, // Creates a dropdown of 15 years to control year
            labelMonthNext: 'Próximo',
            labelMonthPrev: 'Anterior',
            labelMonthSelect: 'Selecione um mês',
            labelYearSelect: 'Selecione o ano',
            monthsFull: [ 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro' ],
            monthsShort: [ 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez' ],
            weekdaysFull: [ 'Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado' ],
            weekdaysShort: [ 'Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab' ],
            weekdaysLetter: [ 'D', 'S', 'T', 'Q', 'Q', 'S', 'S' ],
            today: 'Hoje',
            clear: 'Zerar',
            close: 'Fechar',
            format: 'dd/mm/yyyy'
        });
    });
</script>
