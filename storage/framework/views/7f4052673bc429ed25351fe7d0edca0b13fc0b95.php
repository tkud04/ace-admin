<?php
 $totals = $order['totals'];
 $items = $totals['items'];
  $uu = "http://www.aceluxurystore.com/track?o=".$order['reference'];
?>
<center><img src="http://www.aceluxurystore.com/images/logo.png" width="150" height="150"/></center>
<h3 style="background: #ff9bbc; color: #fff; padding: 10px 15px;">Payment confirmed!</h3>
Hello <?php echo e($user['fname']); ?>,<br> your payment for order <?php echo e($order['payment_code']); ?> has been cleared and your order is being processed. <br><br>
<h5>Order details:</h5>
Reference #: <b><?php echo e($order['reference']); ?></b><br>
Items: <b><?php echo e($items); ?></b><br>
Total: <b>&#8358;<?php echo e(number_format($order['amount'],2)); ?></b><br><br>
<h5 style="background: #ff9bbc; color: #fff; padding: 10px 15px;">Next steps</h5>

<p>Kindly click the button below to track your delivery. Alternatively you can log in to your Dashboard to track your order (go to Orders and click the Track button beside the order).</p><br>
<p style="color:red;"><b>NOTE:</b> Orders are delivered within 48 hours in Lagos.<br><br>Orders outside Lagos are delivered between 3 – 7 days.</p><br><br>

<a href="<?php echo e($uu); ?>" target="_blank" style="background: #ff9bbc; color: #fff; padding: 10px 15px;">Confirm this order</a><br><br>

<?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/emails/confirm-payment.blade.php ENDPATH**/ ?>