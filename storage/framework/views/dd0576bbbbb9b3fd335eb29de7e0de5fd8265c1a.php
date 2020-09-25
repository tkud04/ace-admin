<?php $__env->startSection('title',"Orders"); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
				<?php echo csrf_field(); ?>

                <div class="block">
                    <div class="header">
                        <h2>List of orders in the system</h2>
                    </div>
                    <div class="content">
                       <div id="DataTables_Table_2_wrapper" class="dataTables_wrapper" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                            <thead>
                                <tr>
                                    <th width="20%">Date</th>
                                    <th width="20%">Reference #</th>
                                    <th width="20%">Items</th>                                                                       
                                    <th width="20%">Status</th>                                                                       
                                    <th width="20%">Actions</th>                                                                       
                                </tr>
                            </thead>
                            <tbody>
							  <?php
					  if(count($orders) > 0)
					  {
						 foreach($orders as $o)
						 {
							 $items = $o['items'];
							 $totals = $o['totals'];
							 $statusClass = $o['status'] == "paid" ? "success" : "danger";
							 $uu = "#";
							 
							 $u = [];
							 
							 if($o['user_id'] == "anon")
							 {
								 $u = $o['anon'];
							 }
							 else
							 {
								 $u = $o['user'];
								 $u['name'] = $u['fname']." ".$u['lname'];
							 }
				    ?>
                      <tr>
					   <td><?php echo e($o['date']); ?></td>
					   <td><?php echo e($o['reference']); ?></td>
					    <td>
						<?php
						 foreach($items as $i)
						 {
							 $product = $i['product'];
							 $sku = $product['sku'];
							 $name = $product['name'];
							  $img = $product['imggs'][0];
							 $qty = $i['qty'];
							 $pu = url('edit-product')."?id=".$product['sku'];
							 $tu = url('edit-order')."?r=".$o['reference'];
							 $ttu = url('track')."?o=".$o['reference'];
							$du = url('delete-order')."?o=".$o['reference'];
						 ?>
						 <span>
						 <a href="<?php echo e($pu); ?>" target="_blank">
						   <img class="img img-fluid" src="<?php echo e($img); ?>" alt="<?php echo e($sku); ?>" height="80" width="80" style="margin-bottom: 5px;" />
							   <?php echo e($name); ?>

						 </a> (x<?php echo e($qty); ?>)
						 </span><br>
						 <?php
						 }
						?>
						<b>Total: &#8358;<?php echo e(number_format($o['amount'],2)); ?></b>
					   </td>	  
					   <td>
					      <span class="label label-<?php echo e($statusClass); ?>"><?php echo e(strtoupper($o['status'])); ?></span>
						  
						  <?php if($o['status'] == "unpaid" && count($u) > 0): ?>
							  <br>Contact customer:<br>
							  <em><?php echo e($u['name']); ?></em><br>
							  Phone: <a href="tel:<?php echo e($u['phone']); ?>"><em><?php echo e($u['phone']); ?></em></a><br>
							  Email: <a href="mailto:<?php echo e($u['email']); ?>"><em><?php echo e($u['email']); ?></em></a><br>
						  <?php endif; ?>
					   </td>
					   <td>
					     <a class="btn btn-primary" href="<?php echo e($tu); ?>">View</span>&nbsp;&nbsp;
					     <a class="btn btn-warning" href="<?php echo e($ttu); ?>">Track</span>&nbsp;&nbsp;
					     <a class="btn btn-danger" href="<?php echo e($du); ?>">Delete</span>
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
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/orders.blade.php ENDPATH**/ ?>