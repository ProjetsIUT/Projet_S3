<div class="page_content">

<h1>Détails de l'<?php echo htmlspecialchars($utype).' '.htmlspecialchars($uprenom).' '.htmlspecialchars($unom).' de login '.htmlspecialchars($ulogin); if(Session::is_admin()){echo'<a class=bouton href="index.php?controller=utilisateurs&action=readAll">Retour à la liste des utilisateurs</a>';}?></h1>
<div class="box_center">

<?php   
    echo '<p>  Login : '. htmlspecialchars($ulogin) .' <br> 
    Prenom : '. htmlspecialchars($uprenom) .' <br>
    Nom : '. htmlspecialchars($unom) .' <br>
    Email : '.htmlspecialchars($uemail).' <br>
    Nom Etablissement : '.htmlspecialchars($ucode).' <br>
    Type utilisateur : '.htmlspecialchars($utype).'</p>';
    

    if ($utype === 'etudiant') {
        echo ('<br><a class= "bouton" href="index.php?controller=etudiants&action=read&loginEtudiant=' . rawurlencode($ulogin) . '" > Consulter les informations universitaires ! </a>');
        echo ('<br> <br><a class= "bouton" href="index.php?controller=utilisateurs&action=update&loginUtilisateur=' . rawurlencode($ulogin) . '" > Modifier les informations personnelles ! </a>');
    }
    else if ($utype === 'enseignant') {
        echo ('<br> <br> <a class= "bouton" href="index.php?controller=utilisateurs&action=update&loginUtilisateur=' . rawurlencode($ulogin) . '" > Modifier les informations personnelles ! </a>');
    }
    else if ($utype === 'administrateur') {
        echo ('<br> <br> <a class= "bouton" href="index.php?controller=utilisateurs&action=update&loginUtilisateur=' . rawurlencode($ulogin) . '" > Modifier les informations personnelles ! </a>');
    }

    if(Session::is_admin()) {
        echo ('<br> <br> <a class="bouton_suppr" href="index.php?controller=utilisateurs&action=delete&loginUtilisateur=' . rawurlencode($ulogin) . '" >  Supprimer !  </a>');
    }
    echo '<br>';
?>

</div>
</div>