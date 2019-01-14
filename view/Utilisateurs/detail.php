<div class="page_content">

<h1>Détails de l'<?php echo htmlspecialchars($utype).' '.htmlspecialchars($uprenom).' '.htmlspecialchars($unom).' de login '.htmlspecialchars($ulogin)?><a class=bouton href="index.php?controller=utilisateurs&action=readAll">Retour à la liste des utilisateurs</a></h1>
<div class="box_center">

<?php   
    echo '<p>  Login : '. htmlspecialchars($ulogin) .' <br> 
    Prenom : '. htmlspecialchars($uprenom) .' <br>
    Nom : '. htmlspecialchars($unom) .' <br>
    Email : '.htmlspecialchars($uemail).' <br>
    Code Etablissement : '.htmlspecialchars($ucode).' <br>
    Type utilisateur : '.htmlspecialchars($utype).'</p>';
    

    if ($utype === 'etudiant') {
        echo ('<br><a class= "bouton" href="index.php?controller=etudiants&action=read&loginEtudiant=' . rawurlencode($ulogin) . '" > Consulter les informations universitaires ! </a>');
        echo ('<br> <br> <a class= "bouton" href="index.php?controller=utilisateurs&action=update&loginUtilisateur=' . rawurlencode($ulogin) . '" > Modifier les informations personnelles ! </a>');
        echo ('<br> <br> <a class="bouton_suppr" href="index.php?controller=utilisateurs&action=delete&loginUtilisateur=' . rawurlencode($ulogin) . '" >  Supprimer cet étudiant !  </a> <br>');
    }
    else if ($utype === 'enseignant') {
        echo ('<br><a class= "bouton" href="index.php?controller=enseignants&action=read&loginEnseignant=' . rawurlencode($ulogin) . '" > Consulter les informations universitaires ! </a>');
        echo ('<br> <br> <a class= "bouton" href="index.php?controller=utilisateurs&action=update&loginUtilisateur=' . rawurlencode($ulogin) . '" > Modifier les informations personnelles ! </a>');
        echo ('<br> <br> <a class="bouton_suppr" href="index.php?controller=utilisateurs&action=delete&loginUtilisateur=' . rawurlencode($ulogin) . '" >  Supprimer cet enseignant !  </a> <br>');
    }
    else if ($utype === 'administrateur') {
        echo ('<br> <br> <a class= "bouton" href="index.php?controller=utilisateurs&action=update&loginUtilisateur=' . rawurlencode($ulogin) . '" > Modifier les informations personnelles ! </a>');
        echo ('<br> <br> <a class="bouton_suppr" href="index.php?controller=utilisateurs&action=delete&loginUtilisateur=' . rawurlencode($ulogin) . '" >  Supprimer cet administrateur !  </a> <br>');
    }
?>

</div>
</div>