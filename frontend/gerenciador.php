<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Tarefas</title>
</head>
<body>
    <h1>Gerenciamento de Tarefas</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Setor</th>
            <th>Prioridade</th>
            <th>Descrição</th>
            <th>Status</th>
            <th>Usuário</th>
            <th>Ações</th>
        </tr>

        <?php
        require '../backend/conexão.php';

        $sql = "SELECT t.tar_codigo, t.tar_setor, t.tar_prioridade, t.tar_descricao, t.tar_status, u.usu_nome 
                FROM tarefas t 
                JOIN usuarios u ON t.tar_usu = u.usu_codigo";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['tar_codigo'] . "</td>";
                echo "<td>" . $row['tar_setor'] . "</td>";
                echo "<td>" . $row['tar_prioridade'] . "</td>";
                echo "<td>" . $row['tar_descricao'] . "</td>";
                echo "<td>" . $row['tar_status'] . "</td>";
                echo "<td>" . $row['usu_nome'] . "</td>";
                echo "<td><a href='editar_tarefa.php?id=" . $row['tar_codigo'] . "'>Editar</a> | <a href='excluir_tarefa.php?id=" . $row['tar_codigo'] . "'>Excluir</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Nenhuma tarefa encontrada</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </table>
</body>
</html>
