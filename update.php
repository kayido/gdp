<?php
    require "connexion.php";
    require "function.php";
    
    $id = $_GET["id"];
    $class = $_GET["class"];
    if($class == 1){
        $upd = mysqli_query($con,"UPDATE personnel SET etat = 'accept' WHERE id_perso = '$id'");
        require("mail/sendmailpersonnel.php");
        echo "<script>alert('mail envoyé')</script>";    
        echo "<script>window.location = 'personnel/personnel.php'</script>";    
    }

?>