 
<script>
let nl = '\n';
let text = 
Swal.fire({
  position: 'top',
  type: 'error',
  title: `<strong>Whoops!</strong> ${nl} There were some problems with your input. ${nl}`,
  text: `                     	
                       	<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if($error == "The g-recaptcha-response field is required."): ?>
							    You must fill the captcha to continue
						      <?php elseif($error == "The selected sz is invalid." || $error == "The sz field is required."): ?>
							    You must select a size to continue
						      <?php else: ?>
						        <?php echo e($error); ?>

						      <?php endif; ?> 
							  ${nl}
						   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         `,
  showConfirmButton: false,
  timer: 3000
});
</script>
	<?php /**PATH C:\bkupp\lokl\repo\ace\resources\views/input-errors.blade.php ENDPATH**/ ?>