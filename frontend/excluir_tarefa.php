<?php
// excluir_tarefa.php

include '../backend/conexão.php';

if (isset($_GET['id'])) {
    // Sanitiza o parâmetro recebido para garantir que seja um número inteiro
    $id = intval($_GET['id']);

    // Prepara a consulta SQL para prevenir injeção de SQL
    $stmt = $conn->prepare("DELETE FROM tarefas WHERE tar_codigo = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    } else {
        // Opcional: Trate o erro de preparação da consulta
        echo "Erro na preparação da consulta: " . $conn->error;
    }

    // Redireciona de volta para o gerenciador de tarefas
    header('Location: gerenciador.php');
    exit();
} else {
    // Opcional: Trate o caso onde 'id' não está definido
    echo "ID da tarefa não fornecido.";
    exit();
}
?>
