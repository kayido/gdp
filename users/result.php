<?php 
    require "connexion.php";
    $mot = @$_POST['mot'];
    $id = $_GET['id'];
    $sql = "SELECT * FROM tache WHERE nom_tache LIKE '%$mot%'";
    $results = mysqli_query($con,$sql);
    $json_array = array();
    echo "<table>";?>
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
                    <?php 
                        
                        while($row2 = mysqli_fetch_assoc($req6)): 
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
                </table>