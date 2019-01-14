<article id="page_connexion">
<div id="formulaire_connexion">
    <a>L'email de récupération vient de vous être envoyé.
    <br>Vous allez être redirigé vers l'accueil du site</a>
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
    </div>
</article>