<?php
    session_start();
    if(isset($_SESSION["connected"])):
?>
<?php    
    require_once ("header.php");
?>
<style>
    .main-create .taches form{
        display : flex;
        flex-direction : column;
        gap : 10px;
    }
     form textarea{
        width : 100%;
        height : 100px;
        resize : none;
        text-align : justify;
        font-size : 1.1em;
        font-family: 'Times New Roman', Times, serif;
    }
    form .progr{
        display : flex;
        flex-direction : row;
        justify-content : space-between;
        border : 3px violet solid;
        padding : 10px 10px;
    }
    form .progr div{
        width : calc(80%/3);
    }
</style>
<div class="main-create">
    <h2>programmer une tache</h2>
    <hr>
    <div class="taches">
        <?php                 
            $req3 = mysqli_query($con,"SELECT * FROM projet where id_pro = '$id' ");
            $row3 = mysqli_fetch_assoc($req3);
        ?>
        <?php 
            if(isset($_POST["submit-tache"])){
                extract($_POST);
                $req = mysqli_query($con,"SELECT * FROM projet WHERE id_pro = '$id'");
                $fd = mysqli_fetch_assoc($req);
                $fond = $fd["fd"];
                $t_projet = $row3["id_pro"];
                if(!empty($nom_tache) && !empty($date_debut_tache) && !empty($date_fin_tache) && !empty($cout_tache) AND !empty($perso) AND !empty($t_projet)){
                    if(!empty($_FILES["pf"]["name"])){
                        $img_nom=$_FILES['pf']['name'];
                        $tmp_nom = $_FILES['pf']['tmp_name'];
                        $time =time();
                        $nouveau_nom_img = $time.$img_nom;
                        $deplacer_img = move_uploaded_file($tmp_nom,"image_bdd/".$nouveau_nom_img);
                    }           
                    if($cout_tache<$fond){
                        $line = $pro1.",".$pro2.",".$pro3;
                        $sql = mysqli_query($con,"INSERT INTO programmer VALUES(null,'$line')");
                        
                        $max = mysqli_query($con,"SELECT max(id_programm) as id FROM programmer");
                        $max = mysqli_fetch_assoc($max);
                        $max = $max["id"];
                

                        $req = mysqli_query($con,"INSERT INTO tache (id_tache,nom_tache,description,date_debut,date_fin,cout,id_pro,id_perso,id_programm) 
                        values(null,'$nom_tache','$description','$date_debut_tache','$date_fin_tache','$cout_tache','$t_projet','$perso','$max')");
                        $soust = $fond - $cout_tache;
                        $upd = mysqli_query($con,"UPDATE projet SET fd ='$soust' WHERE id_pro = '$id'");
                        $actor = $info["id_u"];
                        $atvdesc = "creation d une nouvelle tache : $nom_tache ";
                        $upd = mysqli_query($con,"INSERT INTO  activite VALUES (null,CURRENT_TIMESTAMP,'$atvdesc','$actor','$id','0')");
                        if(!$upd){
                            echo mysqli_error($con);
                        }else{
                            if(!empty($_FILES["pf"]["name"])){
                                if($req){
                                    $idr = mysqli_query($con, "SELECT max(id_tache) as id FROM tache");
                                    if(!$idr){
                                        echo mysqli_error($con);
                                    }
                                    $od = mysqli_fetch_assoc($idr);
                                    $rid = $od["id"];
                                    $img = mysqli_query($con,"INSERT INTO fichier values(null,'$img_nom','$nouveau_nom_img','$rid')");
                                    if(!$img){
                                        echo "fichier non importer".mysqli_error($con);
                                    }
                                    echo "<script>alert('tache creer avec sucess')</script>";
                                }else{
                                    echo "<p style='color:red;font-size:1.1em;text-align:center;'>tache failed</p>";
                                }
                                
                            }
                            // header("Location: task-projects.php?id=$id");
                        }
                    }else{
                        echo "<script>alert('fond indisponible')</script>";
                    }
                }else{
                    echo "<p style='color:red;font-size:1.1em;text-align:center;'>remplisser toute les informations</p>";
                }     
            }
        ?>
        <form method="post" class="form-tache" enctype="multipart/form-data">
           
            <input type="text " disabled  value="<?= $row3["n_pro"] ?>">
            <div>
                <label for="">nom de la tache</label>
                <input type="text" id="nom_tache" name="nom_tache">
           </div>
           <div>
                <label>Description</label>
                <textarea name="description">

                </textarea>
           </div>
           <div>
                <label for="">date de debut</label>
                <input type="date" name="date_debut_tache" >    
           </div>
           <div>
                <label for="date_fin">date de fin</label>
                <input type="date" name="date_fin_tache" >
           </div>
           <div>
                <label for="cout-tache">budjet</label>
                <input type="number" id="cout_tache" name="cout_tache">    
           </div>
            <div>
                <label for="doing">assigné a</label>
                <select name="perso" label="choisir le personnel">
                    <optgroup label="internes">
                        <?php 
                            $req2 = mysqli_query($con,"SELECT id_perso,nom_perso FROM personnel where statut = 'interne'");
                            while($row2 = mysqli_fetch_assoc($req2)):
                        ?>
                            <option value="<?= $row2["id_perso"] ?>"><?= $row2["nom_perso"]?></option>
                        <?php endwhile; ?>
                    </optgroup>
                    <optgroup label="externes">
                        <?php 
                            $req2 = mysqli_query($con,"SELECT * FROM personnel where statut = 'externe'");
                            while($row2 = mysqli_fetch_assoc($req2)):
                        ?>
                            <option value="<?= $row2["id_perso"] ?>"><?= $row2["nom_perso"]?></option>
                        <?php endwhile; ?>
                    </optgroup>
                </select>    
            </div>
            <div>
                <label>importer le fichier de la tache(optionnel)</label>
                <input type="file" name="pf">    
            </div>
            <div>
                <label>condition</label>
                <div class="progr">
                    <div>
                        <label>1er condition</label>
                        <?php 
                            $req = mysqli_query($con,"SELECT * FROM projet JOIN client ON client.id_client = projet.id_client JOIN tache ON tache.id_pro =  projet.id_pro JOIN personnel ON personnel.id_perso = tache.id_perso WHERE projet.id_pro = '$id' AND tache.statut_tache != 'termine' ");
                        ?>
                        <select name='pro1'  label="none">
                            <option value='0'>none</option>
                            <?php 
                                while($row = mysqli_fetch_assoc($req)):
                            ?>
                            <option value="<?= $row["id_tache"] ?>"><?= $row["nom_tache"] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div>
                        <label>2eme condition</label>
                        <?php 
                            $req = mysqli_query($con,"SELECT * FROM projet JOIN client ON client.id_client = projet.id_client JOIN tache ON tache.id_pro =  projet.id_pro JOIN personnel ON personnel.id_perso = tache.id_perso WHERE projet.id_pro = '$id' AND tache.statut_tache != 'termine' ");
                        ?>
                        <select name='pro2'  label="none">
                            <option value='0'>none</option>
                            <?php 
                                while($row = mysqli_fetch_assoc($req)):
                            ?>
                            <option value="<?= $row["id_tache"] ?>"><?= $row["nom_tache"] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div>
                        
                        <label>3eme condition</label>
                        <?php 
                            $req = mysqli_query($con,"SELECT * FROM projet JOIN client ON client.id_client = projet.id_client JOIN tache ON tache.id_pro =  projet.id_pro JOIN personnel ON personnel.id_perso = tache.id_perso WHERE projet.id_pro = '$id' AND tache.statut_tache != 'termine' ");
                        ?>
                        <select name='pro3'  label="none">
                            <option value='0'>none</option>
                            <?php 
                                while($row = mysqli_fetch_assoc($req)):
                            ?>
                            <option value="<?= $row["id_tache"] ?>"><?= $row["nom_tache"] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                
            </div>            
            <input type="submit" name="submit-tache" id="submit_task" value="creer">
        </form>
    </div>
</div>
</div>
<?php require_once ("footer.php");?>
<?php else:
    header("Location: index.php");
endif; ?>


