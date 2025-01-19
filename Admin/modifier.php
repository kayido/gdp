<?php $message=""; ?>
<?php require 'connexion.php'; ?>
<?php if(isset($_POST['submit'])){
$req = mysqli_query($con,'SELECT * FROM admin'); 
$row = mysqli_fetch_assoc($req);
if(!$req){
echo "requete de selection mal effectue";
}
extract($_POST);
if($last_identif ==$row['nom_ad'] && $last_pass == $row['password']){
if(!empty($last_identif) && !empty($last_pass) && !empty($new_identif) && !empty($new_pass)){
  $req = mysqli_query($con ,"UPDATE admin SET nom_ad = '$new_identif', password = '$new_pass' WHERE id = 1");
  if($req){
    $message = "<p style='color:green; text-align:center;'>information modifier avec sucess</p>";
  }else{
    $message = "<p style='color:red;text-align:center;' >echec de la modification avec sucess</p>";
    echo "vrai2";
  }
}
}else{
  $message= "<p style='color:red; text-align:center;'>erreur sur les information entrées</p>";
}

} ?>

<?php if(!empty($_COOKIE['jeton'])): ?>
<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Responsiive Admin Dashboard | CodingLab</title>
    <link rel="stylesheet" href="admin-in.css" />
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <?php include "header.php" ?>
      <div class="home-content">
        <div class="sales-boxes">
            <div class="wrapper-add">
              <p><?php if(isset($message)){ echo $message;}?></p>
                <form method="post">
                    <div>
                        <label>ancien identifiant</label>
                        <input type="text" id="last_identified" name="last_identif">
                    </div>
                    <div>
                        <label>ancien mot de passe</label>
                        <input type="text" id="last_pass" name="last_pass">
                    </div>
                    <div>
                        <label>nouveau identifiant</label>
                        <input type="text" id="new_identified" name="new_identif">
                    </div>
                    <div>
                        <label>nouveau mot de passe</label>
                        <input type="text" id="new_pass" name="new_pass">
                    </div>
                        <input type="submit" id="submit" name="submit">
                    </div>
                </form>
          </div>
        </div>
    </section>
    <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
  </body>
</html>
<?php else:
    echo "vous n etes connecte veuillez vous"; ?>
    <a href="/new/Admin/admin_conn.php"> connecter</a>
  <?php
  endif ?>