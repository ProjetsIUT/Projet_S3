<article id="page_connexion">
<div id="formulaire_connexion">
<p> L'utilisateur a bien été supprimé ! <br>
    Vous allez être redirigez.</p>
</div>

<?php 
    if(Session::is_admin()) {
        echo '<meta http-equiv="refresh" content="3; URL=index.php?controller=utilisateurs&action=readAll" />';
    }
    else {
        echo '<meta http-equiv="refresh" content="3; URL=index.php" />';
    }
?>

</article>