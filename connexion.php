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

if($login && $password){

    $username = $_POST['pseudo'];
    $stmt = $bdd->prepare("SELECT * FROM utilisateur WHERE login = ? AND password = ?");
    $stmt->execute(array($login, $password)); 
    $userexiste =$stmt ->rowCount();

    if ($userexiste == 1){
        $userinfo = $stmt ->fetch();
        $_SESSION['id'] = $userinfo ['id'];
        $_SESSION['pseudo'] = $userinfo ['login'];
    
        header("Location: connectez.php?id=".$_SESSION['id']);

    }else {
        $erreur ='Login ou mdp incorecte';
    }
    
} else $erreur ='Remplir le formulaire svp';
}
?>

<section class="login">
<div>
    <h2>Se connecter</h2>
    <form method="post" action ="">

        <input type="text" placeholder ="Votre pseudo" name="pseudo" id="pseudo"/>
        <input type="password" placeholder ="Votre mot de passe" name="password"/>
        <input type="submit" name="connexion" />
        
    </form>
    <p class="lien"><a href="newuser.php"title="nouveau utilisateur"> Créez un compte <br /> </a> </p>
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
