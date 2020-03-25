  <?php
  $signal = $signals['okays'];
   $class = "warning";   
           
   if($val == "error"){
   	$signal = $signals['errors'];
   	$class = "danger";         
       $pop .= "-error";
   } 
  ?>                
  
  <script>
Swal.fire({
  position: 'top',
  type: '<?php echo e($class); ?>',
  title: '<?php if($val == "error"): ?><strong>Whoops!</strong> <?php else: ?> Success! <?php endif; ?>',
  text: '<?php echo e($signal[$pop]); ?>',
  showConfirmButton: false,
  timer: 4500
});
</script>
	<?php /**PATH C:\bkupp\lokl\repo\ace\resources\views/session-status.blade.php ENDPATH**/ ?>