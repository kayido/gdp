<?php
    session_start();
    if(isset($_SESSION["connected"])):
?>
<?php  require_once ("header.php");?>

    <div class="versement_project <?php if(el_exist($right,"budjet")): ?>menu_project<?php endif; ?>" <?php if(!el_exist($right,"budjet")): ?>style = "display : none;"<?php endif; ?>>
        <div class="head-task-project">
            <h2><?= $data["n_pro"] ?></h2>        
        </div>
        <div class="main-versement">
            <?php 
                $req5 = mysqli_query($con,"SELECT * from versement JOIN projet ON projet.id_pro = versement.id_pro where projet.id_pro = '$id' ");
                if(!$req5){
                    echo mysqli_error($con);
                }
                $soldeverse = 0;
            ?>
            <table>
                <tr>
                    <th style="width: 50%; ">intitule</th>
                    <th style="width: 25%; padding-left: 20px;">date</th>
                    <th style="width: 25%; padding-left: 10px;">montant</th>
                    <th></th>
                </tr>
                <?php 
                    while($row3 = mysqli_fetch_assoc($req5)):
                        $soldeverse += $row3['montant'];
                ?>
                <tr>
                    <td style="width: 40%; "><?=$row3['nom_ver']?></td>
                    <td style="width: 25%; "><?=$row3['date_ver']?></td>
                    <td style="width: 25%; "><?=$row3['montant']?></td>
                    <td class="td_icon">
                        <a href="<?= $row3["recipe"] ?>" title="telecharger le reçu"><i class="fa fa-download"></i></a>
                        <a href="delete.php?id=<?=$row3['id_ver']?>&class=6"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php 
                    
                
                ?>
                <tr>
                    <th style="width: 50%; ">solde verse</th>
                    <th style="width: 25%; "></th>
                    <th style="width: 25%; "><?=$soldeverse?></th>
                    <th></th>
                </tr>
                <tr>
                    <th style="width: 50%; ">solde attendu</th>
                    <th style="width: 25%; "></th>
                    <th style="width: 25%; "><?= $data['bud_pro'] ?></th>
                    <th></th>
                </tr>
                <tr>
                    <th style="width: 50%; ">sode restant</th>
                    <th style="width: 25%; "></th>
                    <th style="width: 25%; "><?= $data['bud_pro'] - $soldeverse ?></th>
                    <th></th>
                </tr>
                
                <?php 
                    $budjet = mysqli_query($con, "SELECT SUM(versement.montant) as m FROM projet JOIN versement ON projet.id_pro = versement.id_pro WHERE projet.id_pro = '$id'");
                    $m = mysqli_fetch_assoc($budjet);
                    $cout = mysqli_query($con,"SELECT SUM(tache.cout) as m FROM tache JOIN projet ON projet.id_pro = tache.id_pro WHERE projet.id_pro = '$id'");
                    $m2 = mysqli_fetch_assoc($cout);
                    if($m['m']+$m2['m'] != $data['bud_pro']){
                ?>
                
                <div class="button">
                    <button><a href="../create.php?class=5&id=<?=$id?>" style="color:#fff;">ajouter un versement</a></button>
                </div>
                <?php }else{ ?>
                <?php echo "<h2 style='color : green;'>soldé</h2>";?>
                <?php } ?>
            </table>
        </div>
        <div class="fonds">
            <?php 
                if(isset($_POST['submit-montant'])){
                    extract($_POST);
                    $sel = mysqli_query($con,"SELECT * FROM projet WHERE id_pro = '$id'");
                    $sel_recup = mysqli_fetch_assoc($sel);
                    $ajout = $sel_recup["fd"];
                    $total = $ajout + $montant;
                    $bdj = $sel_recup["bud_pro"];
                    if($montant > $bdj){
                        $mgs = "<script>alert('erreur dans le decaissement')</script>";
                    }else{
                        $upd1 = mysqli_query($con,"UPDATE projet SET fd = '$total' WHERE id_pro = '$id'");
                        if($upd1){
                            echo "<script> alert('fond decaisse') </script>";
                            $actor = $info["id_u"];
                            $atvdesc = "fonds decaisse pour le projet: ".$sel_recup["n_pro"];
                            $upd = mysqli_query($con,"INSERT INTO  activite VALUES (null,CURRENT_TIMESTAMP,'$atvdesc','$actor','$id','0')");
                            if(!$upd){
                                echo mysqli_error($con);
                            }
                        }
                    }
                    
                }
            ?>
            <style>
                #vers{
                    margin-top: 50px;
                    width:100%;
                }
                #vers label{
                    display:block;
                    text-transform : capitalize;
                    font-size : 1.1em;
                    
                }
                #vers input{
                    display:inline-block;
                    width : 100%;
                    height : 25px;
                    outline : none;
                    margin-bottom: 5px;
                }
                #vers input["submit"]{
                    background: #00309B;
                }
            </style>
            <form method="post" id="vers">
                <?php 
                    if(isset($mgs)){
                        echo "<p style='color:red;'>$mgs</p>";
                    }
                ?>
                <h3>decaisser un fond</h3>
                <label>montant<label>
                <input type="number" name="montant">
                <input type="submit" name="submit-montant" value="decaisser">
            </form>
        </div>
        <div class="sales-boxes">
            <div class="box1">
                <p class="budjet"><span class="icon"><i class="fas fa-landmark"></i></span>montant versé : <span ><?= $m["m"] ?></span></p>
            </div>
            <div class="box2">
                <p class="depense"><span class="icon"><i class="fas fa-donate"></i></span> depense : <span ><?= $m2["m"] ?></span></p> 
            </div>
            <div class="box3">
                <p class="reste"><span class="icon"><i class="fas fa-wallet"></i></span> solde disponible : <span ><?= $m["m"] - $m2["m"] ?></span></p> 
            </div>
        </div>
    </div>
</div>
</div>
<?php require_once ("footer.php");?>
<?php else:
    header("Location: ../index.php");
endif; ?>