<?php
    session_start();
    if(isset($_SESSION["con"])):
?>
<?php require("header.php"); ?>
<?php require("../connexion.php"); ?>
<?php require("../function.php"); ?>
<?php 
    
?>
<div class="main-task-project">
    <div class="option">
        <button>taches</button>
        <button>fichiers</button>
        <button>activités</button>
    </div>    
    <div class="task_block menu_taches" >
        <div class="head-task-project">
            <h2>taches</h2>
            <div class="search-bar">
                <input type="search" onkeyup="test()" id="search">
            </div>
        </div>
        <div class="show-task">
            <?php 
                if(isset($_POST["submit-task"])){
                    extract($_POST);
                    $id_perso_activite = $id;
                    for($i=0;$i<COUNT($task);$i++){
                        $j = $task[$i];
                        $t = mysqli_query($con,"SELECT nom_tache,id_pro  FROM tache where id_tache = '$j'");
                        $actor = mysqli_fetch_assoc($t);
                        $v = $actor["id_pro"];
                        $atv_desc= "validation de la tache :".$actor["nom_tache"];
                        $req = mysqli_query($con,"UPDATE tache SET statut_tache = 'termine' WHERE id_tache ='$j'");
                        
                        $sql =  mysqli_query($con,"SELECT * FROM tache WHERE id_programm != '0' ");
                        while($dat = mysqli_fetch_assoc($sql)){
                            $rid = $dat["id_tache"];
                            actualiser($rid);
                        }

                        $atv = mysqli_query($con, "INSERT INTO activite VALUES(null,CURRENT_TIMESTAMP,'$atv_desc','0','$v','$id_perso_activite')");
                        if(!$atv){
                            echo "erreur activite ".mysqli_error($con);
                        }
                    }
                }
            ?>
            <form method = "post">
            <table id="sugg">
                    <tr>
                        <th style="width: 10px; text-align: left;"></th>
                        <th class="td-1" style="width: 50px; text-align: left;">N°</th>
                        <th style="width: 15%; text-align: center;">titre</th>
                        <th style="width: 25%; text-align: left;" >description</th>
                        <th style="width: 10%; text-align: center;" >debut</th>
                        <th style="width: 10%; text-align: center;" >fin</th>
                        <th style="width: 10%; text-align: center;" >projet</th>
                        <th style="width: 10%; text-align: center;">cout</th>
                        <th>statut</th>
                    </tr>
                    <?php 
                        $req2 = mysqli_query($con,"SELECT * FROM projet JOIN client ON client.id_client = projet.id_client JOIN tache ON tache.id_pro =  projet.id_pro JOIN personnel ON personnel.id_perso = tache.id_perso WHERE personnel.id_perso = '$id' AND tache.statut_tache != 'termine' AND tache.statut_tache != 'en attende' AND tache.id_programm = '0'");
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
                    ?>
                    <tr class="hover calc">  
                        <td style="width: 10px; text-align: left;"><input type="checkbox" name="task[]" value='<?=$row2["id_tache"]?>'></td>
                        <td class="td-1" style="width: 50px; text-align: left;"><?= $row2["id_tache"] ?></td>
                        <td style="width: 20%; text-align: center;"><?= $row2["nom_tache"] ?></td>
                        <td style="width: 20%; text-align: center;" ><?= $row2["description"] ?></td>
                        <td style="width: 10%; text-align: center;" ><?= $row2["date_debut"] ?></td>
                        <td style="width: 10%; text-align: center;" ><?= $row2["date_fin"] ?></td>
                        <td style="width: 10%; text-align: center;" ><?= $row2["n_pro"] ?></td>
                        <td style="width: 10%; text-align: center;"><?= $row2["cout"] ?></td>
                        <td 
                            <?php
                            if($row2['statut_tache'] == "en cours"){ ?>
                               id= "tache_continue" 
                            <?php }else if($row2['statut_tache'] == "termine"){?>
                                id= "tache_finish" 
                            <?php } else if($row2['statut_tache'] == "retard"){?>
                                id = "tache_retard"
                            <?php }  else if($row2['statut_tache'] == "en attende"){?>
                                id = "tache_attende";
                            <?php } ?>
                        
                            class="filt" style="text-align: center; margin-top: 12px;width: 200px; margin-left: 20px;"><?= $row2['statut_tache'] ?></td>
                                               
                        </td>            
                    </tr>

                    <?php 
                        endwhile;
                    ?>
                </table>
                <div class="button">
                    <button><a href="#" id="select_task_all">tout selectionner</a></button>
                    <button type="submit"  name="accomplished">accomplie</button>
                    <button type = "submit" name="submit-task" >valider une tache</button>
                </div>
            </form>                
        </div>
        
    </div>
    <div class="fichier_project menu_taches" style="display: none;">
        <div class="head-task-project">
            <h2>fichier</h2>
        </div>
        
        <form method = "post">
            <table id="sugg">
                <tr>
                    <th style="width: 10px; text-align: left;"></th>
                    <th class="td-1" style="width: 5%; text-align: left;">N°</th>
                    <th style="width: 15%; text-align: center;">nom_fichier</th>
                    <th style="width: 10%; text-align: center;" >tache</th>
                    <th style="width: 100px; text-align: center;">action</th>
                </tr>
                <?php 
                    $req = mysqli_query($con,"SELECT * FROM fichier JOIN tache ON tache.id_tache = fichier.id_tache JOIN personnel ON personnel.id_perso = tache.id_perso WHERE personnel.id_perso ='$id'");
                    while($row = mysqli_fetch_assoc($req)):
                ?>
                <tr class="cells">
                    <td style="width: 10px; text-align: left;"><input type="checkbox"></td>
                    <td class="td-1" style="width: 5%; text-align: left;"><?= $row["id_fic"] ?></td>
                    <td style="width: 15%; text-align: center;"><?= $row["nom_fic"]?></td>
                    <td style="width: 10%; text-align: center;" ><?= $row["nom_tache"]?></td>
                    <td>
                        <a download="<?=$row["path"]?>" href=""><i class="fas fa-download"></i></a>
                    </td>
                </tr>
                <?php endwhile; ?>               

            </table>
            <div class="button">
                <button><a href="#" id="select_task_all">tout selectionner</a></button>
                <button type="button" class="btn btn-new-task btn-modal-task">importer un fichier</button>
            </div>
        </form>
    </div>
    <div class="activity menu_taches">
        <div class="head-activity">
            <h2>rapport d'activité</h2>
            <div class="menu">
                <form>
                    <caption>filtrer</caption>
                    <input type="date">
                    <input type="time">
                    <button><i class="fas fa-filter"></i></button>
                </form>
            </div>
        </div>
        <div class="activity-content">
            <?php 
                $req = mysqli_query($con,"SELECT * FROM activiteperso JOIN personnel on personnel.id_perso = activiteperso.id_perso WHERE personnel.id_perso = '$id' ORDER BY activiteperso.d_atv DESC");
                if(!$req){
                    echo mysqli_error($con);
                }
                while($row = mysqli_fetch_assoc($req)):
            ?>
            <div class="atv">
                <p><?= $row["d_atv"] ?></p>
                <p><?= $row["desc_atv_perso"] ?></p>
                <p><?= $row["nom_perso"] ?></p>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>
</div>
<script>
        let c = document.getElementById("search")
        function find(t, a){
            if(t.search(a)){
                return true;
            }
        }
        function test(){
        
            b = document.getElementsByName("tbody");
            tr =document.querySelectorAll(".show-task table .calc");

            tr.forEach(element => {
               
                let word = element.cells[2].innerText;
                
                if(find(word,c.value)){
                    element.style.display = "none";
                }else{
                    
                    element.style.display = "table-row";
                }
            });

        }
        
    </script>

<?php require("footer.php");?>
<?php else:
    header("Location: index.php");
endif; ?>
