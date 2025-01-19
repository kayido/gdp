<?php
    session_start();
    if(isset($_SESSION["connected"])):
?>
<?php require_once ("header.php");?>
<style>
    .staff-accept tr td .btn-g{
        background : blue;
        color : #fff;
        padding: 5px 10px;
    }    
    .staff-accept tr td .btn-r{
        background : red;
        color : #fff;
        padding: 5px 10px;
    }
</style>
<div class="main-staff">
    <div class="overlay">
        <div class="head-main-staff">
            <h2>personnels</h2> 
            <div class="search-bar">
                <input type="search" id="search" name="search" onkeyup="test()">
                <label><i class="fas fa-search"></i></label>
            </div>  
            <div class="filter-staff">
                <span class="filt-personnel view-staff">personnel</span>
                <span class="filt-equip">candidat</span>
            </div>         
        </div>
        
        <div class="show-staff">
            <table class="staff-uniq">
            <caption></caption>
                <tr>
                    <th>nom</td>
                    <th>email</th>
                    <th>adresse</th>
                    <th>numero</th>
                    <th>statut</th>
                    <th></th>
                </tr>
                <tbody>
                <?php 
                    $req = mysqli_query($con,"SELECT * FROM personnel where etat ='accept' ");
                    while($row =mysqli_fetch_assoc($req)):
                ?>
                <tr>
                    <td><?= $row["nom_perso"] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?= $row["adresse"] ?></td>
                    <td><?= $row["telephone"] ?></td>
                    <td><?= $row["poste"] ?></td>
                    <td>
                        <a href="view.php?id=<?= $row["id_perso"] ?>"><i class="fas fa-eye"></i></a>
                        <a href="delete.php?id=<?= $row["id_perso"]?>&class=4"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php 
                    endwhile; 
                ?>
                </tbody>
            </table>
            <table class="staff-accept view-staff">
                <tr>
                    <th>nom personnel</th>
                    <th>email</th>
                    <th>date enregistrement</th>
                    <th>actions</th>
                </tr>
                <tbody>
                    <?php 
                        $req = mysqli_query($con,"SELECT * FROM personnel where etat = 'etude'");
                        while($row2 =mysqli_fetch_assoc($req)):
                    ?>
                    <tr>
                        <td><?= $row2["nom_perso"] ?></td>
                        <td><?= $row2["email"] ?></td>
                        <td><?= $row2["poste"] ?></td>
                        <td>
                            <button class="btn-g"><a href="update.php?id=<?= $row2["id_perso"] ?>&class=1">accepter</a></button>
                            <button class="btn-r"><a href="delete.php?id=<?=$row2["id_perso"]?>&class=8" style="color:#fff;">refuser</a></button>
                        </td>
                    </tr>
                    <?php 
                        endwhile;
                    ?>
                </tbody>
            </table>
            <!-- <div class="button">
                <button class="btn-modal-group"><a href="create.html">ajouter un membre</a></button>
                <button class="btn btn-new-group btn-modal-staff"><a href="create.html"> creer une nouvelle equipe</a></button>
            </div> -->
            
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
            tr =document.querySelectorAll(".show-staff table tbody tr");

            tr.forEach(element => {
               
                let word = element.cells[0].innerText;
                
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
    header("Location: index.php");
endif; ?>


