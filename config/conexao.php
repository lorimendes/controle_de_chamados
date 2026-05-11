    <?php

    $host = "localhost";
    $bancodedados = "chamados";
    $usuario = "root";
    $senha = "";

    try {
        $pdo = new PDO("mysql:host=$host; dbname=$bancodedados", $usuario, $senha);
        // echo "Conectado ao banco de dados: $bancodedados.";
    } catch (PDOException $e) {
        echo "Erro ao conectar: " . $e->getMessage();
    }
    ?>