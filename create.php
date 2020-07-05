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
		 
		 $mess [] = '';
		if (isset($_POST['create'])) {
			$name= $_POST['name'];
			$email= $_POST['email'];
			$uname= $_POST['uname'];
			$cell= $_POST['cell'];

			$user_name_check = unique ($connection, 'users', 'uname', $uname);
			$email_check = unique ($connection, 'users', 'email', $email);
			$cell_check = unique ($connection, 'users', 'cell', $cell);

			$password= $_POST['password'];
			$password_hash = password_hash($password, PASSWORD_DEFAULT);

			$cpass= $_POST['cpass'];
			if ($password == $cpass) {
				$password_check = true ;
			} else {
				$password_check = false ;
			}

			
			if ($user_name_check == false) {
				$mess[]= "<p class='alert alert-danger'>Username Already Exists !<button class='close' data-dismiss='alert'>&times;</button></p>";
			} else {
				$mess[]= '';
			}

			if ($email_check == false) {
				$mess[]= "<p class='alert alert-danger'>Email Already Exists !<button class='close' data-dismiss='alert'>&times;</button></p>";
			} else {
				$mess[]= '';
			}

			if ($cell_check == false) {
				$mess[]= "<p class='alert alert-danger'>Cell Already Exists !<button class='close' data-dismiss='alert'>&times;</button></p>";
			} else {
				$mess[]= '';
			}

			
			if (empty($name) || empty($email) || empty($cell) || empty($password) || empty($uname)) {
				$mess[]= "<p class='alert alert-danger'>All filed are requird<button class='close' data-dismiss='alert'>&times;</button></p>";
			}elseif(filter_var($email, FILTER_VALIDATE_EMAIL)== false){
				$mess[]= "<p class='alert alert-info'>Invalide Email<button class='close' data-dismiss='alert'>&times;</button></p>";
			}elseif($password_check == false) {
				$mess[]= "<p class='alert alert-warning'>Password not Match !!!<button class='close' data-dismiss='alert'>&times;</button></p>";
			}
			else{
				
				if ($user_name_check == true AND $email_check == true AND $cell_check == true) {
					$data = fileUpload($_FILES['photo'],'photos/');
					$photo_name = $data['file_name'];

					if ($data ['status'] = 'yes') {

						$sql = "INSERT INTO users (name, email, uname, cell, password, photo) VALUES ('$name','$email','$uname','$cell','$$password_hash', '$photo_name')";
						$connection -> query($sql);

						setMsg('User Registation Success .' );

						header("location:create.php");

						$mess[]= "<p class='alert alert-success'>Data Recived<button class='close' data-dismiss='alert'>&times;</button></p>";
					}else{
						$mess[]= "<p class='alert alert-danger'>Invailid File Format<button class='close' data-dismiss='alert'>&times;</button></p>";
					}
				}
				
				
			}
		}

	?>
	

	<div class="wrap shadow">
		<div class="card" style="margin-left: 400px ; margin-right: 400px; margin-top: 100px">
			<div class="card-body" >
				<h2>Log In</h2>
				<?php 
				

				if (count($mess) > 0) {
					foreach ($mess as $m) {
						echo $m;
					}
				   }

				   getMsg();
			    ?>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="">Name</label>
						<input name="name" class="form-control" value="<?php old('name'); ?>" type="text">
					</div>

					<div class="form-group">
						<label for="">Username</label>
						<input name="uname" class="form-control" value="<?php old('uname'); ?>" type="text">
					</div>

					<div class="form-group">
						<label for="">E-mail</label>
						<input name="email" class="form-control" value="<?php old('email'); ?>" type="text">
					</div>

					<div class="form-group">
						<label for="">Cell</label>
						<input name="cell" class="form-control" value="<?php old('cell'); ?>" type="text">
					</div>



					<div class="form-group">
						<label for="">Password</label>
						<input name="password" class="form-control" type="password">
					</div>

					<div class="form-group">
						<label for="">Confrim Password</label>
						<input name="cpass" class="form-control" type="password">
					</div>

					<div class="form-group">
						<label for="">Photo</label>
						<input name="photo" class="form-control" type="file">
					</div>

					<div class="form-group">
						
						<input name="create" class="btn btn-primary" type="submit" value="Create Account">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<a href="index.php">Log In</a>
			</div>
		</div>
	</div>

	<br>
	<br>
	<br>
	<br>
	<br>

</body>
</html>