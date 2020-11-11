<?php $__env->startSection('title',"Edit Courier"); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
			<form method="post" action="<?php echo e(url('courier')); ?>" id="ac-form">
				<?php echo csrf_field(); ?>

				<input type="hidden" name="xf" value="<?php echo e($c['id']); ?>"/>
				
				<div class="block">
                    <div class="header">
                        <h2>Edit courier</h2>
                    </div>
                    <div class="content controls">
					<div class="form-row">
                                <div class="col-md-3">Name:</div>
								<div class="col-md-9">
							      <input type="text" class="form-control" name="name" id="ac-name" placeholder="Courier name e.g Fedex" value="<?php echo e($c['name']); ?>" required/>
								 </div>
								</div>
								<div class="col-md-3">Nickname:</div>
								<div class="col-md-9">
							      <input type="text" class="form-control" name="nickname" id="ac-nickname" placeholder="System nickname e.g fedex" value="<?php echo e($c['nickname']); ?>" required/>
								 </div>
								</div>
								
								<div class="form-row">
                                <div class="col-md-3">Type:</div>
								<div class="col-md-9">
							      <select class="form-control" name="type" id="ac-type" style="margin-bottom: 5px;">
							        <option value="none">Select type</option>
								    <?php
								     $types = [
									     'prepaid' => "Prepaid",
									     'pod' => "Pay on Delivery"
										 ];
										 
								     foreach($types as $key => $value){
										$ss = $c['type'] == $key ? " selected='selected'" : "";
								    ?>
								    <option value="<?php echo e($key); ?>"<?php echo e($ss); ?>><?php echo e($value); ?></option>
								    <?php
								    }
								    ?>
							      </select>
								 </div>
								</div>
								
								<div class="form-row">
                                <div class="col-md-3">Price (&#8358;):</div>
								<div class="col-md-9">
							      <input type="number" class="form-control" name="price" id="ac-price" value="<?php echo e($c['price']); ?>" required/>
								 </div>
								</div>
						

								<div class="form-row">
                                <div class="col-md-3">Coverage:</div>
								<div class="col-md-9">
							      <select class="form-control" name="coverage" id="ac-coverage" style="margin-bottom: 5px;">
							        <option value="none">Select coverage</option>
								    <?php
								     $cvgs = [
									     'lagos' => "Lagos",
									     'sw' => "Southwest states",
									     'others' => "Other states"
										 ];
										 
								     foreach($cvgs as $key => $value){
										$ss = $c['coverage'] == $key ? " selected='selected'" : "";
								    ?>
								    <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
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
							  <span class="text-danger text-bold" id="ac-validation-error">All fields are required</span>
							    <button type="submit" id="ac-submit" class="btn btn-default btn-block btn-clean">Submit</button>
							  </center>
							</div>
                            <div class="col-md-4"></div>							
                        </div>
                                              
                    </div>
                </div>  
            </form>				
            </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/courier.blade.php ENDPATH**/ ?>