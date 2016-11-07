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
    $mensagem = new Mensagem();
    $mensagem->id_remetente = $usuario_logado['id_usuario'];
    $mensagem->id_destinatario = $_POST['id_destinatario'];
    $mensagem->mensagem = $_POST['mensagem'];
    $mensagem->dataenvio = date('Y-m-d H:i:s');

    if($mensagem->insert()){
        header('Location: ' . URL.'mensagem.php?ok=1');
        die;
    }else{
        header('Location: ' . URL.'mensagem.php?erro=1');
        die;
    }
}

include "view/header.php";
?>
    <div class="container row">
        <div class="col s12 m10 l8 offset-m1 offset-l2">
            <h3>Enviar mensagem</h3>
            <?php if (isset($_GET['ok']) && $_GET['ok']) { ?>
                <div class="box-success">
                    Mensagem enviada com sucesso, caso queira ver todas as mensagens clique <a href="<?php echo URL ?>mensagens.php">aqui</a>.
                </div>
            <?php } ?>
            <?php if (isset($_GET['erro']) && $_GET['erro']) { ?>
                <div class="box-error">
                    Não foi possível enviar seu mensagem, tente novamente.
                </div>
            <?php } ?>
            <form action="<?php echo URL ?>mensagem.php" method="post">
                <input name="cadastrar" type="hidden" value="1"/>
                <div class="row">
                    <div class="input-field col s12">
                        <select  name="id_destinatario" id="id_destinatario" class="validate" required="required">
                            <option value="">Selecione...</option>
                            <?php
                            $usuario = new Usuario();
                            $drs = $usuario->listaTipo($usuario_logado['tipo'] == 1 ? 2 : 1);
                            if($drs){
                                foreach($drs as $dr){ ?>
                                <option <?php echo isset($_GET['id_destinatario']) && $_GET['id_destinatario'] == $dr['id_usuario'] ? 'selected="selected"' : '' ?> value="<?php echo $dr['id_usuario'] ?>"><?php echo $dr['tipo'] == 2 ? 'Dr.' : '' ?> <?php echo $dr['nome'] ?></option>
                                <?php }
                            }
                            ?>
                        </select>
                        <label for="id_destinatario" data-error="Destinatário inválido, tente novamente">Enviar para</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="mensagem" id="mensagem" class="materialize-textarea" length="200"></textarea>
                        <label for="mensagem">Mensagem</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn waves-effect waves-light" type="submit" name="action">
                            Enviar<i class="material-icons right">send</i>
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