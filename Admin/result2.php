<?php 
require "connexion.php";
    $mot = @$_POST['mot2'];
    $sql = "SELECT * FROM contacts WHERE nom LIKE '%$mot%'";
    $results = mysqli_query($con,$sql);
    $json_array = array();
    echo "<table>";?>
        <tr>
            <th>nom</th>
            <th>email</th>
            <th>subjet</th>
            <th>message</th>
            <th>date</th>
        </tr>
    <?php while($data = mysqli_fetch_assoc($results)){?>
        <tr class="hover">
        <td><?=$data["nom"]?></td>
        <td><?=$data["email"]?></td>
        <td><?=$data["subject"]?></td>
        <td><a class="open-and-close-devis" href="avis.php\?id=<?=$data["id"]?>&&name=contacts">voir le message</a></td>
        <td><?=$data["date"]?></td>
    </tr>
    <?php }
    echo "</table>";
?>