<!DOCTYPE>
<?php

session_save_path(realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();
include("functions/functions.php");

?>

<html>
<head>

<title> My Online Store </title>
<link rel="stylesheet" href="styles/styles.css" media="all">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
var $uls = $('ul').has('li:nth-child(6)').append('<li class="more">Show more</li>');

$uls.on('click', '.more', function() {
  var $nexts = $(this).parent().children('li:not(.more):visible:last').nextAll(':not(.more)');
  $nexts.slice(0, 3).show();
  if ($nexts.length <= 3) {
    $(this).toggleClass('more less').text('Show less')
  }
});
$uls.on('click', '.less', function() {
  var $curr = $(this).parent().children('li:not(.less):visible');
  var num = $curr.length % 3 || 3;
  $curr.slice(-num).hide();
  if ($curr.length <= 10) {
    $(this).toggleClass('more less').text('Show more')
  }
});	



});
	</script>
</head>
<body>
<div class="main_wrapper">


<div class="header_wrapper">

<a href="index.php"><img  src="images/petlogo.jpg" width="160px" height="100px"></a>&nbsp;
<a href="index.php"><img src="images/petshopimg3.jpg" width="160px" height="100px"></a>&nbsp;
<a href="index.php"><img src="images/petshopimg2.jpg" width="160px" height="100px"></a>&nbsp;
<a href="index.php"><img src="images/petlogo3.jpg" width="160px" height="100px"></a>&nbsp;
<a href="index.php"><img src="images/petshopimg3.jpg" width="160px" height="100px"></a>&nbsp;
<a href="index.php"><img src="images/petlogo3.jpg" width="160px" height="100px"></a>

<div class="menubar"> 
<ul id="menu">
	<li><a href="index.php">Home</a></li>
	<li><a href="all_products.php">All Products</a></li>
	<li><a href="customer/my_account.php">My account</a></li>
	<li><a href="#">Sign up</a></li>
	<li><a href="cart.php">Shopping cart</a></li>
	<li><a href="#">Contact Us</a></li>
	
</ul>

<div id="form">

<form method="get" action="result.php" enctype="multipart/form-data">
	<input type="text" name="user_querry" placeholder="Search a product">
	<input type="submit" name="search" value="Search">
</form>
	
	
</div>
<div id="form">

<form method="post" action="pricesort.php" enctype="multipart/form-data">
	<select name="p_s">
  <option value="1">Choose Option</option>
  <option value="2">Price High to Low</option>
  <option value="3">Price Low to High</option>
  <option value="3">Price 0-500</option>
  <option value="3">Price 500-1000</option>
  <option value="3">Price-More than 1000</option>
</select>
	<input type="submit" name="click" value="sort">
</form>
	
	
</div>

</div>

</div>

<div class="content_wrapper">

<div id="sidebar"> 

<div id="sidebar_title">Categories</div>
<ul id="cats">

<?php getCats(); ?>
	
</ul>


  
  
<div id="sidebar_title">Breed</div>
<ul id="cats">

<?php getBrands(); ?>
	
	
</ul>
<div id="sidebar_title">Color</div>
<ul id="cats">

<?php getColor(); ?> 
	
	
</ul>

  </div>
<div id="content_area">
	<?php cart(); ?>
	<div id="shopping_cart">
		<span style="float:right;font-size:18px;padding:5px;line-height:40px;">
		<?php 
					if(isset($_SESSION['customer_email'])){
					echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b style='color:yellow;'>Your</b>" ;
					}
					else {
					echo "<b>Welcome Guest:</b>";
					}
					?>
		
		&nbsp;<b style="color:yellow;">Shopping Cart-</b>Total items:<?php total_items();?><a href="index.php" style="color:yellow">Back to Shop</a>
		<?php 
					if(!isset($_SESSION['customer_email'])){
					
					echo "<a href='checkout.php' style='color:orange;'>Login</a>";
					
					}
					else {
					echo "<a href='logout.php' style='color:orange;'>Logout</a>";
					}
					
					
					
					?>
		
		
		
	</span>
	</div>
	
	
	
	<div id="products_box">
	<form action="" method="post" enctype="multipart/form-data">
			
				<table align="center" width="700" bgcolor="skyblue">
					
					<tr align="center">
						<th>Remove</th>
						<th>Product(S)</th>
						<th>Quantity</th>
						<th>Update</th>
						<th>Total Price</th>
						<th>Discount</th>
					</tr>
		       <?php
				global $con;
				$total=0;
				$tot=0;	
				$dedt=0;
				$ip=get_client_ip();
				$get_total_id=" select * from cart where ip_add ='$ip'";
	
                 $run_total_id=mysqli_query($con,$get_total_id);
                  while($row_total_id=mysqli_fetch_array($run_total_id)){
	              $product_id=$row_total_id['p_id'];
	
                $pro_price="select * from pets where pet_id='$product_id'";
	
	              $run_price=mysqli_query($con,$pro_price);
	
	             while($row_price=mysqli_fetch_array($run_price)){
					$discount=0;	
	               $valuearray=array($row_price['pet_price']);
		             $value=array_sum($valuearray);
					 $total +=$value;
					$pet_title=$row_price['pet_title'];
					$pet_image=	$row_price['pet_image'];
					$pet_price_single=$row_price['pet_price'];
					$pet_lifespan=	$row_price['pet_lifespan'];
					$pet_age=	$row_price['pet_age'];	
	               if ($pet_age/$pet_lifespan <0.5){
					   $discount=0;	
				   
				   }
					else {
					
					$discount=0.3*$pet_price_single;
					
					} 
					 
					?>
		
		<tr align="center">
		<td> <input type="checkbox" name="remove[]" value="<?php echo $product_id; ?>"></td>
			<td><?php echo $pet_title;?> <br>
			
			<img src="admin_area/product_images/<?php echo $pet_image;?> " width="60" height="60">
			   </td>
			<td><input type="text" size="4" name="qty" value=""/></td>
			<td> <input type="checkbox" name="addin[]" value="<?php echo $product_id; ?>"></td>
			<?php
				global $con;
				$ip=get_client_ip();
				 
				if(isset($_POST['update_cart'])){
					
					foreach($_POST['addin'] as $add_id){
							
							
							$qty = $_POST['qty'];
							
							
							$update_qty = "update cart set qty='$qty' where p_id='$add_id' AND ip_add='$ip'";
							echo $update_qty;
							$run_qty = mysqli_query($con, $update_qty); 
							
							
							/*$_SESSION['qty']=$qty;*/
							echo $qty;
					
				}
				}
				
					 if ($qty==0){
							$qty=1;
							}
						else {
							$qty=$qty;
						}
					 
			 ?> 
			
			<td><b><?php echo "$".$pet_price_single*$qty;?> </b></td>
			<td><b><?php echo "$". $discount*$qty;?></b></td>
								<?php	$tot +=$pet_price_single*$qty -$discount*$qty ; ?>						
			
		</tr>
		
		
		 
      <?php } } ?>
		<tr align="right">
			<td colspan="5"><b>Sub Total:</b></td>
			<td> <b><?php echo"$". ($tot); ?></b></td>
		</tr>
		
		<tr align="center">
						<td colspan="2"><input type="submit" name="update_cart" value="Update Cart"/></td>
						
						<td><input type="submit" name="continue" value="Continue Shopping" /></td>
						<td><button><a href="checkout.php" style="text-decoration:none; color:black;">Checkout</a></button></td>
					</tr>
		</table>
		</form>
		
		<?php
		function updatecart(){
		global $con;
		$ip=get_client_ip();
		if(isset($_POST['update_cart'])){
		  foreach($_POST['remove'] as $remove_id){

		$delete_product="delete from cart where p_id= '$remove_id' AND ip_add ='$ip'";	
			
		$run_delete=mysqli_query($con,$delete_product);
			
			if ($run_delete){
			
			echo"<script>window.open('cart.php','_self')</script>";
			}
			
		}
		}
		if(isset($_POST['continue'])){
		echo"<script>window.open('index.php','_self')</script>";
		}
			
		
		}
		
		echo @$up_cart=	updatecart();
		?>
		
	</div>
	
	
	
</div>

</div>

<div id="footer" >	

<h2 style="text-align:center; padding-top:30px;">&copy; 2016 by www.cricket247blog.com</h2>

</div>

</div>


</body>

</html>