-- Change cantanti.immagine_profilo from BLOB to VARCHAR(255)
ALTER TABLE `cantanti` 
    MODIFY `immagine_profilo` VARCHAR(255) DEFAULT NULL;

-- Change canzoni.copertina from BLOB to VARCHAR(255)
ALTER TABLE `canzoni` 
    MODIFY `copertina` VARCHAR(255) DEFAULT NULL;

-- Remove file_audio column from canzoni table
ALTER TABLE `canzoni` 
    DROP COLUMN `file_audio`;

-- Because file_audio was NOT NULL, we need to adjust the table structure
-- Add a new column to store the audio file path
ALTER TABLE `canzoni` 
    ADD COLUMN `percorso_audio` VARCHAR(255);