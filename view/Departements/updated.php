<article id="page_connexion">
<div id="formulaire_connexion">
<?php
    echo '<p> La matière de code '.htmlspecialchars($_GET['codeMatiere']).' a été mis à jour!
    <br>
    Vous allez être redirigé vers la page précédente.</p>
    ';

        $redirection = 'index.php?controller=etudiants&action=read&codeMatiere='.htmlspecialchars($_GET['codeMatiere']).'';
        header('Refresh: 3; url='.$redirection);

?>

</div>
</article>