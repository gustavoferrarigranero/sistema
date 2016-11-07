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
    header('Location: ' . URL . 'index.php?erro=2');
    die;
}

include "view/header.php";
?>
    <div class="container row">
        <div class="col s12 m10 l8 offset-m1 offset-l2" style="min-height: 400px">
            <h3>Minhas consultas</h3>
            <?php
            $consulta = new Consulta();
            $consultas = $consulta->lista($_COOKIE['id_usuario_logado']);
            if ($consultas) {
                ?>

                <ul class="collection with-header">
                    <?php foreach ($consultas as $cons) { ?>
                        <li class="collection-item avatar">
                            <?php
                            if ($cons['id_doutor'] == $_COOKIE['id_usuario_logado']) {
                                $doutor = 'Você mesmo';
                            } else {
                                $doutor = new Usuario();
                                $doutor->id = $cons['id_doutor'];
                                $doutor = $doutor->get();
                                if ($doutor) {
                                    $doutor = $doutor['nome'];
                                } else {
                                    $doutor = 'Desconhecido';
                                }
                            }
                            ?>
                            <?php
                            if ($cons['id_paciente'] == $_COOKIE['id_usuario_logado']) {
                                $paciente = 'Você mesmo';
                            } else {
                                $paciente = new Usuario();
                                $paciente->id = $cons['id_paciente'];
                                $paciente = $paciente->get();
                                if ($paciente) {
                                    $paciente = $paciente['nome'];
                                } else {
                                    $paciente = 'Desconhecido';
                                }
                            }
                            ?>
                            <img src="<?php echo URL ?>view/img/consulta.png" alt="doutor: <?php echo $doutor ?>" class="circle">
                            <span class="title"><strong>Doutor(a):</strong> <?php echo $doutor ?></span> <br/>
                            <span class="title"><strong>Paciente:</strong> <?php echo $paciente ?></span>
                            <p><strong>Sintomas: </strong><?php echo $cons['sintomas'] ?></p>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>

    </div>
<?php
include "view/footer.php";
?>