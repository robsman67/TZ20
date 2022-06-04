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

if($login && $password){

    $username = $_POST['pseudo'];
    $stmt = $bdd->prepare("SELECT * FROM utilisateur WHERE login = ? AND password = ?");
    $stmt->execute(array($login, $password)); 
    $userexiste =$stmt ->rowCount();

    if ($userexiste == 1){
        $userinfo = $stmt ->fetch();
        $_SESSION['id'] = $userinfo ['id'];
        $_SESSION['pseudo'] = $userinfo ['login'];
        $_SESSION['password'] = $userinfo ['password'];
        header("Location: connectez.php?id=".$_SESSION['id']);
        
        
    }else {
        $erreur ='login ou mdp incorecte';
    }
    
} else $erreur ='remplir le formulaire svp';
}

?>

<div align="center">
    <h2>Se connectez</h2>
    <form method="post" action ="">
        <table>
            <tr>
                <td align="center">Login:<input type="text" placeholder ="votre pseudo" name="pseudo" id="pseudo"/></td> <br>
            </tr>
            <tr>
                <td align="center">Mot de passe:<input type="password" placeholder ="votre mot de passe" name="password"/></td> <br>
            </tr>
            <tr>
                <td align="center">Connexion:<input type="submit" name="connexion" /></td> <br>
            </tr>
            <tr>
                <td> </td>
            </tr>
        </table>
        
    </form>
    <a href="newuser.php"title="nouveau utilisateur"> Créez un compte <br /> </a>
    <?php 
    if(isset($erreur)){
        echo $erreur;
    }
    ?>

</div>
    </body>
</html>
