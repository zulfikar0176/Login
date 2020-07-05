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

		if (isset($_POST['login'])) {
			$ue= $_POST['ue'];
			$pass= $_POST['pass'];

			if (empty($ue) || empty($pass)) {
				$mess = "<p class='alert alert-danger'>All filed are requird<button class='close' data-dismiss='alert'>&times;</button></p>";
			}else{
				$sql = "SELECT * FROM users WHERE uname = '$ue' || email = '$ue'";
				$data = $connection -> query($sql);

				$login_users = $data -> fetch_assoc();

				if ($data -> num_rows == 1) {
					if (password_verify($pass , $login_users['password']) == true) {
						header("location:profile.php");
					}else{
						$mess = "<p class='alert alert-danger'>Worng Password !!!<button class='close' data-dismiss='alert'>&times;</button></p>";
					}
				}else{
					$mess = "<p class='alert alert-danger'>Worng Username or Email !!!!<button class='close' data-dismiss='alert'>&times;</button></p>";
				}
			}
		}



	 ?>

	<div class="wrap shadow">
		<div class="card" style="margin-left: 400px ; margin-right: 400px; margin-top: 100px">
			<div class="card-body" >
				<h2>Log In</h2>
				<?php 
				

				if (isset($mess) ) {
					
						echo $mess;
					}
				   

				   
			    ?>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<div class="form-group">
						<label for="">Email/Username</label>
						<input name="ue" class="form-control" value="<?php old('ue'); ?>" type="text">
					</div>

					<div class="form-group">
						<label for="">Password</label>
						<input name="pass" class="form-control" value="<?php old('pass'); ?>" type="password">
					</div>

					<div class="form-group">
						
						<input name="login" class="btn btn-primary" type="submit" value="LogIn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<a href="create.php">Create an account</a>
			</div>
		</div>
	</div>

	



</body>
</html>