<?php
    session_start();
    if(isset($_SESSION["connected"])):
?>
<?php 
require_once ("header.php");
require("connexion.php");

?>
<div class="main-contacts">
    <div class="overlay">
        <div class="head-main-contacts">
            <h2>tous les contacts clients</h2>
            <div class="search-bar">
                <input type="search" id="search" name="search" onkeyup="test()">
                <label><i class="fas fa-search"></i></label>
            </div>  
        </div>
        <div class="show-contacts">
            <table>
                <tr>
                    <th>nom du client</th>
                    <th>email</th>
                    <th>adresse</th>
                    <th>numero telephone</th>
                    <th></th>
                </tr>
                <?php 
                    $req = mysqli_query($con,"SELECT * FROM client");
                    
                    while($row = mysqli_fetch_assoc($req)):
                ?>
                <tr>
                    <td><?= $row["nom_client"]?></td>
                    <td><?= $row["email"]?></td>
                    <td><?= $row["adresse"]?></td>
                    <td><?= $row["telephone"]?></td>
                    <td>
                        <a href="viewclient.php?id=<?= $row["id_client"] ?>"><i class="fas fa-eye"></i></a>
                        <a href="delete.php?id=<?= $row["id_client"]?>&class=3"><i class="fas fa-trash"></i></a>
                        <a href="edit.php?id=<?= $row["id_client"]?>&class=1"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
                <?php endwhile; ?>
                
            </table>
            <div>
                <button class="btn btn-new-contact btn-modal"><a href="create.php?class=1" style="color : #fff;">nouveau client </a></button>
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
            tr =document.querySelectorAll(".show-contacts table tbody tr");

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
