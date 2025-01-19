<?php
    session_start();
    if(isset($_SESSION["connected"])):
?>
<?php 
    if(!empty($_SERVER['QUERY_STRING'])){
        $id = $_GET["id"];
    }
    require_once ("header.php");
?>
<div class="main-taches">
    <div class="head-menu">
        <button><a href="taches.php">gestionnaire de taches</a></button>
        <button><a href="activite.php">activite</a></button>
    </div>
    <?php
        
        $req1 = mysqli_query($con, "SELECT COUNT(*) FROM tache JOIN projet ON projet.id_pro = tache.id_pro WHERE tache.statut_tache = 'en cours' AND projet.stat <> 'termine'");
        $req2 = mysqli_query($con,"SELECT COUNT(*) FROM tache JOIN projet ON projet.id_pro = tache.id_pro WHERE tache.statut_tache ='termine' AND projet.stat <> 'termine'");
        $req3 = mysqli_query($con,"SELECT COUNT(*) FROM tache JOIN projet ON projet.id_pro = tache.id_pro WHERE tache.statut_tache ='en attende' AND projet.stat <> 'termine'");
        $req4 = mysqli_query($con,"SELECT COUNT(*) FROM tache JOIN projet ON projet.id_pro = tache.id_pro WHERE tache.statut_tache ='retard' AND projet.stat <> 'termine'");

        $nbr1 = mysqli_fetch_assoc($req1);
        $nbr2 = mysqli_fetch_assoc($req2);
        $nbr3 = mysqli_fetch_assoc($req3);
        $nbr4 = mysqli_fetch_assoc($req4);
    ?>
    <div class="taches_content menu-act">
        <div class="header-taches">
            <h2>Listes des taches </h2>
        </div>
        <div class="taches-stat">
            <div class="stat" style="background-color: orange;">
                <i class="fas fa-cogs"></i>
                <p>taches en cours</p>
                <p><?= $nbr1["COUNT(*)"]?></p>
            </div>
            <div class="stat" style="background-color: #aaa;">
                <i class="fas fa-cogs"></i>
                <p>taches en attende</p>
                <p><?= $nbr3["COUNT(*)"]?></p>
            </div>
            <div class="stat" style="background-color: green;">
                <i class="fas fa-cogs"></i>
                <p>taches termine</p>
                <p><?= $nbr2["COUNT(*)"]?></p>
            </div>
            <div class="stat" style="background-color: red;">
                <i class="fas fa-cogs"></i>
                <p>taches en retart</p>
                <p><?= $nbr4["COUNT(*)"]?></p>
            </div>
        </div>
        <div class="list-pro">
            <?php 
                $req = mysqli_query($con,"SELECT * FROM projet WHERE  projet.stat <> 'termine' ");
                while($row = mysqli_fetch_assoc($req)):
                    echo "<button><a href=taches.php?id=".$row['id_pro'].">".$row["n_pro"]."</a><button>";
                endwhile;
            ?>
        </div>
        <?php 
            if(empty($id)){
                $req = mysqli_query($con,"SELECT * FROM projet WHERE  projet.stat <> 'termine' ");
            }else{
                $req = mysqli_query($con,"SELECT * FROM projet WHERE  projet.stat <> 'termine' AND id_pro='$id'");
            }
            while($row = mysqli_fetch_assoc($req)):
        ?>
        <div class="div-tache">
            <h3><a href="../projet/tache-projets.php?id=<?=$row["id_pro"]?>"><?= $row["n_pro"] ?></a> <span> <a href="../create.php?class=3&id=<?= $row["id_pro"]?> "><i class="fas fa-plus"></i></a></h3><hr>
            <table>
                <?php
                $id =  $row["id_pro"];
                    $reqt = mysqli_query($con,"SELECT * FROM projet JOIN tache ON tache.id_pro = projet.id_pro JOIN personnel ON personnel.id_perso = tache.id_perso WHERE projet.id_pro = '$id' AND projet.stat <> 'termine' ");
                    if(!$reqt){
                        echo "erreur de requette";
                    }
                    while($rowt = mysqli_fetch_assoc($reqt)):
                ?>
                <tr>
                    <td><?= $rowt["nom_tache"] ?></td>
                    <td><?= $rowt["cout"] ?></td>
                    <td><?= $rowt["nom_tache"] ?></td>
                    <td><?= $rowt["date_debut"] ?></td>
                    <td><?= $rowt["date_fin"] ?></td>
                    <td 
                            <?php
                            if($rowt['statut_tache'] == "en cours"){ ?>
                               id= "tache_continue" 
                            <?php }else if($rowt['statut_tache'] == "termine"){?>
                                id= "tache_finish" 
                            <?php } else if($rowt['statut_tache'] == "retard"){?>
                                id = "tache_retard"
                            <?php }  else if($rowt['statut_tache'] == "en attende"){?>
                                id = "tache_attende";
                            <?php } ?>
                        
                            class="filt" style="text-align: center; margin-top: 12px;width: 200px; margin-left: 20px;"><?= $rowt['statut_tache'] ?></td>
                                               
                    </td>  
                </tr>
                <?php endwhile; ?>
                
            </table>
        </div>
        <?php endwhile; ?>
        <hr>
    </div>
</div>
</div>

<?php require_once ("footer.php");?>
<?php else:
    header("Location: ../index.php");
endif; ?>


