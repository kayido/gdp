<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin-in.css">
</head>
<style>
    .wrapper-read{
        width: 45%;
        height: 550px;
        margin: auto;
        position: relative;
        top: 150px;
        padding: 20px 30px;
        border-radius: 15px;
        box-shadow: 5px 10px 20px #aaa;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow-x: hidden;
        overflow-y: scroll;
    }
    .wrapper-read table tr td{
        width: 100px;
        padding: 10px 20px;
    }
    .wrapper-read h4{
        width: 100px;
        padding: 10px 20px;
    }
    .wrapper-read p{
        text-align: justify;
        padding: 10px 20px;
    }
    .wrapper-read .action{
        width: 100%;
        background-color: rgba(0,0,0,0.1);
    }
    .wrapper-read .action ul{
        display: flex;
        justify-content: space-between;
        list-style: none;
        font-size: 1.2em;
        padding: 10px 20px;
    }
    @media screen and (max-width : 700px) {
        .wrapper-read{
            width: 80%;
        }
    }
</style>
<body>
    <?php
        require "connexion.php";
        $id = $_GET['id'];
        $choice = @$_GET['name_'];
        $req = mysqli_query($con,"SELECT * FROM quote WHERE id = $id");
        if(!$req){
            echo "erreur de requete";
        }
    ?>
    <div class="container">
        <div class="wrapper-read">
            <?php if($choice == "quote"){?>
                <?php $row = mysqli_fetch_assoc($req); ?>
            <div>
                <div class="info">
                
                    <table>
                        
                        <tr>
                            <td>nom :</td>
                            <td><?=@$row["name"]?></td>
                        </tr>
                        <tr>
                            <td>email :</td>
                            <td><?=@$row["email"]?></td>
                        </tr>
                        <tr>
                            <td>phone :</td>
                            <td><?=@$row["phone"]?></td>
                        </tr>
                    </table>
                    <h4>message</h4>
                    <p>
                    <?=@$row["message"]?>
                    </p>
                </div>
                <div class="action">
                    <ul>
                        <li><a href="/new/Admin/quote.php">retour</a></li>
                        <li><a href="mailto:<?=@$row["email"] ?>">repondre</a></li>
                        <li><a href="delete_quote.php/?id=<?=@$row["id"] ?>">supprimer</a></li>
                    </ul>
                
                </div>
            </div>
            <div> 
                <?php }else{?>
                    <?php  $req = mysqli_query($con,"SELECT * FROM contacts WHERE id = $id"); ?>
                    <?php $row = mysqli_fetch_assoc($req); ?>
                <div class="info">
                    <table>
                    
                        <tr>
                            <td>nom :</td>
                            <td><?=$row["nom"]?></td>
                        </tr>
                        <tr>
                            <td>email :</td>
                            <td><?=$row["email"]?></td>
                        </tr>
                        <tr>
                            <td>phone :</td>
                            <td><?=$row["subject"]?></td>
                        </tr>
                    </table>
                    <h4>message</h4>
                    <p>
                        <?=$row["message"]?>
                    </p>
                </div>
                <div class="action">
                    <ul>
                        <li><a href="/new/Admin/contacts.php">retour</a></li>
                        <li><a href="mailto:<?= $row["email"] ?>">repondre</a></li>
                        <li><a href="delete_contact.php/?id=<?= $row["id"]?>">supprimer</a></li>
                    </ul>
                </div>
                <?php } ?>
            </div>
    </div>
</body>
</html>
