<?php $__env->startSection('title',"Edit Banner"); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
			<form method="post" action="<?php echo e(url('edit-banner')); ?>" enctype="multipart/form-data">
				<?php echo csrf_field(); ?>

				<input type="hidden" name="xf" value="<?php echo e($xf); ?>">
				<?php
                           	    $imgg = $b['img'];
	                            $subtitle = $b['subtitle'];
	                            $title = $b['title'];
	                            $copy = $b['copy'];
	                            $status = $b['status'];
								
								$du = url('delete-img')."?xf=".$b['img'];
							   ?>
                <div class="block">
                    <div class="header">
                        <h2>Add new banner</h2>
                    </div>
                    <div class="content controls">
					     <div class="form-row">
                            <div class="col-md-3">Subtitle</div>
                           <div class="col-md-9">
							  <input type="text" class="form-control" name="subtitle" value="<?php echo e($subtitle); ?>" placeholder="Enter subtitle">
						   </div>
                        </div><br>
						<div class="form-row">
                            <div class="col-md-3">Title</div>
                           <div class="col-md-9">
							  <input type="text" class="form-control" name="title" value="<?php echo e($title); ?>" placeholder="Enter title">
						   </div>
                        </div><br>
						<div class="form-row">
                            <div class="col-md-3">Copy (optional)</div>
                           <div class="col-md-9">
							  <input type="text" class="form-control" name="copy" value="<?php echo e($copy); ?>" placeholder="Enter copy">
						   </div>
                        </div><br>
					    <div class="form-row">
                            <div class="col-md-3">Upload image:</div>
                            <div class="col-md-9">
							   <?php if($imgg == ""): ?>
							    <p class="form-control-plaintext text-left"><i class="fa fa-asterik"></i> Upload ad image (<b>Recommended dimension: 1920 x 550</b>)</p>
								<input type="file" name="img" id="img-1" class="form-control" >
							   <?php else: ?>
							    <img class="img img-responsive" src="<?php echo e($imgg); ?>"><br>
							    <a href="#" class="btn btn-default btn-block btn-clean">delete</a>
                               <?php endif; ?>								
							</div>
                        </div><br>
                       
                       
						<div class="form-row">
                            <div class="col-md-3">Status:</div>
                           <div class="col-md-9">
							  <select class="form-control" name="status">
							    <option value="none">Select status</option>
								<?php
								 $stockStatuses = ['enabled' => "Enabled",'disabled' => "Disabled"];
								
								foreach($stockStatuses as $key=> $value){
									$ss = $key == $b['status'] ? "selected='selected'" : "";
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
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/edit-banner.blade.php ENDPATH**/ ?>