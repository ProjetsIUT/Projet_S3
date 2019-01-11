<div class="page_content" id="div_page_perso_enseignant">

    <div class="ligne">

        <div class="tab" id="tab_profil">

            <h3>Bienvenue sur Agora</h3>
            <br>
            <?php 
            if(isset($error_page)) {
                echo '<h3 style="color:#E70739;"> '.$error_page.' </h3> <br>';
            }
            ?>
            <a>Bienvenue dans votre espace personnel<?php echo ' '.$_SESSION["prenomUtilisateur"].' '.$_SESSION["nomUtilisateur"] ?>
            <br>Vous utilisez la version Alpha d'Agora. Certaines fonctionnalités ne sont pas encore disponibles.</a>
            <br>
            <br>
            <a href="index.php?controller=utilisateurs&action=readAll" class="bouton">Gérer les utilisateurs</a>
            <br>
            <br>
            <a href="index.php?controller=matieres&action=readAll" class="bouton"> Gérer les matières</a>
            <br>
            <br>
            <a href="index.php?controller=departements&action=readAll" class="bouton"> Gérer les départements</a>
            <br>
            <br>
            <a href="index.php?controller=etablissements&action=readAll" class="bouton"> Gérer les établissements</a>
        </div>



    </div>

</div>