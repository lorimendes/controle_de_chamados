<?php

require("./config/conexao.php");

//Cadastro de setor
if (isset($_POST['nome'])) {

    $nome = $_POST['nome'];

    $query = "INSERT INTO setores (nome) VALUES (?)";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$nome]);

    header("Location: index.php?sucesso=setor");
    exit;
};

//Cadastro de prioridade
if (isset($_POST['prioridade'])) {

    $nivel_prioridade = $_POST['prioridade'];
    $tempo_previsto = $_POST['tempo'];

    $query = "INSERT INTO prioridades (nivel_prioridade, tempo_previsto) VALUES (?, ?)";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$nivel_prioridade, $tempo_previsto]);

    header("Location: index.php?sucesso=prioridade");
    exit;
};

//Cadastro de chamado
if (isset($_POST['descricao'])) {

    $descricao = $_POST['descricao'];
    $setor = $_POST['setor'];
    $nivel_prioridade = $_POST['nivel_prioridade'];

    $query = "INSERT INTO chamados (descricao, id_setor, id_prioridade) VALUES (?, ?, ?)";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$descricao, $setor, $nivel_prioridade]);

    header("Location: lista_chamados.php?sucesso=chamado");
    exit;
};

//Atualização checkin
if (isset($_POST['acao']) && $_POST['acao'] == 'checkin') {

    $id = $_POST['id'];

    $query = "UPDATE chamados SET situacao = 'Em andamento', data_inicio = NOW() WHERE id_chamado = ?";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    header("Location: lista_chamados.php?sucesso=checkin");
    exit;
}

//Atualização checkout
if (isset($_POST['acao']) && $_POST['acao'] == 'checkout') {
    $id = $_POST['id'];
    $solucao = $_POST['solucao'];

    $query = "UPDATE chamados SET situacao = 'Concluído', data_fim = NOW(), solucao = ? WHERE id_chamado = ?";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$solucao, $id]);

    header("Location: lista_chamados.php?sucesso=checkout");
    exit;
}
