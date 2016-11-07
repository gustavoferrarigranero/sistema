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

if (isset($_POST['cadastrar']) && $_POST['cadastrar']) {
    $consulta = new Consulta();
    $consulta->id_paciente = $_POST['id_paciente'];
    $consulta->id_doutor = $_POST['id_doutor'];
    $consulta->data = date('Y-m-d',strtotime($_POST['data']));
    $consulta->sintomas = $_POST['sintomas'];

    if($consulta->insert()){
        header('Location: ' . URL.'consulta.php?ok=1');
        die;
    }else{
        header('Location: ' . URL.'consulta.php?erro=1');
        die;
    }
}

include "view/header.php";
?>
    <div class="container row">
        <div class="col s12 m10 l8 offset-m1 offset-l2">
            <h3>Marcar consulta</h3>
            <?php if (isset($_GET['ok']) && $_GET['ok']) { ?>
                <div class="box-success">
                    Consulta marcada com sucesso, caso queira ver suas consultas clique <a href="<?php echo URL ?>consultas.php">aqui</a>.
                </div>
            <?php } ?>
            <?php if (isset($_GET['erro']) && $_GET['erro']) { ?>
                <div class="box-error">
                    Não foi possível marcar sua consulta, tente novamente.
                </div>
            <?php } ?>
            <form action="<?php echo URL ?>consulta.php" method="post">
                <input name="cadastrar" type="hidden" value="1"/>
                <div class="row">
                    <div class="input-field col s12">
                        <select  name="id_doutor" id="id_doutor" class="validate" required="required">
                            <option value="">Selecione...</option>
                            <?php
                            $usuario = new Usuario();
                            $drs = $usuario->listaTipo(2);
                            if($drs){
                                foreach($drs as $dr){ ?>
                                <option <?php echo $usuario_logado['id_usuario'] == $dr['id_usuario'] ? 'selected="selected"' : '' ?> value="<?php echo $dr['id_usuario'] ?>"><?php echo $dr['tipo'] == 2 ? 'Dr.' : '' ?> <?php echo $dr['nome'] ?></option>
                                <?php }
                            }
                            ?>
                        </select>
                        <label for="id_doutor" data-error="Doutor(a) inválido, tente novamente">Doutor(a)</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <select  name="id_paciente" id="id_paciente" class="validate" required="required">
                            <option value="">Selecione...</option>
                            <?php
                            $usuario = new Usuario();
                            $drs = $usuario->listaTipo(1);
                            if($drs){
                                foreach($drs as $dr){ ?>
                                <option <?php echo $usuario_logado['id_usuario'] == $dr['id_usuario'] ? 'selected="selected"' : '' ?> value="<?php echo $dr['id_usuario'] ?>"><?php echo $dr['tipo'] == 2 ? 'Dr.' : '' ?> <?php echo $dr['nome'] ?></option>
                                <?php }
                            }
                            ?>
                        </select>
                        <label for="id_paciente" data-error="Paciente inválido, tente novamente">Paciente</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="date" name="data" id="data" class="datepicker" required="required"/>
                        <label for="data">Data</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="sintomas" id="sintomas" class="materialize-textarea" length="300"></textarea>
                        <label for="sintomas">Sintomas</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn waves-effect waves-light" type="submit" name="action">
                            Marcas consulta<i class="material-icons right">send</i>
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