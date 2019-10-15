<?php

	session_start();
	//initiale variables
	$name="";
	$address="";
	$id=0;
	$edit_state=false;

	
	//connection database
	$db=new mysqli("localhost","root","",'crud') or die("connection unable");
	//if save button is cllicked
	if (isset($_POST['save'])) {
		$name=$_POST['name'];
		$address=$_POST['address'];

		$query="insert into info(name,address) values('$name','$address')";

		mysqli_query($db,$query);
		$_SESSION['msg']="Address Saves";
		header('location:index.php');//redirect to index page after inserting
	}
	//update records
	if (isset($_POST['update'])) {
		$name=mysqli_real_escape_string($db,$_POST['name']);
		$address=mysqli_real_escape_string($db,$_POST['address']);
		$id=mysqli_real_escape_string($db,$_POST['id']);

		mysqli_query($db,"update info set name='$name',address='$address' where id=$id");
		$_SESSION['msg']="Address Updated";
		header('location:index.php');
	}

	//delete records
	if (isset($_GET['del'])){
		$id=$_GET['del'];
		mysqli_query($db,"delete from info where id=$id");
		$_SESSION['msg']="Address deleted";
		header('location:index.php');
	
	}

	//retrieve records
	$results=mysqli_query($db,"select * from info");

?>