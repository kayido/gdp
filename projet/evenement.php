<?php
    session_start();
    if(isset($_SESSION["connected"])):
?>
<?php require 'header.php';?>
<?php require_once '../connexion.php'; ?>
<?php $id= $_GET["id"]; echo $id;?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    height: 650,
    events: 'fetchEvents.php',
    selectable: true,
      eventClick: function(info) {
        info.jsEvent.preventDefault();
        info.el.style.borderColor = 'red';
        // Swal.fire({
        //   title: info.event.title,
        //   icon: 'info',
        //   showCloseButton: true,
        //   showCancelButton: true,
        //   showDenyButton: true,
        //   cancelButtonText: 'Close',
        //   confirmButtonText: 'Delete',
        // });
    }
    
  });
    calendar.render();
  });
</script>  
<div class="main-event">
  <div class="content-event">
    <div id='calendar'></div>
  </div>  
</div>
<style>
  :root {
--fc-border-color: black;
--fc-daygrid-event-dot-width: 5px;
}
#calendar{
  width: 65%;
  height: 85vh;
}
/* .fc-theme-standard td, .fc-theme-standard th {
  border: 1px solid var(--fc-border-color);
} */
</style> 
<?php require_once ("footer.php");?>
<?php else:
    header("Location: ../index.php");
endif; ?>