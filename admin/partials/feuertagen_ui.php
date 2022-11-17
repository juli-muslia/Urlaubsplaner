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
    ?>
<!-- DELETE POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> Delete Feuertag </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <form action="" method="POST">

                  <div class="modal-body">

                      <input type="hidden" name="delete_id" id="delete_id">

                      <h4 class="text-center"> Do you want to Delete this Worker?</h4>
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



    <div class='container mt-4'>
    <h3 class='text-center'>ADD DETAILS</h3>
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
	
<?php 	
}