<?php

function insert_feuertagen()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "publishing_feuertage";

    if (isset($_POST['insert_feuertag'])) 
{
        $start_date = preg_replace("([^0-9/])", "", $_POST['start_date']);
        $end_date = preg_replace("([^0-9/])", "", $_POST['end_date']);
     


        $results = $wpdb->query("INSERT INTO $table_name(feuertag_start_date, feuertag_end_date,feuertag_overlap, feuertag_display, feuertag_color) VALUES('$start_date','$end_date','false', 'background', '#FF0000')");



        if ($results) {
            echo '<div class="alert alert-success text-center" role="alert">
        <h3>Data Saved successfully !</h3>
              </div>
              <meta http-equiv="refresh" content="1">';
        }
        else {
            echo '<div class="alert alert-danger text-center" role="alert">
        <h3>Data was not successfully saved !</h3>
              </div>
              <meta http-equiv="refresh" content="5">';
        }
    }
}

function delete_feuertagen()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "publishing_feuertage";
    if (isset($_POST['deletedata'])) 
{
        $id = $_POST['delete_id'];

        $query = $wpdb->query("DELETE FROM $table_name WHERE ID='$id'");


        if ($query) {
            echo '<div class="alert alert-success text-center" role="alert">
        <h3>Data Deleted successfully !</h3>
              </div>
              <meta http-equiv="refresh" content="1">';

        }
        else {
            echo '<div class="alert alert-danger text-center" role="alert">
        <h3>Data was not successfully deleted !</h3>
              </div>
              <meta http-equiv="refresh" content="5">';
        }    }
}
?>