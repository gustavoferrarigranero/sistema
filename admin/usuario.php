<?php

require_once("../model/config.php");
$config = new Config();

if(!isset($_COOKIE['login']) || !$_COOKIE['login']){
    header('Location: '.URL.'admin/login.php?erro=2');
    die;
}

if (isset($_GET['delete']) && $_GET['delete']) {
    $usuario = new Usuario();
    $usuario->id = $_GET['delete'];
    if($usuario->delete()){
        header('Location: ' . URL.'admin/usuarios.php');
        die;
    }
}

if (isset($_POST['cadastrar']) && $_POST['cadastrar']) {
    $usuario = new Usuario();
    $usuario->nome = $_POST['nome'];
    $usuario->email = $_POST['email'];
    $usuario->usuario = $_POST['usuario'];
    $usuario->senha = md5($_POST['senha']);
    $data = explode('/',$_POST['datanascimento']);
    $usuario->datanascimento = $data[2].'-'.$data[1].'-'.$data[0];
    $usuario->cpf = $_POST['cpf'];
    $usuario->rg = $_POST['rg'];
    $usuario->problemasaude = $_POST['problemasaude'];
    $usuario->datacadastro = date('Y-m-d H:i:s');
    $usuario->tipo = $_POST['tipo'];
    $usuario->status = 1;
    if($usuario->insert()){
        header('Location: ' . URL.'admin/usuarios.php');
        die;
    }else{
        header('Location: ' . URL.'admin/usuarios.php');
        die;
    }
}

if (isset($_POST['alterar']) && $_POST['alterar']) {
    $usuario = new Usuario();
    $usuario->id = $_POST['id_usuario'];
    $usuario->nome = $_POST['nome'];
    $usuario->email = $_POST['email'];
    $usuario->usuario = $_POST['usuario'];

    if(isset($_POST['senha']) && $_POST['senha'])
        $usuario->senha = md5($_POST['senha']);

    $data = explode('/',$_POST['datanascimento']);
    $usuario->datanascimento = $data[2].'-'.$data[1].'-'.$data[0];
    $usuario->cpf = $_POST['cpf'];
    $usuario->rg = $_POST['rg'];
    $usuario->problemasaude = $_POST['problemasaude'];
    $usuario->datacadastro = date('Y-m-d H:i:s');
    $usuario->tipo = $_POST['tipo'];
    $usuario->status = 1;
    if($usuario->update()){
        header('Location: ' . URL.'admin/usuario.php?ok=1&id_usuario='.$_POST['id_usuario']);
        die;
    }else{
        header('Location: ' . URL.'admin/usuario.php?erro=1&id_usuario='.$_POST['id_usuario']);
        die;
    }
}

require_once('header.php');

?>
<div class="container">
    <h4 class="truncate">Usuário</h4>
    <?php if(isset($_GET['id_usuario']) && $_GET['id_usuario']){ ?>
        <?php
        $usuario_logado = new Usuario();
        $usuario_logado->id = $_GET['id_usuario'];
        $usuario_logado = $usuario_logado->get();
        ?>
        <?php if (isset($_GET['ok']) && $_GET['ok']) { ?>
            <div class="box-success">
                Dados cadastrados com sucesso.
            </div>
        <?php } ?>
        <?php if (isset($_GET['erro']) && $_GET['erro']) { ?>
            <div class="box-error">
                Não foi possível alterar seu cadastro, tente novamente.
            </div>
        <?php } ?>
        <form action="<?php echo URL ?>/admin/usuario.php" method="post">
            <input name="alterar" type="hidden" value="1"/>
            <input name="id_usuario" type="hidden" value="<?php echo $usuario_logado['id_usuario'] ?>"/>
            <div class="row">
                <div class="input-field col s12">
                    <input value="<?php echo $usuario_logado['nome'] ?>" type="text" name="nome" id="nome" class="validate" required="required"/>
                    <label for="nome">Nome completo</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input value="<?php echo $usuario_logado['email'] ?>" type="email" name="email" id="email" class="validate" required="required"/>
                    <label for="email" data-error="E-mail inválido, tente novamente">E-mail</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input value="<?php echo $usuario_logado['usuario'] ?>" type="text" name="usuario" id="usuario" class="validate" required="required"/>
                    <label for="usuario">Usuário</label>
                </div>
                <div class="input-field col s12 m6">
                    <input value="" type="password" name="senha" id="senha" class="validate"/>
                    <label for="senha">Senha</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input value="<?php echo $usuario_logado['rg'] ?>" type="text" name="rg" id="rg" class="validate" required="required"/>
                    <label for="rg">RG</label>
                </div>
                <div class="input-field col s12 m6">
                    <input value="<?php echo $usuario_logado['cpf'] ?>" type="text" name="cpf" id="cpf" class="validate" required="required"/>
                    <label for="cpf">CPF</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input value="<?php echo date('d/m/Y',strtotime($usuario_logado['datanascimento'])) ?>" type="date" name="datanascimento" id="datanascimento" class="datepicker" required="required"/>
                    <label for="datanascimento">Data de nascimento</label>
                </div>
                <div class="input-field col s12 m6 select-wrapper">
                    <select name="tipo" id="tipo" class="validate" required="required">
                        <option value="" selected="selected">Selecione</option>
                        <option value="1"<?php echo $usuario_logado['tipo'] == 1 ? ' selected="selected"' : '' ?>>Paciente</option>
                        <option value="2"<?php echo $usuario_logado['tipo'] == 2 ? ' selected="selected"' : '' ?>>Doutor</option>
                    </select>
                    <label>Tipo de cadastro</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea name="problemasaude" id="problemasaude" class="materialize-textarea" length="150"><?php echo $usuario_logado['problemasaude'] ?></textarea>
                    <label for="problemasaude">Possui algum problema de saúde?</label>
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
        <form action="<?php echo URL ?>admin/usuario.php" method="post">
            <input name="cadastrar" type="hidden" value="1"/>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" name="nome" id="nome" class="validate" required="required"/>
                    <label for="nome">Nome completo</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="email" name="email" id="email" class="validate" required="required"/>
                    <label for="email" data-error="E-mail inválido, tente novamente">E-mail</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input type="text" name="usuario" id="usuario" class="validate" required="required"/>
                    <label for="usuario">Usuário</label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="password" name="senha" id="senha" class="validate" required="required"/>
                    <label for="senha">Senha</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input type="text" name="rg" id="rg" class="validate" required="required"/>
                    <label for="rg">RG</label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="text" name="cpf" id="cpf" class="validate" required="required"/>
                    <label for="cpf">CPF</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input type="date" name="datanascimento" id="datanascimento" class="datepicker" required="required"/>
                    <label for="datanascimento">Data de nascimento</label>
                </div>
                <div class="input-field col s12 m6 select-wrapper">
                    <select name="tipo" id="tipo" class="validate" required="required">
                        <option value="">Selecione</option>
                        <option value="1">Paciente</option>
                        <option value="2">Doutor</option>
                    </select>
                    <label>Tipo de cadastro</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea name="problemasaude" id="problemasaude" class="materialize-textarea" length="150"></textarea>
                    <label for="problemasaude">Possui algum problema de saúde?</label>
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
