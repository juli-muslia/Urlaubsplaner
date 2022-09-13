<?php 
function update_event()
{

    global $wpdb;
    $table_name = $wpdb -> prefix . "publishing_urlaubs";

    if (isset($_POST['update_event'])) {
        $update_event_id = $_POST['edit_event_id'];

        $update_event_name    = $_POST['edit_event_name'];
        $update_event_start_date  = $_POST['edit_event_start_date'];
        $update_event_end_date  = $_POST['edit_event_end_date'];
        $update_event_color    = $_POST['edit_color'];


        $query = $wpdb->query(" UPDATE $table_name SET event_name='$update_event_name', event_start_date='$update_event_start_date', event_end_date='$update_event_end_date', color='$update_event_color' WHERE event_id='$update_event_id' ");


        if ($query) {
            echo '<div class="alert alert-success text-center" role="alert">
            <h3>Daten erfolgreich aktualisiert!</h3>
                  </div>
                  <meta http-equiv="refresh" content="2">'; 
        }
        else {
            echo '<div class="alert alert-danger text-center" role="alert">
            <h3>Daten nicht erfolgreich aktualisiert!</h3>
                  </div>
                  <meta http-equiv="refresh" content="5">';
        }
    }
}
