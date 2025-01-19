<?php
    session_start();
    if(isset($_SESSION["con"])):
?>
<?php require("../connexion.php"); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="pragma" content="no-cache">
    <link rel="stylesheet" href="../assets/css/edit.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <title>Dashbord</title>
</head>
<body>
<style>
    .edit .wrapper3{
        width : 60%;
        background : #fff;
        padding : 10px 20px;
        margin : auto;
        margin-top: 50px;
    }
    .edit .wrapper3 form input{
        display :block;
        width : 100%;
        height : 25px;
        outline : none;
        margin-bottom : 5px;
    }
    #submit-staff{
        background :#00309B;
        border : none;
        border-radius : 5px;
        margin-top : 15px;
        color: #fff;
    }
    @media (max-width: 600px){
        .edit .wrapper3{
            width: 80%;
        }
    }
</style>
<div class="edit" >
     
        <?php
            $id = $_GET["id"];
            $modif = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM personnel WHERE id_perso = '$id'"));            
            if(isset($_POST["submit-staff"])){
                extract($_POST);
                $full_name = $nom." ".$prenom;
                echo $full_name;
                if(!empty($full_name) && !empty($birth) && !empty($email) && !empty($tel) && !empty($adress) && !empty($login) && !empty($password)){
                    $atvdesc = "ajout d un client nommé : $full_name ";
                    if(!empty($_FILES['pf']) && isset($full_name) && isset($email) && isset($tel) && isset($adress) && isset($birth)){
                        $img_nom=$_FILES['pf']['name'];
                        $tmp_nom = $_FILES['pf']['tmp_name'];
                        $time =time();
                        $nouveau_nom_img = $time.$img_nom;
                        $deplacer_img = move_uploaded_file($tmp_nom,"../image_bdd/".$nouveau_nom_img);
                    
                    }else{
                            $message1 = "veuillez choisir une image de taille inferieru a 1Mo";
                    }
                    $req = mysqli_query($con, "UPDATE personnel SET nom_perso ='$full_name',date_naissance ='$birth',email = '$email',telephone = '$tel',password = '$password',adresse = '$adress' , photo ='$nouveau_nom_img',poste ='$poste' ,statut='$statut',login_perso = '$login' WHERE id_perso = '$id'" );
                    if(!$req){
                        echo "erreur de requette";
                    }else{
                         $message= "enregistrement reussi, nous vous enverons un mail de confirmation";
                    }    
            } else{
                $message1 = "remplissez tous les champs";
            }
            }


        ?>
        <div class="wrapper3" >
           <?php if(isset($full_name)){
                echo $full_name;
            }?>
            <form method="post" enctype="multipart/form-data">
                <h2>Modifier vos informations</h2>
                <p style="color : red; text-align:center;"><?php if(isset($message1)): echo $message1; endif?></p>
                <p style="color : green;text-align:center;"><?php if(isset($message)): echo $message; endif?></p>
                <fieldset>
                    <legend>vos coordonnées</legend>
                    <label>nom </label>
                    <input type="text" name = "nom" value="" >
                    <label>prenom</label>
                    <input type="text" name="prenom">
                    <label>date de naissance</label>
                    <input type="date" name="birth" value="<?= $modif['date_naissance'] ?>">
                    <label>votre email</label>
                    <input type="email" name="email" value="<?= $modif['email'] ?>">
                    <label>telephone</label>
                    <input type="tel" name="tel" value="<?= $modif['telephone'] ?>">
                    <label>photo de profil</label>
                    <input type="file" name="pf">
                    <label>votre adresse</label>
                    <input type="text" name="adress" value="<?= $modif['adresse'] ?>">
                    <label>poste</label>
                    <input type="text" name="poste" value="<?= $modif['poste'] ?>">
                    <label>statut</label>
                    <select label="votre statut" name="statut">
                        <option value="interne">interne</option>
                        <option value="externe">externe</option>
                    </select>
                </fieldset>
                <fieldset>
                    <legend>informations de connexions</legend>
                    <label>login</label>
                    <input type="text" name="login" value="<?= $modif['login_perso'] ?>">
                    <label>mot de passe</label>
                    <input type="password" name="password" value="<?= $modif['password'] ?>">
                </fieldset>
                <input type="submit" name="submit-staff" id="submit-staff">
            </form>
        </div>
    </div>
<?php require "footer.php";?>
<?php else:
    header("Location: index.php");
endif; ?>
