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
if(isset($_GET['edit_pro'])){

	$get_id = $_GET['edit_pro']; 
	
	$get_pro = "select * from pets where pet_id='$get_id'";
	
	$run_pro = mysqli_query($con, $get_pro); 
	
	
	
	$row_pro=mysqli_fetch_array($run_pro);
		
		$pro_id = $row_pro['pet_id'];
		$pro_title = $row_pro['pet_title'];
		$pro_image = $row_pro['pet_image'];
		$pro_price = $row_pro['pet_price'];
		$pro_desc = $row_pro['pet_des']; 
		$pro_keywords = $row_pro['pet_keywords']; 
		$pro_cat = $row_pro['pet_cat'];
		$pro_breed = $row_pro['pet_breed'];
		$pro_lifespan = $row_pro['pet_lifespan'];
	     $pro_age = $row_pro['pet_age'];
	     $pro_color = $row_pro['pet_color'];
		
		$get_cat = "select * from categories where cat_id='$pro_cat'";
		
		$run_cat=mysqli_query($con, $get_cat); 
		
		$row_cat=mysqli_fetch_array($run_cat); 
		
		$category_title = $row_cat['cat_title'];
		
		$get_breed = "select * from breeds where breed_id='$pro_breed'";
		
		$run_breed=mysqli_query($con, $get_breed); 
		
		$row_breed=mysqli_fetch_array($run_breed); 
		
		$breed_title = $row_breed['breed_title'];
	$get_color= "select * from color where color_id='$pro_color'";
		
		$run_color=mysqli_query($con, $get_color); 
		
		$row_color=mysqli_fetch_array($run_color); 
		
		$color_title = $row_color['color_title'];
}
?>
<html>
	<head>
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'textarea' });</script>
		<title>Inserting Pets</title> 
		</head>
		
	<body bgcolor="skyblue">


	<form action="" method="post" enctype="multipart/form-data"> 
		
		<table align="center" width="795" height="auto" border="2" bgcolor="#187eae">
			
			<tr align="center">
				<td colspan="7"><h2>Edit or Update here</h2></td>
			</tr>
			<tr>
				<td align="right"><b>Pet Title:</b></td>
				<td><input type="text" name="pet_title" size="60" value="<?php echo $pro_title;?> "/></td>
			</tr>
			
			<tr>
				<td align="right"><b>Pet Category:</b></td>
				<td><select name="pet_cat">
					
					<option> <?php echo $category_title;?></option>
					
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
					
					<option><?php echo $breed_title;?></option>
					
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
				<td><input type="text" name="pet_price" value="<?php echo $pro_price;?>"/></td>
			</tr>
			<tr>
				<td align="right"><b>Pet Color:</b></td>
				<td>
					<select name="pet_color">
					
					<option><?php echo $color_title;?></option>
					
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
				<td><input type="text" name="pet_lifespan" value="<?php echo $pro_lifespan;?>"/></td>
			</tr>
			<tr>
				<td align="right"><b>Pet Age:</b></td>
				<td><input type="text" name="pet_age"  value="<?php echo $pro_age;?>"/></td>
			</tr>
			<tr>
				<td align="right"><b>Pet Description:</b></td>
				<td><textarea name="pet_des" cols=20 rows=10><?php echo $pro_desc; ?></textarea></td>
			</tr>
			<tr>
				<td align="right"><b>Pet Image:</b></td>
				<td><input type="file" name="pet_image" /><img src="product_images/<?php echo $pro_image;?>" width="60" height="60"/></td>
			</tr>
			<tr>
				<td align="right"><b>Pet Keywords:</b></td>
				<td><input type="text" name="pet_keywords" size=50 value="<?php echo $pro_keywords;?>"/></td>
			</tr>
			<tr align="center">
				<td colspan="7"><input type="submit" name="update_post" value="Update Product Now"/></td>
			</tr>
		</table>
		</form>
	</body>
</html>


<?php
if (isset($_POST['update_post'])){
	
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
	
	
$update_pet="update pets set pet_cat='$pet_cat',pet_breed = '$pet_breed' ,pet_title ='$pet_title',pet_price='$pet_price',pet_color='$pet_color',pet_lifespan='$pet_lifespan',pet_age='$pet_age',pet_des='$pet_des',pet_image='$pet_image',pet_keywords='$pet_keywords' where pet_id ='$get_id'";

$update_petdb=mysqli_query($con,$update_pet);
	
	if($update_petdb){
	echo"<script>alert('Product has been Updated Sucessfully')</script>";
	echo"<script>window.open('index.php?view_products','_self')</script>";
	}


	else {
		echo"<script>alert('Product has not been Updated Sucessfully')</script>";
		
	}

}







?>


<?php } ?>