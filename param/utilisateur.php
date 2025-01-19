<?php
    session_start();
    if(isset($_SESSION["connected"])):
?>
<style>
   
</style>
<?php require_once ("header.php");?>
    <div class="settings_users menu_users">
        <div class="head-users">
            <h2>listes de utlisateurs</h2>
            <div class="search-bar">
                <input type="search" id="search" name="search" onkeyup="test()">
                <!-- <label><i class="fas fa-search"></i></label> -->
            </div>
           
            <div class="diff-users">
                <button><a href="utilisateur.php">administrateur</a></button>
                <button><a href="utilisateur_perso.php">personnels</a></button>
            </div>
        </div>
        <div class="users">
            <table>
                <tr>
                    <th></th>
                    <th style="width: 30%;">utilisateurs</th>
                    <th style="width: 10%;">date de denieres connexions</th>
                    <th style="width: 45%;">liste des ses droits</th>
                    <th style="width: 15%;">
                        
                    </th>
                </tr>
                <tr>
                    <td><img src="image_bdd/1695896323testimonials-5.jpg"></td>
                    <td style="width: 30%;">admin</td>
                    <td style="width: 10%;">19/01/2024 15:26:32</td>
                    <td style="width: 45%;">tous les droits</td>
                    <td style="width: 15%;">
                        -----
                    </td>
                </tr>
                <tbody>
                    <?php 
                        $req = mysqli_query($con,"SELECT * FROM utilisateurs");
                        while($row = mysqli_fetch_assoc($req)):
                    ?>
                    <tr class="calc_u">
                        <td ><img src="../image_bdd/<?= $row["pp"] ?>"></td>
                        <td style="width: 30%;"><?= $row["login"] ?></td>
                        <td style="width: 10%;"><?= $row["date_enregistrement"] ?></td>
                        <td style="width: 45%;">
                            <?= $row["droit"]; ?>
                        </td>
                        <td style="width: 15%;">
                            <a href="../delete.php?id=<?= $row["id_u"]?>&class=7"><i class="fas fa-trash"></i></a>
                            <a href="../edit.php?id=<?= $row["id_u"]?>&class=2"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                    <?php endwhile ;?>
                </tbody>
                <tr>
                    <td><button><a href="../create.php?class=2">ajouter un admin</a></button></td>
                </tr>
            </table>
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
        tr =document.querySelectorAll(".calc_u");
        console.log(tr);
        tr.forEach(element => {
            
            let word = element.cells[1].innerText;
            
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
