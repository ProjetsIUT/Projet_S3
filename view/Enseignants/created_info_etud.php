<div class=page_content>
<article id="page_connexion">
<div id="formulaire_connexion">
    <p>
	    L'étudiant a bien été créée !
	    <br>
	    Veuillez activer le compte via le lien reçu par mail. 
	    Vous allez être redirigé vers l'accueil.
    </p>
</div>
<?php
	if(Session::is_student()){ //si c'est un étudiant 
        $redirection = 'index.php?controller=etudiants&action=show_perso_page';
        header('Refresh: 3; url='.$redirection);
    }
    else if(Session::is_teacher()){ //si c'est un enseignant
        $redirection = 'index.php?controller=enseignants&action=show_perso_page';
        header('Refresh: 3; url='.$redirection);
    }
    else if(Session::is_admin()){ //si c'est un admin
        $redirection = 'index.php?controller=administrateur&action=show_perso_page';
        header('Refresh: 3; url='.$redirection);
    }
    else {
        $redirection = 'index.php';
        header('Refresh: 3; url='.$redirection);
    }
?>
</article>
</div>