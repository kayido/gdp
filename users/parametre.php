<?php
    session_start();
    if(isset($_SESSION["con"])):
?>
<?php require("header.php"); ?>
        <div class="main-settings">
            <div class="info_settings menu_settings">
                <div class="main_info_settings menu_users">
                    <?php 
                        $req = mysqli_query($con,"SELECT * FROM personnel WHERE id_perso = '$id'");
                        $row = mysqli_fetch_assoc($req);
                    ?>
                    <H2>informations du compte</H2>
                    <h2>statut : <span>personnel</span></h2>
                    <div class="wrapper">
                        <div class="image_view">
                            <img src="../image_bdd/<?=$row["photo"]?>">
                        </div>
                        <div class="view_info">
                            <label>nom</label>
                            <input type="text" disabled value="<?=$row["nom_perso"]?>">
                            <label>prenom</label>
                            <input type="text" disabled value="<?=$row["nom_perso"]?>">
                            <label>email</label>
                            <input type="email" disabled value="<?=$row["email"]?>">
                            <label>numero</label>
                            <input type="tel" disabled value="<?=$row["telephone"]?>">
                            <label>date de naissance</label>
                            <input type="date" disabled value="<?=$row["date_naissance"]?>">
                            <label>Adresse</label>
                            <input type="text" disabled value="<?=$row["adresse"]?>">
                            <label>poste</label>
                            <input type="text" disabled value="<?=$row["poste"]?>">
                            <label>login de connexion</label>
                            <input type="text" disabled value="<?=$row["login_perso"]?>">
                            <label>mot de passe</label>
                            <input type="password" value="<?=$row["password"]?>" disabled>
                            <button><a href="edit.php?id=<?= $row['id_perso'] ?>">modifier</a></button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
            
            
    </div>   
   <script src="script.js"></script>
   <script src="projects.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
   <script src="assets/dist/index.global.min.js"></script>
</body>
</html>
<?php else:
    header("Location: index.php");
endif; ?>
