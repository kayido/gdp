<?php 
    session_start(); 
    require_once("connexion.php");
    $req = mysqli_query($con,"SELECT login,pp,droit,pw FROM utilisateurs");
    
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="container">
        <h1>Africa's <span>Services</span></span></h1>
        <div class="form" action = "action.php">
            <?php
                if(isset($_POST["submit"])){
                    while($row = mysqli_fetch_assoc($req)){
                        extract($row);
                        if($_POST["login"] == $login AND $_POST["password"] == $pw){
                            $_SESSION["connected"] = "1234";
                            $_SESSION["username"] = $login;
                            $_SESSION["img"] = $pp;
                            $_SESSION["droit"] = $droit;
                            header("Location: dashbord.php");
                        }else{
                            $message = "mot de passe ou identifiant incorrect";
                        }
                    }
                }
            ?>
            <form method="post">
                <h2>login</h2>
                <p style="color:red;"><?php if(isset($message)){echo $message;}?><p>
                <label for="login">login</label>
                <input type="text" name="login"><br>
                <label for="password" >mot de passe</label>
                <input type="password" name="password"><br>
                <input type="submit" name="submit" id="submit" value="se connecter">
            </form>
        </div>
    </div>
</body>
</html>