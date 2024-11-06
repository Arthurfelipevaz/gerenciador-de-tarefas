<?php
include '../backend/conexão.php';

if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];
    $tarefa = $conn->query("SELECT * FROM tarefas WHERE tar_codigo=$codigo")->fetch_assoc();
}

if (isset($_POST['atualizar'])) {
    $codigo = $_POST['codigo'];
    $setor = $_POST['setor'];
    $prioridade = $_POST['prioridade'];
    $descricao = $_POST['descricao'];
    $status = $_POST['status'];
    $conn->query("UPDATE tarefas SET tar_setor='$setor', tar_prioridade='$prioridade', tar_descricao='$descricao', tar_status='$status' WHERE tar_codigo=$codigo");
    header('Location: gerenciador.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Tarefa</title>
</head>
<body>
    <h2>Editar Tarefa</h2>
    <form method="post" action="">
        <input type="hidden" name="codigo" value="<?php echo $tarefa['TAR_CODIGO']; ?>">
        Setor: <input type="text" name="setor" value="<?php echo $tarefa['TAR_SETOR']; ?>"><br>
        Prioridade: <input type="text" name="prioridade" value="<?php echo $tarefa['TAR_PRIORIDADE']; ?>"><br>
        Descrição: <textarea name="descricao"><?php echo $tarefa['TAR_DESCRICAO']; ?></textarea><br>
        Status: <input type="text" name="status" value="<?php echo $tarefa['TAR_STATUS']; ?>"><br>
        <input type="submit" name="atualizar" value="Atualizar">
    </form>
</body>
</html>
