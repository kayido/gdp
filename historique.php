<?php 
    session_start();

?>
<?php require("header.php");?>
<div class="main-history">
    <div class="header-history">
        <h1>Historique</h1>
        <div class="search-bar">
            <input type="search" id="search" name="search">
            <label><i class="fas fa-search"></i></label>
        </div>
    </div>

    <hr>
    <div class="projet-history">
        <h2>projets</h2>
        <table>
                <tr>
                    <th>nom du projet</th>
                    <th>date debut</th>
                    <th>date fin</th>
                    <th>client</th>
                    <th>details<th>
                    <th></th>
                </tr> 
                <?php 
                    $req =mysqli_query($con,"SELECT * FROM projet JOIN client ON client.id_client = projet.id_client WHERE projet.stat = 'termine'"); 
                    while($row =mysqli_fetch_assoc($req)):
                ?>
                <tr>
                    <td><?= $row["n_pro"] ?></td>
                    <td><?= $row["d_deb_pro"] ?></td>
                    <td><?= $row["d_fin_pro"] ?></td>
                    <td><?= $row["nom_client"] ?></td>
                    <td><a href="details-histo.php?id=<?=$row["id_pro"]?>"><i class="fa fa-eye"></i></a></td>
                    <td><a href="#"><i class="fa fa-trash"></i></a></td>
                </tr> 
                <?php endwhile; ?>   
        </table>
    </div>
</div>
</div>
<?php require_once ("footer.php");?>