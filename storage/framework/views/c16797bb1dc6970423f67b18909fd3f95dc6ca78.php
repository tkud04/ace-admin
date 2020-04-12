<?php $__env->startSection('title',"Trackings"); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
				<?php echo csrf_field(); ?>

				<?php
				$tu = url('new-tracking')."?r=".$r;
				?>
                <div class="block">
                    <div class="header">
                        <h2>Trackings for order #<?php echo e($r); ?></h2><br>
						<a class="btn btn-primary" href="<?php echo e($tu); ?>">Add tracking</a>
                    </div>
                    <div class="content">
                       <div id="DataTables_Table_2_wrapper" class="dataTables_wrapper" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                            <thead>
                                <tr>
                                    <th width="20%">ID</th>
                                    <th width="20%">Date</th>
                                    <th width="20%">Status</th>                                                                       
                                    <th width="20%">Description</th>                                                                                                                                             
                                </tr>
                            </thead>
                            <tbody>
					<?php
					  if(count($trackings) > 0)
					  {
						 foreach($trackings as $t)
						 {
				    ?>
					 <tr>
					   <td><?php echo e($t['id']); ?></td>
					   <td><?php echo e($t['date']); ?></td>
					   <td><?php echo e($t['status']); ?></td>
					   <td><?php echo e($t['description']); ?></td>
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
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/trackings.blade.php ENDPATH**/ ?>