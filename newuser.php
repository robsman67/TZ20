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

try{
    $bdd =new PDO ('mysql:host=127.0.0.1;dbname=tz20;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }

if(isset($_POST['connexion'])){


    $login=htmlentities(trim($_POST['pseudo']));  //hmtlentities pour sécurisé
    $password=htmlentities(trim($_POST['password']));
    $name=htmlentities(trim($_POST['nom']));
    $firstname=htmlentities(trim($_POST['prenom']));

if($login && $password && $name && $firstname){

    $reqlogin = $bdd ->prepare("SELECT * FROM utilisateur WHERE login = ?");
    $reqlogin -> execute(array($login));
    $loginexist = $reqlogin ->rowCount();
   
    if ($loginexist == 0){
        $connexion= $bdd-> prepare("INSERT INTO utilisateur (nom, prénom, login, password) 
        VALUES (?,?,?,?)");
        $connexion->execute(array($name, $firstname, $login, $password));
        header("Location: connexion.php?)");
    }else $erreur='ce pseudo existe deja';
   
// date pas bonne

//je renvoie vers la page de connexion pour qu'il se connecte car sinon
// j'arrive pas à recuperer les infos pour afficher ses infos dans connectez.php


}else $erreur='remplir le formulaire svp';


}
?>
<section class="login">
<div>
    <h1>S'inscrire</h1>
    <form method="post" action ="">
        
        <input type="text" placeholder ="Votre nom" name="nom"/>
        <input type="text" placeholder ="Votre prenom" name="prenom"/>
        <input type="text" placeholder ="Votre pseudo" name="pseudo"/>
        <input type="password" placeholder ="Votre mot de passe" name="password"/>
        <input type="submit" name="connexion" value="Créez son compte"/>
        
    </form>
    <a href="connexion.php"title="nouveau utilisateur"> Se connecter <br></a>
    <p class="erreur">
    <?php 
    if(isset($erreur)){
        echo $erreur;
    }
    ?>
    </p>
    </div>
    </section>
    </body>
</html>
