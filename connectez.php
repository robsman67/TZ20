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

try{
    $bdd =new PDO ('mysql:host=127.0.0.1;dbname=tz20;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }

    if(isset($_GET['id']) && $_GET['id'] > 0){
        $getid = intval($_GET['id']);
        $requser = $bdd -> prepare("SELECT * FROM utilisateur WHERE id = ?");
        $requser-> execute(array($getid));
        $userinfo = $requser->fetch();
    }
    
    if(isset($_POST['affichagecate'])){
        
        if(($_POST['catego']== '1')){

            
            }            

        }else if(($_POST['catego']== '2')){
           
            $affichage =$bdd->prepare("SELECT Nom FROM produit INNER JOIN categorie_produit ON ID_produit=id AND ID_nom_categorie=3");
            $affichage->execute();
            $affichageList = $affichage ->fetch();

            foreach ($affichageList as $affichageList){
                echo $affichageList['Nom']. '</br>';
        }

    }
        

?>
<div align="center">
    <h2>Bienvenu <?php echo $userinfo['login']; ?></h2>
    <table>
    <form method="post" action ="">
        <tr> <td><label for="catego">List de catégorie</td>  </tr></label> 
        <tr> <td> <select name="catego" id="catego">
            <option value="1" > Jeux</option>
            <option value ="2"> Console</option>
        </select></td> </tr> <br> <br>
        <tr> <td> <a href="deconnexion.php"> se deconnecter </a></td> </tr><br> <br>
        <tr> <td>recherchez:<input type="submit" name="affichagecate"/> </td> </tr> <br> <br>
     
    </form>
    </table>
</div>
    </body>
</html>
