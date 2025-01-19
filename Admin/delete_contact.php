<?php
    include "connexion.php";
    $id = $_GET['id'];
    $req = mysqli_query($con,"DELETE  FROM contacts WHERE id = $id");
    if(!$req){
        echo "suppression mal effectue";
    }
    header("location:/new/Admin/contacts.php");
?>
