<article id="page_connexion">
  <form id="formulaire_connexion" method="get" action="index.php">
    
      <p><?php echo htmlspecialchars($type)?></p>
      
        
        <?php 

        $controller = static::$object;
        echo('<input type="hidden" name="controller" value="'.htmlspecialchars($controller).'"/>');

        if($_GET['action'] === 'create') {
          echo'
          <input type="hidden" name="action" value="created"/>
          <label for="loginUtilisateur_id">Login : </label>
          <input type="text" placeholder="dupontp" name="loginUtilisateur" id="loginUtilisateur_id" required/>
          <br>
          <label for="nomUtilisateur_id">Nom : </label>
          <input type="text" placeholder="Dupont" name="nomUtilisateur" id="nomUtilisateur_id" required/>
          <br>
          <label for="nomUtilisateur_id">Prénom : </label>
          <input type="text" placeholder="Pierre" name="prenomUtilisateur" id="prenomUtilisateur_id" required/>
          <br>
          <label for="emailUtilisateur_id">Email : </label>
          <input type="email" placeholder="example@gmail.com" name="emailUtilisateur" id="emailUtilisateur_id" required/>
          <br>
          <label for="typeUser_id">Type : </label>
          <select name="typeUtilisateur" id="typeUtilisateur_id" size="1" required>
            <option value="administrateur"> Administrateur
            <option value="etudiant"> Etudiant
            <option value="enseignant"> Enseignant  
          </select>
          <br>
          <label for="codeEtablissement_id">Code établissement : </label>
          <input type="number" name="codeEtablissement" id="codeEtablissement_id" required/>
          <br>
          ';
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
          <input type="number" name="codeEtablissement" id="codeEtablissement_id" required/>
          <br>';
        }
        /*
        else if($_GET['action'] === 'update') {
          echo('
          <input type="hidden" name="action" value="updated"/>
          <input type="text" value="'.htmlspecialchars($ulogin).'" name="loginUtilisateur" id="loginUtilisateur_id" readonly required/>
          <input type="text" value="'.htmlspecialchars($unom).'" name="nomUtilisateur" id="nomUtilisateur_id" required/>
          <input type="text" value="'.htmlspecialchars($uprenom).'" name="prenomUtilisateur" id="prenomUtilisateur_id" required/>
          <br>
          <label>Adresse de facturation:</label>
          <br>
          <textarea name="adresseFacturationUtilisateur" id="adresseFacturationUtilisateur_id" > '.htmlspecialchars($uadresseF).' </textarea>
          <br>
          <label>Adresse de livraison:</label>
          <br>
          <textarea name="adresseLivraisonUtilisateur" id="adresseLivraisonUtilisateur_id" > '.htmlspecialchars($uadresseL).' </textarea>
          <br>
          <input type="password" placeholder="Mot de passe" name="passUtilisateur" id="passUtilisateur_id" required/>
          <input type="password" placeholder="Confirmer le mot de passe" name="vpassUtilisateur" id="vpassUtilisateur_id" required/>
          <input type="email" value="'.htmlspecialchars($uemail).'" name="emailUser" id="emailUser_id" />');
          if(Session::is_admin()) {
            if($utype == 1) {
              $dec = '<option value="1"> Oui
              <option value="0"> Non'; 
            }
            else {
              $dec = '<option value="0"> Non
              <option value="1"> Oui';
            }
            echo '<label for="typeUser_id">Administrateur</label>
            <select name="typeUser" id="typeUsers_id" size="1" required>
                '.$dec.'
            </select>';
          }
        }
        else if($_GET['action'] === 'created') {
          echo('
          <input type="hidden" name="action" value="created"/>
          <p> '.$verif.' </p>
          <input type="text" value="'.htmlspecialchars($_GET['loginUtilisateur']).'" name="loginUtilisateur" id="loginUtilisateur_id" required/>
          <input type="text" value="'.htmlspecialchars($_GET['nomUtilisateur']).'" name="nomUtilisateur" id="nomUtilisateur_id" required/>
          <input type="text" value="'.htmlspecialchars($_GET['prenomUtilisateur']).'" name="prenomUtilisateur" id="prenomUtilisateur_id" required/>
          <br>
          <label>Adresse de facturation:</label>
          <br>
          <textarea name="adresseFacturationUtilisateur" id="adresseFacturationUtilisateur_id" > '.htmlspecialchars($_GET['adresseFacturationUtilisateur']).'</textarea>
          <br>
          <label>Adresse de livraison:</label>
          <br>
          <textarea name="adresseLivraisonUtilisateur" id="adresseLivraisonUtilisateur_id" > '.htmlspecialchars($_GET['adresseLivraisonUtilisateur']).' </textarea>
          <br>
          <input type="password" placeholder="Mot de passe" name="passUtilisateur" id="passUtilisateur_id" required/>
          <input type="password" placeholder="Confirmer le mot de passe" name="vpassUtilisateur" id="vpassUtilisateur_id" required/>
          <input type="email" value="'.htmlspecialchars($_GET['emailUser']).'" name="emailUser" id="emailUser_id" />');
          if(Session::is_admin()) {
            if($_GET['typeUser'] == 1) {
              $dec = '<option value="1"> Oui
              <option value="0"> Non'; 
            }
            else {
              $dec = '<option value="0"> Non
              <option value="1"> Oui';
            }
            echo '<label for="typeUser_id">Administrateur</label>
            <select name="typeUser" id="typeUsers_id" size="1" required>
                '.$dec.'
            </select>';
          }
        }
        else if ($_GET['action'] === 'updated') {
          echo('
          <input type="hidden" name="action" value="updated"/>
          <p> '.$verif.' </p>
          <input type="text" value="'.htmlspecialchars($_GET['loginUtilisateur']).'" name="loginUtilisateur" id="loginUtilisateur_id" required/>
          <input type="text" value="'.htmlspecialchars($_GET['nomUtilisateur']).'" name="nomUtilisateur" id="nomUtilisateur_id" required/>
          <input type="text" value="'.htmlspecialchars($_GET['prenomUtilisateur']).'" name="prenomUtilisateur" id="prenomUtilisateur_id" required/>
          <br>
          <label>Adresse de facturation:</label>
          <br>
          <textarea name="adresseFacturationUtilisateur" id="adresseFacturationUtilisateur_id" > '.htmlspecialchars($_GET['adresseFacturationUtilisateur']).'</textarea>
          <label>Adresse de livraison:</label>
          <br>
          <textarea name="adresseLivraisonUtilisateur" id="adresseLivraisonUtilisateur_id" > '.htmlspecialchars($_GET['adresseLivraisonUtilisateur']).' </textarea>
          <br>
          <input type="password" placeholder="Mot de passe" name="passUtilisateur" id="passUtilisateur_id" required/>
          <input type="password" placeholder="Confirmer le mot de passe" name="vpassUtilisateur" id="vpassUtilisateur_id" required/>
          <input type="email" value="'.htmlspecialchars($_GET['emailUser']).'" name="emailUser" id="emailUser_id" />');
          if(Session::is_admin()) {
            if($_GET['typeUser'] == 1) {
              $dec = '<option value="1"> Oui
              <option value="0"> Non'; 
            }
            else {
              $dec = '<option value="0"> Non
              <option value="1"> Oui';
            }
            echo '<label for="typeUser_id">Administrateur</label>
            <select name="typeUser" id="typeUsers_id" size="1" required>
                '.$dec.'
            </select>';
          }
        }
        */
        
        ?>
        <input type="submit" value="Suivant" />
      
    
  </form>
</article>