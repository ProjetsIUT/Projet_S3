<article id="page_connexion">
<div id="formulaire_connexion">
<?php
    echo '<p> L\'étudiant de login '.htmlspecialchars($_GET['loginEtudiant']).' a été mis à jour!
    <br>
    Vous allez être redirigé vers la page précédente.</p>
    ';

        $redirection = 'index.php?controller=etudiants&action=read&loginEtudiant='.$_GET['loginEtudiant'].'';
        header('Refresh: 3; url='.$redirection);

?>

</div>
</article>