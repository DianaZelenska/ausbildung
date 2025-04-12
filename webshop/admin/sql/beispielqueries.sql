select id,produktname,beschreibung from produkt;
select id,produktname from produkt;

select id,produktname,beschreibung from produkt where id=1 limit 1;

UPDATE `produkt` SET `produktname` = 'Günstige Zahnbürste xx', `beschreibung` = 'Günstige Zahnbürste, mittelhart\nPutzt sogar hinter den Zähnen!\n\nVerwendung: fragen Sie Ihren Arzt oder Apotheker.\n\nxxx' WHERE `produkt`.`id` = 1 