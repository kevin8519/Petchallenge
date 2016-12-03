<?php 
 session_save_path('/tmp');
session_start(); 
include("includes/db.php");
if(!isset($_SESSION['user_email'])){
	
	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {

?>
	





<!DOCTYPE>


<html>
	
	
	<head>
		
	<title> This is admin panel </title>	
	<link rel="stylesheet" href="styles/styles.css"	 media="all">
	
	</head>
<body>
	
	<div class="main_wrapper">
	
		<div id="header"></div>
		<div id="right">
		
		<h2 style="text-align:center;">Manage Content</h2>
			
			<a href="index.php?insert_product">Insert New Product</a>
			<a href="index.php?view_products">View All Products</a>
			<a href="index.php?insert_cat">Insert New Category</a>
			<a href="index.php?view_cats">View All Categories</a>
			<a href="index.php?insert_breed">Insert New Breed</a>
			<a href="index.php?view_breeds">View All Breeds</a>
			<a href="index.php?view_customers">View Customers</a>
			<a href="index.php?view_orders">View Orders</a>
			<a href="index.php?view_payments">View Payments</a>
			<a href="logout.php">Admin Logout</a>
		
		</div>
		
		
		
		
		<div id="left">
		<h2 style="color:red; text-align:center;"><?php echo @$_GET['logged_in']; ?></h2>
			<?php 
			if(isset($_GET['view_orders'])){
				
			include("view_orders.php");	
			}
			
			if(isset($_GET['view_payments'])){
				
			include("view_payments.php");	
			}
			
			
			if(isset($_GET['insert_product'])){
				
			include("insert_product.php");	
			}
			
			if(isset($_GET['view_products'])){
		
		    include("view_products.php"); 
		
		      }
			
			if(isset($_GET['edit_pro'])){
		
		      include("edit_pro.php"); 
		
		        }
			
			
			if(isset($_GET['delete_pro'])){
		
		      include("delete_pro.php"); 
		
		        }
			
		if(isset($_GET['insert_cat'])){
		
		      include("insert_cat.php"); 
		
		        }
				if(isset($_GET['view_cats'])){
		
		      include("view_cats.php"); 
		
		        }
			
			if(isset($_GET['edit_cat'])){
		
		      include("edit_cat.php"); 
		
		        }
			
			if(isset($_GET['delete_cat'])){
		
		      include("delete_cat.php"); 
		
		        }
			
			
			
			
			if(isset($_GET['insert_breed'])){
		
		      include("insert_breed.php"); 
		
		        }
			
			if(isset($_GET['view_breeds'])){
		
		      include("view_breeds.php"); 
		
		        }
			
			if(isset($_GET['edit_breed'])){
		
		      include("edit_breed.php"); 
		
		        }
			
			if(isset($_GET['delete_breed'])){
		
		      include("delete_breed.php"); 
		
		        }
			if(isset($_GET['view_customers'])){
		
		      include("view_customers.php"); 
		
		        }
			
			if(isset($_GET['delete_c'])){
		
		      include("delete_c.php"); 
		
		        }
		        ?>
			
	        	
			
			
			
			
			
			
		</div>
	
	
	
	
	</div>
	
	
	
</body>	
	
	
</html>

<?php


   if(isset($_GET['confirm_order'])){

       $get_order=$_GET['confirm_order'];

           $status='Completed';

        $query_update="update orders set status='$status' where order_id ='$get_order'";

            $run_update=mysqli_query($con,$query_update);

       if ($run_update){
         echo "<script>alert('Sucessfully updated')</script>";
         echo "<script>window.open('index.php?view_orders','_self')</script>";
          }
	else {
	 echo "<script>alert('Not Sucessfully updated')</script>";
         echo "<script>window.open('index.php?view_orders','_self')</script>";
	
	}

        }

	?>



<?php } ?> 

