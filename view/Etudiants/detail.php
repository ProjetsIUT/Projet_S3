<div class="page_content">

<h1>Informations universitaire de l'<?php echo 'étudiant'.' '.htmlspecialchars($uprenom).' '.htmlspecialchars($unom).' de login '.htmlspecialchars($ulogin)?></h1>
<div class="box_center">

<?php   
    echo '<p>  Login : '. htmlspecialchars($ulogin) .' <br> 
    Annee en cours : '. htmlspecialchars($uace) .' <br>
    Code Departement : '. htmlspecialchars($ucd) .' <br>
    Semestre en cours : '.htmlspecialchars($usce).' <br>
    Moyenne générale actuelle : '.htmlspecialchars($umoyenneGeneral).' <br> </p>';
    

        echo ('<br><a class= "bouton" href="index.php?controller=utilisateurs&action=read&loginUtilisateur=' . rawurlencode($ulogin) . '" > Retour sur les informations utilisateurs ! </a>');
        echo ('<br>  <br> <a class= "bouton" href="index.php?controller=etudiants&action=update&loginEtudiant=' . rawurlencode($ulogin) . '" > Modifier les informations universitaires ! </a>');
        
?>
<br>
</div>
</div>