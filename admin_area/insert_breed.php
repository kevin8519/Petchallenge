<?php 
 session_save_path('/tmp');
session_start(); 

if(!isset($_SESSION['user_email'])){
	
	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {

?>

<form action="" method="post" style="padding:80px;">

<b>Insert New Breed:</b>
<input type="text" name="new_breed" required/> 
<input type="submit" name="add_breed" value="Add Breed" /> 

</form>

<?php 
include("includes/db.php"); 

	if(isset($_POST['add_breed'])){
	
	$new_breed = $_POST['new_breed'];
	
	$insert_breed = "insert into breeds (breed_title) values ('$new_breed')";

	$run_breed = mysqli_query($con, $insert_breed); 
	
	if($run_breed){
	
	echo "<script>alert('New Breed has been inserted!')</script>";
	echo "<script>window.open('index.php?view_breeds','_self')</script>";
	}
	}

?>


<?php } ?>