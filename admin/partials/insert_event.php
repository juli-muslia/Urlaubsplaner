<?php

function insert_event()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "publishing_urlaubs";
    $current_user = wp_get_current_user(); 

    if (isset ($_POST['inserturlaubs'])){
        $new_name = $current_user->display_name ;
        $new_start_date = $_POST['event_start_date'];
        $new_end_date = $_POST['event_end_date'];
        $new_color = $_POST['color'];


        $results = $wpdb->query ("INSERT INTO $table_name (event_name, event_start_date, event_end_date, color) values ('$new_name', '$new_start_date', '$new_end_date', '$new_color')");


        if($results) {
            echo '<div class="alert alert-success text-center" role="alert">
            <h3> Daten erfolgreich gespeichert !</h3>
            </div>
            <meta http-equiv="refresh" content="2">';

            
            // 3 Variables + Function to send an email when user saves new urlaubs

            $mailto='mj@publishing-group.de'; 
            $subject='Neue Urlaubs geplannt ';
            $message=' Hallo Admin!  <br> Benutzer' . $new_name . ' hat neue Urlaubs geplant!'; 

            wp_mail( $mailto, $subject, $message);
        
        }
        else {
        echo    '<div class="alert alert-danger text-center" role="alert">
        <h3>Daten wurden nicht erfolgreich gespeichert !</h3>
              </div>
              <meta http-equiv="refresh" content="5"> ';
        }
    }
}
