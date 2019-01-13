<div class="page_content">

<h1>Informations universitaire de l'<?php echo 'étudiant'.' '.htmlspecialchars($uprenom).' '.htmlspecialchars($unom).' de login '.htmlspecialchars($ulogin)?></h1>
<div class="box_center">

<?php   
    echo '<p>  Login : '. htmlspecialchars($ulogin) .' <br> 
    Annee en cours : '. htmlspecialchars($uace) .' <br>
    Nom Departement : '. htmlspecialchars($ucd) .' <br>
    Semestre en cours : '.htmlspecialchars($usce).' <br>
    Moyenne générale actuelle : '.htmlspecialchars($umoyenneGenerale).'/20 <br> </p>';
    

    if (Session::is_admin()) {
        echo ('<br> <a class= "bouton_suppr" href="index.php?controller=etudiants&action=delete&loginEtudiant=' . rawurlencode($ulogin) . '" > Supprimer les informations universitaires de cet étudiant! </a>');
        echo ('<br>  <br> <a class= "bouton" href="index.php?controller=etudiants&action=update_info_etud&loginEtudiant=' . rawurlencode($ulogin) . '" > Modifier les informations universitaires ! </a>');
    }
    echo ('<br> <br> <a class= "bouton" href="index.php?controller=utilisateurs&action=read&loginUtilisateur=' . rawurlencode($ulogin) . '" > Retour sur les informations utilisateurs ! </a>');
        
?>
<br>
</div>
</div>