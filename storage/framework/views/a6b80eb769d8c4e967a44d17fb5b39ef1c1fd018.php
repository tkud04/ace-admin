<?php $__env->startSection('title',"Couriers"); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
				<?php echo csrf_field(); ?>

                <div class="block">
                    <div class="header">
                        <h2>List of courier services used by the system</h2>
                        <a class="pull-right btn btn-clean" href="<?php echo e(url('add-courier')); ?>">Add</a>
                    </div>
                    <div class="content">
                       <div id="DataTables_Table_2_wrapper" class="dataTables_wrapper" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                            <thead>
                                <tr>                                  
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Coverage</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
							  <?php
							  
					  if(count($couriers) > 0)
					  {
						 foreach($couriers as $c)
						 {
							 $name = $c['name'];
							 $type = ""; $coverage = "";
							 
							 if($c['type'] == "prepaid") $type = "Prepaid";
							 else if($c['type'] == "pod") $type = "Pay on Delivery";
							 
							 if($c['coverage'] == "lagos") $coverage = "Lagos state";
							 else if($c['coverage'] == "sw") $coverage = "Southwest states";
							 else if($c['coverage'] == "others") $coverage = "Other states";
							 
							 $price = $c['price'];
							 $vu = url('courier')."?xf=".$c['id'];
							$ru = url('remove-courier')."?xf=".$c['id'];
							
							$ss = $c['status'] == "enabled" ? "label-info" : "label-warning";
							 
							
				    ?>
                      <tr>
					   
					   <td><?php echo e($name); ?></td>
					   <td><?php echo e($type); ?></td>
					   <td><?php echo e($coverage); ?></td>
					  <td>(&#8358;)<?php echo e(number_format($price)); ?></code></td>
					  <td>				   
					    <h3 class="label <?php echo e($ss); ?>"><?php echo e(strtoupper($c['status'])); ?></h3>
					  </td>
					   <td>
						<a class="btn btn-default btn-clean" href="<?php echo e($vu); ?>">View</a>
						<a class="btn btn-default btn-clean" href="<?php echo e($ru); ?>">Remove</a>
                       </td>
					
					 </tr>
					<?php
						 }  
					  }
                    ?>				               
                            </tbody>
                        </table>                                        

                    </div>
                </div>  
            </div>				
           </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/couriers.blade.php ENDPATH**/ ?>