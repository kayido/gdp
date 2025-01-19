<?php
require 'connexion.php';
if(isset($_POST['submit_con'])){
    $req = mysqli_query($con,"SELECT * FROM admin");
    if(!$req){
        echo "erreur de connexion";
    }
    if(!$req){
        echo "requete mal effectue";
    }else{
        $row = mysqli_fetch_assoc($req);
        if(isset($_POST['password']) && isset($_POST["nom_ad"])){
            if($_POST['password'] == $row['password'] && $_POST["nom_ad"] == $row["nom_ad"]){
                $jeton = $row["nom_ad"];
                setcookie("jeton", $jeton);
                header("location:/new/Admin/admin-in.php/");
            }else{
                $message  = "mot de passe ou identifiant incorrecte";
            }
       }else{
                $message = "veuillez remplir tous les champs";
        }
    }
}
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin-in.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>africa's <span>services</span></h1>
        <div class="wrapper_conn">
            <form method="post">
                <h1>admin</h1>
                <p style  ="color:red; text-align: center;" class="error_conn"><?php if(isset($message)) echo $message; ?></p>
                <label>nom de admin</label>
                <input type="text" name="nom_ad" id="nom_ad">
                <label>password</label>
                <input type="password" name="password" id="password">
                <input type="submit" id="submit_con" name="submit_con" value="se connecter">
            </form>
        </div>
    </div>
</body>
</html>