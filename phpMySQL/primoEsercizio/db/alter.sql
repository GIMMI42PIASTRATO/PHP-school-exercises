-- AGGIUNGE LA COLONNA codice_fiscale ALLA TABELLA rappresentante
ALTER TABLE rappresentante
ADD codice_fiscale VARCHAR(16) NOT NULL;

-- RIMOVE LA PRIMARY KEY DA id
ALTER TABLE rappresentante
DROP PRIMARY KEY;

-- RIMUOVE LA COLONNA id
ALTER TABLE rappresentante
DROP COLUMN id;

-- AGGIUNGE LA PRIMARY KEY A codice_fiscale
ALTER TABLE rappresentante
ADD PRIMARY KEY (codice_fiscale);
