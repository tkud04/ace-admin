<?php
 $uu = "http://www.aceluxurystore.com/review-order?ref=".$order['reference'];
?>
<center><img src="http://www.aceluxurystore.com/images/logo.png" width="150" height="150"/></center>
<h3 style="background: #ff9bbc; color: #fff; padding: 10px 15px;"><?php echo e($subject); ?></h3>
Hello <?php echo e($name); ?>,<br> We want to say a big thank you for purchasing on our store! What did you think of your order? If you don't mind, we would like you to please leave a review here:<br><br>

<a href="<?php echo e($uu); ?>" target="_blank" style="background: #ff9bbc; color: #fff; padding: 10px 15px; margin-right: 10px;">Leave a review</a><br><br>

If the button above doesn't work, please copy and paste this link to your browser: <a href="<?php echo e($uu); ?>" target="_blank"><?php echo e($uu); ?></a>
<?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/emails/ask-review.blade.php ENDPATH**/ ?>