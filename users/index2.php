<?php
    session_start();
    if(isset($_SESSION["con"])):
?>
<?php require ("header.php");?>
        <div class="main">   
            <div class="main-menu">
                <h2 style="display: block;">Dashboard</h2>
            </div>
            <?php 
                $reqtec =mysqli_query($con,"SELECT COUNT(*) FROM tache JOIN projet ON projet.id_pro = tache.id_pro JOIN personnel ON personnel.id_perso = tache.id_perso WHERE tache.statut_tache = 'en cours' AND personnel.id_perso = '$id'");
                $reqtt =mysqli_query($con,"SELECT COUNT(*) FROM tache JOIN projet ON projet.id_pro = tache.id_pro JOIN personnel ON personnel.id_perso = tache.id_perso WHERE tache.statut_tache = 'termine' AND personnel.id_perso = '$id'");
                $reqtr =mysqli_query($con,"SELECT COUNT(*) FROM tache JOIN projet ON projet.id_pro = tache.id_pro JOIN personnel ON personnel.id_perso = tache.id_perso WHERE tache.statut_tache = 'retard' AND personnel.id_perso = '$id'");
                $reqtatt =mysqli_query($con,"SELECT COUNT(*) FROM tache JOIN projet ON projet.id_pro = tache.id_pro JOIN personnel ON personnel.id_perso = tache.id_perso WHERE tache.statut_tache = 'en attende' AND personnel.id_perso = '$id'");
                $dattec = mysqli_fetch_assoc($reqtec);
                $dattt = mysqli_fetch_assoc($reqtt);
                $dattr = mysqli_fetch_assoc($reqtr);
                $dattatt = mysqli_fetch_assoc($reqtatt);   
            ?>
            <div class="main-content">
                <div class="sales-boxes">
                    <div class="box " style="background-color: orange;">
                        <i class="fas fa-cogs"></i>
                        <p>nombres de taches en cours</p>
                        <p><?= $dattec["COUNT(*)"] ?></p>
                    </div>
                    <div class="box" style="background-color: green;">
                        <i class="fas fa-cogs"></i>
                        <p>nombres de taches terminées</p>
                        <p><?= $dattt["COUNT(*)"] ?></p>
                    </div>
                    <div class="box" style="background-color: #aaa;">
                        <i class="fas fa-cogs"></i>
                        <p>nombre de taches en attendes</p>
                        <p><?= $dattatt["COUNT(*)"] ?></p>
                    </div>
                    <div class="box" style="background-color: red;">
                        <i class="fas fa-users"></i>
                        <p>nombres de taches en retards</p>
                        <p><?= $dattr["COUNT(*)"] ?></p>
                    </div>
                </div>
                <div class="group">
                    <?php 
                        $req = mysqli_query($con,"SELECT * FROM tache JOIN personnel ON personnel.id_perso = tache.id_perso WHERE statut_tache='en cours' AND date_debut = CAST(NOW() AS DATE) AND CAST(NOW() AS DATE) <= date_fin");
                        if(!$req){
                            echo "erreur de requette".mysqli_error($con);
                        }
                        
                    ?>
                    <div class="all_task" style="overflow:scroll;">
                        <h2>tache journalière</h2>
                        <table>
                            <caption>
                                <a href="taches.php">voir</a></caption>
                            <tr>
                                <th>nom de la tache</th>
                                <th>statut</th>
                            </tr>
                            <?php while($row = mysqli_fetch_assoc($req)): ?>
                            <tr>
                                <td><?= $row["nom_tache"] ?></td>
                                <td><?= $row["statut_tache"]?></td>
                            </tr>
                            <?php endwhile; ?>
                        </table>
                    </div>
                    <div class="activite" style="overflow-y:scroll;">
                        <h2>activite reçents</h2>
                        <?php 
                        $req = mysqli_query($con,"SELECT * FROM activite JOIN personnel on personnel.id_perso = activite.id_perso WHERE personnel.id_perso = '$id' AND CAST(date_atv_admin AS date) = CAST(NOW() AS date) ORDER BY activite.date_atv_admin DESC");
                        if(!$req){
                            echo mysqli_error($con);
                        }
                        while($row = mysqli_fetch_assoc($req)):
                    ?>
                        <div class="box_act">
                            <p><?= $row["date_atv_admin"] ?></p>
                            <p><?= $row["desc_a"] ?></p>
                            <p><?= $row["nom_perso"] ?></p>
                        </div>
                    <?php endwhile; ?>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
   
   <script src="script.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
   <script src="assets/dist/index.global.min.js"></script>
   <script src="projets.js"></script>
</body>
</html>
<?php else:
    header("Location: index.php");
endif; ?>