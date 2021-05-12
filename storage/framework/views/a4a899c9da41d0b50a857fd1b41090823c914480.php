<?php $__env->startSection('title',"Order Reviews"); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
				<?php echo csrf_field(); ?>

                <div class="block">
                    <div class="header">
                        <h2>List of order reviews</h2>
                    </div>
                    <div class="content">
                       <div id="DataTables_Table_2_wrapper" class="dataTables_wrapper" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                            <thead>
                                <tr>
                                    <th width="20%">ID</th>
                                    <th width="20%">Order</th>
                                    <th width="20%">Review</th>                                                                       
                                    <th width="20%">Status</th>                                                                       
                                    <th width="20%">Actions</th>                                                                       
                                </tr>
                            </thead>
                            <tbody>
							   <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							   <?php
                           	   $ref = $r['reference'];
                           	  
								if($r['status'] == "pending" || $r['status'] == "disabled")
								{
									$ss =  "Enable";
									$sss = "enabled";
									$ssc = "warning";
								}
								else{
									$ss =  "Disable";
									$sss = "disabled";
									$ssc = "success";
								}
	                            $pu = url('update-order-review')."?xf=".$ref."&status=".$sss;
								
							   ?>
                                <tr>
                                    <td><?php echo e($r['id']); ?></td>
                                    <td><?php echo e($ref); ?></td>
                                    <td>
									  <b>Came as advertised</b>: <?php echo e($r['caa']); ?><br>
									  <b>Delivered on time</b>: <?php echo e($r['daa']); ?><br>
									  <b>Comment</b>: <?php echo e($r['comment']); ?><br>
									</td>
                                     <td><span class="driver-status label label-<?php echo e($ssc); ?>"><?php echo e($r['status']); ?></span></td>                                                                      
                                    <td>
									  <a href="<?php echo e($pu); ?>" class="btn btn-primary"><?php echo e($ss); ?></button>									  
									</td>                                                                     
                                </tr>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                       
                            </tbody>
                        </table>                                        

                    </div>
                </div>  
            </div>				
           </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/order-reviews.blade.php ENDPATH**/ ?>