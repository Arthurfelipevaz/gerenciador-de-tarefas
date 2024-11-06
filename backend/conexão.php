    <?php

    $servername = "localhost";
    $database = "gerenciador";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($servername,$username,$password,$database);

    if(!$conn){
        die("conexão foi de arrasta: " .mysqli_connect_error());
    }