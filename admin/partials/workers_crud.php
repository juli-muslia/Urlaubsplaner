<?php

function add_workers()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "publishing_users";

    if (isset($_POST['insert_worker'])) 
{
        $new_username = $_POST['name'];
        $new_email = $_POST['email'];
        $new_dob = $_POST['dob'];
     


        $results = $wpdb->query("INSERT INTO $table_name(name, email,dob) VALUES('$new_username','$new_email','$new_dob')");



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

function delete_workers()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "publishing_users";
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