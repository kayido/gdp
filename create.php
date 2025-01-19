<?php
    session_start();
    if(isset($_SESSION["connected"])):
?>
<?php    
    require_once ("header.php");
    $class = $_GET['class'];
?>
<style>
     form textarea{
        width : 100%;
        height : 100px;
        resize : none;
        text-align : justify;
        font-size : 1.1em;
        font-family: 'Times New Roman', Times, serif;
    }
</style>
<div class="main-create">
<h2><?php 
        switch($class):
            case 1 :
                echo"ajouter un client";
            break;
            case 2 :
                echo"ajouter un admin";
            break;
            case 3 :
                $id = $_GET["id"];
                echo "ajouter une tache";
            break;
            case 4 : 
                echo "ajouter un projet";
            break;
        endswitch;
    ?>
    </h2>
    <hr>
    <?php if($class==1) :?>
    <div class="clients">
        
        <?php
            if(isset($_POST["submit-form-staff"])){
                extract($_POST);
                $atvdesc = "ajout d un client nommé : $name ";
                $transport = formimg($_FILES,$name,$email,$tel,$adress,$birth);
                $req = mysqli_query($con,"INSERT INTO client VALUES(NULL,'$name','$email','$tel','$adress','$birth','$transport')");
                if(!$req){
                    echo "erreur de requette";   
                }else{
                    $actor = $info["id_u"];
                    echo $actor;
                    $upd = mysqli_query($con,"INSERT INTO  activite VALUES (null,CURRENT_TIMESTAMP,'$atvdesc','$actor','0','0')");
                    if(!$upd){
                        echo mysqli_error($con);
                    }else{
                        header("Location: contacts.php");
                    }
                }
            }

        ?>
        <div class="form-client" >
            <form method="post" action="" enctype="multipart/form-data">
                <!-- <span class="btn btn-cancel-form-staff btn-modal-staff">x</span> -->
                <label>nom </label>
                <input type="text"  name="name" id="name-cli" require>
                <label>email</label>
                <input type="email" id="email" name="email" placeholder="ex: nom@votreentreprise" require>
                <label>date de naissance</label>
                <input type="date" id="birth" name="birth" require>
                <label>phone</label>
                <input type="tel" name="tel" id="tel" require>
                <label>sa photo & logo</label>
                <input type="file" name="pf" id="pf" require>
                <label>adresse</label>
                <input type="text" name="adress" id="adress" require>
                <input type="submit" value="enregistrer" id="submit-form-staff" name="submit-form-staff">
            </form>
        </div>
    </div>
    <?php endif ;?>
    <?php if($class == 2) : ?>
    <div class="users"  >
    <h1>
        <?php
            if(isset($_POST["submit-user"])){
                extract($_POST);
                $transport = formimg($_FILES,$name,$email,$tel,$adress,$birth);
                $trigth = implode(",",$urigth);
                if(!empty($login) && !empty($password) && !empty($trigth)){
                    $req = mysqli_query($con,"INSERT INTO utilisateurs (id_u,nom_u,ddn_u,email_u,add_u,tel_u,pp,login,pw,droit,poste,date_enregistrement) VALUES(NULL,'$name','$birth','$email','$adress','$tel','$transport','$login','$password','$trigth','$poste',CURRENT_TIMESTAMP)");
                    if(!$req){
                        echo "erreur de requette:".mysqli_error($con);   
                    }else{
                        echo "<p style='text-align:center;color:green;font-size:1.1em;'>utilisateur crée avec sucess</p>";
                        $actor = $info["id_u"];
                        $atvdesc = "creation d un nouvel utilisateur nommé: $name ";
                        $upd = mysqli_query($con,"INSERT INTO  activite VALUES (null,CURRENT_TIMESTAMP,'$atvdesc','$actor','$v','0')");
                        if(!$upd){
                            echo mysqli_error($con);
                        }else{
                            header("Location: parametre.php");
                        }
                    }
                }else{
                    echo "<p style='text-align:center;color:red;font-size:1.1em;'> remplissez toute vos informations</p>";
                }
            }

        ?></h1>
        <form method="post" action="" enctype="multipart/form-data">
            <fieldset>
                <legend>coordonnées</legend>
                <!-- <span class="btn btn-cancel-form-staff btn-modal-staff">x</span> -->
                <label>nom </label>
                <input type="text"  name="name" id="name">
                <label>email</label>
                <input type="email" id="email" name="email" placeholder="ex: nom@votreentreprise">
                <label>date de naissance</label>
                <input type="date" id="birth" name="birth">
                <label>phone</label>
                <input type="tel" name="tel" id="tel-users" >
                <label>sa photo & logo</label>
                <input type="file" name="pf" id="pf-cli">
                <label>adresse</label>
                <input type="text" name="adress" id="adress-cli">
                <label>poste</label>
                <input type="text" name="poste" >
            </fieldset>
            <fieldset>
                <legend>connexion</legend>
                <label>login</label>
                <input type="text" name="login">
                <label>mot de passse</label>
                <input type="password" name="password">
                <label>liste des droits</label>
                <table>
                    <tr>
                        <td>projet</td>
                        <td><input type="checkbox" value="projet" name="urigth[]"></td>
                    </tr>
                    <tr>
                        <td>tache</td>
                        <td><input type="checkbox" value="tache" name="urigth[]"></td>
                    </tr>
                    <tr>
                        <td>client</td>
                        <td><input type="checkbox" value="client" name="urigth[]"></td>
                    </tr>
                    <tr>
                        <td>personnel</td>
                        <td><input type="checkbox" value="personnel" name="urigth[]"></td>
                    </tr>
                    <tr>
                        <td>budjet</td>
                        <td><input type="checkbox" value="budjet" name="urigth[]"></td>
                    </tr>
                    <tr>
                        <td>users</td>
                        <td><input type="checkbox" value="users" name="urigth[]"></td>
                    </tr>
                    <tr>
                        <td>historique</td>
                        <td><input type="checkbox" value="historique" name="urigth[]"></td>
                    </tr>
                </table>
                <input type="submit" name="submit-user" id="submit_user">
            </fieldset>
        </form>
    </div>
    <?php endif ; ?>
    <?php if($class==3) : ?>
    <div class="taches">
        <?php 
                
                $req3 = mysqli_query($con,"SELECT * FROM projet where id_pro = '$id' ");
                $row3 = mysqli_fetch_assoc($req3);
        ?>
        <?php 
            // if(isset($_POST["submit-tache"])){
            //     extract($_POST);
            //     print_r($_POST);
            //     print_r($_FILES);
            //     $t_projet = $row3["id_pro"];
                
            //     if(!empty($nom_tache) && !empty($date_debut_tache) && !empty($date_fin_tache) && !empty($cout_tache) AND !empty($perso) AND !empty($t_projet)){
            //         if(!empty($_FILES['pf'])){
            //             echo "img selected";
            //             $img_nom=$_FILES['pf']['name'];
            //             $tmp_nom = $_FILES['pf']['tmp_name'];
            //             $time =time();
            //             $nouveau_nom_img = $time.$img_nom;
            //             $deplacer_img = move_uploaded_file($tmp_nom,"image_bdd/".$nouveau_nom_img);
            //             $req = mysqli_query($con,"INSERT INTO tache (id_tache,nom_tache,description,date_debut,date_fin,cout,id_pro,id_perso) values(null,'$nom_tache','$description','$date_debut_tache','$date_fin_tache','$cout_tache','$t_projet','$perso')");
                        
            //         if(!$req){
            //             echo "erreur de la requette".mysqli_error($con);
            //         }else{
            //             echo "<p style='color:green;font-size:1.1em;text-align:center;'>tache creer avec sucess</p>";
            //             $idr = mysqli_query($con, "SELECT max(id_tache) as id FROM tache");
            //             if(!$idr){
            //                 echo mysqli_error($con);
            //             }
            //             $od = mysqli_fetch_assoc($idr);
            //             $rid = $od["id"];
            //             $img = mysqli_query($con,"INSERT INTO fichier  values(null,'$img_nom','$id')");
            //         }
            //         }else{
            //             $message = "veuillez choisir une image de taille inferieru a 1Mo";
            //         }
                
            //         }else{
            //             echo "<p style='color:red;font-size:1.1em;text-align:center;'>remplissez tous les champs</p>";
            //         }
            //     }
        
            if(isset($_POST["submit-tache"])){
                extract($_POST);
                $req = mysqli_query($con,"SELECT * FROM projet WHERE id_pro = '$id'");
                $fd = mysqli_fetch_assoc($req);
                $fond = $fd["fd"];
                $t_projet = $row3["id_pro"];
                if(!empty($nom_tache) && !empty($date_debut_tache) && !empty($date_fin_tache) && !empty($cout_tache) AND !empty($perso) AND !empty($t_projet)){
                    if(!empty($_FILES["pf"]["name"])){
                        $img_nom=$_FILES['pf']['name'];
                        $tmp_nom = $_FILES['pf']['tmp_name'];
                        $time =time();
                        $nouveau_nom_img = $time.$img_nom;
                        $deplacer_img = move_uploaded_file($tmp_nom,"image_bdd/".$nouveau_nom_img);
                    }           
                    if($cout_tache<$fond){
                        $req = mysqli_query($con,"INSERT INTO tache (id_tache,nom_tache,description,date_debut,date_fin,cout,id_pro,id_perso) values(null,'$nom_tache','$description','$date_debut_tache','$date_fin_tache','$cout_tache','$t_projet','$perso')");
                        $soust = $fond - $cout_tache;
                        $upd = mysqli_query($con,"UPDATE projet SET fd ='$soust' WHERE id_pro = '$id'");
                        $actor = $info["id_u"];
                        require("mail/sendmailtache.php");
                        $atvdesc = "creation d une nouvelle tache : $nom_tache ";
                        $upd = mysqli_query($con,"INSERT INTO  activite VALUES (null,CURRENT_TIMESTAMP,'$atvdesc','$actor','$id','0')");
                        if(!$upd){
                            echo mysqli_error($con);
                        }else{

                            if(!empty($_FILES["pf"]["name"])){
                                if($req){
                                    $idr = mysqli_query($con, "SELECT max(id_tache) as id FROM tache");
                                    if(!$idr){
                                        echo mysqli_error($con);
                                    }
                                    $od = mysqli_fetch_assoc($idr);
                                    $rid = $od["id"];
                                    $img = mysqli_query($con,"INSERT INTO fichier values(null,'$img_nom','$nouveau_nom_img','$rid')");
                                    if(!$img){
                                        echo "fichier non importer".mysqli_error($con);
                                    }
                              
                                }else{
                                    echo "<p style='color:red;font-size:1.1em;text-align:center;'>tache failed</p>";
                                }
                                
                            }
                                
                            echo "<script>alert('tache creer avec sucess')</script>";
                            echo "<script>window.location = 'projet/tache-projets.php?id=$id';</script>";  
                            // header("Location: task-projects.php?id=$id");
                        }
                    }else{
                        echo "<script>alert('fond indisponible')</script>";
                    }
                }else{
                    echo "<p style='color:red;font-size:1.1em;text-align:center;'>remplisser toute les informations</p>";
                }     
            }
        ?>
        <form method="post" class="form-tache" enctype="multipart/form-data">
           
            <input type="text " disabled  value="<?= $row3["n_pro"] ?>">
            <label for="">nom de la tache</label>
            <input type="text" id="nom_tache" name="nom_tache">
            <label>Description</label>
            <textarea name="description">

            </textarea>
            <label for="">date de debut</label>
            <input type="date" name="date_debut_tache" >
            <label for="date_fin">date de fin</label>
            <input type="date" name="date_fin_tache" >
            <label for="cout-tache">budjet</label>
            <input type="number" id="cout_tache" name="cout_tache">
            <label for="doing">assigné a</label>
            <select name="perso" label="choisir le personnel">
                <optgroup label="internes">
                    <?php 
                        $req2 = mysqli_query($con,"SELECT id_perso,nom_perso FROM personnel where statut = 'interne'");
                        while($row2 = mysqli_fetch_assoc($req2)):
                    ?>
                        <option value="<?= $row2["id_perso"] ?>"><?= $row2["nom_perso"]?></option>
                    <?php endwhile; ?>
                </optgroup>
                <optgroup label="externes">
                    <?php 
                        $req2 = mysqli_query($con,"SELECT * FROM personnel where statut = 'externe'");
                        while($row2 = mysqli_fetch_assoc($req2)):
                    ?>
                        <option value="<?= $row2["id_perso"] ?>"><?= $row2["nom_perso"]?></option>
                    <?php endwhile; ?>
                </optgroup>
            </select>
            <label>importer le fichier de la tache(optionnel)</label>
            <input type="file" name="pf">
            <input type="submit" name="submit-tache" id="submit_task" value="creer">
        </form>
    </div>
    <?php endif; ?>
    <?php if($class == 4) : ?>
    <div class="projets">
        <?php 
            if(isset($_POST["submit-form"])){
                extract($_POST);
                if(!empty($name) && !empty($start) && !empty($end) && !empty($budjet) && !empty($client) && !empty($desc)){
                    $req = mysqli_query($con,"INSERT INTO projet (id_pro,n_pro,d_deb_pro,d_fin_pro,avan,bud_pro,id_client,desc_pro) VALUES(NULL,'$name','$start','$end',0,'$budjet','$client','$desc')");
                    if(!$req){
                        echo "erreur de requette";   
                    }else{
                        "<p style='color:green;font-size:1.1em;text-align:center'>projet creer avec sucess</p>";
                        $actor = $info["id_u"];
                        $atvdesc = "creation d un nouveau projet: $name ";
                        $upd = mysqli_query($con,"INSERT INTO  activite VALUES (null,CURRENT_TIMESTAMP,'$atvdesc','$actor','0','0')");
                        if(!$upd){
                            echo mysqli_error($con);
                        }else{
                            echo "<script>alert('projet $name crée')</script>";
                        }
                    }
                }
            }
        ?>
        <div class="form-project" >
            <form method="post" action="">
                <label>nom du projet</label>
                <input type="text"  name="name" id="name-project">
                <label>description</label>
                <textarea name="desc">
                </textarea>
                <label>date debut </label>
                <input type="date" name="start" id="start-date">
                <label>date fin (optionnel)</label>
                <input type="date" name="end" id="start-date">
                <label>client</label>
                <select name="client" id="client-project">
                    <?php 
                        $req = mysqli_query($con,"SELECT nom_client,id_client FROM client");
                        while($row=mysqli_fetch_assoc($req)):
                    ?>
                    <option value="<?= $row["id_client"] ?>"><?= $row["nom_client"] ?></option>
                    <?php endwhile; ?>
                </select>
                <label>budjet</label>
                <input type="number" name="budjet" >
                <input type="submit" value="creer" id="submit-project" name="submit-form">
            </form>
        </div>
    </div>
    <?php endif; ?>
    <?php if($class == '5'): ?>
    <div class="versement">
        <h2>ajouter un versement</h2>
        <?php 
            $id = $_GET["id"];
            if(isset($_POST["submit_ver"])){
                
                $sel = mysqli_query($con,"SELECT * FROM projet where id_pro = '$id'");
                $recup = mysqli_fetch_assoc($sel);
                $req5 = mysqli_query($con,"SELECT * from versement JOIN projet ON projet.id_pro = versement.id_pro where projet.id_pro = '$id' ");
                if(!$req5){
                    echo mysqli_error($con);
                }
                $soldedepense = 0;
                while($sum =mysqli_fetch_assoc($req5)){
                    $soldedepense += $sum["montant"]; 
                }
                extract($_POST);
                if(($soldedepense + $montant) > $recup["bud_pro"]){
                    echo "impossible d effectuer un versement";
                }else{
                    $id = $_GET["id"];
                    if(!empty($_FILES['pf']) && isset($intitule) && isset($montant)){
                        $img_nom=$_FILES['pf']['name'];
                        $tmp_nom = $_FILES['pf']['tmp_name'];
                        $time =time();
                        $nouveau_nom_img = $time.$img_nom;
                        $deplacer_img = move_uploaded_file($tmp_nom,"image_bdd/".$nouveau_nom_img);
                        $req = mysqli_query($con,"INSERT INTO versement VALUES(null,'$intitule',CURRENT_TIMESTAMP,'$montant','$nouveau_nom_img','$id')");
                        if(!$req){
                            echo "erreur sur le fichier";
                        }else{
                            echo "<script>alert('versement effectue')</script>";
                            echo "<script>window.location = 'projet/versement.php?id=$id';</script>";  

                        }
                    }else{
                            $message = "veuillez choisir une image de taille inferieru a 1Mo";
                    }
                }
                                
                
            }
        ?>
        <style>
            form label{
                display:block;
            }
            form input{
                width : 100%;
                outline : none;
                height : 25px;
            }
            form #submit-ver{
                background : #00309B;
                color : #fff;
                border: none; 
            }
        </style>
        <form method="post" enctype="multipart/form-data">
            <?php if(isset($message)) echo $message; ?>
            <label>intitulé</label>
            <input type="text" name="intitule">
            <label>montant</label>
            <input type="number" name ="montant">
            <label>importer le recu de payement</label>
            <input type="file" name="pf">
            <input type="submit" id='submit-ver' name="submit_ver" value="enregistrer le versement"> 
        </form>
    </div>
    <?php endif; ?>
</div>
</div>
<?php require_once ("footer.php");?>
<?php else:
    header("Location: index.php");
endif; ?>


