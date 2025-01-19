<?php if(!empty($_COOKIE['jeton'])): ?>
<?php $page = 'quote'; ?>
    <?php $title="voir les devis"; ?>
    <?php include "header.php"; ?>
    <?php include "function.php"; ?>
    <?php 
      require "connexion.php";
      $req = mysqli_query($con, "SELECT * FROM admin JOIN quote WHERE date>last_time ");
      if(!$req){
        $message = mysqli_error($con);
      }
      if(mysqli_num_rows($req) == 0){
        $message_quote =  "Il n'y a pas de nouveaux devis envoyées!" ;
      } 
    ?>
      <div class="home-content">
        <div class="sales-boxes">
            <h1>NEWS</h1>
            <?php if(isset($message)) echo $message; ?>
            
            <div class="wrapper-quote">
            <?php head_new("voir les nouveaux devis"); ?>
              <?php if(isset($message_quote)){
                echo $message_quote;
              }else{ ?>  
              <table id="rem">
                  <tr>
                    <th>nom</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>message</th>
                    <th>date</th>
                </tr>
                <?php
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
                  ?>
              </table>
              <?php } ?>
              <?php head_new("voir les nouvelles suggestions"); ?>
              <?php 
                $req = mysqli_query($con, "SELECT * FROM admin JOIN contacts WHERE date>last_time ");
                if(!$req){
                  $message = mysqli_error($con);
                }
                if(mysqli_num_rows($req) == 0){
                    $message_contacts =  "Il n'y a pas de nouvelles suggestions envoyées !" ;
                  
              }
              ?>
              <?php if(isset($message_contacts)){
                echo $message_contacts;
              } else{ ?>
              <table id="rem">
                  <tr>
                    <th>nom</th>
                    <th>email</th>
                    <th>subjet</th>
                    <th>message</th>
                    <th>date</th>
                </tr>
                <?php
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
                  ?>
              </table>
            <?php } ?>
              <table id="sugg">
              </table>
            </div>
          </div>
        </div>
    </section>
    <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
<?php else:
    echo "vous n etes connecte veuillez vous"; ?>
    <a href="/new/Admin/admin_conn.php"> connecter</a>
  <?php
  endif ?>