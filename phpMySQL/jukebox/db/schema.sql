USE BUSSANOVITTORIO;

CREATE TABLE IF NOT EXISTS cantanti (
    id VARCHAR(32) PRIMARY KEY,
    nickname VARCHAR(255) NOT NULL,
    immagine_profilo BLOB,
    biografia TEXT,
    attivo BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS generi (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL
);


CREATE TABLE IF NOT EXISTS canzoni (
    id VARCHAR(32) PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    data_rilascio DATE NOT NULL DEFAULT(CURRENT_DATE()),
    durata INT NOT NULL,
    genere INT UNSIGNED NOT NULL,
    copertina BLOB,
    file_audio BLOB NOT NULL,
    FOREIGN KEY (genere) REFERENCES generi(id)
);

CREATE TABLE IF NOT EXISTS interpreta (
    id_cantante VARCHAR(32) NOT NULL,
    id_canzone VARCHAR(32) NOT NULL,
    PRIMARY KEY (id_cantante, id_canzone),
    FOREIGN KEY (id_cantante) REFERENCES cantanti(id),
    FOREIGN KEY (id_canzone) REFERENCES canzoni(id)
);

CREATE TABLE IF NOT EXISTS ruoli (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO ruoli (nome) VALUES 
('user'),
('admin');

CREATE TABLE IF NOT EXISTS utenti (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    ruolo_id INT UNSIGNED NOT NULL DEFAULT 1, -- Default al ruolo 'user'
    data_registrazione DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    attivo BOOLEAN NOT NULL DEFAULT TRUE,
    FOREIGN KEY (ruolo_id) REFERENCES ruoli(id)
);