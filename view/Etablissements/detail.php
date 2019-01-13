<div class="page_content">

<h1>Détails de l'établissement <?php echo htmlspecialchars($mnomEtablissement).'' ?><a class=bouton href="index.php?controller=etablissements&action=readAll">Retour à la liste des établissements</a></h1>
<div class="box_center">

<?php   
    echo '<p>  Code de l\'établissement : '. htmlspecialchars($mcodeEtablissement) .' <br> 
    Nom de l\'établissement : '. htmlspecialchars($mnomEtablissement) .' <br>
    Ville de l\'établissement : '. htmlspecialchars($mvilleEtablissement) .' <br>
    
    ';
    

        echo ('<br> <br> <a class= "bouton" href="index.php?controller=etablissements&action=update&codeEtablissement=' . rawurlencode($mcodeEtablissement) . '" > Modifier les informations de l\'établissement ! </a>');
        echo ('<br> <br> <a class="bouton_suppr" href="index.php?controller=etablissements&action=delete&codeEtablissement=' . rawurlencode($mcodeEtablissement) . '" >  Supprimer cet établissement !  </a> <br>');
?>

</div>
</div>