<?php
    session_start();
    if(isset($_SESSION["connected"])):
?>

<?php 
    require_once ("header.php");
?>
<?php
    $deb;
    $fin;

    $data = [];
    $sum = 0;
    if(!empty($_POST["submit"])){
        extract($_POST);
        $deb = $start;
        $fin = $end;
    }
    if(empty($deb) AND empty($fin)){
        $req = mysqli_query($con,"SELECT * FROM activite JOIN utilisateurs ON utilisateurs.id_u = activite.id_u ORDER BY activite.date_atv_admin DESC");
    }else{
        $req = mysqli_query($con,"SELECT * FROM activite JOIN utilisateurs ON utilisateurs.id_u = activite.id_u  WHERE CAST(activite.date_atv_admin as date) >= '$deb' AND CAST(activite.date_atv_admin as date) <= '$fin' ORDER BY activite.date_atv_admin DESC");
    }
   
?>

<div class="main-taches">
    <div class="head-menu">
        <button><a href="taches.php">gestionnaire de taches</a></button>
        <button><a href="activite.php">activite</a></button>
    </div>
    <div class="activity menu-act">
        <div class="head-activity">
            <form method="post">
                <input type="date" name="start">
                <input type="date" name="end">
                <input type="submit" name = "submit" value="filtrer">
            </form>  
        </div>
        <div class="activity-content">
            <?php 
            /////////////requette

            ////////////////////


            while($atv = mysqli_fetch_assoc($req)):
            ?>
            <div class="atv">
                <p><?= $atv["date_atv_admin"] ?></p>
                <p><?= $atv["desc_a"] ?></p>
                <p><?= $atv["nom_u"] ?></p>
            </div>
            <?php
                // $date =$atv["date_atv_admin"] ;
                // $h = mysqli_query($con,"SELECT DATE_FORMAT($date,)");
                // if($atv['date_atv_admin']  === ):
                //     <h3 id="check-month">01/2/2024</h3>
                // endif;
            ?>
            <?php 
                endwhile;
            ?>
        </div>
    </div>
</div>
</div>
<?php require_once ("footer.php");?>
<?php else:
    header("Location: ../index.php");
endif; ?>


