<?php if(!empty($_COOKIE['jeton'])): ?>
<?php $page = 'quote'; ?>
    <?php $title="voir les devis"; ?>
    <?php include "header.php"; ?>
    <?php include "function.php"; ?>
    <?php 
      require "connexion.php";
      $req = mysqli_query($con, "SELECT * FROM quote");
      if(!$req){
        echo "requete de selection errone";
      }
    ?>
    <?php 
      if(isset($_POST['filtrer'])){
        extract($_POST);
        $req_filt =  mysqli_query($con,"SELECT * FROM quote WHERE email LIKE '%$email%'   ORDER BY name $nom , date $date");
        if(!$req_filt){
          $message = "errur de requete dans la bd";
        }
      }
    ?>
      <div class="home-content">
        <div class="sales-boxes">    
            <?php head($title); ?>
            <div class="wrapper-quote">
                <table id="rem">
                  <tr>
                    <th>nom</th>
                    <th>email</th>
                    <th>subjet</th>
                    <th>message</th>
                    <th>date</th>
                </tr>
                <?php if(isset($req_filt)){
                    view($req_filt);
                }else{
                  view($req);
                }
                ?>
              </table>
              <table id="sugg">
              </table>
            </div>
          </div>
        </div>
    </section>
    <form id="form-filter" method="post" >
        <span class="open-close-filter" >x</a></span>
        <label >filtrer par le nom</label>
        <select name="nom">
        <option value="">aucun</option>
          <option value="ASC">croissant</option>
          <option value="DESC">decroissant</option>
        </select>
        <label >filtrer par email</label>
        <select name="email">
        <option value="">aucun</option>
          <option value="gmail">gmail</option>
          <option value="hotmail">hotmail</option>
          <option value="icloud">icloud</option>
          <option value="">autres</option>
        </select>
        <label>filtrer par la date</label>
        <select name="date">
        <option value="">aucun</option>
          <option value="DESC">decroissant</option>
          <option value="ASC">croissant</option>
        </select>
        <input type="submit" value="filtrer" name="filtrer">
      </form>
    <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
<?php else:
    echo "vous n etes connecte veuillez vous"; ?>
    <a href="/new/Admin/admin_conn.php"> connecter</a>
  <?php
  endif ?>