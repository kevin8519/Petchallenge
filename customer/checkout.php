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


<ul id="cats">

 
	
	
</ul>

  </div>
<div id="content_area">
	
	<div id="shopping_cart" >
		<span style="float:right;font-size:18px;padding:5px;line-height:40px;">
		<?php 
					if(isset($_SESSION['customer_email'])){
					echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b style='color:yellow;'>Your</b>" ;
					}
					else {
					echo "<b>Welcome Guest:</b>";
					}
					?>
		
		
	</span>
	</div>
	
	
	
	<div id="products_box">
	<?php 
				if(!isset($_SESSION['customer_email'])){
					
					include("customer_login.php");
				}
				else {
				
				include("payment.php");
				
				}
				
				?>
	</div>
	
	
	
</div>

</div>

<div id="footer">	

<h2 style="text-align:center; padding-top:30px;">&copy; 2016 by www.kevinapr16.com</h2>

</div>

</div>


</body>

</html>