<?php
    session_start();
    if(isset($_SESSION["connected"])):
?>
<?php  require_once ("header.php");?>
        <?php
            $req2 = mysqli_query($con,"SELECT * FROM projet JOIN client ON client.id_client = projet.id_client JOIN tache ON tache.id_pro =  projet.id_pro JOIN personnel ON personnel.id_perso = tache.id_perso WHERE projet.id_pro = '$id' AND tache.statut_tache != 'termine' AND tache.id_programm = '0'");
            $v = $data["id_pro"];
            $nn = $data["n_pro"];
            echo $v;
            // echo $nn;
            if(isset($_POST["suppress"])){
                extract($_POST);
                for($i=0;$i<count($select);$i++){
                    $od = $select[$i];
                    $req =mysqli_query($con,"DELETE FROM tache WHERE id_tache = '$od'");
                    $req =mysqli_query($con,"DELETE FROM fichier WHERE id_tache = '$od'");
                    $actor = $info["id_u"];
                    $atvdesc = "suppresion d'une tache du projet ";
                    // $m8 = mysqli_query($con,"INSERT INTO  activite VALUES(null,CURRENT_TIMESTAMP,'$atvdesc','1','$v','0')");
                    if(!$m8){
                        echo "erreur ".mysqli_error($con);
                    }else{
                        echo "tache bien effectue";
                    }
                    header("location : task-projets.php?id=$id");    
                    if(!$req){
                        echo "suppression echoué";
                    }else{
                        echo "<script>alert('suppresion reussi')</script>";
                    }
                }                
            }
            
        ?>
        
    <div class="task_block <?php if(el_exist($right,"tache")): ?>menu_project<?php endif; ?>" <?php if(!el_exist($right,"tache")): ?>style = "display : none;"<?php endif; ?> >
        <div class="head-task-project">
            <h2><?=$data["n_pro"]?></h2>
            <div class="search-bar">
                <form method="post">
                    <input type="search" onkeyup="test()" id="search" name="mot">
                </form><!-- <label><i class="fas fa-search"></i></label> -->
            </div>
            <div class="filter-task">
                <span class="filt-tout-task">tout</span>
                <span class="filt-enattente-task view-staff">en attende</span>
                <span class="filt-encours-task">en cours</span>
                <span class="filt-termine-task">termine</span>
                <span class="filt-retard-task">retard</span>
            </div>
        </div>
       
        <div class="show-task">
            <form method = "post">
                <table id="rem">
                    <tr>
                        <th style="width: 10px; text-align: left;"></th>
                        <th class="td-1" style="width: 50px; text-align: left;">N°</th>
                        <th style="width: 15%; text-align: center;">titre</th>
                        <th style="width: 25%; text-align: left;" >description</th>
                        <th style="width: 10%; text-align: center;" >debut</th>
                        <th style="width: 10%; text-align: center;" >fin</th>
                        <th style="width: 10%; text-align: center;" >personnel</th>
                        <th style="width: 10%; text-align: center;">cout</th>
                        <th>statut</th>
                    </tr>
                    <tbody>
                    <?php 
                        
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
                        <td style="width: 10px; text-align: left;"><input type="checkbox" name="select[]" value = "<?=$row2["id_tache"]?>"></td>
                        <td class="td-1" style="width: 50px; text-align: left;"><?= $row2["id_tache"] ?></td>
                        <td style="width: 20%; text-align: center;"><?= $row2["nom_tache"] ?></td>
                        <td style="width: 20%; text-align: center;" ><?= $row2["description"] ?></td>
                        <td style="width: 10%; text-align: center;" ><?= $row2["date_debut"] ?></td>
                        <td style="width: 10%; text-align: center;" ><?= $row2["date_fin"] ?></td>
                        <td style="width: 10%; text-align: center;" ><?= $row2["nom_perso"] ?></td>
                        <th style="width: 10%; text-align: center;"><?= $row2["cout"] ?></th>
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
                    </tbody>
                </table>
                <table id="sugg"></table>
                <div class="button">
                    <button><a href="#" id="select_task_all">tout selectionner</a></button>
                    <button type="submit" value="supprimer la tache" name="suppress">supprimer</button>
                    <button type="button" class="btn btn-new-task ">
                        <a href="../create.php?class=3&id=<?=$id?>">nouveau tache</a></button>
                </div>
            </form>
            <?php 
                if($data["avan"] == 100):
            ?>
            <div class="end-projet">
                <?php 
                    if(isset($_POST["clear"])){
                        $ter = mysqli_query($con,"UPDATE projet SET stat ='termine' WHERE id_pro = '$id'");
                        if($ter){
                            echo "<script>alert('projet termine')</script>";
                        }
                        header("Location: projets.php");
                    }
                ?>
                <form method="post">
                    <button type="submit" name="clear">projet termine </button>
                </form>
            </div>                
            <?php endif; ?>
        </div>
        
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
            tr =document.querySelectorAll(".show-task form table tbody tr");

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

<?php require_once ("footer.php");?>
<?php else:
    header("Location: ../index.php");
endif; ?>