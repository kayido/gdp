<?php
    session_start();
    if(isset($_SESSION["connected"])):
?>
<?php 
    require_once ("header.php");
    $id = $info["id_u"];
?>
<div class="main">   
    <div class="main-menu">
        <h2 style="display: block;">Dashboard</h2>
        <div class="button">
            <?php if(el_exist($right,"projet")): ?>
            <button><a href="create.php?class=4">creer un projet</a></button>
            <?php endif; ?>
            <?php if(el_exist($right,"personnel")): ?>
            <button><a href="create.php?class=1">ajouter un client</a></button>
            <?php endif; ?>
        </div>
    </div>
    <?php 
        $reqec = mysqli_query($con,"SELECT COUNT(*) FROM projet WHERE stat = 'en cours'");
        $reqt = mysqli_query($con,"SELECT COUNT(*) FROM projet WHERE stat ='termine'");
        $reqatt = mysqli_query($con,"SELECT COUNT(*) FROM projet WHERE stat = 'en attende'");
        $reqer = mysqli_query($con,"SELECT COUNT(*) FROM projet WHERE stat = 'retard'");
        $datec = mysqli_fetch_assoc($reqec);
        $datt = mysqli_fetch_assoc($reqt);
        $datatt = mysqli_fetch_assoc($reqatt);
        $dater = mysqli_fetch_assoc($reqer);
    
    ?>
    <div class="main-content">
        <div class="sales-boxes">
            <div class="box " style="background-color: orange;">
                <i class="fas fa-tasks"></i>
                <p>nombres de projets en cours</p>
                <p>
                    <?php 
                        if(el_exist($right,"projet")){ 
                            echo $datec["COUNT(*)"];
                        }else{
                            echo "-----";
                        }
                    ?>
                </p>
            </div>
            <div class="box" style="background-color: green;">
                <i class="fas fa-tasks"></i>
                <p>nombres de projets terminés</p>
                <p>
                    <?php 
                        if(el_exist($right,"projet")){ 
                            echo $datt["COUNT(*)"];
                        }else{
                            echo "-----";}
                    ?>
                </p>
            </div>
            <div class="box" style="background-color: #aaa;">
                <i class="fas fa-tasks"></i>
                <p>nombres de projets en attendes</p>
                <p>
                <?php 
                        if(el_exist($right,"projet")){ 
                            echo $datatt["COUNT(*)"];
                        }else{
                            echo "-----";}
                    ?>
                </p>
            </div>
            <div class="box" style="background-color: red;">
                <i class="fas fa-tasks"></i>
                <p>nombres de projets en retards</p>
                <p>
                <?php 
                        if(el_exist($right,"projet")){ 
                            echo $dater["COUNT(*)"];
                        }else{
                            echo "-----";}
                    ?>
                </p>
            </div>
        </div>
        <?php 
            $reqtec =mysqli_query($con,"SELECT COUNT(*) FROM tache WHERE statut_tache = 'en cours'");
            $reqtt =mysqli_query($con,"SELECT COUNT(*) FROM tache WHERE statut_tache = 'termine'");
            $reqtr =mysqli_query($con,"SELECT COUNT(*) FROM tache WHERE statut_tache = 'retard'");
            $reqtatt =mysqli_query($con,"SELECT COUNT(*) FROM tache WHERE statut_tache = 'en attende'");
            $dattec = mysqli_fetch_assoc($reqtec);
            $dattt = mysqli_fetch_assoc($reqtt);
            $dattr = mysqli_fetch_assoc($reqtr);
            $dattatt = mysqli_fetch_assoc($reqtatt);
        
        ?>
        <?php if(el_exist($right,'tache')):?>
        <h2>taches</h2>
        <div class="graphics">
            <input type="number" id="ter" value="<?= $dattr["COUNT(*)"] ?>" style="display:none;">
            <input type="number" id="ttt" value="<?= $dattt["COUNT(*)"] ?>" style="display:none;">
            <input type="number" id="taa" value="<?= $dattatt["COUNT(*)"] ?>" style="display:none;">
            <input type="number" id="tec" value="<?= $dattec["COUNT(*)"] ?>" style="display:none;">
            <?php 
                $a = $dattr["COUNT(*)"];
                $b =$dattt["COUNT(*)"] ; 
            ?>
            <div class="chart-container" style="position: relative; height:350px; width:350px">
                <canvas id="myChart" ></canvas>
            </div>
            <div class="commentary">
                <style>
                    td{
                        width : 150px;
                        color : #aaa;
                    }

                </style>
                <table>
                    <tr>
                        <td><div style="width:50px;height: 50px ; border-radius: 50%; background-color: green; "></div></td>
                        <td>tache termine</td>
                    </tr>
                    <tr>
                        <td><div style="width:50px;height: 50px ; border-radius: 50%; background-color: orange; "></div></td>
                        <td>tache en cours</td>
                    </tr>
                    <tr>
                        <td><div style="width:50px;height: 50px ; border-radius: 50%; background-color: #aaa; "></div></td>
                        <td>tache en attende</td>
                    </tr>
                    <tr>
                        <td><div style="width:50px;height: 50px ; border-radius: 50%; background-color: #f00; "></div></td>
                        <td>tache depassé</td>
                    </tr>
                </table>
                <div class="">
                    <?php 
                        $message = "bonne";
                        if($a<5){
                            $message =  "bonne";
                        }else{
                            $message =  "mauvaise";
                        }
                    ?>
                    <h1> performance : <span 
                    style =' <?php 
                            if($a<5){
                                echo "color : green;";
                            }else{
                                echo "color : red;";
                            }
                        ?> text-align : center;'
                    ><?php echo "$message"; ?></span></h1>
                </div>
            </div>
            
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        </div>
        
        <?php endif; ?>
        
    </div>
</div>
</div>
<?php require_once ("footer.php");?>
<?php else:
    header("Location: index.php");
endif; ?>



















