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
</head>
<body>
<div class="main_wrapper">


<div class="header_wrapper">

	<a href="../index.php"><img  src="images/petlogo.jpg" width="160px" height="100px"></a>&nbsp;
<a href="../index.php"><img src="images/petshopimg3.jpg" width="160px" height="100px"></a>&nbsp;
<a href="../index.php"><img src="images/petshopimg2.jpg" width="160px" height="100px"></a>&nbsp;
<a href="../index.php"><img src="images/petlogo3.jpg" width="160px" height="100px"></a>&nbsp;
<a href="../index.php"><img src="images/petshopimg3.jpg" width="160px" height="100px"></a>&nbsp;
<a href="../index.php"><img src="images/petlogo3.jpg" width="160px" height="100px"></a>

<div class="menubar"> 
<ul id="menu">
	<li><a href="../index.php">Home</a></li>
	<li><a href="../all_products.php">All Product</a></li>
	<li><a href="my_account.php">My account</a></li>
	<li><a href="#">Sign up</a></li>
	<li><a href="../cart.php">Shopping cart</a></li>
	<li><a href="#">Contact Us</a></li>
	
</ul>

<div id="form">

<form method="get" action="result.php" enctype="multipart/form-data">
	<input type="text" name="user_querry" placeholder="Search a product">
	<input type="submit" name="search" value="Search">
</form>
	
	
</div>

</div>

</div>

<div class="content_wrapper">

<div id="sidebar"> 

<div id="sidebar_title">My Account:</div>
<ul id="cats">
            <?php 
	
				if(!isset($_SESSION['customer_email'])){
					
					
				}
				$user = $_SESSION['customer_email'];
				
				$get_img = "select * from customers where customer_email='$user'";
				
				$run_img = mysqli_query($con, $get_img); 
				
				$row_img = mysqli_fetch_array($run_img); 
				
				$c_image = $row_img['customer_image'];
				
				$c_name = $row_img['customer_name'];
				
				echo "<p style='text-align:center;'><img src='customer_images/$c_image' width='150' height='150'/></p>";
				
				?>     
                 
                 
                 

                 <li><a href="my_account.php?my_orders">My Orders</a></li>
				<li><a href="my_account.php?edit_account">Edit Account</a></li>
				<li><a href="my_account.php?change_pass">Change Password</a></li>
				<li><a href="my_account.php?delete_account">Delete Account</a></li>
				
	
</ul>


  


  </div>
<div id="content_area">
	<?php cart(); ?>
	
	<div id="shopping_cart">
	
	
		<span style="float:right;font-size:18px;padding:5px;line-height:40px;">
		
		<?php 
					if(isset($_SESSION['customer_email'])){
					echo "<b>Welcome:</b>" . $_SESSION['customer_email']; 
					}
					?>
		
		
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
	
	<?php
	if(!isset($_SESSION['customer_email'])){
					
					echo  " <h2>Please login to proceed further</h2>";
					
					}
		
	?>
	
		<?php 
				if(!isset($_GET['my_orders'])){
					if(!isset($_GET['edit_account'])){
						if(!isset($_GET['change_pass'])){
							if(!isset($_GET['delete_account'])){
							
				echo " <h2>Welcome. $c_name</h2>";
		         echo "<b>You can see your orders progress by clicking this <a href='my_account.php?my_orders'>link</a></b>";	
		
				
				
				}
				}
				}
				}
			?>
		
		
	
	<?php 
				if(isset($_GET['edit_account'])){
				include("edit_account.php");
				}
				if(isset($_GET['change_pass'])){
				include("change_pass.php");
				}
				if(isset($_GET['delete_account'])){
				include("delete_account.php");
				}
				if(isset($_GET['my_orders'])){
				include("my_orders.php");
				}
				
				?>
	
	</div>
	
	
	
</div>

</div>

<div id="footer">	

<h2 style="text-align:center; padding-top:30px;">&copy; 2016 by www.cricket247blog.com</h2>

</div>

</div>


</body>

</html>