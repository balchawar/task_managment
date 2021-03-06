<?php if(!isset($conn)){ include 'db_connect.php'; } ?>

<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="manage-project">

        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Job Number</label>
					<input type="text" class="form-control form-control-sm" name="job" value="<?php echo isset($job) ? $job : '' ?>">
				</div>
			</div>
          	<div class="col-md-6">
				<div class="form-group">
					<label for="">Mode</label>
					<select name="mode" id="mode" class="form-control form-control-sm">
						<option value="0" <?php echo isset($mode) && $mode == 0 ? 'selected' : '' ?>>Sea</option>
						<option value="3" <?php echo isset($mode) && $mode == 3 ? 'selected' : '' ?>>Air</option>
						<option value="5" <?php echo isset($mode) && $mode == 5 ? 'selected' : '' ?>>By Road</option>
						<option value="7" <?php echo isset($mode) && $mode == 7 ? 'selected' : '' ?>>Rail-way</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Goods</label>
					<input type="text" class="form-control form-control-sm" name="name" value="<?php echo isset($name) ? $name : '' ?>">
				</div>
			</div>
          	<div class="col-md-6">
				<div class="form-group">
					<label for="">Supplier</label>
					<select name="status" id="status" class="form-control form-control-sm">
						<option value="0" <?php echo isset($supplier) && $supplier == 0 ? 'selected' : '' ?>>Dilpack</option>
						<option value="1" <?php echo isset($supplier) && $supplier == 1 ? 'selected' : '' ?>>Sanpack</option>
						<option value="2" <?php echo isset($supplier) && $supplier == 2 ? 'selected' : '' ?>>Manuchar BV</option>
						<option value="3" <?php echo isset($supplier) && $supplier == 3 ? 'selected' : '' ?>>Axum PLC</option>
						<option value="4" <?php echo isset($supplier) && $supplier == 4 ? 'selected' : '' ?>>S.De Vries/Mr. Siebold</option>
						<option value="5" <?php echo isset($supplier) && $supplier == 5 ? 'selected' : '' ?>>Amiran</option>
						<option value="6" <?php echo isset($supplier) && $supplier == 6 ? 'selected' : '' ?>>Hansa</option>
						<option value="7" <?php echo isset($supplier) && $supplier == 7 ? 'selected' : '' ?>>Annor Bagley/Mr. Stephen</option>
						<option value="8" <?php echo isset($supplier) && $supplier == 8 ? 'selected' : '' ?>>AI Waffa/Mr Jay</option>
						<option value="9" <?php echo isset($supplier) && $supplier == 9 ? 'selected' : '' ?>>Chrysal Ltd</option>
						<option value="10" <?php echo isset($supplier) && $supplier == 10 ? 'selected' : '' ?>>Omini agriculture</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Country</label>
					<input type="text" class="form-control form-control-sm" name="country" value="<?php echo isset($country) ? $country : '' ?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Start Date</label>
              <input type="date" class="form-control form-control-sm" autocomplete="off" name="start_date" value="<?php echo isset($start_date) ? date("Y-m-d",strtotime($start_date)) : '' ?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">End Date</label>
              <input type="date" class="form-control form-control-sm" autocomplete="off" name="end_date" value="<?php echo isset($end_date) ? date("Y-m-d",strtotime($end_date)) : '' ?>">
            </div>
          </div>
		</div>
        <div class="row">
        	<?php if($_SESSION['login_type'] == 1 ): ?>
           <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Project Manager</label>
              <select class="form-control form-control-sm select2" name="manager_id">
              	<option></option>
              	<?php 
              	$managers = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where type = 2 order by concat(firstname,' ',lastname) asc ");
              	while($row= $managers->fetch_assoc()):
              	?>
              	<option value="<?php echo $row['id'] ?>" <?php echo isset($manager_id) && $manager_id == $row['id'] ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
              	<?php endwhile; ?>
              </select>
            </div>
          </div>
      <?php else: ?>
      	<input type="hidden" name="manager_id" value="<?php echo $_SESSION['login_id'] ?>">
      <?php endif; ?>
          <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Project Team Members</label>
              <select class="form-control form-control-sm select2" multiple="multiple" name="user_ids[]">
              	<option></option>
              	<?php 
              	$employees = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where type = 3 order by concat(firstname,' ',lastname) asc ");
              	while($row= $employees->fetch_assoc()):
              	?>
              	<option value="<?php echo $row['id'] ?>" <?php echo isset($user_ids) && in_array($row['id'],explode(',',$user_ids)) ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
              	<?php endwhile; ?>
              </select>
            </div>
          </div>
        </div>
		<div class="row">
			<div class="col-md-10">
				<div class="form-group">
					<label for="" class="control-label">Current Status</label>
					<textarea name="description" id="" cols="30" rows="10" class="summernote form-control">
						<?php echo isset($description) ? $description : '' ?>
					</textarea>
				</div>
			</div>
		</div>
        </form>
    	</div>
    	<div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-project">Save</button>
    			<button class="btn btn-flat bg-gradient-secondary mx-2" type="button" onclick="location.href='index.php?page=order_list'">Cancel</button>
    		</div>
    	</div>
	</div>
</div>
<script>
	$('#manage-project').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_project',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
						location.href = 'index.php?page=order_list'
					},2000)
				}
			}
		})
	})
</script>