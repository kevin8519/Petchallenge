<?php 
session_save_path('/tmp');
session_start(); 

if(!isset($_SESSION['user_email'])){
	
	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {

?>
	


<!DOCTYPE>

<?php
include("includes/db.php");

?>
<html>
	<head>
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'textarea' });</script>
		<title>Inserting Pets</title> 
		</head>
		
	<body bgcolor="skyblue">


	<form action="insert_product.php" method="post" enctype="multipart/form-data"> 
		
		<table align="center" width="795" height="auto" border="2" bgcolor="#187eae">
			
			<tr align="center">
				<td colspan="7"><h2>Insert New Pets Here</h2></td>
			</tr>
			<tr>
				<td align="right"><b>Pet Title:</b></td>
				<td><input type="text" name="pet_title" size="60" required/></td>
			</tr>
			
			<tr>
				<td align="right"><b>Pet Category:</b></td>
				<td><select name="pet_cat">
					
					<option>select a category</option>
					
					<?php
					$get_cats="select * from categories";
					$run_cats=mysqli_query($con,$get_cats);
	
					while($row_cats=mysqli_fetch_array($run_cats)){

     				$cat_id = $row_cats['cat_id'];
					$cat_title = $row_cats['cat_title'];
	
					echo"<option value='$cat_id'>$cat_title</option>";
						}
					?>
					
				</select></td>
			</tr>
			<tr>
				<td align="right"><b>Pet Breed:</b></td>
				<td><select name="pet_breed">
					
					<option>select breed</option>
					
					<?php
					$get_breeds="select * from breeds";
					$run_breeds=mysqli_query($con,$get_breeds);
	
					while($row_breeds=mysqli_fetch_array($run_breeds)){

     				$breed_id = $row_breeds['breed_id'];
     				$breed_title = $row_breeds['breed_title'];
	
					echo"<option value='$breed_id'>$breed_title</option>";

						}
					?>
					
				</select></td>
					
	
			</tr>
			
			<tr>
				<td align="right"><b>Pet Price:</b></td>
				<td><input type="text" name="pet_price" required/></td>
			</tr>
			<tr>
				<td align="right"><b>Pet Color:</b></td>
				<td>
					<select name="pet_color">
					
					<option>select color</option>
					
					<?php
					$get_color="select * from color";
				$run_color=mysqli_query($con,$get_color);
	
				while($row_color=mysqli_fetch_array($run_color)){

     				$color_id = $row_color['color_id'];
     				$color_title = $row_color['color_title'];
	
					echo"<option value='$color_id'>$color_title<option>";
					}
					?>
					
				</select>
						
				</td>
			</tr>
			<tr>
				<td align="right"><b>Pet Lifespan:</b></td>
				<td><input type="text" name="pet_lifespan" required/></td>
			</tr>
			<tr>
				<td align="right"><b>Pet Age:</b></td>
				<td><input type="text" name="pet_age"  required/></td>
			</tr>
			<tr>
				<td align="right"><b>Pet Description:</b></td>
				<td><textarea name="pet_des" cols=20 rows=10></textarea></td>
			</tr>
			<tr>
				<td align="right"><b>Pet Image:</b></td>
				<td><input type="file" name="pet_image"/></td>
			</tr>
			<tr>
				<td align="right"><b>Pet Keywords:</b></td>
				<td><input type="text" name="pet_keywords" size=50 required/></td>
			</tr>
			<tr align="center">
				<td colspan="7"><input type="submit" name="insert_post" value="Insert Product Now"/></td>
			</tr>
		</table>
		</form>
	</body>
</html>


<?php
if (isset($_POST['insert_post'])){

	$pet_title=$_POST['pet_title'];
	$pet_cat=$_POST['pet_cat'];
	$pet_breed=$_POST['pet_breed'];
	$pet_price=$_POST['pet_price'];
	$pet_color=$_POST['pet_color'];
	$pet_lifespan=$_POST['pet_lifespan'];
	$pet_age=$_POST['pet_age'];
	$pet_des=$_POST['pet_des'];
	$pet_keywords=$_POST['pet_keywords'];
	
	$pet_image=$_FILES['pet_image']['name'];
	$pet_image_tmp=$_FILES['pet_image']['tmp_name'];
	
	move_uploaded_file($pet_image_tmp,"product_images/$pet_image");
	
	
$insert_pet="insert into pets (pet_cat,pet_breed,pet_title,pet_price,pet_color,pet_lifespan,pet_age,pet_des,pet_image,pet_keywords) 						values ('$pet_cat','$pet_breed','$pet_title','$pet_price','$pet_color','$pet_lifespan','$pet_age','$pet_des','$pet_image','$pet_keywords')";

$insert_petdb=mysqli_query($con,$insert_pet);
	
	if($insert_petdb){
	echo"<script>alert('Product has been inserted')</script>";
	echo"<script>window.open('index.php?insert_product','_self')</script>";
	}




}







?>


<?php } ?>