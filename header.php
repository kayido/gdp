
<?php 
    require('function.php');
    require("connexion.php");
    $user = $_SESSION["username"];
    $rightreq = mysqli_query($con,"SELECT id_u,nom_u,pp,id_u,droit FROM utilisateurs WHERE login ='$user'");
    $datareq = mysqli_fetch_assoc($rightreq);
    extract($datareq);
    $right = explode(",",$datareq["droit"]);
    $info = [
        "id_u" => $id_u,
        "nom_u" => $_SESSION["username"]
    ];
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="pragma" content="no-cache">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <title>Dashbord</title>
</head>
<body>
    <div class="sidebar">
        <header>
            <img src="image_bdd/<?= $datareq["pp"] ?>" class="image-side"> 
            <?= $datareq["nom_u"] ?>
        </header>
        <ul>
            <li><a href="dashbord.php"><i class="fas fa-qrcode"></i>Dashbord</a></li>
            <?php if(el_exist($right,"projet") || el_exist($right,"tache")): ?>
            <li><a href="projets.php"><i class="fas fa-sliders-h"></i>Projets</a></li>
            <?php endif; ?>
            <?php if(el_exist($right,"tache")): ?>
            <li><a href="analyse/taches.php"><i class="fas fa-stream"></i>taches</a></li>
            <?php endif; ?>
            <?php if(el_exist($right,"client")):?>
            <li><a href="contacts.php"><i class="fas fa-phone"></i>Conctacts</a></li>
            <?php endif; ?>
            <?php if(el_exist($right,"personnel")):?>
            <li><a href="personnel/personnel.php"><i class="far fa-address-book"></i>personnels</a></li>
            <?php endif; ?>
            <li><a href="param/parametre.php"><i class="fas fa-cogs"></i>parametre</a></li>
            <?php if(el_exist($right,"historique")):?>
            <li><a href="historique.php"><i class="fas fa-question-circle"></i>historique</a></li>
            <?php endif; ?>
            <li class="deconnexion"><a href="deconnexion.php" ><i class="fa fa-sign-out-alt"></i>deconnexion</a></li>
        </ul>
    </div>
    <div class="header">
        <div class="btn-side">
            <i class="fas fa-bars" id="bars"></i>
        </div>
        <div class="logo">
            
            <h2>africa's <span>services</span></h2>
        </div>
    </div>
    <div class="container">
        