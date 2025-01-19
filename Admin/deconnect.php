<?php
    require 'connexion.php';
    $req = mysqli_query($con,"UPDATE admin set last_time = CURRENT_TIMESTAMP WHERE id=1");
    if($req){
        setcookie("jeton");
        header("location:/new/Admin/admin_conn.php");
    }else{
        echo "erreur de deconnexion";
    }
    
?>