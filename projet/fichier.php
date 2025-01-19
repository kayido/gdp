<?php
    session_start();
    if(isset($_SESSION["connected"])):
?>
<?php  require_once ("header.php");?>

    <div class="fichier_project <?php if(el_exist($right,"tache")): ?>menu_project<?php endif; ?>" <?php if(!el_exist($right,"tache")): ?>style = "display : none;"<?php endif; ?>>
        <div class="head-task-project">
        <h2><?= $data["n_pro"] ?></h2>
            <!-- <div class="search-bar">
                <input type="search" onkeyup="ajaxing()" id="search" name="search">
                 <label><i class="fas fa-search"></i></label> 
            </div>
             -->
        </div>
        
        <form method = "post" action = "task-projects.html">
            <table id="sugg">
                <tr>
                    <th style="width: 10px; text-align: left;"></th>
                    <th class="td-1" style="width: 5%; text-align: left;">N°</th>
                    <th style="width: 15%; text-align: center;">nom_fichier</th>
                    <th style="width: 10%; text-align: center;" >tache</th>
                    <th style="width: 100px; text-align: center;">action</th>
                </tr>
                <?php  
                    $req6 = mysqli_query($con,"SELECT * FROM fichier JOIN  tache ON tache.id_tache = fichier.id_tache JOIN projet ON projet.id_pro = tache.id_pro WHERE projet.id_pro ='$id'");
                    if(!$req6){
                        echo "requette nm valide".mysqli_error($con);
                    }
                    while($row4 = mysqli_fetch_assoc($req6)):
                ?>
                <tr>
                    <td style="width: 10px; text-align: left;"><input type="checkbox"></td>
                    <td class="td-1" style="width: 5%; text-align: left;"><?= $row4["id_fic"] ?></td>
                    <td style="width: 15%; text-align: center;"><?= $row4["nom_fic"] ?></td>
                    <td style="width: 10%; text-align: center;" ><?= $row4["nom_tache"] ?></td>
                    <td>
                        <a href="" download="<?= $row4["path"] ?>"><i class="fas fa-download"></i></a>
                        <a href="task-projects.html"><i class="fas fa-eye"></i></a>
                        <a href="#"><i class="fas fa-trash"></i></a>
                        <a href=""><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
            <div class="button">
                <button><a href="#" id="select_task_all">tout selectionner</a></button>
                <button type="button" class="btn btn-new-task btn-modal-task">supprimer</button>
            </div>
        </form>
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