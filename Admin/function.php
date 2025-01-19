<?php
  function view($req){
    while($row = mysqli_fetch_assoc($req)){?>
      <tr class="hover">
        <td><?=$row["name"]?></td>
        <td><?=$row["email"]?></td>
        <td><?=$row["phone"]?></td>
        <td><a class="open-and-close-devis" href="avis.php\?id=<?=$row["id"]?>&&name =quote">voir le message</a></td>
        <td><?=$row["date"]?></td>
        <td>
        <a href="delete_quote.php/?id=<?= $row["id"] ?>"><i class="bx bx-trash-alt"></i></a>
        </td>
      </tr>
    <?php } 
  }
  function view_contact($req){
    while($row = mysqli_fetch_assoc($req)){?>
      <tr class="hover">
        <td><?=$row["nom"]?></td>
        <td><?=$row["email"]?></td>
        <td><?=$row["subject"]?></td>
        <td><a class="open-and-close-devis" href="avis.php\?id=<?=$row["id"]?>&name =contacts">voir le message</a></td>
        <td><?=$row["date"]?></td>
        <td>
          <a href="delete_contact.php/?id=<?= $row["id"] ?>"><i class="bx bx-trash-alt"></i></a>
        </td>
      </tr>
    <?php } 
  }
  function view_contact_filt($req_filt){
    while($row = mysqli_fetch_assoc($req_filt)){?>
      <tr class="hover">
        <td><?=$row["nom"]?></td>
        <td><?=$row["email"]?></td>
        <td><?=$row["subject"]?></td>
        <td><a class="open-and-close-devis" href="avis.php\?id=<?=$row["id"]?>&name =contacts">voir le message</a></td>
        <td><?=$row["date"]?></td>
        <td>
          <a href="delete_contact.php/?id=<?= $row["id"] ?>"><i class="bx bx-trash-alt"></i></a>
        </td>
      </tr>
    <?php } 
  }

function head($title){?>

    <div class="header">
      <div class="title">
                <h1><?= $title ?></h1>
              </div>
          <div class="filter"><i class="bx bx-filter-alt open-close-filter"></i></div>
      </div>
<?php } ?>
<?php function head_new($title){?>

<div class="header">
  <div class="title">
            <h1><?= $title ?></h1>
          </div>
      <div class="filter"></div>
  </div>
<?php } ?>