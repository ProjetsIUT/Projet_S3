CREATE OR REPLACE FUNCTION moyGeneraleEtudiant(p_loginEtudiant agora_etudiants.loginEtudiant%TYPE, p_date agora_notes.dateNote%TYPE) RETURN NUMBER
DECLARE
v_moy NUMBER; 
BEGIN
SELECT MOY(note) FROM agora_notes INTO v_moy;
WHERE codeEtudiant=p_loginEtudiant AND dateNote<=p_date;
RETURN v_moy;
END;