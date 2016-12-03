<?php
include("includes/db.php");
				global $con;
				
				$tot=0;	
				$dedt=0;
                $final=0;
				$ip=get_client_ip();

				echo $ip;
				$get_total_id=" select * from cart where ip_add ='$ip'";
	
                 $run_total_id=mysqli_query($con,$get_total_id);
                  while($row_total_id=mysqli_fetch_array($run_total_id)){
	              $product_id=$row_total_id['p_id'];
					  echo $product_id;
				$qty=	$row_total_id['qty'];  
				echo $qty;
                $pro_price="select * from pets where pet_id='$product_id'";
	
	              $run_price=mysqli_query($con,$pro_price);
	
	             while($row_price=mysqli_fetch_array($run_price)){
					$discount=0;	
	               $pet_id=$row_price['pet_id'];
					$pet_title=$row_price['pet_title'];
					 echo $pet_title;
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
					echo $final;
					?>
					







<div>
	
	
	<h2 align="center">Pay now with paypal</h2>
	
	
	<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" >

<!-- Identify your business so that you can collect the payments. -->
<input type="hidden" name="business" value="sriniv_1293527277_biz@inbox.com">

<!-- Specify a Buy Now button. -->
<input type="hidden" name="cmd" value="_xclick">

<!-- Specify details about the item that buyers will purchase. -->
<input type="hidden" name="item_name" value="<?php echo $pet_title; ?>">
<input type="hidden" name="item_number" value="<?php echo $pet_id; ?>">
<input type="hidden" name="amount" value="<?php echo $final; ?>">
<!--<input type="hidden" name="quantity" value="<?php echo $qty; ?>">-->
<input type="hidden" name="currency_code" value="USD">

<input type="hidden" name="return" value="http://www.cricket247blog.com/myshop/ecom/paypal_success.php"/>
<input type="hidden" name="cancel_return" value="http://www.cricket247blog.com/myshop/ecom/paypal_cancel.php"/>

<!-- Display the payment button. -->
<input type="image" name="submit" border="0"
src="paypal_button.png"
alt="PayPal - The safer, easier way to pay online">
<img alt="" border="0" width="1" height="1"
src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>

	
		
	
	
</div>