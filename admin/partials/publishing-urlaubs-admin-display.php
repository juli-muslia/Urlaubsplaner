<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://julianmuslia.com
 * @since      1.0.0
 *
 * @package    Publishing_Urlaubs
 * @subpackage Publishing_Urlaubs/admin/partials
 */



function publishingUrlaubs (){
  global $wpdb;
  $table_name = $wpdb->prefix . "publishing_urlaubs";
  $events = $wpdb->get_results("Select * from $table_name");
    require_once 'modal.php';
    modal();

    require_once 'insert_event.php';
    insert_event();
    require_once 'update_event.php';
    update_event();

    require_once 'delete_event.php';
    delete_event();

    $current_user = wp_get_current_user(); // Gets current logged in user


    $items = array(); // Array to get all events and gets filled with FOREACH loop under !
    foreach ($events as $e)
    {   
      if ( $e->event_name == $current_user->display_name ){
      $items[] = $e;
      }
    }

    // Displays this message for the user that does not have any days off !
if ( count($items) == 0 )
echo '<div class="alert alert-warning text-center" role="alert"> Hi, ' . $current_user->display_name . '! You haven\'t added any vacations ! </div>' ;

$length = count($items); // Gets Array Length 

$daysOff = []; // Array that stores the total number of days that are marked as Vacation days. 

// the FOR loop gets the Starting and Ending date of the event, makes the difference and stores it to the above Array. 
for ($i=0; $i<$length; $i++){  
  $starting_date = new DateTime($items[$i]->event_start_date);
  $ending_date = new DateTime($items[$i]->event_end_date);
  $difference = date_diff($starting_date, $ending_date);
  $intdiff = intval ($difference->format("%d"));

  array_push($daysOff, $intdiff); 
}

$days_off = array_sum($daysOff); // Sum all elements of the array to give us the total number of days Off ! 
    
?>


<style>
#calendar {
  max-width: 1300px;
  margin: 0 auto

}
.fc-day-sat, .fc-day-sun {
    background-color: gray !important;
}
</style>

 
<div class="container">

    <br>
        <h2 class="text-center" style="font-family: 'Roboto', sans-serif;"><span style="color:#DE0A2B">Publishing Group</span> Urlaubs Plan</h2>
        <h5 class="text-center">Herzlich willkommen <?php echo $current_user->display_name; ?> ! Sie haben bis jetzt <b style="color:#DE0A2B"><?php echo $days_off; ?></b> Tage frei genommen</h5>
    <br>

    <table id="example1" class="table table-bordered table-hover" style="margin-right:-10px">
        <div id='calendar' class="col-centered"></div>
    </table>

    
</div>

<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var initialLocaleCode = 'de'; // Display language of the calendar 
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: initialLocaleCode,
        defaultView: 'month',
         
      navLinks: false, // can click day/week names to navigate views
      selectable: true,
      selectMirror: true,
      eventLimit: true,
	  	selectHelper: true,
          // editable: true,  // True -- MAKE EVENT DRAGGABLE -- FALSE -- MAKE EVENT NOT DRAGGABLE
          // timeZone: 'local',
          // left: 'prev,next today',
          // center: 'title',
          // right: 'dayGridMonth',
          // dayMaxEvents: true, // True --- >> To show all events of the day  False --> Create a VIEW MORE shortcut 


// ------------------ Selects the START and END date and adds them to ADD MODAL ------------------ 
      select: function(info) {

        var start = info.startStr;
        var end = info.endStr;
       $('#add_urlaub #event_start_date').val(start);
       $('#add_urlaub #event_end_date').val(end);
       $('#add_urlaub').modal('show');
       calendar.unselect() 
      },
// ----------------------------END ADD MODAL -----------------------------------------------------


// ------------------ Gets all the data from the database and displays it to the calendar. ------------------ 
             events: [ 
        <?php
          if ($events) {
            foreach ($events as $event)
            {
        ?>  
              {   
                id: '<?php echo $event->event_id; ?>',
                title: '<?php echo $event->event_name; ?>',
                start: '<?php echo $event->event_start_date; ?>',
                end: '<?php echo $event->event_end_date; ?>',
                color: '<?php echo $event->color; ?>'
              },
       <?php
           }
          }
        ?>   
      ],
// ----------------------------END DATA DISPLAY FROM DATABASE -----------------------------------------------


// ------------------ Gets data from Event click and displays them to the EDIT MODAL ! ------------------
      eventClick: function(info) {
   
       // alert(info.event.id)
        // if (confirm('Are you sure you want to delete this event?')) {
        //   arg.event.remove()
        // } 
         var startDate = new Date (info.event.start);
         var endDate = new Date (info.event.end);

         startDate.setDate(startDate.getDate() + 1);
         endDate.setDate(endDate.getDate() + 1);


        $('#edit_urlaub').modal('show'); 
        $('#edit_urlaub #edit_event_id').val(info.event.id);    
        $('#deletemodal #delete_event_id').val(info.event.id);    // When user clicks the Event even the DELETE MODAL Gets the ID of the EVENT     
        $('#edit_urlaub #edit_event_name').val(info.event.title);
  
        $('#edit_urlaub #edit_event_start_date').val(startDate.toISOString().split('T')[0]);
        $('#edit_urlaub #edit_event_end_date').val(endDate.toISOString().split('T')[0]);

      },
// ----------------------------END EVENT CLICK EDIT MODAL -----------------------------------------------


// ----------------------------Script to update EVENT on Drag & Drop -----------------------------------------------
      // eventDrop: function (event){
      //   var id = event.id;
      //   var start_date = moment(event.start).format('YYYY-MM-DD');
      //   var end_date = moment(event.end).format('YYYY-MM-DD');
      // }

  //     eventDrop: function(info) {
  //      alert(info.event.title + " was dropped on " + info.event.startStr);

  //   if (!confirm("Are you sure about this change?")) {
  //     alert("<?php update_event()?>");
  //   }
  // }
// ----------------------------End Script to update EVENT on Drag & Drop -------------------------------------------  
    });

    calendar.render();
  });


 
</script>

<?php
}
