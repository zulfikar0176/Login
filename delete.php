<?php 
	require_once "function.php";
	require_once "db.php";





	$name = $_GET['name'];
	$sql= "DELETE  FROM student_info WHERE name='$name'";
	$connection -> query($sql);

	header('location:allstudent.php');
?>