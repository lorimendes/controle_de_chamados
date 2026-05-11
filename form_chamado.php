<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Chamados</title>
    <link rel="shortcut icon" href="./images/favicon.png">
    <link rel="stylesheet" href="./index.css">
</head>

<body>
    <div class="page">
        <header class="header">
            <div class="header__container" onclick="window.location.href='index.php'">
                <img class="header__image" src="./images/favicon.png" alt="Desenho de engrenagem">
                <h1 class="header__title">Controle de Chamados</h1>
            </div>
        </header>
        <main>
            <section class="buttons">
                <button class="buttons__item buttons__item-selected"
                    onclick="window.location.href='form_chamado.php'">Abrir chamado</button>
                <button class="buttons__item" onclick="window.location.href='lista_chamados.php'">Listar
                    chamados</button>
                <button class="buttons__item" onclick="window.location.href='form_setor.php'">Cadastrar setor</button>
                <button class="buttons__item" onclick="window.location.href='form_prioridade.php'">Cadastrar
                    prioridade</button>

            </section>
            <section class="forms">

                <h2 class="forms__title">Abertura de chamado</h2>

                <form action="cadastros.php" method="POST">
                    <label class="forms__label" for="Setor">Setor:</label>
                    <select name="setor" id="idsetor">
                        <option value="">Selecione o setor</option>
                        <?php
                        require_once("./config/conexao.php");
                        $sql = "SELECT id, nome FROM setores ORDER BY nome";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $setores = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($setores as $setor) {
                            echo '<option value="' . $setor['id'] . '">' . htmlspecialchars($setor['nome']) . '</option>';
                        }
                        ?>
                    </select>
                    <label class="forms__label" for="nivel_prioridade">Nível de prioridade:</label>
                    <select name="nivel_prioridade" id="idnivel">
                        <option value="">Selecione o nível</option>
                        <?php
                        require_once("./config/conexao.php");
                        $sql = "SELECT id, nivel_prioridade FROM prioridades ORDER BY nivel_prioridade";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $prioridades = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($prioridades as $prioridade) {
                            echo '<option value="' . $prioridade['id'] . '">' . htmlspecialchars($prioridade['nivel_prioridade']) . '</option>';
                        }
                        ?>
                    </select>
                    <label class="forms__label" for="descricao">Descrição:</label>
                    <textarea name="descricao" id="iddescricao"></textarea>
                    <input type="submit" value="Abrir chamado">
                </form>
            </section>
        </main>
        <footer>
            <p class="footer__text">&copy; 2026 Lorena Mendes</p>
        </footer>
    </div>

</body>

</html>