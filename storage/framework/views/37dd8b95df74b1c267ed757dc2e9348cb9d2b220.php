<?php $__env->startSection('title',"Edit Order"); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
			<form method="post" action="<?php echo e(url('edit-order')); ?>" enctype="multipart/form-data">
				<?php echo csrf_field(); ?>

				<input type="hidden" name="xf" value="<?php echo e($xf); ?>">
				<?php
                           	   $items = $o['items'];
							 $totals = $o['totals'];
							 $statusClass = $o['status'] == "paid" ? "success" : "danger";
							 $uu = "#";
							 $u = $o['user_id'] == "anon" ? $o['anon'] : $o['user'];
							 $em = $u['email'];
							   ?>
							   <input type="hidden" name="fxx" value="<?php echo e($em); ?>">
							   
                <div class="block">
                    <div class="header">
                        <h2>Edit order information</h2>
                    </div>
                    <div class="content controls">
					     <div class="form-row">
                            <div class="col-md-3">Reference number</div>
                           <div class="col-md-9">
							  <input type="text" class="form-control" value="<?php echo e($o['reference']); ?>" readonly>
						   </div>
                        </div><br>
						<div class="form-row">
                            <div class="col-md-3">Payment method</div>
                           <div class="col-md-9">
							  <input type="text" class="form-control" value="<?php echo e($o['type']); ?>" readonly>
						   </div>
                        </div><br>
						<div class="form-row">
                            <div class="col-md-3">Customer email</div>
                           <div class="col-md-9">
						    <!-- <p class="form-control-plaintext"><b>NOTE</b>: Changing the email address will send another email to the customer.</p>-->
							  <input type="text" name="email" id="edit-order-email" class="form-control" value="<?php echo e($em); ?>">
						   </div>
                        </div><br>
						<div class="form-row">
                            <div class="col-md-3">Items</div>
                           <div class="col-md-9">
							    <?php
						 foreach($items as $i)
						 {
							 $product = $i['product'];
							 $sku = $product['sku'];
							 $name = $product['name'];
							   $img = $product['imggs'][0];
							 $pd = $product['pd'];
							 $qty = $i['qty'];
							 $pu = url('edit-product')."?id=".$product['sku'];
							 $tu = url('edit-order')."?r=".$o['reference'];
						 ?>
						 <span>
						 <a href="<?php echo e($pu); ?>" target="_blank">
						   <img class="img img-fluid" src="<?php echo e($img); ?>" alt="<?php echo e($sku); ?>" height="50" width="50" style="margin-bottom: 5px;" />
							   <?php echo e($name); ?> - &#8358;<?php echo e(number_format($pd['amount'],2)); ?>

						 </a> (x<?php echo e($qty); ?>)
						  </span><br>
						 <?php
						 }
						?>
							 
						   </div>
                        </div><br>
						<div class="form-row">
                            <div class="col-md-3">Total</div>
                           <div class="col-md-9">
							  <input type="text" class="form-control" value="&#8358;<?php echo e(number_format($o['amount'],2)); ?>">
						   </div>
                        </div><br>
					   
                       
                       
						<div class="form-row">
                            <div class="col-md-3">Status:</div>
                           <div class="col-md-9">
							  <select class="form-control" name="status">
							    <option value="none">Select status</option>
								<?php
								 $statuses = ['unpaid' => "Unpaid",'paid' => "Paid"];
								
								foreach($statuses as $key=> $value){
									$ss = $key == $o['status'] ? "selected='selected'" : "";
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
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/edit-order.blade.php ENDPATH**/ ?>