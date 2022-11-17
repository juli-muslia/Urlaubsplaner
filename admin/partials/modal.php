<?php


function modal () {
	  
    ?>

<!-- Start ADD popup dialog box -->
<div class="modal fade" id="add_urlaub" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel">Fügen Sie neue Urlaube hinzu</h5>
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
								<label for="event_name">Name</label>
								<input type="text" name="event_name" id="event_name" class="form-control" required value="<?php $current_user = wp_get_current_user(); echo $current_user->display_name?>" disabled>
								</div>
							</div>

							<div class="col-sm-12">  
								<div class="form-group">
								<label for="color">Wähle eine Farbe</label>
								<input type="color" name="color" id="color" class="form-control" value="#F08080">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">  
								<div class="form-group">
								<label for="event_start_date">Anfangsdatum</label>
								<input type="date" name="event_start_date" id="event_start_date" class="form-control onlydatepicker" placeholder="Event start date" required>
								</div>
							</div>
							<div class="col-sm-6">  
								<div class="form-group">
								<label for="event_end_date">Rückflugdatum</label>
								<input type="date" name="event_end_date" id="event_end_date" class="form-control" placeholder="Event end date"required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="inserturlaubs">Urlaub sparen</button>
				</div>
			</form>		
		</div>
	</div>
</div>
<!-- End ADD popup dialog box -->

<!-- START EDIT popup dialog box -->

<div class="modal fade" id="edit_urlaub" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel">Aktuelle Ferien bearbeiten</h5>
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
								
								<input type="text" name="edit_event_id" id="edit_event_id" class="form-control" hidden >
								</div>
							</div>


								<input type="text" name="current_user" id="current_user" class="form-control" required value="<?php echo $current_user->display_name; ?>" hidden >

							<div class="col-sm-12">  
								<div class="form-group">

								<label for="event_name">Name</label>
								<input type="text" name="edit_event_name" id="edit_event_name" class="form-control" required readonly>

								<!-- <input type="text" name="edit_event_name" id="edit_event_name" class="form-control" required value="<?php $current_user = wp_get_current_user(); echo $current_user->display_name?>" readonly> -->
								</div>
							</div>

							<div class="col-sm-12">  
								<div class="form-group">
								<label for="color">Wähle eine Farbe</label>
								<input type="color" name="edit_color" id="edit_color" class="form-control" value="#FFEF00">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">  
								<div class="form-group">
								<label for="event_start_date">Anfangsdatum</label>
								<input type="date" name="edit_event_start_date" id="edit_event_start_date" class="form-control onlydatepicker" required>
								</div>
							</div>
							<div class="col-sm-6">  
								<div class="form-group">
								<label for="event_end_date">Rückflugdatum</label>
								<input type="date" name="edit_event_end_date" id="edit_event_end_date" class="form-control" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">

					<button type="submit" name="update_event" class="btn btn-primary">Aktualisieren</button>
					
					<!-- If user is admin can delete the event -->
					<?php
						if ( current_user_can('administrator')) {
							?>
							<button type="button"  class="btn btn-danger" data-toggle="modal" data-target="#deletemodal"> Löschen </button>
							<?php
						}
						?>
	

				</div>
			</form>
		</div>
	</div>
</div>
<!-- End EDIT popup dialog box -->




<!-- START DELETE DATA popup dialog box -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> Aktuellen Urlaubsplan löschen </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <form action="" method="POST">

                  <div class="modal-body">
				 	 
					  <input type="text" name="delete_event_id" id="delete_event_id" class="form-control" hidden>
							<br>
							<br><br>
                      <h4 class="text-center"> Möchten Sie diese Urlaube löschen?</h4>
					  <br><br>
                      <h6 class="alert alert-danger text-center"> Hinweis: Nach dem Löschen sind Ihre Daten für immer gelöscht ! </h6>

					  <br><br><br><br>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"> NEIN </button>
                      <button type="submit" name="deletedata" class="btn btn-danger"> Ja ! Lösche es. </button>
                  </div>
              </form>
			  
          </div>
      </div>
  </div>
	<!-- END DELETE DATA popup dialog box -->





	
<?php	
     
} 