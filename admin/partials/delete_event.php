<?php
function delete_event() {

    global $wpdb;

    $table_name = $wpdb ->prefix . "publishing_urlaubs";

    if (isset($_POST['deletedata'])){
        $id= $_POST['delete_event_id'];

        $query = $wpdb->query("DELETE FROM $table_name WHERE event_id = '$id'");

    if ($query){
        echo '<div class="alert alert-success text-center" role="alert">
        <h3>Daten erfolgreich gelöscht!</h3>
              </div>
              <meta http-equiv="refresh" content="2">';
    
    }

    else {
        echo '<div class="alert alert-danger text-center" role="alert">
    <h3>Daten wurden nicht erfolgreich gelöscht !</h3>
          </div>
          <meta http-equiv="refresh" content="5">';
    }
    }
}

?>

