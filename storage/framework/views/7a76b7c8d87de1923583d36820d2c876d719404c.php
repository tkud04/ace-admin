<?php $__env->startSection('title',"Plugins"); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
				<?php echo csrf_field(); ?>

                <div class="block">
                    <div class="header">
                        <h2>List of plugins installed on the system</h2>
                        <a class="pull-right btn btn-clean" href="<?php echo e(url('add-plugin')); ?>">Add</a>
                    </div>
                    <div class="content">
                       <div id="DataTables_Table_2_wrapper" class="dataTables_wrapper" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                            <thead>
                                <tr>                                  
                                    <th>Name</th>
                                    <th>Code snippet</th>
                                    <th>Status</th>
									
                                    
                                </tr>
                            </thead>
                            <tbody>
							  <?php
							  
					  if(count($plugins) > 0)
					  {
						 foreach($plugins as $p)
						 {
							 $name = $p['name'];
							$value = $p['value'];
							$vu = url('plugin')."?s=".$p['id'];
							$ru = url('remove-plugin')."?s=".$p['id'];
							
							$ss = $p['status'] == "enabled" ? "label-info" : "label-warning";
							 
							
				    ?>
                      <tr>
					   
					   <td><?php echo e($name); ?></td>
					  <td><code><?php echo e($value); ?></code></td>
					  <td>				   
					    <h3 class="label <?php echo e($ss); ?>"><?php echo e(strtoupper($p['status'])); ?></h3>
					  </td>
					   <td>
						<a class="btn btn-default btn-block btn-clean" href="<?php echo e($vu); ?>">View</a>
						<a class="btn btn-default btn-block btn-clean" href="<?php echo e($ru); ?>">Remove</a>
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
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/plugins.blade.php ENDPATH**/ ?>