<!DOCTYPE html>
<?php 
    require("../connexion.php"); 
    
    $info =  $_SESSION["username"];
    $eq = mysqli_query($con,"SELECT * FROM personnel WHERE login_perso = '$info'");
    $req = mysqli_fetch_assoc($eq);
    $id = $req["id_perso"]; 
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="pragma" content="no-cache">
    <link rel="stylesheet" href="users.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <title>Dashbord</title>
</head>
<body>
    <div class="sidebar">
        <header>
            <img src="../image_bdd/<?= $req["photo"]?>" class="image-side"> 
            <?= $req["nom_perso"] ?>
        </header>
        <ul>
            <li><a href="index2.php"><i class="fas fa-qrcode"></i>Dashbord</a></li>
            <li><a href="taches.php"><i class="far fa-address-book"></i>taches</a></li>
            <li><a href="parametre.php"><i class="fas fa-link"></i>parametre</a></li>
            <li class="deconnexion"><a href="deconnexion.php" ><i class="fa fa-sign-out-alt"></i>deconnexion</a></li>
        </ul>
    </div>
    <div class="header">
        <div class="btn-side">
            <i class="fas fa-bars" id="bars"></i>
        </div>
        <div class="logo">
            <div class="tools-bar">
                <span>0</span>
                <i class="far fa-bell"></i>
            </div>
            <h2>africa's <span>services</span></h2>
        </div>
        </div>
    <div class="container">
        