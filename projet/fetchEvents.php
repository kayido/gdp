<?php 
    // Include database configuration file 
    require_once 'dbConfig.php'; 
    // Filter events by calendar date 
    $where_sql = ''; 
    $id = $_GET["id"];
    if(!empty($_GET['start']) && !empty($_GET['end'])){ 
    $where_sql .= " WHERE tache.date_debut BETWEEN '".$_GET['start']."' AND '".$_GET['end']."' AND projet.id_pro = '$id' "; 
    } 
    $where_sql = " WHERE  projet.id_pro = '$id'";
    // // Fetch events from database 
    $sql = "SELECT * FROM tache JOIN projet ON projet.id_pro = tache.id_pro $where_sql"; 
    $id = $_GET["id"];
    $result = $db->query($sql); 
    $eventsArr = array(); 
    if($result->num_rows > 0){ 
    while($row = $result->fetch_assoc()){ 
        array_push($eventsArr, $row); 
    } 
    } 
    // Render event data in JSON format 
    echo json_encode($eventsArr);
?>