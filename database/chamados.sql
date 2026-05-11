CREATE DATABASE chamados;

CREATE TABLE setores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(30) NOT NULL UNIQUE
);

CREATE TABLE prioridades (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nivel_prioridade VARCHAR(10) NOT NULL UNIQUE,
    tempo_previsto INT NOT NULL
);

CREATE TABLE chamados (
    id_chamado INT PRIMARY KEY AUTO_INCREMENT,
    descricao VARCHAR(200),
    situacao VARCHAR(20) DEFAULT 'Aberto',
    data_inicio DATETIME,
    data_fim DATETIME,
    solucao VARCHAR(200),
    id_setor INT NOT NULL,
    id_prioridade INT NOT NULL,
    FOREIGN KEY (id_setor) REFERENCES setores (id),
    FOREIGN KEY (id_prioridade) REFERENCES prioridades (id)
);