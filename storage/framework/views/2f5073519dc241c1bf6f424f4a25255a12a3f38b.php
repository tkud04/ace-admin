<?php
 $totals = $order['totals'];
 $items = $order['items'];
 $itemCount = $totals['items'];
 $uu = "http://admin.aceluxurystore.com/edit-order?r=".$order['reference'];
 $tu = "http://admin.aceluxurystore.com/track?o=".$order['reference'];
?>
<center><img src="http://www.aceluxurystore.com/images/logo.png" width="150" height="150"/></center>
<h3 style="background: #ff9bbc; color: #fff; padding: 10px 15px;">New order <?php echo e($order['reference']); ?> paid via admin!</h3>
Hello admin,<br> please be informed that an admin just posted this order. See the details below:<br><br>
Reference #: <b><?php echo e($order['reference']); ?></b><br>
Customer: <b><?php echo e($name); ?></b><br>
Customer contact: <b><?php echo e($phone); ?> | <?php echo e($user); ?></b><br>
Notes: <b><?php echo e($order['notes']); ?></b><br><br>
<?php
foreach($items as $i)
{
	$product = $i['product'];
	$sku = $product['sku'];
	$name = $product['name'];
	$qty = $i['qty'];
	$pu = url('product')."?sku=".$product['sku'];
	$img = $product['imggs'][0];
	
?>

<a href="<?php echo e($pu); ?>" target="_blank">
  <img style="vertical-align: middle;border:0;line-height: 20px;" src="<?php echo e($img); ?>" alt="<?php echo e($sku); ?>" height="80" width="80" style="margin-bottom: 5px;"/>
	  <?php echo e($name); ?>

</a> (x<?php echo e($qty); ?>)<br>
<?php
}
?>
Total: <b>&#8358;<?php echo e(number_format($order['amount'],2)); ?></b><br><br>

<h6>Shipping Details</h6>
<p>Address: <?php echo e($shipping['address']); ?></p>
<p>City: <?php echo e($shipping['city']); ?></p>
<p>State: <?php echo e($shipping['state']); ?></p><br><br>
<h5 style="background: #ff9bbc; color: #fff; padding: 10px 15px;">Next steps</h5>

<p>Click the <b>View Order</b> button below to view the order or <b>Track Order</b> button to update delivery information. Alternatively you can log in to the Admin Dashboard to view or update tracking info for this order (go to Orders and click either the View or Track buttons beside the order).</p><br>
<p style="color:red;"><b>NOTE:</b> The tracking status for this order is currently marked as <b>PENDING</b>, kindly update delivery information for this order.</p><br><br>

<a href="<?php echo e($uu); ?>" target="_blank" style="background: #ff9bbc; color: #fff; padding: 10px 15px; margin-right: 10px;">View order</a>
<a href="<?php echo e($tu); ?>" target="_blank" style="background: #ff9bbc; color: #fff; padding: 10px 15px; margin-right: 10px;">Track order</a>
<br><br>
<?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/emails/bao-alert.blade.php ENDPATH**/ ?>