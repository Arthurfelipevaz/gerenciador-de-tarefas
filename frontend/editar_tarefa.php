<?php
// editar_tarefa.php

include '../backend/conexão.php';

// Inicializa a variável $tarefa
$tarefa = null;

// Verifica se o parâmetro 'id' está presente na URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepara a consulta para selecionar a tarefa específica
    $stmt = $conn->prepare("SELECT * FROM tarefas WHERE tar_codigo = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $tarefa = $result->fetch_assoc();
        $stmt->close();
    } else {
        // Opcional: Trate o erro de preparação da consulta
        echo "Erro na preparação da consulta: " . $conn->error;
    }
}

// Verifica se o formulário foi submetido para atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atualizar'])) {
    // Sanitiza e atribui os valores recebidos do formulário
    $codigo = intval($_POST['id']);
    $setor = mysqli_real_escape_string($conn, $_POST['setor']);
    $prioridade = mysqli_real_escape_string($conn, $_POST['prioridade']);
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Prepara a consulta para atualizar a tarefa
    $stmt = $conn->prepare("UPDATE tarefas SET tar_setor = ?, tar_prioridade = ?, tar_descricao = ?, tar_status = ? WHERE tar_codigo = ?");
    if ($stmt) {
        $stmt->bind_param("ssssi", $setor, $prioridade, $descricao, $status, $codigo);
        $stmt->execute();
        $stmt->close();

        // Redireciona de volta para o gerenciador de tarefas após a atualização
        header('Location: gerenciador.php');
        exit();
    } else {
        // Opcional: Trate o erro de preparação da consulta
        echo "Erro na preparação da consulta: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
</head>
<body>
    <h2>Editar Tarefa</h2>

    <?php if ($tarefa): ?>
        <form method="post" action="">
            <!-- Campo oculto para armazenar o ID da tarefa -->
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($tarefa['tar_codigo']); ?>">

            <label for="setor">Setor:</label>
            <input type="text" id="setor" name="setor" value="<?php echo htmlspecialchars($tarefa['tar_setor']); ?>" required><br><br>

            <label for="prioridade">Prioridade:</label>
            <input type="text" id="prioridade" name="prioridade" value="<?php echo htmlspecialchars($tarefa['tar_prioridade']); ?>" required><br><br>

            <label for="descricao">Descrição:</label><br>
            <textarea id="descricao" name="descricao" rows="4" cols="50" required><?php echo htmlspecialchars($tarefa['tar_descricao']); ?></textarea><br><br>

            <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Pendente">Pendente</option>
            <option value="Em Andamento">Em Andamento</option>
            <option value="Concluída">Concluída</option>
        </select><br><br>

            <input type="submit" name="atualizar" value="Atualizar">
        </form>
    <?php else: ?>
        <p>Tarefa não encontrada.</p>
    <?php endif; ?>
</body>
</html>
