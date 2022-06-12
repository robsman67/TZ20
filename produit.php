<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Formulaire</title>
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
        $retour .= "<a href=\"produit.php?id=" . $line['id'] . "\">" . $line['Nom'] . "<br> </a>";
    
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
<div align="center">
    <h2>Bienvenu <?php echo $userinfo['login']; ?></h2>
<?php if (isset($_POST['catego'])) 
	echo make_produits($_POST['catego']);
?>
    <table>
    <form method="post" action ="">
        <tr> <td><label for="catego">Liste de catégorie</td>  </tr></label> 
        <tr> <td> <select name="catego" id="catego">
	<?php echo make_categories();  ?>
        </select></td> </tr> <br> <br>
        <tr> <td> <a href="deconnexion.php"> se deconnecter </a></td> </tr><br> <br>
        <tr> <td><input type="submit" value="recherchez"/> </td> </tr> <br> <br>
        <tr><td align="center"><input type="submit"  value ="Voir pannier" name="vpannier" /></td></tr> <br>
        
    </form>
    </table>

<?php 

$j=0;
    while(isset($tableau) && $j < $i ){
        echo $tableau[$j];
        echo $tableauprix[$j];
        $j = $j +1;
    }

    ?>

</div>
    </body>
</html>
