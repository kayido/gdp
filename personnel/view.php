<?php
    session_start();
    if(isset($_SESSION["connected"])):
?>
<?php require_once ("header.php");?>
<div class="main-view">
    <?php 
        $id = $_GET["id"];
        $req = mysqli_query($con,"SELECT * FROM personnel WHERE id_perso ='$id'");
        $row = mysqli_fetch_assoc($req);
    ?>
    <div class="wrapper_view">
        <div class="image_view">
            <img src='../image_bdd/<?= $row["photo"]?>'>
        </div>
        <?php 
            $count = mysqli_query($con,"SELECT COUNT(*) FROM tache JOIN personnel ON personnel.id_perso = tache.id_perso WHERE tache.statut_tache='retard'");
            $count = mysqli_fetch_assoc($count);
            $count = $count["COUNT(*)"];
            
            $perso = mysqli_query($con,"SELECT COUNT(*) FROM tache JOIN personnel ON personnel.id_perso = tache.id_perso WHERE personnel.id_perso = '$id'");
            $perso = mysqli_fetch_assoc($perso);
            $perso = $perso["COUNT(*)"];
            
            $total = mysqli_query($con,"SELECT COUNT(*) FROM tache JOIN personnel ON personnel.id_perso = tache.id_perso ");
            $total = mysqli_fetch_assoc($total);
            $total = $total["COUNT(*)"];
            if($count > 2){
                $mgs = "Mauvaise";
            }
            $quote = ($perso/$total) * 100;
        ?>
        
        <div class="view_info">
            <h1>performance : <?= $mgs ?></h1>
            <label>nom</label>
            <input type="text" disabled value="<?= $row["nom_perso"] ?>">
            <label>email</label>
            <input type="phone" disabled value="<?= $row["email"] ?>">
            <label>numero</label>
            <input type="tel" disabled value="<?= $row["telephone"] ?>">
            <label>date de naissance</label>
            <input type="date" disabled value="<?= $row["date_naissance"] ?>">
            <label>Adresse</label>
            <input type="text" disabled value="<?= $row["adresse"] ?>">
            <label>poste</label>
            <input type="text" disabled value="<?= $row["poste"] ?>">
            <label>quote part<label>
            <input type="text" disabled value="<?= $quote ?> %" style="font-size: 0.8em ;">                
            <label style="font-size: 0.9em ;">projet en cours</label>
            <?php 
                $reqn = mysqli_query($con,"SELECT DISTINCT COUNT(*) FROM projet JOIN tache ON tache.id_pro = projet.id_pro JOIN personnel ON tache.id_perso = personnel.id_perso WHERE personnel.id_perso = '$id'");
                $nbr = mysqli_fetch_assoc($reqn);
                $nbr = $nbr["COUNT(*)"];
                if($nbr > 5){
                    $nbr = 5;
                }
            ?>
            <select size="<?=$nbr?>">
                <?php 
                    $reqpr = mysqli_query($con,"SELECT DISTINCT n_pro FROM projet JOIN tache ON tache.id_pro = projet.id_pro JOIN personnel ON tache.id_perso = personnel.id_perso WHERE personnel.id_perso = '$id'");
                    if(!$reqpr){
                        echo "erreur de requette";
                    }
                    while($rowpr = mysqli_fetch_assoc($reqpr)):
                ?>
                <option style="font-size: 0.5em ;"><?= $rowpr["n_pro"] ?></option>
                <?php endwhile ; ?>
            </select>
            <button><a href="">supprimer</a></button>
        </div>
    </div>
                
        </div>
    </div>
<?php require_once ("footer.php");?>
<?php else:
    header("Location: ../index.php");
endif; ?>
