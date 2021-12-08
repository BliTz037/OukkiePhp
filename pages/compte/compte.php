<?php

session_start();

$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', 'root');
    
    if(isset($_POST['formconnexion'])){
        
        $pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
        $mdpconnect = sha1($_POST['mdpconnect']);
        
        if(!empty($pseudoconnect) AND !empty($mdpconnect)){
            
            $requser = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ? AND motdepasse = ?");
            $requser->execute(array($pseudoconnect, $mdpconnect));
            $userexist = $requser->rowCount();
            
            if($userexist == 1){
                
                $userinfo = $requser->fetch();
                $_SESSION['id'] = $userinfo['id'];
                $_SESSION['pseudo'] = $userinfo['pseudo'];
                header("Location: profil.php?id=".$_SESSION['id']);
                
            }
            else{
                $erreur = "Votre pseudo ou mot de passe est incorrect !";
            }
            
        }
        else
        {
         $erreur = "Tous les champs doivent être remplis !";  
        }
    }
?>


<?php require '../../templates/top.php'?>

<main>
    <h2>Connexion</h2>
    <form method="POST" action="">
        <table align="center">
            <tr>
                <td><label for="pseudoconnect">Pseudo :</label></td>
                <td><input type="text" name="pseudoconnect" placeholder="pseudo" /><br></td>
            </tr>
            <tr>
                <td><label for="mdpconnect">Mot de Passe :</label></td>
                <td><input type="password" name="mdpconnect" id="mdpconnect" placeholder="Mot De passe" /></td>
            </tr>
        </table>

        <input type="submit" name="formconnexion" value="Se connecter">
    </form> <br>

    <?php
    if(isset($erreur)){
       
        echo '<p>';
        echo   '<font color="red">'.$erreur.'</font>';
        echo '</p>';
    }
    ?>
</main>

<?php require '../../templates/bottom.php'?>
}
   else{
       header("Location: compte.php");
   }
