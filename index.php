<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Chamados</title>
    <meta name="description"
        content="Aplicação de gerenciamento do fluxo de chamados de suporte ou solicitações internas" />
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
            <!-- <div class="header__line"></div> -->
        </header>
        <main>
            <section class="buttons">
                <button class="buttons__item" onclick="window.location.href='form_chamado.php'">Abrir chamado</button>
                <button class="buttons__item" onclick="window.location.href='lista_chamados.php'">Listar
                    chamados</button>
                <button class="buttons__item" onclick="window.location.href='form_setor.php'">Cadastrar setor</button>
                <button class="buttons__item" onclick="window.location.href='form_prioridade.php'">Cadastrar
                    prioridade</button>

            </section>

        </main>
        <footer>
            <p class="footer__text">&copy; 2026 Lorena Mendes</p>
        </footer>
    </div>

</body>

</html>