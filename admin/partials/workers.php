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



function addPublishingWorkers (){
	require_once 'workers_crud.php';
    add_workers();
	delete_workers();
    ?>




 <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
 <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> Delete Worker </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <form action="" method="POST">

                  <div class="modal-body">

                      <input type="text" name="delete_id" id="delete_id">

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
							<label>Name</label>
							<input type="text" class="form-control"  name='name' id='name' placeholder="Name" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name='email' id='email' placeholder="Email" required >
						</div>
						<div class="form-group">
							<label>DOB</label>
							<input type="date" class="form-control" name='dob' id='dob' placeholder="dd-mm-yyyy" required>
						</div>
						<div class="form-group">
							<input type='submit' name='insert_worker' id="insert_worker" value='Submit' class='btn btn-primary'>
						</div>
					</form>
				</div>
                
				<div class='col-md-8'>
					<table class='table table-bordered mt-5'>
						<thead>
							<tr>
								<td>S.No</td>
								<td>Name</td>
								<td>Email</td>
								<td>DOB</td>
								<td>Delete</td>
							</tr>
						</thead>
						<tbody>
							<?php 
   						 global $wpdb;
   						 $table_name = $wpdb->prefix . "publishing_users";
							$results = $wpdb->get_results("Select * from $table_name");
						if ($results){
							foreach ($results as $row){
								?>	
								<tr>
									<td> <?php echo $row->ID; ?></td>
									<td> <?php echo $row->NAME; ?></td>
									<td> <?php echo $row->EMAIL; ?></td>
									<td> <?php echo $row->DOB; ?></td>
									<td> <button type="button" class="btn btn-danger deletebtn"> DELETE </button></td>
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

          $('.deletebtn').on('click', function () {

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