<?php $__env->startSection('title',"Edit Category"); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
			<form method="post" action="<?php echo e(url('edit-category')); ?>" enctype="multipart/form-data">
				<?php echo csrf_field(); ?>

				<input type="hidden" name="xf" value="<?php echo e($category['id']); ?>">
                <div class="block">
                    <div class="header">
                        <h2>Edit category information</h2>
                    </div>
                    <div class="content controls">
                        <div class="form-row">
                            <div class="col-md-3">Category:</div>
                            <div class="col-md-9"><input type="text" class="form-control" name="category" placeholder="e.g necklaces, bracelets" value="<?php echo e($category['category']); ?>"/></div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3">Special: <span class="label label-warning">Optional</span></div>
                           <div class="col-md-9">
							   <select class="form-control" name="special">
							    <option value="none">Select special</option>
								<?php
								 $specials = ['hot' => "Hot",'popular' => "Popular",'trending' => "Trending"];
								foreach($specials as $key => $value){
								$ss = $key == $category['special'] ? " selected='selected'" : "";
								?>
								 <option value="<?php echo e($key); ?>"<?php echo e($ss); ?>><?php echo e($value); ?></option>
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
								 $statuses = ['enabled' => "Enabled",'disabled' => "Disabled"];
								 foreach($statuses as $key=> $value){
									$ss = $key == $category['status'] ? " selected='selected'" : "";
								?>
								 <option value="<?php echo e($key); ?>" <?php echo e($ss); ?>><?php echo e($value); ?></option>
								<?php
								 }
								?>
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
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/edit-category.blade.php ENDPATH**/ ?>