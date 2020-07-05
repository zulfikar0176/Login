<?php 
	require_once "function.php";
	require_once "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">



	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	
</head>
<body>
	
	

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		
		<div class="card" style="margin: 100px; margin-top: 50px" >
			<a class="btn btn-success btn-sm" style="margin-right : 1000px" href="form.php">Add New Student</a>
			
			<div class="card-header">
			
			</div>
			<div class="card-body">
				<h2>All Data</h2>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							
							<th>name</th>
							<th>email</th>
							<th>roll</th>
							<th>contact</th>
							<th>Location</th>
							<th>photo</th>
							<th>action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$sql= "SELECT * FROM student_info";

							$data= $connection -> query($sql);

							$i=1;

							while($fdata = $data -> fetch_assoc()) :
						?>
						<tr>
							<td><?php echo $i; $i++; ?></td>
							<td><?php echo $fdata['name']; ?></td>
							<td><?php echo $fdata['email']; ?></td>
							<td><?php echo $fdata['roll']; ?></td>
							<td><?php echo $fdata['contact']; ?></td>
							<td><?php echo $fdata['location']; ?></td>
							<td><img src="photos/<?php echo $fdata['photo']; ?>" alt=""></td>
							<td>
								<a class="btn btn-sm btn-success" href="show.php?name=<?php echo $fdata['name']; ?>">View</a>
								<a class="btn btn-sm btn-warning" href="edit.php?id=<?php echo $fdata['id']; ?>">Edit</a>
								<a id="delete-item" class="btn btn-sm btn-danger" href="delete.php?name=<?php echo $fdata['name']; ?>">Delete</a>
							</td>
						</tr>
						<?php 
							endwhile;
						?>
					</tbody>
					
				</table>
				
			</div>
			<div class="card-footer"></div>
			
		</div>
	</form>

	<script>
		$('a#delete-item').click(function(){
			let val = confirm('are you sure?');
			if (val == true) {
				return true;
			}else{
				return false;
			}
		});
	</script>

</body>
</html>