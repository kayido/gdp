<?php
    session_start();
    if(isset($_SESSION["connected"])):
?>
<?php    
     require('function.php');
     require("connexion.php");
     $user = $_SESSION["username"];
     $rightreq = mysqli_query($con,"SELECT nom_u,pp,id_u,droit FROM utilisateurs WHERE login ='$user'");
   
     $datareq = mysqli_fetch_assoc($rightreq);
     extract($datareq);
     $right = explode(",",$datareq["droit"]);
     $info = [
         "id_u" => $id_u,
         "nom_u" => $_SESSION["username"]
     ];
    $class = $_GET['class'];
    $id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="pragma" content="no-cache">
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <link rel="stylesheet" href="assets/css/edit.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
</head>
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
<body>
<div class="container">
<h2><?php 
        switch($class):
            case 1 :
                $title = "Modfier vos informations";
                $abs = mysqli_query($con,"SELECT * from projet WHERE id_client ='$id'");
                if(!$abs){
                    echo mysqli_error($con);
                }else{
                   if( $rep = mysqli_fetch_assoc($abs)){
                        $v = $rep["id_client"];
                   }else{
                        $v = 0;
                   }
                }
            
            break;
            case 2 :
                $title = "Modifier vos informations";
            break;
            case 3 :
                $title =  "ajouter une tache";
                $abs = mysqli_query($con,"SELECT id_pro from tache WHERE id_pro ='$id'");
                if(!$abs){
                    echo mysqli_error($con);
                }else{
                   if( $rep = mysqli_fetch_assoc($abs)){
                        $v = $rep["id_pro"];
                   }else{
                        $v = 0;
                   }
                }
            
            break;
            case 4 : 
                $title = "Modifier les informations du projet";
                $abs = mysqli_query($con,"SELECT id_pro from projet WHERE id_pro ='$id'");
                if(!$abs){
                    echo mysqli_error($con);
                }else{
                   if( $rep = mysqli_fetch_assoc($abs)){
                        $v = $rep["id_pro"];
                   }else{
                        $v = 0;
                   }
                }
            break;
        endswitch;
    ?>
    </h2>  
    <div class="main-edit-personnel">      
    <?php if($class==1) :?>
    <div class="clients">
        <?php
            
            $req = mysqli_query($con,"SELECT * FROM client where id_client ='$id'");
            $data = mysqli_fetch_assoc($req);
            $rid = $data["id_client"];
            if(isset($_POST["submit-form-staff"])){
                extract($_POST);
                $atvdesc = "modification des informations sur le client, nouveau nom : $name ";
                $transport = formimg($_FILES,$name,$email,$tel,$adress,$birth);
                $req = mysqli_query($con,"UPDATE client SET nom_client ='$name', email = '$email', telephone = '$tel', adresse = '$adress', date_naissance ='$birth', phto_profil = '$transport' WHERE id_client = $rid");
                if(!$req){
                    echo "erreur de requette";   
                }else{
                    $actor = $info["id_u"];
                    echo $actor;
                    $upd = mysqli_query($con,"INSERT INTO  activite VALUES (null,CURRENT_TIMESTAMP,'$atvdesc','$actor','$v','0')");
                    if(!$upd){
                        echo mysqli_error($con);
                    }else{
                        echo "<script>alert('modification reussi');</script>";
                        header("Location: contacts.php");
                    }
                }
            }

        ?>
        <div class="form-client" >
            
            <form method="post" action="" enctype="multipart/form-data">
                <h2><?= $title ?></h2>
                <!-- <span class="btn btn-cancel-form-staff btn-modal-staff">x</span> -->
                <label>nom </label>
                <input type="text"  name="name" id="name-cli" value="<?=$data['nom_client']?>" require>
                <label>email</label>
                <input type="email" id="email" name="email" value="<?=$data['email']?>" placeholder="ex: nom@votreentreprise" require>
                <label>date de naissance</label>
                <input type="date" id="birth" name="birth" value="<?=$data['date_naissance']?>" require>
                <label>phone</label>
                <input type="tel" name="tel" id="tel" value="<?=$data['telephone']?>" require>
                <label>sa photo & logo</label>
                <input type="file" name="pf" id="pf" value="<?=$data['phto_profil']?>" require>
                <label>adresse</label>
                <input type="text" name="adress" id="adress" value="<?=$data['adresse']?>" require>
                <input type="submit" value="enregistrer" class="submit" name="submit-form-staff">
            </form>
        </div>
    </div>
    <?php endif ;?>
    <?php if($class == 2) : ?>
    <div class="users"  >
    <h1>
        <?php
            $req = mysqli_query($con,"SELECT * FROM utilisateurs where id_u ='$id'");
            $data = mysqli_fetch_assoc($req);
            $rid = $data["id_u"];
            if(isset($_POST["submit-user"])){
                
                extract($_POST);
                $transport = formimg($_FILES,$name,$email,$tel,$adress,$birth);
                $trigth = implode(",",$urigth);
                if(!empty($login) && !empty($password) && !empty($trigth)){
                    $req = mysqli_query($con,"UPDATE utilisateurs SET nom_u = '$name', ddn_u ='$birth', email_u = '$email', add_u = '$adress', tel_u = '$tel', pp = '$transport', login = '$login', pw = '$password', droit = '$trigth' WHERE id_u = '$rid'" );
                    if(!$req){
                        echo "erreur de requette:".mysqli_error($con);   
                    }else{
                        echo "<p style='text-align:center;color:green;font-size:1.1em;'>utilisateur crée avec sucess</p>";
                        $actor = $info["id_u"];
                        $atvdesc = "modification de  utilisateur nommé: $name ";
                        $upd = mysqli_query($con,"INSERT INTO  activite VALUES (null,CURRENT_TIMESTAMP,'$atvdesc','$actor','$v','0')");
                        if(!$upd){
                            echo mysqli_error($con);
                        }else{
                            header("Location: param/utilisateur.php");
                        }

                    }
                }else{
                    echo "<p style='text-align:center;color:red;font-size:1.1em;'> remplissez toute vos informations</p>";
                }
            }

        ?></h1>
        <form method="post" action="" enctype="multipart/form-data">
            <h2><?= $title ?></h2>
            <fieldset>
                <legend>coordonnées</legend>
                <!-- <span class="btn btn-cancel-form-staff btn-modal-staff">x</span> -->
                <label>nom </label>
                <input type="text"  name="name" id="name" value="<?= $data["nom_u"]?>">
                <label>email</label>
                <input type="email" id="email" name="email" value="<?= $data["email_u"]?>"  placeholder="ex: nom@votreentreprise">
                <label>date de naissance</label>
                <input type="date" id="birth" name="birth" value="<?= $data["ddn_u"]?>">
                <label>phone</label>
                <input type="tel" name="tel" id="tel-users" value="<?= $data["tel_u"]?>">
                <label>sa photo & logo</label>
                <input type="file" name="pf" id="pf-cli" value="<?= $data["pp"]?>">
                <label>adresse</label>
                <input type="text" name="adress" id="adress-cli" value="<?= $data["add_u"]?>">
            </fieldset>
            <fieldset>
                <legend>connexion</legend>
                <label>login</label>
                <input type="text" name="login" value="<?= $data["login"]?>">
                <label>mot de passse</label>
                <input type="password" name="password" value="<?= $data["pw"]?>">
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
                <input type="submit" name="submit-user" class="submit" value="modifier">
            </fieldset>
        </form>
    </div>
    <?php endif ; ?>
    
    <?php if($class == 4) : ?>
    <?php 
        $id = $_GET["id"];
        $req = mysqli_query($con,"SELECT * FROM projet where id_pro ='$id'");
        $data = mysqli_fetch_assoc($req);
    ?>
    <div class="projets">
        <?php 
            if(isset($_POST["submit-form"])){
                extract($_POST);
                print_r($_POST);
                if(!empty($name) && !empty($start) && !empty($end) && !empty($budjet) && !empty($client) && !empty($desc)){
                    $req = mysqli_query($con,"UPDATE projet SET n_pro = '$name', desc_pro = '$desc', d_deb_pro = '$start', d_fin_pro= '$end', bud_pro ='$budjet', id_client ='$client' WHERE id_pro ='$id' ");
                    if(!$req){
                        echo "erreur de requette : -> ".mysqli_error($con);   
                    }else{
                        "<p style='color:green;font-size:1.1em;text-align:center'>projet creer avec sucess</p>";
                        "<script>projet creer avec sucess</script>";

                        $actor = $info["id_u"];
                        $atvdesc = "modification des informations sur le projet: $name ";
                        $upd = mysqli_query($con,"INSERT INTO  activite VALUES (null,CURRENT_TIMESTAMP,'$atvdesc','$actor','$v','0')");
                        if(!$upd){
                            echo mysqli_error($con);
                        }else{
                            header("Location: projets.php");
                        }
                    }
                }else{
                    "<p style='color:red;font-size:1.1em;text-align:center'>informations manquants</p>";
                }
            }
        ?>
        <div class="form-project" >
            <form method="post" action="">
                <h2><?= $title ?></h2>
                <label>nom du projet</label>
                <input type="text"  name="name" id="name-project" value="<?=$data["n_pro"]?>">
                <label>description</label>
                <textarea name="desc">
                    <?= $data["desc_pro"] ?>
                </textarea>
                <label>date debut </label>
                <input type="date" name="start" id="start-date" value="<?= $data["d_deb_pro"]?>">
                <label>date fin (optionnel)</label>
                <input type="date" name="end" id="end-date" value="<?=$data["d_fin_pro"]?>">
                <label>client</label>
                <select name="client" id="client-project" >
                    <?php 
                        $req = mysqli_query($con,"SELECT nom_client,id_client FROM client");
                        while($row=mysqli_fetch_assoc($req)):
                    ?>
                    <option value="<?= $row["id_client"] ?>"><?= $row["nom_client"] ?></option>
                    <?php endwhile; ?>
                </select>
                <label>budjet</label>
                <input type="number" name="budjet" value="<?= $data["bud_pro"]?>" >
                <input type="submit" value="modifier" class="submit" name="submit-form">
            </form>
        </div>
    </div>
    <?php endif; ?>
</div>
</div>
            </div>
        </div>
    </div>
   
    <script src="assets/js/script.js"></script>
   <script src="assets/js/projects.js"></script>
   <!-- <script src="assets/js/contacts.js"></script> -->
   <script src="assets/js/personnels.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
   <script src="assets/dist/index.global.min.js"></script>
   <script src="assets/js/task.js"></script>
   <script src="assets/js/task_projet.js"></script>
   <script src="assets/js/evenement.js"></script>
   <script src="assets/js/dashboard.js"></script>
   <script src="assets/js/create.js"></script>   
</body>
</html>
<?php else:
    header("Location: index.php");
endif; ?>