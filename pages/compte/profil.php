<?php

session_start();

$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', 'root');

if(isset($_GET['id']) AND $_GET['id'] > 0){
    
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
}

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
    <h2>Profil de <?php echo $userinfo['pseudo']; ?> </h2>
    <img src="https://minotar.net/avatar/<?php echo $userinfo['pseudo']; ?>">
    
    
    <p>Pseudo : <?php echo $userinfo['pseudo']; ?></p>
    <p>Grade : <?php echo $userinfo['grade']; ?></p>

</main>

<?php require '../../templates/bottom.php'?>

<?php
else {
       header("Location: compte.php");
   }
?>
