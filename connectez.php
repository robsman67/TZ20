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

    $bdd = get_db();
        if(isset($_GET['id']) && $_GET['id'] == $_SESSION['id'] && $_GET['id'] > 0){
            $getid = intval($_GET['id']);
            $requser = $bdd -> prepare("SELECT * FROM utilisateur WHERE id = ?");
            $requser-> execute(array($getid));
            $userinfo = $requser->fetch(); 
        }else header('Location: connexion.php');

    function make_produits($categorie_id) {
	    $bdd = get_db();
	    if (is_null($bdd))
		    return '';

    $affichage =$bdd->prepare("SELECT Nom, id FROM produit INNER JOIN catégorie_produit ON ID_produit=id AND ID_nom_catégorie=?");
		    $affichage->execute(array($categorie_id));
		    $retour = '';
	while (($line = $affichage->fetch()) == true){
        $retour .= "<a href=\"produit.php?id=" . $line['id'] . "\">" . $line['Nom'] . "<br> </a> <br>";
    
    }
	return $retour;    
	}

    function make_categories() {
	    $bdd = get_db();
	    if (is_null($bdd)){
		    return '';
        }

	    $affichage = $bdd->prepare("select ID_nom_categorie, nom_categorie from nom_catégorie;");
	    $affichage->execute();
	    $retour = '';
	    while (($line = $affichage->fetch(PDO::FETCH_NUM)) == true)
		    $retour .= "<option value=\"$line[0]\">$line[1]</option>";
	    return $retour;
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
        
?>
<section class="login">
<div>
    <h1>Bienvenu <?php echo $userinfo['login']; ?></h1>
<p class="lien">
<?php if (isset($_POST['catego'])) 
	echo make_produits($_POST['catego']);
?>
</p>
    <form method="post" action ="">
    <label for="catego">Liste de catégorie</label> <br>
    <select name="catego" id="catego">
	<?php echo make_categories();  ?>
    </select> <br>
    <input type="submit" value="recherchez"/>
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
