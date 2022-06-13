<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Formulaire</title>
    <link rel = "stylesheet" href = "style.css" />
</head>
<body>
<?php

    function get_db() {
	try {
	    $bdd =new PDO ('mysql:host=localhost;dbname=tz20;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
	    return $bdd;
        }
	    catch (Exception $e) {
		    return null;
	    }
    }

    $dbb = get_db();
    if($_GET['id'] > 0 ){
        $affich = $dbb -> prepare("SELECT Nom, Prix FROM produit WHERE id = ?");
        $affich -> execute(array($_GET['id']));
        while (($lin = $affich->fetch()) == true){
            $tabbleauproduit[0]= $lin['Nom'];
            $tabbleauproduit[1]= $lin['Prix'];
        }

    }

    $db = get_db();
    if(isset($_POST['pannier'])){
        $affi = $db -> prepare("INSERT INTO pannier (ID_produit, ID_utilisateur) VALUES (?,?)");
        $affi->execute(array($_GET['id'], $_SESSION['id']));
    }

    $dd = get_db();
    if(isset($_POST['vpannier'])){
       $affichage = $dd -> prepare("SELECT Nom, Prix FROM produit INNER JOIN pannier ON ID_produit = id AND ID_utilisateur = ?");
       $affichage->execute(array($_SESSION['id']));
       $retour = '';
       $i = 0;
       while (($line = $affichage->fetch()) == true){
        $retour = $line['Nom'] . " ";
        $prix = $line['Prix'] . "$ <br>";               
        $tableau [$i] = $retour;
        $tableauprix [$i] = $prix;
        $i = $i + 1;
       }      
   }
   $retou = '';
   $retou .= "<a href=\"connectez.php?id=" . $_SESSION['id'] . "\"> Retournez à la page principal  <br> </a>";

?>

<section class="login">
<div>   
    <form method="post" action ="">        
        <h1><?php 
        echo $tabbleauproduit[0] . "<br>";
        
        if($_GET['id'] == 3){
            ?>
            <img src = "PS5.jpg" alt ="Image de PS5" title ="La PS5"> <br>
            <?php
        }
        if($_GET['id'] == 5){
            ?>
            <img src = "XBOX.jpg" alt ="Image de Xbox serie X" title ="La XBOX"> <br>
            <?php
        }
        if($_GET['id'] == 7){
            ?>
            <img src = "ELDEN_RING.jpg" alt ="ELDEN_RING" title ="ELDEN RING"> <br>
            <?php
        }
        if($_GET['id'] == 8){
            ?>
            <img src = "GT7.jpg" alt ="Image de GT7" title ="GT7"> <br>
            <?php
        }
        echo $tabbleauproduit[1] . "$";
        ?></h1>
        <p class="lien">
        <?php echo $retou  ?></p>
        <input type="submit"  value ="Ajoutez au pannier" name="pannier" />
        <input type="submit"  value ="Voir pannier" name="vpannier" />
        <p class="lien"> <a href="deconnexion.php"> Se déconnecter </a> </p> 
        
    </form>
    
<p class="produit">
<?php 
$j=0;
    while(isset($tableau) && $j < $i ){
        echo $tableau[$j];
        echo $tableauprix[$j];
        $j = $j +1;
    }
    ?>
</p>

</div>
</section>
    </body>
</html>
