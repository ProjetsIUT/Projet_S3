

<?php
    echo '<h1>Détails de l\'utilisateur '.htmlspecialchars($ulogin).'</h1>';
    
    echo '<p>  Login : '. htmlspecialchars($ulogin) .' <br> 
    Prenom : '. htmlspecialchars($uprenom) .' <br>
    Nom : '. htmlspecialchars($unom) .' <br>
    Email : '.htmlspecialchars($uemail).' <br>
    Code Etablissement : '.htmlspecialchars($ucode).' <br>
    Type utilisateur : '.htmlspecialchars($utype).' <br>';
    

    echo ('<br> <br> <br><a class="bouton_red" href="index.php?controller=utilisateur&action=delete&loginUtilisateur=' . rawurlencode($ulogin) . '" >  Cliquez ici pour supprimer cette utilisateur !  </a>');
    echo ('<br> <br> <br><a class= "bouton" href="index.php?controller=utilisateur&action=update&loginUtilisateur=' . rawurlencode($ulogin) . '" > Cliquez ici pour modifier cette utilisateur ! </a>');
    
?>