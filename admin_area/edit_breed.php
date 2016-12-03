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

if(isset($_GET['edit_breed'])){

	$breed_id = $_GET['edit_breed']; 
	
	$get_breed = "select * from breeds where breed_id='$breed_id'";

	$run_breed = mysqli_query($con, $get_breed); 
	
	$row_breed = mysqli_fetch_array($run_breed); 
	
	$breed_id = $row_breed['breed_id'];
	$breed_title = $row_breed['breed_title'];
}


?>
<form action="" method="post" style="padding:80px;">

<b>Update Breed:</b>
<input type="text" name="new_breed" value="<?php echo $breed_title;?>"/> 
<input type="submit" name="update_breed" value="Update Breed" /> 

</form>

<?php 


	if(isset($_POST['update_breed'])){
	
	$update_id = $breed_id;
	
	$new_breed = $_POST['new_breed'];
	
	$update_breed = "update breeds set breed_title='$new_breed' where breed_id='$update_id'";

	$run_breed = mysqli_query($con, $update_breed); 
	
	if($run_breed){
	
	echo "<script>alert(' Breed has been updated!')</script>";
	echo "<script>window.open('index.php?view_breeds','_self')</script>";
	}
	}

?>


<?php } ?>