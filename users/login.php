<?php 
    session_start(); 
?>
<?php require "head.php";?>
    <?php
       
        if(isset($_POST["connect"])){
            $req = mysqli_query($con,"SELECT * FROM personnel"); 
            if(!$req){
                echo "erreur de requette";  
            }
            while($row = mysqli_fetch_assoc($req)){
                extract($_POST);
                extract($row);
                if($login_perso == $login AND $pass == $password){
                    $_SESSION["con"] = "1234";
                    $_SESSION["username"] = $login_perso;
                    $_SESSION["img"] = $photo;
                    header("Location: index2.php");
                }else{
                    $message = "mot de passe ou identifiant incorrect";
                }
            }
        }
    ?>
    <div class="container">
        <div class="wrapper2" >
            <form method="post">
                <h2>se connecter</h2>
                <p style ="color :red; text-align:center;">
                    <?php if(isset($message)){
                        echo $message;}
                    ?>
                </p>
                <div style="display:flex;flex-direction:column;gap:10px">
                    <div >
                        <label>login</label>
                        <input type="text" name="login">
                    </div>
                    <div>
                        <label>mot de passe</label>
                        <input type="password" name="pass">
                    </div>
                <div>
                <input type="submit" name="connect" id="submit">
            </form>
        </div>
</body>
</html>