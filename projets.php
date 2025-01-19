<?php
    session_start();
    if(isset($_SESSION["connected"])):
?>
<?php require_once ("header.php");?>
<div class="main-projects">
    <div class="head-main-project">
        <h2>tous les projects</h2>
        <div class="search-bar">
            <input type="search" id="search" name="search" onkeyup="test()">
            <label><i class="fas fa-search"></i></label>
        </div>  
        <?php if(el_exist($right,"projet")): ?>
            <button class="btn"><a href="create.php?class=4">nouveau</a></button>
        <?php endif ;?>
    </div>
    <div class="show-projects">
        <table id="rem">
            <tr>
                <th style="width : calc(100%/7);">projects</th>
                <th style="width : calc(100%/7);">date debut</th>
                <th style="width : calc(100%/7);">date fin</th>
                <th style="width : calc(100%/7);">client</th>
                <th style="width : calc(100%/7);">avance</th>
                <th style="width : calc(100%/7);">statut</th>
                <th style="width : calc(100%/7);">action</th>
            </tr>
            <tbody>
                <?php $date = time();?>
                <?php 

                        $reqinfo = mysqli_query($con,"SELECT * FROM projet"); 
                        while($dat = mysqli_fetch_assoc($reqinfo)):  
                            // $statut ="termine";
                            $id = $dat['id_pro'];
                            if($dat['stat'] != 'termine'){           
                                $date_tmp1 = strtotime($dat['d_deb_pro']);
                                $date_tmp2 = strtotime($dat['d_fin_pro']) + 86400;
                                if($date_tmp1 < $date && $date_tmp2 > $date){
                                    $statut = "en cours";
                                }else if($date_tmp1>$date){
                                    $statut = "en attende";
                                }else if($date_tmp2<$date){
                                    $statut = "retard";
                                }
                                $upd = mysqli_query($con,"UPDATE projet SET stat = '$statut' WHERE id_pro = $id");
                                if(!$upd){
                                    echo "erreur dans la requete update".mysqli_error($con);
                                }
                            }
                        endwhile; 
                        
                            
                    
                    /*********************************************************************************************** */
                    $req = mysqli_query($con,"SELECT * FROM projet JOIN CLIENT ON client.id_client = projet.id_client WHERE projet.stat <> 'termine'");
                    while($row =mysqli_fetch_assoc($req)):
                ?>
                <tr>
                    <td style="width : calc(100%/7);"><?= $row["n_pro"]?> </td>
                    <td style="width : calc(100%/7);"><?= $row["d_deb_pro"]?></td>
                    <td style="width : calc(100%/7);"><?= $row["d_fin_pro"]?></td>
                    <td style="width : calc(100%/7);"><?= $row["nom_client"]?></td>
                    <td style="width : calc(100%/7);" <?php if($row['avan'] == 100){?> style="color:green;" <?php }else if($row['avan'] > 0 AND $row['avan'] < 100){?>style="color: orange";<?php }else if($row['avan'] == 0){?> style="color: #aaa;" <?php } ?>> <?= $row['avan'] ?> </td>
                    <td  style="
                            <?php if($row["stat"] == "en cours"){?>
                                color:orange;
                            <?php } else  if($row["stat"] == "retard"){?>
                                color : red;
                            <?php } else if($row["stat"] == "en attende"){?>
                                color : #aaa;
                            <?php } else  if($row["stat"] == "termine"){?>
                                color:green;
                            <?php } ?>



                        ">
                        <?= $row["stat"]?>
                    </td>
                    <td style="width : calc(100%/7);">
                        <a href="projet/overview.php?id=<?= $row["id_pro"] ?>"><i class="fas fa-eye"></i></a>
                        <?php if(el_exist($right,"projet")): ?>
                        <a href="delete.php?id=<?= $row["id_pro"]?>&class=2"><i class="fas fa-trash"></i></a>
                        <a href="edit.php?id=<?= $row["id_pro"]?>&class=4"><i class="fas fa-edit"></i></a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <table id="sugg"></table>
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
            tr =document.querySelectorAll(".show-projects table tbody tr");

            tr.forEach(element => {
               
                let word = element.cells[0].innerText;
                
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
    header("Location: index.php");
endif; ?>
