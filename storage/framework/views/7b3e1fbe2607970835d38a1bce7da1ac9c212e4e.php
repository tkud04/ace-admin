<?php $__env->startSection('title',"Edit Plugin"); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
			<form method="post" action="<?php echo e(url('plugin')); ?>" enctype="multipart/form-data">
				<?php echo csrf_field(); ?>

				<input type="hidden" name="xf" value="<?php echo e($p['id']); ?>">
                <div class="block">
                    <div class="header">
                        <h2>Update plugin information</h2>
                    </div>
                    <div class="content controls">
					<div class="form-row">
                                <div class="col-md-3">Name:</div>
								<div class="col-md-9">
							      <input type="text" class="form-control" name="name" id="ap-name" placeholder="Plugin name e.g Facebook,Google etc" value="<?php echo e($p['name']); ?>" required/>
								 </div>
								</div>
								
								<div class="form-row">
                                <div class="col-md-3">Value:</div>
								<div class="col-md-9">
							      <textarea class="form-control" name="value" id="ap-value" required><?php echo e($p['value']); ?></textarea>
								 </div>
								</div>
						

								<div class="form-row">
                                <div class="col-md-3">Status:</div>
								<div class="col-md-9">
							      <select class="form-control" name="status" id="ap-status" style="margin-bottom: 5px;">
							        <option value="none">Select status</option>
								    <?php
								     $secs = ['enabled' => "Enabled",'disabled' => "Disabled"];
								     foreach($secs as $key => $value){
										$ss = $p['status'] == $key ? " selected='selected'" : "";
								    ?>
								    <option value="<?php echo e($key); ?>"<?php echo e($ss); ?>><?php echo e($value); ?></option>
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
							    <button type="submit" id="add-plugin-submit" class="btn btn-default btn-block btn-clean">Submit</button>
							  </center>
							</div>
                            <div class="col-md-4"></div>							
                        </div>
                                              
                    </div>
                </div>  
            </form>				
            </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/plugin.blade.php ENDPATH**/ ?>