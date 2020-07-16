<?php $__env->startSection('title',"Update Product Stock"); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
				<?php echo csrf_field(); ?>

                <div class="block">
                    <div class="header">
                        <h2>Update stock for multiple products</h2>
                    </div>
                   <div class="content">
					 <div class="dataTables_wrapper" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" data-idl="3" class="table table-bordered table-striped sortable">
                            <thead>
                                <tr>
                                    <th width="70%">Product</th>
                                    <th width="20%">Quantity</th>
                                    <th width="10%">
									 <button id="pq-select-all" onclick="pqSelectAllProducts()" class="btn btn-success">Select all</button>
									 <button id="pq-unselect-all" onclick="pqUnselectAllProducts()" class="btn btn-success">Unselect all</button>
									</th>                                                                                                      
                                </tr>
                            </thead>
                            <tbody>
							   <?php
							   $uss = [];
							   
							   foreach($products as $p)
							   {
								 if($p['status'] == "enabled")
								 {
								   $sku = $p['sku'];
								   $pd = $p['pd'];
							       $img = $p['imggs'][0];
							       $qty = $p['qty'];
								   $pu = url('edit-product')."?id=".$sku;
									
							   ?>
                                <tr>
                                    <td>
									<h6><?php echo e($sku); ?></h6>
									  
						 
						 <span>
						 <a href="<?php echo e($pu); ?>" target="_blank">
						   <img class="img img-fluid" src="<?php echo e($img); ?>" alt="<?php echo e($sku); ?>" height="40" width="40" style="margin-bottom: 5px;" />
							   
						 </a> (&#8358;<?php echo e(number_format($pd['amount'],2)); ?>)<br>
							 <?php echo $pd['description']; ?>

						 </span><br>
									</td>
                                    <td><span class="label label-info sink"><?php echo e($qty); ?></span></td>
									<td>
									 <div class="btn-group" role="group">
									 <button onclick="pqSelectProduct({sku: '<?php echo e($sku); ?>'})" id="pq-<?php echo e($sku); ?>" class="btn btn-info p"><span class="icon-check"></span></button>
									 <button onclick="pqUnselectProduct({sku: '<?php echo e($sku); ?>'})" id="pq-unselect_<?php echo e($sku); ?>" class="btn btn-warning pq-unselect"><span class="icon-check-empty"></span></button>
									 </div>
									</td>                                                                     
                                </tr>
                               <?php
							   }
							 }
                               ?>							   
                            </tbody>
                        </table>                                        

                    </div>
						   
						   
                            <div class="hp-info hp-simple pull-left">
							<form action="<?php echo e(url('bup')); ?>" id="bup-form" method="post" enctype="multipart/form-data">
							  <?php echo csrf_field(); ?>

							  <input type="hidden" id="pq-dt" name="dt">
							  <input type="hidden" id="pq-action" name="action">
							</form>
                                <span class="hp-main">Enter quantity:</span>
                                <div class="hp-sm">
								 <input type="number" class="form-control" placeholder="Enter quantity" id="pq-qty" aria-label="Username" aria-describedby="basic-addon1"><br>
								 <h3 id="pq-select-product-error" class="label label-danger text-uppercase">Please select a product</h3>
								 <h3 id="pq-select-qty-error" class="label label-danger text-uppercase">Please enter quantity</h3>
								 <br>
								 <button onclick="updateProducts()" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Submit</button>
								</div>                                
                            </div>
                   </div>  
               </div>				
           </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/bup.blade.php ENDPATH**/ ?>