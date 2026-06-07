# Solução para Controle de Atendimentos

![PHP](https://img.shields.io/badge/PHP-Backend-777BB4)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1)
![Status](https://img.shields.io/badge/status-in%20development-yellow)


Desafio técnico desenvolvido com o projeto de gerenciar de forma eficiente o fluxo de chamados de solicitações internas, controlando tempos de atendimento e prazos SLA.

---

## Tecnologias Utilizadas

* **Back-end:** PHP
* **Banco de Dados:** MySQL
* **Front-end:** HTML5 e CSS3 (adotando a metodologia **BEM** para organização de classes)
* **Comunicação com o banco:** Extensão Nativa **PDO** (PHP Data Objects)

---

## Funcionalidades do Projeto

* **Cadastro de setores:** permite a segmentação dos chamados por departamentos.
* **Cadastro de prioridades:** configuração de níveis de urgência atrelados a um tempo estimado de resolução em horas.
* **Abertura de chamados:** vinculação dinâmica de setores e prioridades.
* **Check-in:** registra a data e hora exata do início do atendimento, alterando o status para "Em andamento". O sistema bloqueia o início de chamados já finalizados.
* **Check-out:** solicita uma breve descrição da solução resolvida e registra a data e hora do término do atendimento, alterando o status para "Concluído".
* **Painel de monitoramento dinâmico:** listagem exibindo setor, prioridade, status atual e tempo total de atendimento decorrido calculado em tempo real.

---

## Destaques Técnicos e Boas Práticas

Durante o desenvolvimento do projeto, priorizei a aplicação de conceitos fundamentais de engenharia de software e segurança:

### 1. Performance no Banco de Dados
Em vez de sobrecarregar a camada de aplicação (PHP) calculando tempos decorridos dentro de loops estruturais, utilizei funções nativas do MySQL como `TIMESTAMPDIFF` combinadas com condicionais `CASE WHEN` diretamente na query SQL. Isso garante que o banco entregue o dado processado de forma performática.

### 2. Segurança da Informação
* **SQL Injection:** implementação de **Prepared Statements** nas atualizações de status, separando os comandos lógicos dos dados enviados pelo usuário.
* **Cross-Site Scripting (XSS):** sanitização de dados na camada de visualização utilizando a função `htmlspecialchars()` do PHP antes de renderizar os textos no navegador.

### 3. Arquitetura Centralizada
Utilização do arquivo `cadastros.php`, centralizando o processamento de requisições `POST` e regras de negócio de escrita, mantendo os arquivos de visualização limpos e focados na interface do usuário.

---

## Estrutura do Banco de Dados

O banco de dados está normalizado para garantir a integridade referencial dos dados através de chaves estrangeiras (`FOREIGN KEY`):

* `setores` (id, nome)
* `prioridades` (id, nivel_prioridade, tempo_previsto)
* `chamados` (id_chamado, descricao, situacao, data_inicio, data_fim, solucao, id_setor, id_prioridade)

---

## Como Executar o Projeto

1.  Clone este repositório em seu ambiente local (dentro da pasta de execução do seu servidor web, como o `htdocs` do XAMPP).
2.  Importe o arquivo `chamados.sql` no seu gerenciador de banco de dados.
3.  Caso necessário, ajuste as credenciais de acesso ao banco (host, usuário e senha) no arquivo `conexao.php`.
4.  Acesse o projeto no navegador através do endereço local (ex: `http://localhost/controle-chamados/index.php`).

---
Desenvolvido por [Lorena Mendes](https://github.com/lorimendes).  
Conecte-se comigo no [LinkedIn](https://www.linkedin.com/in/lorenamendes0/).
