<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuários</title>
</head>
<body>
    <h1>Cadastro de Usuário</h1>
    <form action="cadastroUSU.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <input type="submit" value="Cadastrar">
    </form>

    <?php
    require '../backend/conexão.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        $sql = "INSERT INTO usuarios (usu_nome, usu_email) VALUES ('$nome', '$email')";

        if (mysqli_query($conn, $sql)) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
    ?>
</body>
</html>
