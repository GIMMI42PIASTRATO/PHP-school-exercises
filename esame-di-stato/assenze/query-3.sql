SELECT 
    s.nome AS nome_studente,
    c.tipologia AS classe,
    c.indirizzo AS indirizzo
FROM 
    Assenza a
JOIN 
    Studente s ON a.`cf-studente` = s.cf
JOIN 
    Classe c ON s.`id-classe` = c.id
GROUP BY 
    s.cf
HAVING 
    COUNT(a.id) > 10;
