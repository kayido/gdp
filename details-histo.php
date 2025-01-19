<?php
    session_start();
    if(isset($_SESSION["connected"])):
?>
<?php require("header.php");?>
<?php 
    $id = $_GET["id"];
    $req = mysqli_query($con,"SELECT * FROM projet join client ON client.id_client = projet.id_client where projet.id_pro = '$id'");
    $row =mysqli_fetch_assoc($req);
    
?>
<div class="main-det">
    <div class="main-head-det">
        <h2><?= $row["n_pro"]?></h2>
    </div>
    <div class="stat">
        <table>
            <caption>INFORMATIONS GENERALES</caption>
            <tr>
                <td>nom du projet</td>
                <td><?= $row["n_pro"]?></td>
            </tr>
            <tr>
                <td>date de debut</td>
                <td><?= $row["d_deb_pro"]?></td>
            </tr>
            <tr>
                <td>date de fin</td>
                <td><?= $row["d_fin_pro"]?></td>
            </tr>
            <tr>
                <td>durée</td>
                <td></td>
            </tr>
            <tr>
                <td>budjet</td>
                <td><?= $row["bud_pro"]?></td>
            </tr>
            <tr>
                <td>client</td>
                <td><?= $row["nom_client"]?><td>
            </tr>
            <tr>
                <td>personnels</td>
                <td>
                <?php 
                    $req = mysqli_query($con,"SELECT  DISTINCT * FROM personnel JOIN tache ON tache.id_perso = personnel.id_perso JOIN projet ON projet.id_pro = tache.id_pro WHERE projet.id_pro = '$id'");
                    while($row1 = mysqli_fetch_assoc($req)):
                        echo $row1["nom_perso"];
                        echo " ;";
                    endwhile;?>
                </td>
            </tr>
            <tr>
                <td>description</td>
                <td><?= $row["desc_pro"] ?></td>
            </tr>
        </table>
    </div>
    <?php 
        if(isset($_POST["restor"])){
            $req = mysqli_query($con,"UPDATE projet SET stat = 'en cours' where id_pro = '$id'");
            header("Location: projets.php");
        }
    
    ?>
    <div class="det-foot">
        <form method="post">
            <button type="submit" name="restor">restaurer</button>
            <button type="submit" ><a href="delete.php?id=<?= $row["id_pro"]?>&class=2" style="color:#fff;">supprimer</a></button>
        <form>
    </div>
</div>

<?php require("footer.php");?>
<?php else:
    header("Location: index.php");
endif; ?>


