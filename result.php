<!DOCTYPE>
<?php

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
	
	<div id="shopping_cart">
		<span style="float:right;font-size:18px;padding:5px;line-height:40px;">
		
		Welcome Guest&nbsp;<b style="color:yellow;">Shopping Cart-</b>Total items:<?php total_items();?><a href="cart.php" style="color:yellow">Go to Cart</a>
	</span>
	</div>
	
	
	
	<div id="products_box">
	
	</div>
	<?php
	if(isset($_GET['search'])){
		
		$search_key=$_GET['user_querry'];
	
	$get_pet="select * from pets where pet_keywords like '%$search_key%'";
	$run_pet=mysqli_query($con,$get_pet);
	
	while($row_pet=mysqli_fetch_array($run_pet)){

     $pet_id = $row_pet['pet_id'];
	$pet_cat = $row_pet['pet_cat'];
	$pet_breed = $row_pet['pet_breed'];
	$pet_title = $row_pet['pet_title'];
	$pet_price = $row_pet['pet_price'];
	$pet_image = $row_pet['pet_image'];
	
	
	echo"
	<div id='single_product'>
	
	<h3>$pet_title</h3>
	<img src='admin_area/product_images/$pet_image' width='180' height='180'/>
	
	<p><b>Price:$ $pet_price </b></p>
	
	<a href='details.php?pet_id=$pet_id' style='float:left;'>Details </a>
	<a href='index.php?add_cart=$pet_id'><button style='float:right;'>Add to cart</button> </a>
	
	
	</div>
	
	
	
	
	";
}
	}
	?>
</div>

</div>

<div id="footer">	

<h2 style="text-align:center; padding-top:30px;">&copy; 2016 by www.cricket247blog.com</h2>

</div>

</div>


</body>

</html>