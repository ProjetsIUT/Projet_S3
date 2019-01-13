<article id="page_connexion">
<div id="formulaire_connexion">
<?php
    echo '<p> L\'établissement de code '.htmlspecialchars($_GET['codeEtablissement']).' a été mis à jour!
    <br>
    Vous allez être redirigé vers la page précédente.</p>
    ';

        $redirection = 'index.php?controller=etablissements&action=read&codeEtablissement='.htmlspecialchars($_GET['codeEtablissement']).'';
        header('Refresh: 3; url='.$redirection);

?>

</div>
</article>