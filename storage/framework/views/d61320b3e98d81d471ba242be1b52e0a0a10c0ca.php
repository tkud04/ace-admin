<?php $__env->startSection('title',"Carts"); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
				<?php echo csrf_field(); ?>

                <div class="block">
                    <div class="header">
                        <h2>List of current non empty carts in the system</h2>
                    </div>
                    <div class="content">
                       <div id="DataTables_Table_2_wrapper" class="dataTables_wrapper" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                            <thead>
                                <tr>                                  
                                    <th width="20%">User</th>
                                    <th width="20%">Items</th>
                                </tr>
                            </thead>
                            <tbody>
							  <?php
							  
					  if(count($ccarts) > 0)
					  {
						 foreach($ccarts as $cc)
						 {
							 $uuser = $cc['user'];
							 $cart = $cc['data'];
							 
							$u = "Guest";
							
							if(count($uuser) > 0)
                            {
                            	$u = $uuser['fname']." ".$uuser['lname'];
                                $u .= "<br> Contact details: ".$uuser['phone']." | ".$uuser['email'];
                           }
				    ?>
                      <tr>
					   
					   <td><?php echo $u; ?></td>
					    <td>
						<?php
						 foreach($cart as $c)
						 {
							 $product = $c['product'];
							 $sku = $product['sku'];
							 $name = $product['name'];
							  $img = $product['imggs'][0];
							 $qty = $c['qty'];
							 $pu = url('edit-product')."?id=".$product['sku'];
						 ?>
						 <span>
						 <a href="<?php echo e($pu); ?>" target="_blank">
						   <img class="img img-fluid" src="<?php echo e($img); ?>" alt="<?php echo e($sku); ?>" height="80" width="80" style="margin-bottom: 5px;" />
							   <?php echo e($sku." - ".$name); ?>

						 </a> (x<?php echo e($qty); ?>)
						 </span><br>
						 <?php
						 }
						?>
						<b>Added on <?php echo e($c['date']); ?></b>
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
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/carts.blade.php ENDPATH**/ ?>