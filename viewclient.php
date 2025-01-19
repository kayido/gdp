<?php
    session_start();
    if(isset($_SESSION["connected"])):
?>
<?php require_once ("header.php");?>
<div class="main-view">
    <?php 
        $id = $_GET["id"];
        $req = mysqli_query($con, "SELECT * FROM client where id_client ='$id'");
        $row = mysqli_fetch_assoc($req);
    ?>
    <div class="wrapper_view">
        <div class="image_view">
            <img src='image_bdd/<?= $row["phto_profil"]?>'>
        </div>
        <div class="view_info">
            <label>nom</label>
            <input type="text" disabled value="<?= $row["nom_client"] ?>">
            <label>email</label>
            <input type="phone" disabled value="<?= $row["email"] ?>">
            <label>numero</label>
            <input type="tel" disabled value="<?= $row["telephone"] ?>">
            <label>date de naissance</label>
            <input type="date" disabled value="<?= $row["date_naissance"] ?>">
            <label>Adresse</label>
            <input type="text" disabled value="<?= $row["adresse"] ?>">
            <label>projet</label>
            <?php 
                $reqn = mysqli_query($con,"SELECT DISTINCT COUNT(*) FROM projet  WHERE projet.id_client = '$id'");
                $nbr = mysqli_fetch_assoc($reqn);
            ?>
            <select size="<?= $nbr["COUNT(*)"] ?>">
                <?php 
                    $reqpr = mysqli_query($con,"SELECT n_pro FROM projet JOIN client ON client.id_client = projet.id_client WHERE client.id_client = '$id'");
                    if(!$reqpr){
                        echo "erreur de requette";
                    }
                    while($rowpr = mysqli_fetch_assoc($reqpr)):
                ?>
                <option><?= $rowpr["n_pro"] ?></option>
            <?php endwhile ; ?>
            </select>
            <button><a href="edit.php?id=<?= $id ?>&class=1">modifier</a></button>
            <button><a href="">supprimer</a></button>
        </div>
    </div>
                
        </div>
    </div>
<?php require_once ("footer.php");?>
<?php else:
    header("Location: index.php");
endif; ?>