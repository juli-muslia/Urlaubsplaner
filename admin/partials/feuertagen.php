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



function insert_email_settings()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "publishing_email";

    if (isset($_POST['insert_email_settings'])) 
{
        $email_list = sanitize_text_field($_POST['email_list']);
        $email_subject = sanitize_text_field($_POST['email_subject']);
        $email_text = $_POST['email_text'];



        $results = $wpdb->query("INSERT INTO $table_name(email_list, email_subject,email_text) VALUES('$email_list','$email_subject','$email_text')");



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

function edit_email_options()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "publishing_email";

    if (isset($_POST['update_email_options'])) 
{
        $update_email_id = sanitize_text_field($_POST['email_id']);
        $update_email_list = sanitize_text_field($_POST['update_email_list']);
        $update_email_subject = sanitize_text_field($_POST['update_email_subject']);
        $update_email_text = sanitize_text_field($_POST['update_email_text']);
        
     


        $results = $wpdb->query(" UPDATE $table_name SET email_list='$update_email_list', email_subject='$update_email_subject',email_text ='$update_email_text' WHERE id='$update_email_id'");



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


function delete_email_settings()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "publishing_email";
    if (isset($_POST['delete_email_settings'])) 
{
        $id = $_POST['edit_email_id'];

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