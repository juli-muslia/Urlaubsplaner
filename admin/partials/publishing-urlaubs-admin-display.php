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
  $events = $wpdb->get_results("Select * from $table_name where validity=1");

  $feuertag_table_name = $wpdb->prefix . "publishing_feuertage";
  $feuertagen = $wpdb->get_results("Select * from $feuertag_table_name");

    require_once 'modal.php';
    modal();

    require_once 'events_crud.php';
    insert_event();
    update_event();
    delete_event();
    require_once 'workers_crud.php';


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
echo '<div class="alert alert-warning text-center" role="alert"> Hi, ' .esc_attr( $current_user->display_name) . '! You haven\'t added any vacations ! </div>' ;

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
  margin: 0 auto;
}
/* 
    IF WEEKEND IS DISPLAYED CAN CHANGE THE DISPLAY COLOR OF SATURDAY & SUNDAY !
.fc-day-sat, .fc-day-sun {
    background-color: gray !important;
} */

/* 
  IF ENABLED YOU CAN CHANGE THE COLOR OF THE TODAYS DATE !
.fc .fc-daygrid-day.fc-day-today {
  background-color:red!important;
} */

.fc-bg-event {
    opacity: 1!important;
}
</style>

 
<div class="container-fluid">

    <br>
        <h2 class="text-center" style="font-family: 'Roboto', sans-serif;"><span style="color:#DE0A2B">Publishing Group</span> Urlaubs Plan</h2>
        <h4 class="text-center">Herzlich willkommen, <?php echo esc_attr($current_user->display_name); ?> !<span class="text-center"> Sie haben bis jetzt <b style="color:#DE0A2B"><?php echo esc_attr($days_off); ?>/28</b> Tage frei genommen.</span></h4>
        <h6 class="text-center" style="font-family: 'Roboto', sans-serif;">Bitte klicken Sie nicht auf die roten Daten</h6>
    <br>

   

      <div class='row'>
				
				<div class='col-md-3'>
<?php
        global $wpdb;
        $table_name = $wpdb->prefix . "publishing_users";
        $current_month_day= date("m-d");
        $birthdays = $wpdb->get_results("Select * from $table_name WHERE DATE_FORMAT(DOB,'%m-%d') ='$current_month_day'");

            foreach ($birthdays as $bdays){

              $birthday_date = new DateTime($bdays->DOB);
              $current_date = new DateTime((date('Y-m-d')));
              $interval = $birthday_date->diff($current_date);
              $diff = ($interval->y);

              ?> 
              <div class="alert alert-info mb-3 pt-4 pb-4" href="#"><h5><i class='fa fa-bell' style="font-size:28px"></i> Wünsche <b><?php echo esc_attr(($bdays->NAME))?></b> alles Gute zum Geburtstag !! <br><hr><i class="fa-regular fa-face-grin-squint" style="font-size:28px"></i> Geburtsdatum in <b><?php echo esc_attr(($bdays->DOB))?> </b> <hr style="margin-top: 0.1rem;
    margin-bottom: 0.1rem; border-top-color:#abdde500"><b><i class="fa-solid fa-cake-candles" style="font-size:28px"></i> <?php echo esc_attr( $diff); ?></b> Jahre Alt !! </h5>
              </div>  
              <?php 
            }
            ?>

					
				</div>

        <div class='col-md-8'>
          <table id="example1" class="table table-bordered table-hover" style="margin-right:-10px">
            <div id='calendar' class="col-centered"></div>
          </table>
        </div>
			</div>
		
</div>

<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    var initialLocaleCode = 'de'; // Display language of the calendar 
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: initialLocaleCode,
        defaultView: 'month',
      weekends:false,   // if True shows the Saturday and Sunday
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
                id: '<?php echo esc_attr( $event->event_id); ?>',
                title: '<?php echo esc_attr( $event->event_name); ?>',
                start: '<?php echo esc_attr( $event->event_start_date); ?>',
                end: '<?php echo esc_attr( $event->event_end_date); ?>',
                color: '<?php echo esc_attr( $event->color); ?>',
              },
       <?php
           }
          }
        ?>  
        
        
        // Adds a RED colour to the dates that must not be selected   

        <?php
          if ($feuertagen) {
            foreach ($feuertagen as $feuertag)
            {
        ?>  
          {   
                start: '<?php echo esc_attr( $feuertag->feuertag_start_date); ?>',
                end: '<?php echo esc_attr( $feuertag->feuertag_end_date); ?>',
                overlap: <?php echo esc_attr( $feuertag->feuertag_overlap); ?>,
                display: '<?php echo esc_attr( $feuertag->feuertag_display); ?>',
                color: '<?php echo esc_attr( $feuertag->feuertag_color); ?>',
              },
              <?php
           }
          }
        ?>  
      //  Example of a statick event    
      //{  
      //   start: '2022-11-16',
      //   end: '2022-08-16',
      //   overlap: false,
      //   display: 'background',
      //   color: '#FF0000'
      // },
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

    });
    
    calendar.render();
  });


 
</script>

<?php
}