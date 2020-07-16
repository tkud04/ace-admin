<?php $__env->startSection('title',"Track Orders"); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
				<?php echo csrf_field(); ?>

                <div class="block">
                    <div class="header">
                        <h2>Update tracking info for multiple orders</h2>
                    </div>
                   <div class="content">
					 <div class="dataTables_wrapper" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" data-idl="3" class="table table-bordered table-striped sortable">
                            <thead>
                                <tr>
                                    <th width="70%">Order</th>
                                    <th width="20%">Status</th>
                                    <th width="10%">
									 <button id="tracking-select-all" onclick="trackingSelectAllOrders()" class="btn btn-success">Select all</button>
									 <button id="tracking-unselect-all" onclick="trackingUnselectAllOrders()" class="btn btn-success">Unselect all</button>
									</th>                                                                                                      
                                </tr>
                            </thead>
                            <tbody>
							   <?php
							   $uss = [];
								 $statuses = ['none' => "Select tracking status",
								              'pickup' => "Scheduled for Pickup",
								              'transit' => "In Transit",
								              'delivered' => "Package delivered",
								              'return' => "Package Returned",
								              'receiver_not_present' => "Receiver Not Present at Delivery Address",
											 ];
							   
							   foreach($orders as $o)
							   {
								 if($o['status'] == "paid")
								 {
								   $items = $o['items'];
								    $statusClass = $o['status'] == "paid" ? "success" : "danger";
								$cs = ($o['current_tracking'] != null) ? $o['current_tracking']['status'] : "none";
								$scs = ($cs == "none") ? "none" : $statuses[$cs];
									
							   ?>
                                <tr>
                                    <td>
									<h6>ACE_<?php echo e($o['reference']); ?></h6>
									  <?php
						 foreach($items as $i)
						 {
							 $product = $i['product'];
							 $sku = $product['sku'];
							  $img = $product['imggs'][0];
							 $qty = $i['qty'];
							 $pu = url('edit-product')."?id=".$product['sku'];
							 $tu = url('edit-order')."?r=".$o['reference'];
							 $ttu = url('track')."?o=".$o['reference'];
							$du = url('delete-order')."?o=".$o['reference'];
						 ?>
						 
						 <span>
						 <a href="<?php echo e($pu); ?>" target="_blank">
						   <img class="img img-fluid" src="<?php echo e($img); ?>" alt="<?php echo e($sku); ?>" height="40" width="40" style="margin-bottom: 5px;" />
							   <?php echo e($sku); ?>

						 </a> (x<?php echo e($qty); ?>)
						 </span><br>
						 <?php
						 }
						?>
									</td>
                                    <td><span class="label label-info sink"><?php echo e(strtoupper($scs)); ?></span></td>
									<td>
									 <div class="btn-group" role="group">
									 <button onclick="trackingSelectOrder({reference: '<?php echo e($o['reference']); ?>'})" id="<?php echo e($o['reference']); ?>" class="btn btn-info r"><span class="icon-check"></span></button>
									 <button onclick="trackingUnselectOrder({reference: '<?php echo e($o['reference']); ?>'})" id="tracking-unselect_<?php echo e($o['reference']); ?>" class="btn btn-warning tracking-unselect"><span class="icon-check-empty"></span></button>
									 </div>
									</td>                                                                     
                                </tr>
                               <?php
							   }
							 }
                               ?>							   
                            </tbody>
                        </table>                                        

                    </div>
						   
						   
                            <div class="hp-info hp-simple pull-left">
							<form action="<?php echo e(url('but')); ?>" id="but-form" method="post" enctype="multipart/form-data">
							  <?php echo csrf_field(); ?>

							  <input type="hidden" id="dt" name="dt">
							  <input type="hidden" id="action" name="action">
							</form>
                                <span class="hp-main">Update tracking:</span>
                                <div class="hp-sm">
								 <select id="update-tracking-btn">
								
								<?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								 <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								 </select><br>
								 <h3 id="tracking-select-order-error" class="label label-danger text-uppercase">Please select an order</h3>
								 <h3 id="tracking-select-status-error" class="label label-danger text-uppercase">Please select tracking status</h3>
								 <br>
								 <button onclick="updateTracking()" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Submit</button>
								</div>                                
                            </div>
                   </div>  
               </div>				
           </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/but.blade.php ENDPATH**/ ?>