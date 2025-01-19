<?php
    include "connexion.php";
    $id = $_GET['id'];
    $req = mysqli_query($con,"DELETE  FROM quote WHERE id = $id");
    if(!$req){
        echo "suppression mal effectue";
    }else{
        echo "element bien supprimer";
    }
    header("location:/new/Admin/quote.php");
?>
