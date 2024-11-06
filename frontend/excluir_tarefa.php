<?php
include '../backend/conexão.php';

if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];
    // ...código para excluir a tarefa...
    $conn->query("DELETE FROM tarefas WHERE tar_codigo=$codigo");
    header('Location: gerenciador.php');
}
?>
