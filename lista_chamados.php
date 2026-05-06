<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de chamados</title>
    <link rel="shortcut icon" href="./images/favicon.png">
    <link rel="stylesheet" href="./index.css">
</head>

<body>
    <div class="page">
        <header class="header">
            <div class="header__container" onclick="window.location.href='index.php'">
                <img class="header__image" src="./images/favicon.png" alt="Desenho de engrenagem">
                <h1 class="header__title">Controle de chamados</h1>
            </div>
        </header>

        <main>
            <section class="buttons">
                <button class="buttons__item" onclick="window.location.href='form_chamado.php'">Abrir chamado</button>
                <button class="buttons__item buttons__item-selected"
                    onclick="window.location.href='lista_chamados.php'">Listar
                    chamados</button>
                <button class="buttons__item" onclick="window.location.href='form_setor.php'">Cadastrar setor</button>
                <button class="buttons__item" onclick="window.location.href='form_prioridade.php'">Cadastrar
                    prioridade</button>

            </section>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Setor</th>
                            <th>Prioridade</th>
                            <th>Status atual</th>
                            <th>Tempo total</th>
                            <th>Atualização</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        require_once("conexao.php");

                        $sql = "SELECT 
                                    s.nome as setor_nome,
                                    p.nivel_prioridade,
                                    p.tempo_previsto,
                                    c.id_chamado,
                                    c.situacao,
                                    CASE 
                                        WHEN c.situacao = 'Em andamento' THEN TIMESTAMPDIFF(HOUR, c.data_inicio, NOW())
                                        WHEN c.situacao = 'Concluído' THEN TIMESTAMPDIFF(HOUR, c.data_inicio, c.data_fim)
                                        ELSE 0 
                                    END as tempo_decorrido_horas
                                FROM chamados c
                                LEFT JOIN setores s ON c.id_setor = s.id
                                LEFT JOIN prioridades p ON c.id_prioridade = p.id
                                ORDER BY c.id_chamado DESC";

                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $chamados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (count($chamados) > 0) {
                            foreach ($chamados as $chamado) {
                                echo '<tr>';
                                echo '<td>' . $chamado['setor_nome'] . '</td>';
                                echo '<td>' . $chamado['nivel_prioridade'] . '</td>';
                                echo '<td class="situacao-' . strtolower($chamado['situacao'] ?? 'Aberto') . '">';
                                echo htmlspecialchars($chamado['situacao'] ?? 'Aberto') . '</td>';
                                $tempo = $chamado['tempo_decorrido_horas'];
                                echo '<td>' . (($chamado['situacao'] ?? 'Aberto') == 'Aberto' ? 'Não iniciado' : $tempo . 'h') . '</td>';
                                echo '<td>';
                                if (($chamado['situacao'] ?? 'Aberto') == 'Aberto') {
                                    echo '<form method="POST" action="cadastros.php" style="display:inline;">';
                                    echo '<input type="hidden" name="id" value="' . $chamado['id_chamado'] . '">';
                                    echo '<input type="hidden" name="acao" value="checkin">';
                                    echo '<button class="button__update" type="submit" class="btn-checkin">Check-in</button>';
                                    echo '</form>';
                                } elseif (($chamado['situacao'] ?? '') == 'Em andamento') {
                                    echo '<form method="POST" action="cadastros.php" style="display:inline;">';
                                    echo '<input type="hidden" name="id" value="' . $chamado['id_chamado'] . '">';
                                    echo '<input type="hidden" name="acao" value="checkout">';
                                    echo '<input type="text" name="solucao" placeholder="Digite a solução" maxlength="100" required style="width:150px;">';
                                    echo '<button class="button__update" type="submit" class="btn-checkout">Check-out</button>';
                                    echo '</form>';
                                }
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5" style="text-align: center; padding: 40px;">Nenhum chamado encontrado.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>

        <footer>
            <p class="footer__text">&copy; 2026 Lorena Mendes</p>
        </footer>
    </div>
</body>