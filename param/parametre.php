<?php
    session_start();
    if(isset($_SESSION["connected"])):
?>
<?php require_once ("header.php");?>
    <div class="info_settings menu_settings">
        <div class="main_info_settings menu_users">
            <H2>informations du compte</H2>
            <h2>statut : <span>administrateur</span></h2>
            <?php 
                $id= $datareq["id_u"];
                $req = mysqli_query($con,"SELECT * FROM utilisateurs WHERE id_u = '$id'");
                $row = mysqli_fetch_assoc($req);
            ?>
            <div class="wrapper">
                <div class="image_view">
                    <img src='../image_bdd/<?= $row["pp"] ?>'>
                </div>
                <div class="view_info">
                    <label>nom complet</label>
                    <input type="text" disabled value="<?=$row["nom_u"]?>">
                    <label>email</label>
                    <input type="email" disabled value="<?=$row["email_u"]?>">
                    <label>numero</label>
                    <input type="tel" disabled value="<?=$row["tel_u"]?>">
                    <label>date de naissance</label>
                    <input type="date" disabled value="<?=$row["ddn_u"]?>">
                    <label>Adresse</label>
                    <input type="text" disabled value="<?=$row["add_u"]?>">
                    <label>poste</label>
                    <input type="text" disabled value="<?=$row["poste"]?>">
                    <label>login de connexion</label>
                    <input type="text" disabled value="<?=$row["login"]?>">
                    <label>mot de passe</label>
                    <input type="password" value="<?=$row["pw"]?>" disabled>
                    <button><a href="../edit.php?id=<?=$row["id_u"]?>&class=2">modifier</a></button>
                </div>
            </div>
        </div>
    </div>
    </div>            
</div>   
<?php require_once ("footer.php");?>
<?php else:
    header("Location: ../index.php");
endif; ?>
