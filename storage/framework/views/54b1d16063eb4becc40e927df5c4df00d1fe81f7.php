<?php $__env->startSection('title',"Add New Category"); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
			<form method="post" action="<?php echo e(url('add-category')); ?>" enctype="multipart/form-data">
				<?php echo csrf_field(); ?>

                <div class="block">
                    <div class="header">
                        <h2>Add new category to store</h2>
                    </div>
                    <div class="content controls">
                        <div class="form-row">
                            <div class="col-md-3">Category:</div>
                            <div class="col-md-9"><input type="text" class="form-control" name="category" placeholder="e.g necklaces, bracelets"/></div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3">Special: <span class="label label-warning">Optional</span></div>
                           <div class="col-md-9">
							  <select class="form-control" name="special">
							    <option value="none">Select special</option>
								<?php
								 $specials = ['hot' => "Hot",'popular' => "Popular",'trending' => "Trending"];
								foreach($specials as $key=> $value){
								?>
								 <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
								<?php
								}
								?>
							  </select>
							</div>
                        </div>
						<div class="form-row">
                            <div class="col-md-3">Status:</div>
                           <div class="col-md-9">
							  <select class="form-control" name="status">
							    <option value="none">Select status</option>
								<?php
								 $stockStatuses = ['enabled' => "Enabled",'disabled' => "Disabled"];
								?>
								<?php $__currentLoopData = $stockStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								 <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							  </select>
							</div>
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
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/add-category.blade.php ENDPATH**/ ?>