<?php $__env->startSection('title',"Confirm Payments"); ?>

<?php $__env->startSection('styles'); ?>
  <!-- DataTables CSS -->
  <link href="lib/datatables/css/buttons.bootstrap.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/buttons.dataTables.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" /> 
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <!-- DataTables js -->
       <script src="lib/datatables/js/datatables.min.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="lib/datatables/js/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="lib/datatables/js/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="lib/datatables/js/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="lib/datatables/js/datatables-init.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
				<?php echo csrf_field(); ?>

                <div class="block">
                    <div class="header">
                        <h2>Confirm bank payment for multiple orders</h2>
                    </div>
                   <div class="content">
						  <div class="table-responsive" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" data-idl="3" class="table table-bordered ace-table">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th width="50%">Order</th>
                                    <th width="20%">Type</th>
                                    <th width="20%">Status</th>
                                    <th width="10%">
									<div class="btn-group" role="group">
									 <button id="cp-select-all" onclick="cpSelectAllOrders()" class="btn btn-success">Select all</button>
									 <button id="cp-unselect-all" onclick="cpUnselectAllOrders()" class="btn btn-warning">Unselect all</button>
									 </div>
									</th>                                                                                                      
                                </tr>
                            </thead>
                            <tbody>
							   <?php
							   $uss = [];
							   
							   foreach($orders as $o)
							   {
								 if($o['status'] == "unpaid" || $o['status'] == "pod")
								 {
								   $items = $o['items'];
                                                                   $type = $o['type'];

								    $statusClass = $type == "pod" ? "warning": "danger";
                                                                    $sts = $type == "pod" ? "paid 50%": $o['status'];
									
									
									if($type == "card" || $type == "bank")
							        {
								      $ttype = "Prepaid (".$type.")";
                                      $ttClass = "primary";								
							        } 
							        else if($type == "pod")
							        {
								      $ttype = "Pay on Delivery";
								      $ttClass = "success";
							        } 
									
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
                                                          $du = url('delete-order')."?o=".$o['reference'];
									
							   ?>
                                <tr>
                                   <td>
					    			         <a class="btn btn-danger" href="<?php echo e($du); ?>">Delete</span>
								        </td>
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
									<td><span class="label label-<?php echo e($ttClass); ?> sink"><?php echo e(strtoupper($ttype)); ?></span></td>
                                    <td>
									  <span class="label label-<?php echo e($statusClass); ?> sink"><?php echo e(strtoupper($sts)); ?></span>
									  <br>Contact customer:<br>
							          <em><?php echo e($u['name']); ?></em><br>
							          Phone: <a href="tel:<?php echo e($u['phone']); ?>"><em><?php echo e($u['phone']); ?></em></a><br>
							          Email: <a href="mailto:<?php echo e($u['email']); ?>"><em><?php echo e($u['email']); ?></em></a><br>
									</td>
									<td>
									 <div class="btn-group" role="group">
									 <button onclick="cpSelectOrder({reference: '<?php echo e($o['reference']); ?>'})" id="cp-<?php echo e($o['reference']); ?>" class="btn btn-info cp"><span class="icon-check"></span></button>
									 <button onclick="cpUnselectOrder({reference: '<?php echo e($o['reference']); ?>'})" id="cp-unselect_<?php echo e($o['reference']); ?>" class="btn btn-warning cp-unselect"><span class="icon-check-empty"></span></button>
									 </div>
									</td>     
                                                                                                                                        
                                </tr>
                               <?php
							    }
							   }
                               ?>							   
                            </tbody>
                        </table>                                        

                    </div><br>
					
					<div class="hp-info hp-simple pull-left">
							<form action="<?php echo e(url('bcp')); ?>" id="bcp-form" method="post" enctype="multipart/form-data">
							  <?php echo csrf_field(); ?>

							  <input type="hidden" id="cp-dt" name="dt">
							  <input type="hidden" id="cp-action" name="action">
							</form>
                                <span class="hp-main">Select action:</span>
                                <div class="hp-sm">
								 <select id="cp-btn">
								  <option value="none">Select action</option>
								  <option value="confirm">Confirm payment</option>
								 </select><br>
								 <h3 id="cp-select-order-error" class="label label-danger text-uppercase">Please select an order</h3>
								 <h3 id="cp-select-status-error" class="label label-danger text-uppercase">Please select action</h3>
								 <br>
								 <button onclick="updateBankPayments()" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Submit</button>
								</div>                                
                            </div>
                   </div>  
               </div>				
           </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/bcp.blade.php ENDPATH**/ ?>