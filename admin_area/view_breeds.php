<?php 
 session_save_path('/tmp');
session_start(); 

if(!isset($_SESSION['user_email'])){
	
	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {

?>
	

	<table width="795" align="center" bgcolor="pink"> 

	
	<tr align="center">
		<td colspan="6"><h2>View All Breeds Here</h2></td>
	</tr>
	
	<tr align="center" bgcolor="skyblue">
		<th>Breed ID</th>
		<th>Breed Title</th>
		
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php 
	include("includes/db.php");
	
	$get_breed = "select * from breeds";
	
	$run_breed = mysqli_query($con, $get_breed); 
	
	$i = 0;
	
	while ($row_breed=mysqli_fetch_array($run_breed)){
		
		$breed_id = $row_breed['breed_id'];
		$breed_title = $row_breed['breed_title'];
		
		$i++;
	
	?>
	<tr align="center">
		<td><?php echo $i;?></td>
		<td><?php echo $breed_title;?></td>
		
		<td><a href="index.php?edit_breed=<?php echo $breed_id; ?>">Edit</a></td>
		<td><a href="delete_breed.php?delete_breed=<?php echo $breed_id;?>">Delete</a></td>
	
	</tr>
	<?php } ?>
	<?php } ?>
