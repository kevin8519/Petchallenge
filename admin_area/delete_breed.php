<?php 
 session_save_path('/tmp');
session_start(); 

if(!isset($_SESSION['user_email'])){
	
	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {

?>



<?php 
	include("includes/db.php"); 
	
	if(isset($_GET['delete_breed'])){
	
	$delete_id = $_GET['delete_breed'];
	
	$delete_breed = "delete from breeds where breed_id='$delete_id'"; 
	
	$run_delete = mysqli_query($con, $delete_breed); 
	
	if($run_delete){
	
	echo "<script>alert('A breed has been deleted!')</script>";
	echo "<script>window.open('index.php?view_cats','_self')</script>";
	}
	
	}





?>




<?php } ?>