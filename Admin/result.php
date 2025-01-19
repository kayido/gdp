<?php 
    require "connexion.php";
    $mot = @$_POST['mot'];
    $sql = "SELECT * FROM quote WHERE name LIKE '%$mot%'";
    $results = mysqli_query($con,$sql);
    $json_array = array();
    echo "<table>";?>
        <tr>
            <th>nom</th>
            <th>email</th>
            <th>phone</th>
            <th>message</th>
            <th>date</th>
        </tr>
    <?php while($data = mysqli_fetch_assoc($results)){?>
        <tr class="hover">
        <td><?=$data["name"]?></td>
        <td><?=$data["email"]?></td>
        <td><?=$data["phone"]?></td>
        <td><a class="open-and-close-devis" href="avis.php\?id=<?=$data["id"]?>&&name=quote">voir le message</a></td>
        <td><?=$data["date"]?></td>
    </tr>
    <?php }
    echo "</table>";
    /******************************************************* */ 
    
?>
