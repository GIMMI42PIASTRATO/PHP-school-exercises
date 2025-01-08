USE BUSSANOVITTORIO;

CREATE TABLE IF NOT EXISTS rappresentante (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    ultimo_fatturato FLOAT(2),
    regione VARCHAR(50) NOT NULL,
    provincia VARCHAR(2) NOT NULL,
    percentuale_provvigione INT NOT NULL -- la percentuale viene salvata moltiplicata per 100 (es 25% = 25)
);