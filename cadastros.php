<?php

require("./config/conexao.php");

//Cadastro de setor
if (isset($_POST['nome'])) {

    $nome = $_POST['nome'];

    $query = "INSERT INTO setores (nome) VALUES ('$nome')";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    echo "Setor cadastrado." . "<p><a href='index.php'>Voltar à página inicial.</a></p>";
};

//Cadastro de prioridade
if (isset($_POST['prioridade'])) {

    $nivel_prioridade = $_POST['prioridade'];
    $tempo_previsto = $_POST['tempo'];

    $query = "INSERT INTO prioridades (nivel_prioridade, tempo_previsto) VALUES ('$nivel_prioridade', '$tempo_previsto')";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    echo "Nível de prioridade cadastrado." . "<p><a href='index.php'>Voltar à página inicial.</a></p>";
};

//Cadastro de chamado
if (isset($_POST['descricao'])) {

    $descricao = $_POST['descricao'];
    $setor = $_POST['setor'];
    $nivel_prioridade = $_POST['nivel_prioridade'];

    $query = "INSERT INTO chamados (descricao, id_setor,  id_prioridade) VALUES ('$descricao', '$setor', '$nivel_prioridade')";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    echo "Chamado aberto." . "<p><a href='index.php'>Voltar à página inicial.</a></p>";
};

//Atualização checkin
if (isset($_POST['acao']) && $_POST['acao'] == 'checkin') {
    $id = $_POST['id'];
    $sql = "UPDATE chamados SET situacao = 'Em andamento', data_inicio = NOW() WHERE id_chamado = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    header("Location: lista_chamados.php?sucesso=checkin");
    exit;
}

//Atualização checkout
if (isset($_POST['acao']) && $_POST['acao'] == 'checkout') {
    $id = $_POST['id'];
    $solucao = $_POST['solucao'];

    $sql = "UPDATE chamados SET situacao = 'Concluído', data_fim = NOW(), solucao = ? WHERE id_chamado = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$solucao, $id]);

    header("Location: lista_chamados.php?sucesso=checkout");
    exit;
}
