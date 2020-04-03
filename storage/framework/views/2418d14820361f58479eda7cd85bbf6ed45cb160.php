<?php $__env->startSection('title',"Ads"); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
				<?php echo csrf_field(); ?>

                <div class="block">
                    <div class="header">
                        <h2>List of ads</h2>
                    </div>
                    <div class="content">
                       <div id="DataTables_Table_2_wrapper" class="dataTables_wrapper" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                            <thead>
                                <tr>
                                    <th width="20%">ID</th>
                                    <th width="20%">Ad</th>
                                    <th width="20%">Type</th>
                                    <th width="20%">Status</th>                                                                       
                                    <th width="20%">Actions</th>                                                                       
                                </tr>
                            </thead>
                            <tbody>
							   <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							   <?php
							   $status = $a['status'];
							   $imgg = $a['img'];
							   $ss = ($status == "enabled") ? "success" : "danger";
							   ?>
                                <tr>
                                    <td><?php echo e($a['id']); ?></td>
                                    <td><a href="<?php echo e($imgg); ?>" target="_blank"><?php echo e($imgg); ?></a></td>
                                    <td><?php echo e($a['type']); ?></td>
                                    <td><span class="driver-status label label-<?php echo e($ss); ?>"><?php echo e($status); ?></span></td>                                                                     
                                    <td>
									  <?php
									   $uu = url('edit-ad')."?id=".$a['id'];
									   
									  ?>
									  <a href="<?php echo e($uu); ?>" class="btn btn-primary">View</button>									  
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
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/ads.blade.php ENDPATH**/ ?>