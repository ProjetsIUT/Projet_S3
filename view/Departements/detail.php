<div class="page_content">

<h1>Détails du département <?php echo htmlspecialchars($mnomDepartement).'' ?><a class=bouton href="index.php?controller=departements&action=readAll">Retour à la liste des départements</a></h1>
<div class="box_center">

<?php   
    echo '<p>  Code du département : '. htmlspecialchars($mcodeDepartement) .' <br> 
    Nom du département : '. htmlspecialchars($mnomDepartement) .' <br>
    Nom de l\'établissement : '. htmlspecialchars($mnomEtablissement) .' <br>
    
    <p style="color:#E70739;"> Attention ! Avant de supprimer une matière, il faut que tous les cours de celle-ci soit supprimé avant pour la version Alpha d\'Agora</p> <br>';
    

        echo ('<br> <br> <a class= "bouton" href="index.php?controller=departements&action=update&codeDepartement=' . rawurlencode($mcodeDepartement) . '" > Modifier les informations du département ! </a>');
        echo ('<br> <br> <a class="bouton_suppr" href="index.php?controller=departements&action=delete&codeDepartement=' . rawurlencode($mcodeDepartement) . '" >  Supprimer ce département !  </a> <br>');
?>

</div>
</div>