<?php require "head.php";?>
<div class="container">
     
        <?php
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
                    $req = mysqli_query($con, "INSERT INTO personnel (id_perso,nom_perso,date_naissance,email,telephone,password,adresse,photo,poste,statut,etat,login_perso) 
                    VALUES(null,'$full_name','$birth','$email','$tel','$password','$adress',' $nouveau_nom_img','$poste','$statut','etude','$login') "); 
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
        <div class="wrapper3">
            <form method="post" enctype="multipart/form-data">
                <h2>enregistrement</h2>
                <p style="color : red; text-align:center;"><?php if(isset($message1)): echo $message1; endif?></p>
                <p style="color : green;text-align:center;"><?php if(isset($message)): echo $message; endif?></p>
                <fieldset>
                    <legend>vos coordonnées</legend>
                    <label>nom </label>
                    <input type="text" name = "nom" >
                    <label>prenom</label>
                    <input type="text" name="prenom">
                    <label>date de naissance</label>
                    <input type="date" name="birth">
                    <label>votre email</label>
                    <input type="email" name="email">
                    <label>telephone</label>
                    <input type="tel" name="tel">
                    <label>photo de profil</label>
                    <input type="file" name="pf">
                    <label>votre adresse</label>
                    <input type="text" name="adress">
                    <label>poste</label>
                    <input type="text" name="poste">
                    <label>statut</label>
                    <select label="votre statut" name="statut">
                        <option value="interne">interne</option>
                        <option value="externe">externe</option>
                    </select>
                </fieldset>
                <fieldset>
                    <legend>informations de connexions</legend>
                    <label>login</label>
                    <input type="text" name="login">
                    <label>mot de passe</label>
                    <input type="password" name="password">
                </fieldset>
                <input type="submit" name="submit-staff">
            </form>
        </div>
    </div>
    <script>
        
        let wrapper = document.querySelector(".wrapper");
        let wrapper1 = document.querySelector(".wrapper2");
        let wrapper2 = document.querySelector(".wrapper3");
        wrapper.style.display = "block";
        wrapper1.style.display = "none";
        wrapper2.style.display = "none";
            
        let btn1 = document.getElementById("acc");
        let btn2 = document.getElementById("sc");
        let btn3 = document.getElementById("sin");
        console.log(btn1);
        console.log(btn2);
        console.log(btn3);
        btn1.addEventListener("click", function s(){
            wrapper.style.display = "block";
            wrapper1.style.display = "none";
            wrapper2.style.display = "none";
            
        })
        btn2.addEventListener("click", function s(){
            wrapper.style.display = "none";
            wrapper1.style.display = "block";
            wrapper2.style.display = "none";
        })
        btn3.addEventListener("click", function s(){
            wrapper.style.display = "none";
            wrapper1.style.display = "none";
            wrapper2.style.display = "block";
        })
    </script>
    
</body>
</html>