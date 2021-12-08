<?php

$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', 'root');

    if(isset($_POST['forminscription'])){
        
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $mdp = sha1($_POST['motdepasse']);
            $mdp2 = sha1($_POST['motdepasse2']);
            $grade = htmlspecialchars($_POST['grade']);
            $pseudolength = strlen($pseudo);
        
        if(!empty($_POST['pseudo']) AND !empty($_POST['motdepasse'])){
            
            if($pseudolength <= 255)
            {
                if($mdp == $mdp2){
                    $insertmbr = $bdd->prepare("INSERT INTO membres(pseudo, motdepasse, grade) VALUES(?, ?, ?)");
                    $insertmbr->execute(array($pseudo, $mdp, $grade));
                    $erreur = "Le compte à été créer avec succès !";
                }
                else{
                    $erreur = "Le Mot de passe ne correspond pas !";
                }
            }
            else{
                $erreur = "Votre Pseudo ne doit pas dépasser 255 caractères !";
            }
            
        }
        else {
            $erreur = "Tous les champs doivent être remplis !" ;
            
        }
        
    }
    
?>

<?php require '../../templates/top.php'?>

<main>
    <h2>Inscription</h2>
    <p>Cette page, permet de créer un compte, afin que d'autre membres puisse se connecter.</p>

    <form method="POST" action="">
        <table align="center">
            <tr>
                <td><label for="pseudo">Pseudo :</label></td>
                <td><input type="text" name="pseudo" id="pseudo" /><br></td>
            </tr>
            <tr>
                <td><label for="motdepasse">Mot de Passe :</label></td>
                <td><input type="password" name="motdepasse" id="motdepasse" /></td>
            </tr>

            <tr>
                <td><label for="motdepasse2">Confirmation du Mot de Passe :</label></td>
                <td><input type="password" name="motdepasse2" id="motdepasse2" /></td>
            </tr>

            <tr>
                <td><label for="grade">Choisisez son grade :</label></td>
                <td><select name="grade" id="grade">
                        <option value="new">Apprentie</option>
                        <option value="membre">Oukkie</option>
                        <option value="admin">Admin</option>
                    </select></td>
            </tr>
        </table> <br>

        <input type="submit" name="forminscription" value="Création d'un nouveau compte">
    </form>
    <?php
    if(isset($erreur)){
       
        echo '<p>';
        echo   '<font color="red">'.$erreur.'</font>';
        echo '</p>';
    }
    ?>
</main>

<?php require '../../templates/bottom.php'?>
