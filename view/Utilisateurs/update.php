 <div class=page_content>
<h1><?php echo htmlspecialchars($type)?><a class=bouton href="index.php?controller=utilisateurs&action=readAll">Retour à la liste des utilisateurs</a></h1>
<article id="page_ajouterqcm">
  <form id="formulaire_connexion" method="get" action="index.php">
         
        <?php 

        $controller = static::$object;
        echo('<input type="hidden" name="controller" value="'.htmlspecialchars($controller).'"/>');

        if($_GET['action'] === 'create') {
          echo'
          <br>
          <input type="hidden" name="action" value="created"/>
          <label for="loginUtilisateur_id">Login : </label>
          <input type="text" placeholder="dupontp" name="loginUtilisateur" id="loginUtilisateur_id" required/>
          <br>
          <br>
          <label for="nomUtilisateur_id">Nom : </label>
          <input type="text" placeholder="Dupont" name="nomUtilisateur" id="nomUtilisateur_id" required/>
          <br>
          <br>
          <label for="nomUtilisateur_id">Prénom : </label>
          <input type="text" placeholder="Pierre" name="prenomUtilisateur" id="prenomUtilisateur_id" required/>
          <br>
          <br>
          <label for="emailUtilisateur_id">Email : </label>
          <input type="email" placeholder="example@gmail.com" name="emailUtilisateur" id="emailUtilisateur_id" required/>
          <br>
          <br>
          <label for="typeUser_id">Type : </label>
          <select name="typeUtilisateur" id="typeUtilisateur_id" size="1" required>
            <option value="administrateur"> Administrateur
            <option value="etudiant"> Etudiant
            <option value="enseignant"> Enseignant  
          </select>
          <br>
          <br>
          <label for="codeEtablissement_id">Code établissement : </label>
          <input type="number" name="codeEtablissement" id="codeEtablissement_id" required/>
          <br>
          ';
        }
        else if($_GET['action'] === 'update') {
          echo '
          <br>
          <input type="hidden" name="action" value="updated"/>
          <label for="loginUtilisateur_id">Login : </label>
          <input type="text" value='.htmlspecialchars($ulogin).' name="loginUtilisateur" id="loginUtilisateur_id" readonly required/>
          <br>
          <br>
          <label for="nomUtilisateur_id">Nom : </label>
          <input type="text" value='.htmlspecialchars($unom).' name="nomUtilisateur" id="nomUtilisateur_id" required/>
          <br>
          <br>
          <label for="prenomUtilisateur_id">Prénom : </label>
          <input type="text" value='.htmlspecialchars($uprenom).' name="prenomUtilisateur" id="prenomUtilisateur_id" required/>
          <br>
          <br>
          <label for="emailUtilisateur_id">Email : </label>
          <input type="email" value='.htmlspecialchars($uemail).' name="emailUtilisateur" id="emailUtilisateur_id" required/>
          <br>
          <br>';
          if(Session::is_admin()) {
          echo'<label for="typeUser_id">Type : </label>
          <select name="typeUtilisateur" id="typeUtilisateur_id" size="1" required>';
            if($utype === 'administrateur') {
              echo '
              <option value="administrateur"> Administrateur
              <option value="etudiant"> Etudiant
              <option value="enseignant"> Enseignant </select>';
            }
            else if($utype === 'etudiant') {
              echo '
              <option value="etudiant"> Etudiant
              <option value="administrateur"> Administrateur
              <option value="enseignant"> Enseignant </select>';
            }
            else if($utype === 'administrateur') {
              echo '
              <option value="enseignant"> Enseignant
              <option value="administrateur"> Administrateur
              <option value="etudiant"> Etudiant </select>';
            }
          }  
          echo '
          <br>
          <br>
          <label for="codeEtablissement_id">Code établissement : </label>
          <input type="number" value='.htmlspecialchars($ucodeEtablissement).' name="codeEtablissement" id="codeEtablissement_id" '.$etat.'/>
          <br>';
        }
        else if($_GET['action'] === 'created') {
          
          if(isset($verif)) {
            echo '<a style="color:#E70739;"> '.$verif.' </a>';
          }
          echo '
          <br>
          <input type="hidden" name="action" value="created"/>
          <label for="loginUtilisateur_id">Login : </label>
          <input type="text" value='.htmlspecialchars($_GET['loginUtilisateur']).' name="loginUtilisateur" id="loginUtilisateur_id" required/>
          <br>
          <label for="nomUtilisateur_id">Nom : </label>
          <input type="text" value='.htmlspecialchars($_GET['nomUtilisateur']).' name="nomUtilisateur" id="nomUtilisateur_id" required/>
          <br>
          <label for="prenomUtilisateur_id">Prénom : </label>
          <input type="text" value='.htmlspecialchars($_GET['prenomUtilisateur']).' name="prenomUtilisateur" id="prenomUtilisateur_id" required/>
          <br>
          <label for="emailUtilisateur_id">Email : </label>
          <input type="email" value='.htmlspecialchars($_GET['emailUtilisateur']).' name="emailUtilisateur" id="emailUtilisateur_id" required/>
          <br>
          <label for="typeUser_id">Type : </label>
          <select name="typeUtilisateur" id="typeUtilisateur_id" size="1" required>';
            if($_GET['typeUtilisateur'] === 'administrateur') {
              echo '
              <option value="administrateur"> Administrateur
              <option value="etudiant"> Etudiant
              <option value="enseignant"> Enseignant ';
            }
            else if($_GET['typeUtilisateur'] === 'etudiant') {
              echo '
              <option value="etudiant"> Etudiant
              <option value="administrateur"> Administrateur
              <option value="enseignant"> Enseignant ';
            }
            else if($_GET['typeUtilisateur'] === 'administrateur') {
              echo '
              <option value="enseignant"> Enseignant
              <option value="administrateur"> Administrateur
              <option value="etudiant"> Etudiant ';
            }  
          echo '</select>
          <br>
          <label for="codeEtablissement_id">Code établissement : </label>
          <input type="number" value='.htmlspecialchars($_GET['codeEtablissement']).' name="codeEtablissement" id="codeEtablissement_id" required/>
          <br>';
        }
        else if($_GET['action'] === 'updated') {
          if(isset($verif)) {
            echo '<a style="color:#E70739;"> '.$verif.' </a>';
          }
          echo '
          <br>
          <input type="hidden" name="action" value="updated"/>
          <label for="loginUtilisateur_id">Login : </label>
          <input type="text" value='.htmlspecialchars($_GET['loginUtilisateur']).' name="loginUtilisateur" id="loginUtilisateur_id" readonly required/>
          <br>
          <br>
          <label for="nomUtilisateur_id">Nom : </label>
          <input type="text" value='.htmlspecialchars($_GET['nomUtilisateur']).' name="nomUtilisateur" id="nomUtilisateur_id" required/>
          <br>
          <br>
          <label for="prenomUtilisateur_id">Prénom : </label>
          <input type="text" value='.htmlspecialchars($_GET['prenomUtilisateur']).' name="prenomUtilisateur" id="prenomUtilisateur_id" required/>
          <br>
          <br>
          <label for="emailUtilisateur_id">Email : </label>
          <input type="email" value='.htmlspecialchars($_GET['emailUtilisateur']).' name="emailUtilisateur" id="emailUtilisateur_id" required/>
          <br>
          <br>';
          if(Session::is_admin()) {
          echo'<label for="typeUser_id">Type : </label>
          <select name="typeUtilisateur" id="typeUtilisateur_id" size="1" required>';
            if($_GET['typeUtilisateur'] === 'administrateur') {
              echo '
              <option value="administrateur"> Administrateur
              <option value="etudiant"> Etudiant
              <option value="enseignant"> Enseignant </select>';
            }
            else if($_GET['typeUtilisateur'] === 'etudiant') {
              echo '
              <option value="etudiant"> Etudiant
              <option value="administrateur"> Administrateur
              <option value="enseignant"> Enseignant </select>';
            }
            else if($_GET['typeUtilisateur'] === 'administrateur') {
              echo '
              <option value="enseignant"> Enseignant
              <option value="administrateur"> Administrateur
              <option value="etudiant"> Etudiant </select>';
            }
          }  
          echo '
          <br>
          <br>
          <label for="codeEtablissement_id">Code établissement : </label>
          <input type="number" value='.htmlspecialchars($_GET['codeEtablissement']).' name="codeEtablissement" id="codeEtablissement_id" '.$etat.'/>
          <br>';
        }
        
        ?>
        <br>
        <input type="submit" value="Suivant" />
      
    
  </form>
</article>
      </div>