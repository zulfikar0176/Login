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

		$id = $_GET['id'];
		
		
		if (isset($_POST['update'])) {
			$name= $_POST['name'];
			$email= $_POST['email'];
			$roll= $_POST['roll'];
			$contact= $_POST['contact'];
			$location= $_POST['location'];
			
			
			if (empty($name) || empty($email) || empty($roll) || empty($contact) || empty($location)) {
				$mess= "<p class='alert alert-danger'>All filed are requird<button class='close' data-dismiss='alert'>&times;</button></p>";
			}elseif(filter_var($email, FILTER_VALIDATE_EMAIL)== false){
				$mess= "<p class='alert alert-info'>Invalide Email<button class='close' data-dismiss='alert'>&times;</button></p>";
			}
			else{
				
				$sql = "UPDATE student_info SET name='$name', email='$email', roll='$roll', contact='$contact', location='$location' WHERE id='$id'";
				$connection -> query($sql);

				$mess= "<p class='alert alert-success'>Data Stable<button class='close' data-dismiss='alert'>&times;</button></p>";
				
				
			 }
		}

		$sql= "SELECT * FROM student_info WHERE id='$id'";
		$data = $connection -> query($sql);
		$student_data = $data -> fetch_assoc();

	?>
	


	<form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
		
		<div class="card" style="margin: 300px; margin-top: 50px">
			<a class="btn btn-success btn-sm" style="margin-right : 500px" href="allstudent.php">All Student</a>

			<?php 
				

				if (isset($mess)) {
					echo $mess;
				}
			 ?>
			
			<div class="card-header">
				<h1>Update Student Data</h1>
			</div>
			<div class="card-body">

				<div class="form-group">
					<label for="">Name</label>
					<input name="name" class="form-control" value="<?php echo $student_data['name']; ?>" type="text" >
				</div>

				<div class="form-group">
					<label for="">E-mail</label>
					<input name="email" class="form-control" value="<?php echo $student_data['email']; ?>" type="text" >
				</div>

				<div class="form-group">
					<label for="">Roll</label>
					<input name="roll" class="form-control" value="<?php echo $student_data['roll']; ?>" type="text" >
				</div>

				<div class="form-group">
					<label for="">Contact Number</label>
					<input name="contact" class="form-control" value="<?php echo $student_data['contact']; ?>" type="text" >
				</div>

				<div class="form-group">
					<label for="">Location</label>
					<input name="location" class="form-control" value="<?php echo $student_data['location']; ?>" type="text">
				</div>
				<div class="form-group">
					<img src="photos/<?php echo $student_data['photo']; ?>" alt="">
				</div>

				<div class="form-group">
					<label for="">Photo</label>
					<input name="photo" class="form-control" type="file">
				</div>

				<div class="form-group">
					
					<input name="update" class="btn btn-primary" type="submit" value="Submit Data">
				</div>
			</div>
			<div class="card-footer"></div>
			
		</div>
	</form>
</body>
</html>