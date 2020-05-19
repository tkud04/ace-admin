<?php $__env->startSection('title',"Discounts"); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
				<?php echo csrf_field(); ?>

                <div class="block">
                    <div class="header">
                        <h2>List of discounts</h2>
                    </div>
                    <div class="content">
                       <div id="DataTables_Table_2_wrapper" class="dataTables_wrapper" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                            <thead>
                                <tr>
                                    <th width="20%">ID</th>
                                    <th width="20%">Type</th>
                                    <th width="20%">Discount</th>
                                    <th width="20%">Status</th>                                                                       
                                    <th width="20%">Actions</th>                                                                       
                                </tr>
                            </thead>
                            <tbody>
							   <?php $__currentLoopData = $discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							   <?php
							   $status = $d['status'];
							   $ss = ($status == "enabled") ? "success" : "danger";
							   $disc = "";
							   $dtype = "";
							   
							   if($d['discount_type'] == "flat")
							   {
								   $disc = "&#8358;".$d['discount'];
							   }
							   elseif($d['discount_type'] == "percentage")
							   {
								   $disc = $d['discount']."%";
							   }
							   
							   if($d['type'] == "single")
							   {
								   $dtype = strtoupper($d['type'])." - ".$d['sku'];
							   }
							   elseif($d['type'] == "general")
							   {
								   $dtype = strtoupper($d['type']);
							   }
							   ?>
                                <tr>
                                    <td><?php echo e($d['id']); ?></td>
                                    <td><?php echo e($dtype); ?></td>
                                    <td><?php echo $disc; ?></td>
                                    <td><span class="driver-status label label-<?php echo e($ss); ?>"><?php echo e($status); ?></span></td>                                                                     
                                    <td>
									  <?php
									   $uu = url('edit-discount')."?d=".$d['id'];
									   $du = url('delete-discount')."?xf=".$d['id'];
									   
									  ?>
									  <a href="<?php echo e($uu); ?>" class="btn btn-primary">View</button>									  
									  <a href="<?php echo e($du); ?>" class="btn btn-danger">Delete</button>									  
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
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/discounts.blade.php ENDPATH**/ ?>