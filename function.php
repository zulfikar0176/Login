<?php 

	function old($name){
		if (isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}

	function fileUpload($file, $location, $format=['jpg','png','gif','jpeg']){
		$file_name=$file['name'];
		$file_tmp_name=$file['tmp_name'];

		$file_array = explode('.', $file_name);
		$ext = strtolower(end($file_array));

		$unique_name= md5(time().rand()).'.'.$ext;
		$status = '';
		if (in_array($ext, $format)) {
			move_uploaded_file($file_tmp_name, $location. $unique_name );
			$status = 'yes';
		}else{
			$status = 'no';
		}
		return[
			'file_name'  =>  $unique_name,
			'status'  =>  $status
		];
	}

	function unique ($conn , $table , $col , $data){

		$sql = "SELECT $col FROM $table WHERE $col='$data'";
		$data = $conn -> query($sql);
		$row = $data -> num_rows;

		if ($row > 0) {
			return false;
		}else{
			return true;
		}
	}


	function setMsg ($msg){
		setcookie('smsg', $msg, time()+10);
	}

	function getMsg(){
		if (isset($_COOKIE['smsg'])) {
			echo "<p class='alert alert-info'>" . $_COOKIE['smsg'] . "<button class='close' data-dismiss='alert'>&times;</button></p>";
		}
	}

		
	
