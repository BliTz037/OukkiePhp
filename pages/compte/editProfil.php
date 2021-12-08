<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', 'root');

if(isset($_SESSION['id'])){
    
   $requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $userinfo = $requser->fetch();

?>


<?php require '../../templates/top.php'?>
<?php
         if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
         ?>
<nav class="navProfil">

    <ul>
        <li><a href="../serverRP/serverrp.php">ServerRP</a></li>
        <li><a href="../player/player.php">Starter Pack</a></li>
        <li><a href="">BlackList</a></li>
        <li><a href="editProfil.php">Éditer le profil</a></li>
        <li><a href="déconnexion.php">Déconnexion</a></li>
    </ul>
</nav>
<?php
         }
         ?>

<main>
    <h2>Edition du profil</h2>
    <form method="POST" action="">
        <table align="center">
            <tr>
                <td><label for="newpseudo">Pseudo :</label></td>
                <td><input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $userinfo['pseudo']; ?>" /></td>
            </tr>
            <tr>
                <td><label for="newmdp1">Nouveau mot de passe :</label></td>
                <td><input type="text" name="newmdp1" placeholder="Mot de passe" /></td>
            </tr>
            <tr>
                <td><label for="newmdp1">Confirmer le nouveau mot de passe :</label></td>
                <td><input type="text" name="newmdp2" placeholder="Confirmation du Mot de passe" /></td>
            </tr>
        </table>
    </form>


</main>

<?php require '../../templates/bottom.php'?>

<?php
}
   else{
       header("Location: compte.php");
   }
?>
