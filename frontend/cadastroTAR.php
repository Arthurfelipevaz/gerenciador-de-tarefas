<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Tarefas</title>
</head>
<body>
    <h1>Cadastro de Tarefas</h1>
    <form action="cadastroTAR.php" method="post">
        <label for="setor">Setor:</label>
        <input type="text" id="setor" name="setor" required><br><br>

        <label for="prioridade">Prioridade:</label>
        <select id="prioridade" name="prioridade" required>
            <option value="Baixa">Baixa</option>
            <option value="Média">Média</option>
            <option value="Alta">Alta</option>
        </select><br><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea><br><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Pendente">Pendente</option>
            <option value="Em Andamento">Em Andamento</option>
            <option value="Concluída">Concluída</option>
        </select><br><br>

        <label for="usuario">Usuário Responsável:</label><br>
        <select id="usuario" name="usuario" required>
            <?php
            
            require '../backend/conexão.php';

            
            $usuarios = mysqli_query($conn, "SELECT usu_codigo, usu_nome FROM usuarios");

            
            while($row = $usuarios->fetch_assoc()) {
                echo '<option value="' . $row['usu_codigo'] . '">' . $row['usu_nome'] . '</option>';
            }
            ?>
        </select><br><br>

        <input type="submit" value="Cadastrar Tarefa">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $setor = $_POST['setor'];
        $prioridade = $_POST['prioridade'];
        $descricao = $_POST['descricao'];
        $status = $_POST['status'];
        $usuario = $_POST['usuario'];

        $sql = "INSERT INTO tarefas (tar_setor, tar_prioridade, tar_descricao, tar_status, tar_usu) 
                VALUES ('$setor', '$prioridade', '$descricao', '$status', '$usuario')";

        if (mysqli_query($conn, $sql)) {
            echo "Tarefa cadastrada com sucesso!";
        } else {
            echo "Erro: " . mysqli_error($conn);
        }
    }

    
    mysqli_close($conn);
    ?>
</body>
</html>
