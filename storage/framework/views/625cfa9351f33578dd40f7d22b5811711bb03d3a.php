<?php $__env->startSection('title',"Update Facebook Catalog"); ?>

<?php $__env->startSection('styles'); ?>
  <!-- DataTables CSS -->
  <link href="lib/datatables/css/buttons.bootstrap.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/buttons.dataTables.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" /> 
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
 <script>
  let fcaList = [];
 $(document).ready(() =>{
 $('.fca-hide').hide();
 
 });
 </script>

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
                        <h2>Update stock and product name for multiple products</h2>
                    </div>
                   <div class="content">
				   <div class="row">
				     <div class="col-md-6">
					  <h4>All products</h4>
					 <div class="table-responsive" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" data-idl="3" class="table table-bordered ace-table">
                            <thead>
                                <tr>
                                    <th width="70%">Product</th>
                                    <th width="20%">Status</th>
                                    <th width="10%">
									<div class="btn-group" role="group">
									 <button id="fca-select-all" onclick="FCASelectAllProducts()" class="btn btn-success">Select all</button>
									 <button id="fca-unselect-all" onclick="FCAUnselectAllProducts()" class="btn btn-warning fca-hide">Unselect all</button>
									 </div>
									</th>                                                                                                     
                                </tr>
                            </thead>
                            <tbody>
							   <?php
							   $cid = env('FACEBOOK_APP_ID');
							   $uss = [];
							   #$products = [];
							   foreach($products as $p)
							   {
								 if($p['status'] == "enabled")
								 {
								   $sku = $p['sku'];
								   $name = $p['name'];
								   $pd = $p['pd'];
							       $img = $p['imggs'][0];
							       $qty = $p['qty'];
								   $pu = url('edit-product')."?id=".$sku;
								   $statusClass = $p['status'] == "enabled" ? "success" : "danger";
									
							   ?>
                                <tr>
                                    <td>
									<h6><?php echo e($sku); ?></h6>
									  
						 
						 <span>
						 <a href="<?php echo e($pu); ?>" target="_blank">
						   <img class="img img-fluid" src="<?php echo e($img); ?>" alt="<?php echo e($sku); ?>" height="40" width="40" style="margin-bottom: 5px;" />
							   
						 </a> (&#8358;<?php echo e(number_format($pd['amount'],2)); ?>)<br>
							 <?php echo e($sku); ?><br> <?php echo $pd['description']; ?>

						 </span><br>
									</td>
									 <td><span class="label label-<?php echo e($statusClass); ?>"><?php echo e(strtoupper($p['status'])); ?></span></td>
                                    <td>
									<div>
									  <div class="btn-group" role="group">
									    <button onclick="FCASelectProduct({sku: '<?php echo e($sku); ?>',id: <?php echo e($p['id']); ?>})" id="fca-<?php echo e($p['id']); ?>" data-sku="<?php echo e($sku); ?>" class="btn btn-info fca"><span class="icon-check"></span></button>
									    <button onclick="FCAUnselectProduct({sku: '<?php echo e($sku); ?>',id: <?php echo e($p['id']); ?>})" id="fca-unselect_<?php echo e($p['id']); ?>" data-sku="<?php echo e($sku); ?>" class="btn btn-warning fca-unselect fca-hide"><span class="icon-check-empty"></span></button>
									  </div>
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
					</div> 
					<div class="col-md-6">
					<h4>Products in your Catalog</h4>
					 <div class="table-responsive" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" data-idl="3" class="table table-bordered ace-table">
                            <thead>
                                <tr>
                                    <th width="70%">Product</th>
                                    <th width="20%">Last updated</th>
                                                                                                                                          
                                </tr>
                            </thead>
                            <tbody>
							   	<?php
                                 if(count($catalogs) > 0)
								 {
									foreach($catalogs as $catalog)
									{
										$p = $products->where('sku',$catalog['sku'])->first();
                                ?>
								 <tr>
								   <td><?php echo e($p['sku']." - ".$p['name']); ?></td>
								   <td><?php echo e($catalog['updated']); ?></td>
								 </tr>
								<?php
                                    }
								 }
                                ?>								
                            </tbody>
                        </table>                                        

                    </div><br>
					</div>    
					</div>    
						   
                            <div class="hp-info hp-simple pull-left">
							<form action="<?php echo e(url('facebook-catalog-add')); ?>" id="fca-form" method="post" enctype="multipart/form-data">
							  <?php echo csrf_field(); ?>

							  <input type="hidden" id="fca-dt" name="dt">
							  <select id="fca-action" name="action">
							    <option value="none">Select action</option>
							    <option value="add">Add to catalog</option>
							    <option value="remove">Remove from catalog</option>
							  </select>
							  </form>
                                <div class="hp-sm">
								 <h3 id="fca-select-product-error" class="label label-danger text-uppercase fca-hide mr-5 mb-5">Please select a product</h3>
								 <h3 id="fca-select-action-error" class="label label-danger text-uppercase fca-hide mr-5 mb-5">Please select an action</h3>
								 <br>
								 <button onclick="FCA({cid:'<?php echo e($cid); ?>'})" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Submit</button>
								</div>                                
                            </div>
                     
                   </div>  
               </div>				
           </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/fbcatalog.blade.php ENDPATH**/ ?>