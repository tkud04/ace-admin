<?php $__env->startSection('title',"Banners"); ?>

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
                                    <th width="20%">Image</th>
                                    <th width="20%">Subtitle</th>
                                    <th width="20%">Title</th>                                                                       
                                    <th width="20%">Actions</th>                                                                       
                                </tr>
                            </thead>
                            <tbody>
							   <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							   <?php
                           	    $imgg = $b['img'];
	                            $subtitle = $b['subtitle'];
	                            $title = $b['title'];
							   ?>
                                <tr>
                                    <td><?php echo e($b['id']); ?></td>
                                    <td><a href="<?php echo e($imgg); ?>" target="_blank"><?php echo e($imgg); ?></a></td>
                                    <td><?php echo e($subtitle); ?></td>
                                    <td><?php echo e($title); ?></td>                                                                     
                                    <td>
									  <?php
									   $uu = url('edit-banner')."?id=".$b['id'];
									   
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
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/banners.blade.php ENDPATH**/ ?>