<div class="page_content">

<h1>Détails de la matière <?php echo htmlspecialchars($mnommatiere).'' ?><a class=bouton href="index.php?controller=matieres&action=readAll">Retour à la liste des matières</a></h1>
<div class="box_center">

<?php   
    echo '<p>  Code de la matière : '. htmlspecialchars($mcodematiere) .' <br> 
    Nom de la matière : '. htmlspecialchars($mnommatiere) .' <br>
    Code département : '. htmlspecialchars($mcodeDepartement) .' <br>
    
    <p style="color:#E70739;"> Attention ! Avant de supprimer une matière, il faut que tous les cours de celle-ci soit supprimé avant pour la version Alpha d\'Agora</p> <br>';
    

        echo ('<br> <br> <a class= "bouton" href="index.php?controller=matieres&action=update&codeMatiere=' . rawurlencode($mcodematiere) . '" > Modifier les informations de la matière ! </a>');
        echo ('<br> <br> <a class="bouton_suppr" href="index.php?controller=matieres&action=delete&codeMatiere=' . rawurlencode($mcodematiere) . '" >  Supprimer cette matière !  </a> <br>');
?>

</div>
</div>