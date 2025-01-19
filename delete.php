<?php 
session_start();
require "connexion.php";
require "header.php";
$class = $_GET["class"];
$id = $_GET["id"];

switch($class):
    case 3 :
        echo"ajouter un client";
        $abs = mysqli_query($con,"SELECT * from projet WHERE id_client ='$id'");
        if(!$abs){
            echo mysqli_error($con);
        }else{
           if( $rep = mysqli_fetch_assoc($abs)){
                $v = $rep["id_client"];
           }else{
                $v = 0;
           }
        }
                        
    break;
    case 7 :
        $abs = mysqli_query($con,"SELECT id_pro from tache WHERE id_pro ='$id'");
        if(!$abs){
            echo mysqli_error($con);
        }else{
           if( $rep = mysqli_fetch_assoc($abs)){
                $v = $rep["id_pro"];
           }else{
                $v = 0;
           }
        }
    
    break;
    case 5 :
        echo "ajouter une tache";
        $abs = mysqli_query($con,"SELECT id_pro from tache WHERE id_pro ='$id'");
        if(!$abs){
            echo mysqli_error($con);
        }else{
           if( $rep = mysqli_fetch_assoc($abs)){
                $v = $rep["id_pro"];
           }else{
                $v = 0;
           }
        }
    
    break;
    case 2 : 
        echo "ajouter un projet";
        $abs = mysqli_query($con,"SELECT id_pro from projet WHERE id_pro ='$id'");
        if(!$abs){
            echo mysqli_error($con);
        }else{
           if( $rep = mysqli_fetch_assoc($abs)){
                $v = $rep["id_pro"];
           }else{
                $v = 0;
           }
        }
    break;
    case 1 : 
        echo "ajouter un projet";
        $abs = mysqli_query($con,"SELECT id_pro from projet WHERE id_pro ='$id'");
        if(!$abs){
            echo mysqli_error($con);
        }else{
           if( $rep = mysqli_fetch_assoc($abs)){
                $v = $rep["id_pro"];
           }else{
                $v = 0;
           }
        }
    break;
endswitch;

if($class == 1){
    $req =mysqli_query($con,"DELETE FROM personnel WHERE id_perso = '$id'");
    $req = mysqli_query($con,"SELECT * FROM tache WHERE id_tache = '$id'");
    $count = mysqli_num_rows($req);
    echo $count;
    if($count > 0 ){
        while($row = mysqli_fetch_assoc($req)){
            $od = $row["id_tache"];
            $req =mysqli_query($con,"DELETE FROM tache WHERE id_tache = '$od'");
        }    
    }else if($count <= 0){
        echo "<script>window.location = 'personnel/personnel.php'</script>";    
    }
    $actor = $info["id_u"];
    $atvdesc = "suppresion d' un personnel ";
    $upd = mysqli_query($con,"INSERT INTO  activite VALUES (null,CURRENT_TIMESTAMP,'$atvdesc','$actor','$v','0')");
    echo "<script>window.location = 'personnel/personnel.php'</script>";    
    
}else if($class == 2){
    $req =mysqli_query($con,"DELETE FROM projet WHERE id_pro = '$id'");
    $sel = mysqli_query($con,"SELECT id_tache,n_pro FROM tache JOIN projet ON projet.id_pro = tache.id_pro WHERE projet.id_pro ='$id'");
    while($row = mysqli_fetch_assoc($sel)){
        $name = $row["n_pro"];
        $od = $row["id_tache"];
        $req = mysqli_query($con,"DELETE FROM fichier WHERE id_tache = '$od'");
    }                                                                    
    $req = mysqli_query($con,"DELETE FROM tache WHERE id_pro= '$id'");
    $req = mysqli_query($con,"DELETE FROM versement WHERE id_pro= '$id'");
    $actor = $info["id_u"];
    $atvdesc = "suppresion du projet: $name ";
    $upd = mysqli_query($con,"INSERT INTO  activite VALUES (null,CURRENT_TIMESTAMP,'$atvdesc','$actor','$v','0')");
    
    if(!$req){
        echo "suppression echoué";
    }else{
        echo "<script>window.location = 'projets.php';</script>";    
    }
}else if($class == 3){
    
 
    $sel = mysqli_query($con,"SELECT id_tache FROM tache JOIN projet ON projet.id_pro = tache.id_pro JOIN client ON client.id_client = projet.id_client WHERE projet.id_client ='$id'");
    while($row = mysqli_fetch_assoc($sel)){
        $od = $row["id_pro"];
        $sel = mysqli_query($con,"SELECT id_tache FROM tache JOIN projet ON projet.id_pro = tache.id_pro WHERE projet.id_pro ='$od'");
        while($row = mysqli_fetch_assoc($sel)){
            $ud = $row["id_tache"];
            $req = mysqli_query($con,"DELETE FROM fichier WHERE id_tache = '$ud'");
        }    
        $req = mysqli_query($con,"DELETE FROM tache WHERE id_tache = '$od'");
        $req = mysqli_query($con,"DELETE FROM versement WHERE id_pro= '$od'");
    }                                                                    
    $sel = mysqli_fetch_assoc(mysqli_query($con,"SELECT nom_client FROM client WHERE id_client ='$id'"));
    $name = $sel["nom_client"];
    $req =mysqli_query($con,"DELETE FROM projet WHERE id_client = '$id'");
    $req =mysqli_query($con,"DELETE FROM client WHERE id_client = '$id'");
    $actor = $info["id_u"];
    $atvdesc = "suppresion du client: $name ";
    $upd = mysqli_query($con,"INSERT INTO  activite VALUES (null,CURRENT_TIMESTAMP,'$atvdesc','$actor','$v','0')");
    if(!$req){
        echo "suppression echoué";
    }else{
        echo "<script>window.location = 'contacts.php'</script>";    

    }
}
else if($class == 5){
    $sel = mysqli_fetch_assoc(mysqli_query($con,"SELECT nom_tache FROM tache WHERE id_tache ='$id'"));
    $name = $sel["nom_tache"];
    $req = mysqli_query($con,"DELETE FROM tache WHERE id_tache ='$id'");
    $req = mysqli_query($con,"DELETE FROM fichier WHERE id_tache = '$id'");
    $actor = $info["id_u"];
    $atvdesc = "suppresion du client: $name ";
    $upd = mysqli_query($con,"INSERT INTO  activite VALUES (null,CURRENT_TIMESTAMP,'$atvdesc','$actor','$v','0')");
    echo "<script>window.location = 'projet/tache-projets.php?id=$id'</script>"; 

    
}else if($class == 6){
    $req = mysqli_query($con,"DELETE FROM versement WHERE id_verse ='$id'");
}else if($class == 7){
    $req = mysqli_query($con,"DELETE FROM utilisateurs WHERE id_u ='$id'");
    $actor = $info["id_u"];
    $atvdesc = "suppresion d'un utilisateur";
    $upd = mysqli_query($con,"INSERT INTO  activite VALUES (null,CURRENT_TIMESTAMP,'$atvdesc','$actor','$v','0')");
    echo "<script>window.location = 'utilisateur/utilisateur.php'</script>";    

}else if($class == 8){
    $req =mysqli_query($con,"DELETE FROM personnel WHERE id_perso = '$id'");
    echo "<script>window.location = 'personnel/candidat.php'</script>";    


}

















?>
