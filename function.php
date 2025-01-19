<?php

function el_exist($rigth, $value){
    for($i =0 ; $i< count($rigth) ; $i++){
        if($rigth[$i] === $value){
            return true;
        }
    }
}
function formimg($FILES,$name,$email,$tel,$adress,$birth){
    
    if(!empty($_FILES['pf']) && isset($name) && isset($email) && isset($tel) && isset($adress) && isset($birth)){
        $img_nom=$_FILES['pf']['name'];
        $tmp_nom = $_FILES['pf']['tmp_name'];
        $time =time();
        $nouveau_nom_img = $time.$img_nom;
        $deplacer_img = move_uploaded_file($tmp_nom,"image_bdd/".$nouveau_nom_img);
        if($deplacer_img){
            return $nouveau_nom_img;
        }
    }else{
            $message = "veuillez choisir une image de taille inferieru a 1Mo";
    }
}
function actualiser($id){
    require("connexion.php");
    $od = $id;
    $req = mysqli_query($con,"SELECT * FROM tache WHERE tache.id_tache = '$id'");
    $rep = mysqli_fetch_assoc($req);
    $id =$rep["id_programm"];
    $req = mysqli_query($con,"SELECT * FROM programmer WHERE id_programm = '$id'");
    $rep = mysqli_fetch_assoc($req);
    $id =$rep["condition"];
    $liste = explode(",",$id);
    print_r($liste);
    $k=0;
    for($i=0;$i<count($liste);$i++){
        $req = mysqli_query($con,"SELECT * FROM tache WHERE tache.id_tache = '$id'");
        $rep = mysqli_fetch_assoc($req);
        $statut = $rep["statut_tache"];
        if($statut == "termine"){
            $k++;
        }
        if($id==0){
            $k++;
        }
    }
    if($k == 3){
        $upd = mysqli_query($con,"UPDATE tache SET id_programm = '0' WHERE id_tache = $od");        
    }else{
        echo "il y a encore de la marge";
        echo $k;
        
    }
}
function update(){
    require("connexion.php");
    $id = $_GET["id"];
    $req2 = mysqli_query($con,"SELECT * FROM projet JOIN client ON client.id_client = projet.id_client JOIN tache ON tache.id_pro =  projet.id_pro JOIN personnel ON personnel.id_perso = tache.id_perso WHERE projet.id_pro = '$id' AND tache.statut_tache != 'termine' AND tache.id_programm = '0'");
    while($row2 = mysqli_fetch_assoc($req2)): 
        $date = time();        
        $id2 = $row2['id_tache'];
        if($row2['statut_tache'] != 'termine'){           
            $date_tmp1 = strtotime($row2['date_debut']);
            $date_tmp2 = strtotime($row2['date_fin']) + 86400;
            if($date_tmp1 < $date && $date_tmp2 > $date){
                $statut = "en cours";
            }else if($date_tmp1>$date){
                $statut = "en attende";
            }else if($date_tmp2<$date){
                $statut = "retard";
            }
            $upd = mysqli_query($con,"UPDATE tache SET statut_tache = '$statut' WHERE id_tache = $id2");
            if(!$upd){
                echo "erreur dans la requete update".mysqli_error($con);
            }
        }
    endwhile;
    }