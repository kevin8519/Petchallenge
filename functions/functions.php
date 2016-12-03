<?php


$con=mysqli_connect("127.0.0.1:3308","root","","ecom");

if(mysqli_connect_errno()){

	echo"Failed to connect to Mysql" .mysqli_connect_errno();
}
// user ip address

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
// using cart
function cart(){

if (isset($_GET['add_cart'])){
	global $con;
	$ip=get_client_ip();
	$pro_id=$_GET['add_cart'];
	
	$check_pro=" select * from cart where p_id ='$pro_id' AND ip_add ='$ip'";
	$run_check=mysqli_query($con,$check_pro);
	
	if (mysqli_num_rows($run_check)> 0){
	
		echo "";
	
	}
   else {
	
   $insert_pro="insert into cart (p_id,ip_add) values ('$pro_id','$ip')";
	
	$run_pro=mysqli_query($con,$insert_pro);
	
	echo "<script>window.open('index.php','_self')</script>";
	   
  return  $pro_id; 

}
}	
	
}




function total_items(){
global $con;
if (isset($_GET['add_cart'])){
	
	$ip=get_client_ip();
	
	$check_pro=" select * from cart where ip_add ='$ip'";
	$run_check=mysqli_query($con,$check_pro);
	$run_count=mysqli_num_rows($run_check);
	
}
	
	else {
	$ip=get_client_ip();
	
	
	$check_pro=" select * from cart where ip_add ='$ip'";
	$run_check=mysqli_query($con,$check_pro);
	$run_count=mysqli_num_rows($run_check);
	}
echo "$run_count";

}
//total value


function total_value(){
global $con;
$total=0;	
$ip=get_client_ip();
$get_total_id=" select * from cart where ip_add ='$ip'";
	
$run_total_id=mysqli_query($con,$get_total_id);
while($row_total_id=mysqli_fetch_array($run_total_id)){
	$product_id=$row_total_id['p_id'];
	
$pro_price="select * from pets where pet_id='$product_id'";
	
	$run_price=mysqli_query($con,$pro_price);
	
	while($row_price=mysqli_fetch_array($run_price)){
	
	$valuearray=array($row_price['pet_price']);
		$value=array_sum($valuearray);
		
	$total +=$value;
	

 }
}
	
	
echo "$".$total;	
}

function getCats(){

global $con;

$get_cats="select * from categories";
$run_cats=mysqli_query($con,$get_cats);
	
while($row_cats=mysqli_fetch_array($run_cats)){

     $cat_id = $row_cats['cat_id'];
     $cat_title = $row_cats['cat_title'];
	
	echo"<li><a href='index.php?cat=$cat_id'>$cat_title</a><li>";
}

}


function getBrands(){

global $con;

$get_breeds="select * from breeds";
$run_breeds=mysqli_query($con,$get_breeds);
	
while($row_breeds=mysqli_fetch_array($run_breeds)){

     $breed_id = $row_breeds['breed_id'];
     $breed_title = $row_breeds['breed_title'];
	
	echo"<li><a href='index.php?breed=$breed_id'>$breed_title</a><li>";
}

}


function getColor(){

global $con;

$get_color="select * from color";
$run_color=mysqli_query($con,$get_color);
	
while($row_color=mysqli_fetch_array($run_color)){

     $color_id = $row_color['color_id'];
     $color_title = $row_color['color_title'];
	
	echo"<li><a href='index.php?color=$color_id'>$color_title</a><li>";
}

}

function getPet(){
	
if(!isset($_GET['cat'])){
	if(!isset($_GET['breed'])){
	 if(!isset($_GET['color'])){
global $con;
$get_pet="select * from pets order by RAND() LIMIT 0,6";
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
}
}
}

function getCatSortList(){
	
 if(isset($_GET['cat'])){
	
$cat_sort_id=$_GET['cat'];	
	
global $con;
$get_cat_sort="select * from pets where pet_cat='$cat_sort_id'";
	
$run_cat_sort=mysqli_query($con,$get_cat_sort);
	
$count_cats=mysqli_num_rows($run_cat_sort);
	
	if ($count_cats==0){
		echo "<h3 style='padding:20px;'> No pets/reptiles were found in the category</h3>";
	}
	
while($row_cat_sort=mysqli_fetch_array($run_cat_sort)){

     $pet_id = $row_cat_sort['pet_id'];
	$pet_cat = $row_cat_sort['pet_cat'];
	$pet_breed = $row_cat_sort['pet_breed'];
	$pet_title = $row_cat_sort['pet_title'];
	$pet_price = $row_cat_sort['pet_price'];
	$pet_image = $row_cat_sort['pet_image'];
	
	
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

}
function getBreedSortList(){
	
if(isset($_GET['breed'])){
	
$breed_sort_id=$_GET['breed'];	
	
global $con;
$get_breed_sort="select * from pets where pet_breed='$breed_sort_id'";
	
$run_breed_sort=mysqli_query($con,$get_breed_sort);
	
$count_breed=mysqli_num_rows($run_breed_sort);
	
	if ($count_breed==0){
		echo "<h3 style='padding:20px;'> No pets/reptiles were found in the breed</h3>";
	}
	
while($row_breed_sort=mysqli_fetch_array($run_breed_sort)){

     $pet_id = $row_breed_sort['pet_id'];
	$pet_cat = $row_breed_sort['pet_cat'];
	$pet_breed = $row_breed_sort['pet_breed'];
	$pet_title = $row_breed_sort['pet_title'];
	$pet_price = $row_breed_sort['pet_price'];
	$pet_image = $row_breed_sort['pet_image'];
	
	
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

}


function getColorSortList(){
	
if(isset($_GET['color'])){
	
$color_sort_id=$_GET['color'];	
	
global $con;
$get_color_sort="select * from pets where pet_color='$color_sort_id'";
	
$run_color_sort=mysqli_query($con,$get_color_sort);
	
$count_color=mysqli_num_rows($run_color_sort);
	
	if ($count_color==0){
		echo "<h3 style='padding:20px;'> No pets/reptiles were found in the selected color</h3>";
	}
	
while($row_color_sort=mysqli_fetch_array($run_color_sort)){

     $pet_id = $row_color_sort['pet_id'];
	$pet_cat = $row_color_sort['pet_cat'];
	$pet_breed = $row_color_sort['pet_breed'];
	$pet_title = $row_color_sort['pet_title'];
	$pet_price = $row_color_sort['pet_price'];
	$pet_image = $row_color_sort['pet_image'];
	
	
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

}

function getPriceSortList(){
global $con;	
if(isset($_GET['price_id'])){
	
$price_sort_id=$_GET['price_id'];	
if ($price_sort_id==2){	

$get_price_sort="select * from pets ORDER BY pet_price DESC";
	
$run_price_sort=mysqli_query($con,$get_price_sort);
	

	
while($row_price_sort=mysqli_fetch_array($run_price_sort)){

     $pet_id = $row_price_sort['pet_id'];
	$pet_cat = $row_price_sort['pet_cat'];
	$pet_breed = $row_price_sort['pet_breed'];
	$pet_title = $row_price_sort['pet_title'];
	$pet_price = $row_price_sort['pet_price'];
	$pet_image = $row_price_sort['pet_image'];
	
	
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

 if ($price_sort_id==3){	

 $get_price_sort="select * from pets ORDER BY pet_price DESC";
	
 $run_price_sort=mysqli_query($con,$get_price_sort);
	

	
while($row_price_sort=mysqli_fetch_array($run_price_sort)){

     $pet_id = $row_price_sort['pet_id'];
	$pet_cat = $row_price_sort['pet_cat'];
	$pet_breed = $row_price_sort['pet_breed'];
	$pet_title = $row_price_sort['pet_title'];
	$pet_price = $row_price_sort['pet_price'];
	$pet_image = $row_price_sort['pet_image'];
	
	
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

}
}

function getpricesort(){

global $con;

$get_price="select * from sortprice";
$run_price=mysqli_query($con,$get_price);
	
while($row_price=mysqli_fetch_array($run_price)){

     $price_id = $row_price['sort_id'];
     $price_title = $row_price['sort_title'];
	
	echo"
	
	
	<option>value='index.php?price_id=$price_id'></option>
	
	";
	
	
}

}








?>