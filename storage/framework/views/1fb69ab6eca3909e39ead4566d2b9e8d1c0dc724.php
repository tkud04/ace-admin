<?php $__env->startSection('title',"Edit Review"); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
			<form method="post" action="<?php echo e(url('edit-review')); ?>" enctype="multipart/form-data">
				<?php echo csrf_field(); ?>

				<input type="hidden" name="xf" value="<?php echo e($xf); ?>">
				<?php
                           	     $name = $r['name'];
                           	   $sku = $r['sku'];
	                            $review = $r['review'];
	                            $status = $r['status'];
	                            $rating = $r['rating'];
	                            $status = $r['status'];
	                            $pu = url('edit-product?id=').$sku;
								
							   ?>
                <div class="block">
                    <div class="header">
                        <h2>Edit user review</h2>
                    </div>
                    <div class="content controls">
					     <div class="form-row">
                            <div class="col-md-3">Name</div>
                           <div class="col-md-9">
							  <input type="text" class="form-control" name="name" value="<?php echo e($name); ?>" placeholder="Name">
						   </div>
                        </div><br>
						<div class="form-row">
                            <div class="col-md-3">Rating</div>
                           <div class="col-md-9">
							  <span class="form-control">
							   <?php for($i = 0; $i < $rating; $i++): ?>
							    <span class="icon-star"></span>
							   <?php endfor; ?>
							  </span>
						   </div>
                        </div><br>
						<div class="form-row">
                            <div class="col-md-3">Review</div>
                           <div class="col-md-9">
							  <p class="form-control">
							  <?php echo e($review); ?>

							  </p>
						   </div>
                        </div><br>
                       
                       
						<div class="form-row">
                            <div class="col-md-3">Status:</div>
                           <div class="col-md-9">
							  <select class="form-control" name="status">
							    <option value="none">Select status</option>
								<?php
								 $statuses = ['enabled' => "Enabled",'pending' => "Pending",'disabled' => "Disabled"];
								
								foreach($statuses as $key=> $value){
									$ss = $key == $status ? "selected='selected'" : "";
								?>
								 <option value="<?php echo e($key); ?>" <?php echo e($ss); ?>><?php echo e($value); ?></option>
								<?php
								}
								?>
							  </select>
							</div>
                        </div><br>
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
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/edit-review.blade.php ENDPATH**/ ?>