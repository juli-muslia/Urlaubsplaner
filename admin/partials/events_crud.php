<?php

function insert_event()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "publishing_urlaubs";
    $current_user = wp_get_current_user(); 

    if (isset ($_POST['inserturlaubs'])){
        $new_name = $current_user->display_name ;
     //   $new_start_date = $_POST['event_start_date'];
     $new_start_date= preg_replace("([^0-9/])", "", $_POST['event_start_date']);
     $new_end_date = preg_replace("([^0-9/])", "",  $_POST['event_end_date']);
     $new_color = sanitize_hex_color($_POST['color']);


        $results = $wpdb->query ("INSERT INTO $table_name (event_name, event_start_date, event_end_date, color) values ('$new_name', '$new_start_date', '$new_end_date', '$new_color')");


        if($results) {
            echo '<div class="alert alert-success text-center" role="alert">
            <h3> Daten erfolgreich gespeichert !</h3>
            </div>
            <meta http-equiv="refresh" content="2">';

            $email_list = ""; 
            $email_subject ="";
            $email_text ="";
            global $wpdb;
            $get_email_settings = $wpdb->prefix . "publishing_email";
               $query = $wpdb->get_results("Select * from $get_email_settings");
               if ($query){
                foreach ($query as $row){


                  $email_list = $row->email_list;
                  $email_subject = $row->email_subject;
                  $email_text = $row->email_text;
                    

                }
            }    
            $mailto = $email_list; 
            $subject =$email_subject;
            $message = $email_text .' <br> User that booked new holidays: <strong>'. $new_name . ' </strong> <br> Holiday starts on :  <strong> ' . date( 'd-m-Y', $new_start_date) .' </strong> 
            <br> Returning date :   <strong> ' . date( 'd-m-Y', $new_end_date)  .' </strong> '; 

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


function update_event()
{

    global $wpdb;
    $table_name = $wpdb -> prefix . "publishing_urlaubs";

    if (isset($_POST['update_event'])) {
        $update_event_id = sanitize_text_field( $_POST['edit_event_id']);
        $current_user    = sanitize_text_field( $_POST['current_user']);
        $update_event_name    = sanitize_text_field( $_POST['edit_event_name']);
        $update_event_start_date  = preg_replace("([^0-9/])", "", $_POST['edit_event_start_date']);
        $update_event_end_date  = preg_replace("([^0-9/])", "", $_POST['edit_event_end_date']);
        $update_event_color    = sanitize_hex_color($_POST['edit_color']);

        if(($_POST['current_user'] !== $_POST['edit_event_name']) xor (current_user_can('administrator')) ){
            echo '<div class="alert alert-danger text-center" role="alert">
            <h3>You are not allowed to update others events</h3>
                  </div>
                  <meta http-equiv="refresh" content="5">';
        } else {

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
}

function delete_event() {

    global $wpdb;

    $table_name = $wpdb ->prefix . "publishing_urlaubs";

    if (isset($_POST['deletedata'])){
        $id= sanitize_text_field($_POST['delete_event_id']);

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