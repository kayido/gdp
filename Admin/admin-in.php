<?php if(!empty($_COOKIE['jeton'])): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <title>Responsiive Admin Dashboard | CodingLab</title>
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<?php 
  include 'header.php';
?>
<div class="home-content">
        <div class="sales-boxes">
            <div class="wrapper">
              <div class="box"><a href="/new/Admin/quote.php"><i class="bx bx-buildings"></i><span>devis recus</span></a></div>
              <div class="box"><a href="/new/Admin/contacts.php"><i class="bx bx-message-dots"></i><span>message</span></a></div>
              <div class="box"><a href="/new/Admin/modifier.php"><i class="bx bx-archive-in"></i><span>Modifier</span></a></div>
              <div class="box"><a href="/new/Admin/../../index.php"><i class="bx bx-bar-chart-alt-2"></i><span>voir le site</span></a></div>
            </div>
          </div>
        </div>
    </section>
    <script src="script.js"></script>
  </body>
</html>
<?php else:
    echo "vous n etes connecte veuillez vous"; ?>
    <a href="/new/Admin/admin_conn.php"> connecter</a>
  <?php
  endif 
?>