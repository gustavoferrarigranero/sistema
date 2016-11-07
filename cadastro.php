<?php
require_once "model/config.php";
$config = new Config();

$user = new Usuario();
$usuario_logado = false;
if (isset($_COOKIE['id_usuario_logado']) && $_COOKIE['id_usuario_logado']) {
    $user->id = $_COOKIE['id_usuario_logado'];
    $usuario_logado = $user->get();
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
        header('Location: ' . URL.'cadastro.php?ok=1');
        die;
    }else{
        header('Location: ' . URL.'cadastro.php?erro=1');
        die;
    }
}

include "view/header.php";
?>
    <div class="container row">
        <div class="col s12 m10 l8 offset-m1 offset-l2">
            <h3>Cadastre-se</h3>
            <?php if (isset($_GET['ok']) && $_GET['ok']) { ?>
                <div class="box-success">
                    Dados cadastrados com sucesso, caso queira efetuar seu login clique <a href="<?php echo URL ?>">aqui</a>.
                </div>
            <?php } ?>
            <?php if (isset($_GET['erro']) && $_GET['erro']) { ?>
                <div class="box-error">
                    Não foi possível efetuar seu cadastro, tente novamente.
                </div>
            <?php } ?>
            <form action="<?php echo URL ?>cadastro.php" method="post">
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
                            Cadastrar<i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

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
<?php
include "view/footer.php";
?>