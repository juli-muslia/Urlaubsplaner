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



function addPublishingFeuertagen (){
	require_once 'feuertagen.php';
    insert_feuertagen();
	delete_feuertagen();
    insert_email_settings();
    edit_email_options();
    delete_email_settings();
    ?>
<!-- START DELETE POP UP FORM FOR HOLIDAYS (Bootstrap MODAL) -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> Delete Holiday </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <form action="" method="POST">

                  <div class="modal-body">

                      <input type="text" name="delete_id" id="delete_id">

                      <h4 class="text-center"> Do you want to Delete this Holiday?</h4>
                      <h6 class="alert alert-danger"> Note: After deletion your data will be deleted forever ! </h6>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                      <button type="submit" name="deletedata" class="btn btn-primary"> Yes ! Delete it. </button>
                  </div>
              </form>

          </div>
      </div>
  </div>
<!-- END DELETE POP UP FORM FOR HOLIDAYS (Bootstrap MODAL) -->

<!-- ADD HOLIDAYS UI  -->
<div class='container mt-4'>
    <h3 class='text-center'>Add Details</h3>
            <div class='row'>
           
                <div class='col-md-4'>
                    <form action='' method='post' autocomplete='off'>
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" class="form-control"  name='start_date' id='start_date' placeholder="Start Date" required>
                        </div>
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" class="form-control"  name='end_date' id='end_date' placeholder="End Date" required>
                        </div>
                        <div class="form-group">
                            <input type='submit' name='insert_feuertag' id="insert_feuertag" value='Submit' class='btn btn-primary'>
                        </div>
                    </form>
                </div>
                
                <div class='col-md-8'>
                    <table class='table table-bordered mt-5'>
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Start Date</td>
                                <td>End Date</td>
                                <td>Delete</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                         global $wpdb;
                         $table_name = $wpdb->prefix . "publishing_feuertage";
                            $results = $wpdb->get_results("Select * from $table_name");
                        if ($results){
                            foreach ($results as $row){
                                ?>  
                                <tr>
                                    <td> <?php echo $row->ID; ?></td>
                                    <td> <?php echo $row->feuertag_start_date; ?></td>
                                    <td> <?php echo $row->feuertag_end_date; ?></td>
                                    <td> <button type="button" class="btn btn-danger delete_feuertagen_btn"> DELETE </button></td>
                                </tr>

                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

<!-- END ADD HOLIDAYS UI  -->

<!-- START EDIT POP UP FOR EMAIL SETTINGS -->
<div class="modal fade" id="edit_email" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel">Edit Email Settings</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="POST">
				<div class="modal-body">
					<div class="img-container">
						<div class="row">
							<div class="col-sm-12">  
								<div class="form-group">
								
								<input type="hidden" name="email_id" id="email_id" class="form-control"  >
								</div>
							</div>

							<div class="col-sm-12">  
								<div class="form-group">

								<label for="update_email_list">Email List</label>
								<input type="text" name="update_email_list" id="update_email_list" class="form-control" required>

								<!-- <input type="text" name="edit_event_name" id="edit_event_name" class="form-control" required value="<?php $current_user = wp_get_current_user(); echo $current_user->display_name?>" readonly> -->
								</div>
							</div>

							<div class="col-sm-12">  
								<div class="form-group">
								<label for="update_email_subject">Subject of the email</label>
								<input type="text" name="update_email_subject" id="update_email_subject" class="form-control" value="#FFEF00">
								</div>
							</div>
                            <div class="col-sm-12">  
								<div class="form-group">
								<label for="update_email_text">Text of the email</label><br>
								<textarea name="update_email_text" id="update_email_text" cols="51"rows="3"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">

					<button type="submit" name="update_email_options" class="btn btn-primary">Aktualisieren</button>
					
					<!-- If user is admin can delete the event -->
					<?php
						if ( current_user_can('administrator')) {
							?>
							<button type="button"  class="btn btn-danger" data-toggle="modal" data-target="#delete_email_settings_popup"> Löschen </button>
							<?php
						}
						?>
	

				</div>
			</form>
		</div>
	</div>
</div>
<!-- END EDIT POP UP FOR EMAIL SETTTINGS -->

<!-- START DELETE POP UP FORM FOR EMAIL SETTINGS -->
<div class="modal fade" id="delete_email_settings_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> Delete Email Settings </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <form action="" method="POST">

                  <div class="modal-body">

                  <input type="hidden" name="edit_email_id" id="edit_email_id" class="form-control"  >

                      <h4 class="text-center"> Do you want to Delete email settings ?</h4>
                      <h6 class="alert alert-danger"> Note: After deletion your data will be deleted forever ! </h6>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                      <button type="submit" name="delete_email_settings" class="btn btn-primary"> Yes ! Delete it. </button>
                  </div>
              </form>

          </div>
      </div>
  </div>
<!-- END DELETE POP UP FORM FOR EMAIL SETTING -->



<!-- START ADD EMAIL SETTINGS UI  -->
        <br><br>
<hr style="border: 5px solid #DE0A2B; border-radius: 5px;">
<br>
<?php 
                         global $wpdb;
                         $table_name = $wpdb->prefix . "publishing_email";
                            $results = $wpdb->get_results("Select * from $table_name");
                        if ($results){ ?>
                            <div class="alert alert-info text-center" role="alert">
        <h5>In order to add a new email to the list modify the list clicking <strong>EDIT BUTTON</strong>
    <br> Separate the emails from each other with , (comma) otherwise it will not work!! </h5></div>

    <div class='container mt-4'>
    <h3 class='text-center'>Email Settings</h3>
                <div class='col-md-12'>
                    <table class='table table-bordered mt-5'>
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Email list</td>
                                <td>Email Subject</td>
                                <td>Email Text</td>
                                <td>Edit</td>
                                <td>Delete</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                         global $wpdb;
                         $table_name = $wpdb->prefix . "publishing_email";
                            $results = $wpdb->get_results("Select * from $table_name");
                        if ($results){
                            foreach ($results as $row){
                                ?>  
                                <tr>
                                    <td> <?php echo $row->ID; ?></td>
                                    <td> <?php echo $row->email_list; ?></td>
                                    <td> <?php echo $row->email_subject; ?></td>
                                    <td> <?php echo $row->email_text; ?></td>
                                    <td> <button type="button" class="btn btn-success edit_email_settings"> EDIT </button></td>
                                    <td> <button type="button" class="btn btn-danger delete_email_settings"> DELETE </button></td>
                                </tr>

                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <?php 
                        } 
                        else {?> 

<div class='container mt-4'>
    <h3 class='text-center'>Email Settings</h3>

            <div class='row'>
            <div class='col-md-12'>
                    <form action='' method='post' autocomplete='off'>
                        <div class="form-group">
                            <label>Email List</label>
                            <input type="text" class="form-control"  name='email_list' id='email_list' placeholder="Please write at least 1 email. More than 1 email separate them with , " required>
                        </div>
                        <div class="form-group">
                            <label>Subject of the email</label>
                            <input type="text" class="form-control"  name='email_subject' id='email_subject' placeholder="Write the email subject">
                        </div>

                        <div class="form-group">
                             <label>Text of the email</label>
                            <textarea class="form-control"  name='email_text' id='email_text' rows="3"  placeholder="Please write a generic email. This can not be a personalized email for every email list." ></textarea>
                        </div>
                        <div class="form-group">
                        
                        <input type='submit' name='insert_email_settings' id="insert_email_settings" value='Start Email Settings' class='btn btn-warning'>
                        </div>
                    </form>
                </div>
                

            </div>
        </div>
<!-- END ADD EMAIL SETTINGS UI  -->

<?php    } ?> 
                       


        <script>
      $(document).ready(function () {

          $('.delete_feuertagen_btn').on('click', function () {

              $('#deletemodal').modal('show');

              $tr = $(this).closest('tr');

              var data = $tr.children("td").map(function () {
                  return $(this).text();
              }).get();

              console.log(data);

              $('#delete_id').val(data[0]);

          });
      });
  </script>
	        <script>
      $(document).ready(function () {

          $('.edit_email_settings').on('click', function () {

              $('#edit_email').modal('show');

              $tr = $(this).closest('tr');

              var data = $tr.children("td").map(function () {
                  return $(this).text();
              }).get();

              console.log(data);

              $('#email_id').val(data[0]);
              $('#update_email_list').val(data[1]);
              $('#update_email_subject').val(data[2]);
              $('#update_email_text').val(data[3]);

          });
      });
  </script>


<script>
      $(document).ready(function () {

          $('.delete_email_settings').on('click', function () {

              $('#delete_email_settings_popup').modal('show');

              $tr = $(this).closest('tr');

              var data = $tr.children("td").map(function () {
                  return $(this).text();
              }).get();

              console.log(data);

              $('#edit_email_id').val(data[0]);

          });
      });
  </script>
<?php 	
}