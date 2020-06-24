<?php $__env->startSection('title',$u['fname']." ".$u['lname']); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
			<form method="post" action="<?php echo e(url('user')); ?>" enctype="multipart/form-data">
				<?php echo csrf_field(); ?>

				<input type="hidden" name="xf" value="<?php echo e($u['id']); ?>">
                <div class="block">
                    <div class="header">
                        <h2>Edit user information</h2>
                    </div>
                    <div class="content controls">
                        <div class="form-row">
                            <div class="col-md-3">First name:</div>
                            <div class="col-md-9"><input type="text" name="fname" class="form-control" placeholder="First name" value="<?php echo e($u['fname']); ?>"/></div>
                        </div>
						<div class="form-row">
                            <div class="col-md-3">Last name:</div>
                            <div class="col-md-9"><input type="text" name="lname" class="form-control" placeholder="Last name" value="<?php echo e($u['lname']); ?>"/></div>
                        </div> 
						<div class="form-row">
                            <div class="col-md-3">Email:</div>
                            <div class="col-md-9"><input type="text" class="form-control" name="email" placeholder="Email address" value="<?php echo e($u['email']); ?>"/></div>
                        </div> 
						<div class="form-row">
                            <div class="col-md-3">Phone:</div>
                            <div class="col-md-9"><input type="text" class="form-control" name="phone" placeholder="Phone number" value="<?php echo e($u['phone']); ?>"/></div>
                        </div> 
						<div class="form-row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
							  <center>
							    <button type="submit" class="btn btn-default btn-block btn-clean">Submit</button>
							  </center>
							</div>
                            <div class="col-md-4"></div>							
                        </div>
                                              
                    </div>
                </div>  
            </form>				
            </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/user.blade.php ENDPATH**/ ?>