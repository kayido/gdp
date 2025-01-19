<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8"/>
    <title>Dashboard</title>
    <link rel="stylesheet" href="admin-in.css"/>
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="script.js" defer></script>
  </head>
  <body> 
    <div class="sidebar">
      <div class="logo-details">
        <i class="bx bxl-c-plus-plus"></i>
        <span class="logo_name">ADMIN</span>
      </div>
      <ul class="nav-links">
        <li><a href="/new/Admin/admin-in.php" class="active"><i class="bx bx-grid-alt"></i><span class="links_name">Dashboard</span></a></li>
        <li><a href="/new/Admin/new.php"><i class="bx bx-layer"></i><span class="links_name">nouveaux</span></a></li>
        <li><a href="/new/Admin/quote.php"><i class="bx bx-box"></i><span class="links_name">devis reçu</span></a></li>
        <li><a href="/new/Admin/contacts.php"><i class="bx bx-list-ul"></i><span class="links_name">suggestions</span></a></li>
        <li><a href="/new/Admin/modifier.php"><i class="bx bx-pie-chart-alt-2"></i><span class="links_name">Modifier</span></a></li>
        <li class="log_out"><a href="/new/Admin/deconnect.php"><i class="bx bx-log-out"></i><span class="links_name">Log out</span></a></li>
      </ul>
    </div>
    <section class="home-section">
      <nav>
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard">Dashboard</span>
        </div>
        <div class="search-box">
          <form class="search-box" method="post" a>
              <input type="text" placeholder="Entrez un nom" name="mot3"  <?php if(isset($page)){if($page == 'quote'){?> name="mot" id="mot" onkeyup="ajaxing()" <?php }else if($page == 'contacts'){?> name="mot2" id="mot2" onkeyup="ajaxing2()"<?php } }?> />
              <button type="submit" id="sub_search" name="valid"><i class="bx bx-search"></i></button>
          </form>
          <!-- <div id="sugg" style="background-color: #fff;width: 80%; left:19px; border: 1px black solid;z-index: 999;position:absolute; border-radius:20px;"></div> -->
        </div>
        <div class="logo">
          <h2>AFRICA'S <span>SERVICES</span></h2>
        </div>
      </nav>
