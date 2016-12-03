<?php 
session_save_path(realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start(); 
?>


<html>
	<head>
		<title>Payment Successful!</title>
	</head>

<body>
<?php
include("includes/db.php");
include("functions/functions.php");	
global $con;
				//paymnet
				$tot=0;	
				$dedt=0;
				$final=0;
				$ip=get_client_ip();

				/*echo $ip;*/
				$get_total_id=" select * from cart where ip_add ='$ip'";
	
                 $run_total_id=mysqli_query($con,$get_total_id);
                  while($row_total_id=mysqli_fetch_array($run_total_id)){
	              $product_id=$row_total_id['p_id'];
					 /* echo $product_id;*/
				$qty=	$row_total_id['qty'];  
				/*echo $qty;*/
                $pro_price="select * from pets where pet_id='$product_id'";
	
	              $run_price=mysqli_query($con,$pro_price);
	
	             while($row_price=mysqli_fetch_array($run_price)){
					$discount=0;	
	               $pet_id=$row_price['pet_id'];
					$pet_title=$row_price['pet_title'];
					 /*echo $pet_title;*/
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
					 
					  if ($qty==0){
							$qty=1;
							}
						else {
							$qty=$qty;
						}
					$tot += $pet_price_single*$qty;
					$dedt +=$discount*$qty;
					 
					 
					 
					 
				 }}
					$final=$tot-$dedt; 
					/*echo $final;*/
					
	// this is about the customer
			$user = $_SESSION['customer_email'];
				
			$get_c = "select * from customers where customer_email='$user'";
				
			$run_c = mysqli_query($con, $get_c); 
				
			$row_c = mysqli_fetch_array($run_c); 
				
			$c_id = $row_c['customer_id'];
			$c_email = $row_c['customer_email'];
			$c_name = $row_c['customer_name']; 
			
			//payment details from paypal
			
			$amount = $_GET['amt']; 
			
			$currency = $_GET['cc']; 
			
			$trx_id = $_GET['tx']; 
			
			$invoice=mt_rand();
			
			$insert_payment = "insert into payments (amount,customer_id,product_id,trx_id,currency,payment_date) values ('$amount','$c_id','$pet_id','$trx_id','$currency',NOW())";            
				
				$run_payment = mysqli_query($con, $insert_payment); 
				
				// inserting the order into table
				$insert_order = "insert into orders (p_id, c_id, qty,invoice_no,order_date,status) values ('$pet_id','$c_id','$qty','$invoice', NOW(),'inProgress')";
				$run_order = mysqli_query($con, $insert_order); 
	
		
	
	
		$empty_cart = "delete from cart";
		$run_cart = mysqli_query($con, $empty_cart);
		
		
	
	
	if($amount==$final){
		
		echo "<h2>Welcome:" . $_SESSION['customer_email']. "<br>" . "Your Payment was successful!</h2>";
		echo "<a href='http://www.cricket247blog.com/myshop/ecom/customer/my_account.php'>Go to your Account</a>";
		
		}
		else {
		
		echo "<h2>Welcome Guest, Payment was failed</h2><br>";
		echo "<a href='http://www.cricket247blog.com/myshop/ecom'>Go to Back to shop</a>";
		
		}
		
		       $headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: <pet@cricket247blog.com>' . "\r\n";
			
			$subject = "Order Details";
			
			$message = "<html> 
			<p>
			
			Hello dear <b style='color:blue;'>$c_name</b> you have ordered some products on our website cricket247blog.com/myshop/ecom, please find your order    details, your order will be processed shortly. Thank you!</p>
			
				<table width='600' align='center' bgcolor='#FFCC99' border='2'>
			
					<tr align='center'><td colspan='6'><h2>Your Order Details from cricket247blog.com/myshop/ecom</h2></td></tr>
					
					<tr align='center'>
						<th><b>S.N</b></th>
						<th><b>Product Name</b></th>
						<th><b>Quantity</b></th>
						<th><b>Paid Amount</th></th>
						<th>Invoice No</th>
					</tr>
					
					<tr align='center'>
						<td>1</td>
						<td>$pet_title</td>
						<td>$qty</td>
						<td>$amount</td>
						<td>$invoice</td>
					</tr>
			
				</table>
				
				<h3>Please go to your account and see your order details!</h3>
				
				<h2> <a href='http://www.cricket247blog.com/myshop/ecom'>Click here</a> to login to your account</h2>
				
				<h3> Thank you for your order @ - www.cricket247blog.com</h3>
				
			</html>
			
			";
			
			mail($c_email,$subject,$message,$headers);
						


?>
</body>

</html>