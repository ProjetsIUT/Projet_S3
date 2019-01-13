<article id="page_connexion">
<div id="formulaire_connexion">
<?php
    echo '<p> Les informations sur l\'établissement '.htmlspecialchars($_GET['nomEtablissement']).' ont été mis à jour!
    <br>
    Vous allez être redirigé vers la page précédente.</p>
    ';

        $redirection = 'index.php?controller=etablissements&action=read&codeEtablissement='.htmlspecialchars($_GET['codeEtablissement']).'';
        header('Refresh: 3; url='.$redirection);

?>

</div>
</article>