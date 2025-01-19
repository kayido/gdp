<?php
    session_start();
    if(isset($_SESSION["connected"])):
?>
<?php require_once ("header.php");?>
    <div class="settings_users menu_users">
        <div class="head-users">
            <h2>listes de utlisateurs</h2>
            <div class="search-bar">
                <input type="search" onkeyup="ajaxing()" id="search" name="search">
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
                    <th style="width: 45%;">poste</th>
                    <th style="width: 15%;">
                        
                    </th>
                </tr>
                <?php 
                    $req = mysqli_query($con, "SELECT * FROM personnel");
                    while($row = mysqli_fetch_assoc($req)):
                ?>
                <tr class="calc_p">
                    <td><img src="../image_bdd/<?= $row["photo"] ?>"></td>
                    <td style="width: 30%;"><?= $row["login_perso"] ?></td>
                    <td style="width: 10%;"><?= $row["last_date"] ?></td>
                    <td style="width: 45%;"><?= $row["poste"] ?></td>
                    <td style="width: 15%;">
                        <a href="../delete.php?id=<?=$row["id_perso"]?>&class=7"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php 
                    endwhile;
                ?>
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
        tr =document.querySelectorAll(".calc_p");
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
