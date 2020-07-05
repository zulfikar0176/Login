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

	<?php 

		$name = $_GET['name'];
		$sql= "SELECT * FROM student_info WHERE name='$name'";
		$data = $connection -> query($sql);
		$student_dat = $data -> fetch_assoc();
	?>
	
	<div style="width: 450px;" class="wrap-table shadow">
		<a class="btn btn-info btn-sm" href="allstudent.php">Back</a>
		<div class="card" >
			<div class="card-body" >
				<img style="width: 150px;" class="img-thumbnail d-block mx-auto" src="photos/<?php echo $student_dat['photo']; ?>" alt="">
				<table>
					<tr>
						<td>Name :  </td>
						<td><?php echo $student_dat['name']; ?></td>
					</tr>

					<tr>
						<td>E-mail :  </td>
						<td><?php echo $student_dat['email']; ?></td>
					</tr>

					<tr>
						<td>Roll :  </td>
						<td><?php echo $student_dat['roll']; ?></td>
					</tr>

					<tr>
						<td>Contact :  </td>
						<td><?php echo $student_dat['contact']; ?></td>
					</tr>

					<tr>
						<td>Location :  </td>
						<td><?php echo $student_dat['location']; ?></td>
					</tr>
				</table>
			</div>
		</div>
		
	</div>



</body>
</html>