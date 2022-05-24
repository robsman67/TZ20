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
        $connexion->execute(array($login,$password,$name,$firstname));
        header('Location: connectez.php');
    }else echo 'ce pseudo existe deja';

    

   
// date pas bonne, le reste marche




}else echo 'remplir le formulaire svp';


}
?>

<div align="center">
    <h2>S'Inscrire</h2>
    <form method="post" action ="">
        <table>
        <tr> <td>Nom:<input type="text" placeholder ="votre nom" name="nom"/> </td></tr><br>
        <tr><td>Prenom:<input type="text" placeholder ="votre prenom" name="prenom"/></td> </tr> <br>
        <tr><td>Pseudo:<input type="text" placeholder ="votre pseudo" name="pseudo"/></td> </tr><br>
        <tr><td>Mot de passe:<input type="password" placeholder ="votre mot de passe" name="password"/></td> </tr><br>
        <tr><td>Connexion:<input type="submit" name="connexion" /></td> </tr><br>

        </table>
        
    </form>
    <a href="index.php"title="nouveau utilisateur"> Se connecter </a>

    </div>
    </body>
</html>