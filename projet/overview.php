<?php
    session_start();
    if(isset($_SESSION["connected"])):
?>
<?php  require_once ("header.php");?>

    <div class="overview_project <?php if(el_exist($right,"projet")): ?>menu_project<?php endif; ?>" <?php if(!el_exist($right,"projet")): ?> style="display:none;"<?php endif; ?> >
        <div class="head_overview">
            <h2><?= $data['n_pro'] ?></h2>
            <h2>fonds disponible : <span style="color: green;"><?= $data["fd"] ?></span></h2>
        </div>
        <div class="info_projet">
        <table>
            <tr>
                <td>nom projet</td>
                <td><?=$data['n_pro']?></td>
            </tr>
            <tr>
                <td>description</td>
                <td><?=$data['desc_pro']?></td>
            </tr>
            <tr>
                <td>date debut0</td>
                <td><?=$data['d_deb_pro']?></td>
            </tr>
            <tr>
                <td>date fin</td>
                <td><?=$data['d_fin_pro']?></td>
            </tr>
            <tr>
                <td>client</td>
                <td><?=$data['nom_client']?></td>
            </tr>
            <tr>
                <td>personnels</td>
                <td>Bruce</td>
            </tr>
            <tr>
                <td>statut</td>
                <td><?=$data['stat']?></td>
            </tr>
        </table>
        
        
        </div>
        <div class="main_overview ">
            <?php 
                $reqtec =mysqli_query($con,"SELECT COUNT(*) FROM tache JOIN projet ON projet.id_pro = tache.id_pro WHERE tache.statut_tache = 'en cours' AND projet.id_pro = '$id'");
                $reqtt =mysqli_query($con,"SELECT COUNT(*) FROM tache JOIN projet ON projet.id_pro = tache.id_pro WHERE tache.statut_tache = 'termine' AND projet.id_pro = '$id'");
                $reqtr =mysqli_query($con,"SELECT COUNT(*) FROM tache JOIN projet ON projet.id_pro = tache.id_pro WHERE tache.statut_tache = 'retard' AND projet.id_pro = '$id'");
                $reqtatt =mysqli_query($con,"SELECT COUNT(*) FROM tache JOIN projet ON projet.id_pro = tache.id_pro WHERE tache.statut_tache = 'en attende' AND projet.id_pro = '$id'");
                $dattec = mysqli_fetch_assoc($reqtec);
                $dattt = mysqli_fetch_assoc($reqtt);
                $dattr = mysqli_fetch_assoc($reqtr);
                $dattatt = mysqli_fetch_assoc($reqtatt);
                $val1 = $dattt["COUNT(*)"] + $dattec["COUNT(*)"] +  $dattatt["COUNT(*)"] +$dattr["COUNT(*)"] ;
                $val2 = $dattt["COUNT(*)"];
                   
            ?>
            <div class="taches-stat">
                <div class="stat" style="background-color: orange;">
                    <i class="fas fa-tasks"></i>
                    <p>taches en cours</p>
                    <p><?= $dattec["COUNT(*)"] ?></p>
                </div>
                <div class="stat" style="background-color: #aaa;">
                    <i class="fas fa-tasks"></i>
                    <p>taches en attende</p>
                    <p><?= $dattatt["COUNT(*)"] ?></p>
                </div>
                <div class="stat" style="background-color: green;">
                    <i class="fas fa-tasks"></i>
                    <p>taches termine</p>
                    <p><?= $dattt["COUNT(*)"] ?></p>
                </div>
                <div class="stat" style="background-color: red;">
                    <i class="fas fa-tasks"></i>
                    <p>taches en retard</p>
                    <p><?= $dattr["COUNT(*)"] ?></p>
                </div>
            </div>
            <div class="activity-projet">
                <h2>activité du projet</h2>
                <?php 
                $req = mysqli_query($con,"SELECT * FROM activite  WHERE  id_pro ='$id'  ORDER BY date_atv_admin DESC");
                if(!$req){
                    echo mysqli_error($con);
                }
                while($atv = mysqli_fetch_assoc($req)):
            ?>
                <div class="atv">
                    <p style="font-weight: bold;"><?= $atv["date_atv_admin"] ?></p>
                    <p><?= $atv["desc_a"] ?></p>
                    <p>acteur : <?=  $info["nom_u"] ?></p>
                </div>
                <?php endwhile; ?>
            </div>
            
        </div >
        <div class="footer_overview">
            <?php 
                if($val1 == 0 || $val2 == 0){
                   $val3 = 0; 
                }else{
                    $val3 = ($val2/$val1) *100;
                    $upd = mysqli_query($con,"UPDATE projet SET avan = '$val3' WHERE id_pro = '$id'");
                }
            ?>
            <h3>avancé</h3>
            <span id="advance" style="display : none;"><?= $val3 ?></span>
            <div class="bar">
                <div class="adv_bar"></div>
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