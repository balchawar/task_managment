<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		
		<div class="card-body">
			<table class="table tabe-hover table-condensed" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="15%">
					<col width="15%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Item Name</th>
						<th>Catagory</th>
						<th>Quantity</th>
						<th>Mini. Quantity</th>
						<th>Lead Time(days)</th>
						
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$cat = array("1","2","3","4");
					$where = "";
					if($_SESSION['login_type'] == 2){
						$where = " where p.manager_id = '{$_SESSION['login_id']}' ";
					}elseif($_SESSION['login_type'] == 3){
						$where = " where concat('[',REPLACE(p.user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
					}
					
					$stat = array("Pending","Started","On-Progress","On-Hold","Over Due","Done");
					$qry = $conn->query("SELECT * FROM item_list $where order by lname asc");
					while($row= $qry->fetch_assoc()):
						$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
						unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
						$desc = strtr(html_entity_decode($row['description']),$trans);
						$desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
						

					?>
					<tr>
						<td class="text-center"><?php echo $i++ ?></td>
						
						<td>
							<p><b><?php echo ucwords($row['lname']) ?></b></p>
							<p class="truncate"><?php echo strip_tags($desc) ?></p></td>
						<td><b><?php echo $cat[$row['catagory']] ?></b></td>
						<td><b><?php echo ucwords($row['qty']) ?></b></td>
						<td><b><?php echo ucwords($row['mqty'])?></b></td>
						<td><b><?php echo ucwords($row['ltime'])?></b></td>
						
						<!--<td>
                        	<?php 
                        	if($row['status'] == 1){
						  		echo "<span class='badge badge-secondary'>Pending</span>";
                        	}elseif($row['status'] == 2){
						  		echo "<span class='badge badge-primary'>On-Progress</span>";
                        	}elseif($row['status'] == 3){
						  		echo "<span class='badge badge-success'>Done</span>";
                        	}
                        	?>
                        </td>-->
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <!--<a class="dropdown-item view_project" href="./index.php?page=view_item&id=<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>">View</a>-->
		                      <div class="dropdown-divider"></div>
		                      <?php if($_SESSION['login_type'] != 3): ?>
		                      <a class="dropdown-item" href="./index.php?page=edit_item&id=<?php echo $row['id'] ?>">Edit</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_item" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
		                  <?php endif; ?>
		                    </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<style>
	table p{
		margin: unset !important;
	}
	table td{
		vertical-align: middle !important;
		
	}

</style>
<script>

$(document).ready(function(){
		$('#list').dataTable()
	
	$('.delete_item').click(function(){
	_conf("Are you sure to delete this order?","delete_project",[$(this).attr('data-id')])
	})
	})
	function delete_project($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_item',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>