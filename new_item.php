<?php if(!isset($conn)){ include 'db_connect.php'; } ?>

<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="manage-project">

        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Item Name</label>
					<input type="text" class="form-control form-control-sm" name="lname" value="<?php echo isset($lname) ? $lname : '' ?>"  placeholder="Enter item">
				</div>
			</div>
          	<div class="col-md-6">
				<div class="form-group">
					<label for="">Catagory</label>
					<select name="catagory" id="catagory" class="form-control form-control-sm" >
						<option value="0" <?php echo isset($catagory) && $catagory == 0 ? 'selected' : '' ?>>1</option>
						<option value="3" <?php echo isset($catagory) && $catagory == 3 ? 'selected' : '' ?>>2</option>
						<option value="5" <?php echo isset($catagory) && $catagory == 5 ? 'selected' : '' ?>>3</option>
						<option value="7" <?php echo isset($catagory) && $catagory == 7 ? 'selected' : '' ?>>4</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Quantity</label>
					<input type="text" class="form-control form-control-sm" name="qty" value="<?php echo isset($qty) ? $qty : '' ?>"  placeholder="Enter quantity">
				</div>
			</div>
          	<div class="col-md-6">
			  <div class="form-group">
					<label for="" class="control-label">Minimum Quantity</label>
					<input type="text" class="form-control form-control-sm" name="mqty" value="<?php echo isset($mqty) ? $mqty : '' ?>"  placeholder="Enter minimum quantity">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Lead Time(day)</label>
					<input type="text" class="form-control form-control-sm" name="ltime" value="<?php echo isset($ltime) ? $ltime : '' ?>"  placeholder="Enter lead time">
				</div>
			</div>
		</div>
		
        
		<div class="row">
			<div class="col-md-10">
				<div class="form-group">
					<label for="" class="control-label">Description</label>
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
    			<button class="btn btn-flat bg-gradient-secondary mx-2" type="button" onclick="location.href='index.php?page=item_list'">Cancel</button>
    		</div>
    	</div>
	</div>
</div>
<script>
	$('#manage-project').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_item',
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
						location.href = 'index.php?page=item_list'
					},2000)
				}
			}
		})
	})
</script>