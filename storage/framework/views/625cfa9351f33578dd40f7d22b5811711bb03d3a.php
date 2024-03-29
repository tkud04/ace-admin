<?php $__env->startSection('title',"Update Facebook Catalog"); ?>

<?php $__env->startSection('styles'); ?>
  <!-- DataTables CSS -->
  <link href="lib/datatables/css/buttons.bootstrap.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/buttons.dataTables.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" /> 
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : "<?php echo e(env('FACEBOOK_APP_ID')); ?>",
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v12.0'
    });
  };
</script>

 <script>
  let fcaList = [], fbp = localStorage.getItem('ace_fbp');
 $(document).ready(() =>{
 $('.fca-hide').hide();
 
 <?php
 $cid = env('FACEBOOK_APP_ID');
 $sec = env('FACEBOOK_APP_SECRET');
 //$uu = url("facebook-catalog");
 $uu = "https://admin.aceluxurystore.com/facebook-catalog";
  $fbp = "true";
 ?>
 let fbPermRequired = <?php echo e($fbp); ?>;
		if(fbp){
			let ace_fbp = JSON.parse(fbp);
			if(ace_fbp){
		        $('#bup-ftk').val(ace_fbp.access_token);
				fbPermRequired = false;
			}
			else{
				console.log("Invalid token");
			}
		   
		}
		if(fbPermRequired){
			//invoke dialog to get code
			
		
			Swal.fire({
             title: `Your permission is required`,
             imageUrl: "img/facebook.png",
             imageWidth: 64,
             imageHeight: 64,
             imageAlt: `Grant the app catalog permissions`,
             showCloseButton: true,
             html:
             "<h4 class='text-warning'>Facebook <b>requires your permission</b> to make any changes to your Catalog.</h4><p class='text-primary'>Click OK below to redirect to Facebook to grant this app access.</p>"
           }).then((result) => {
               if (result.value) {
                 let cid = "<?php echo e($cid); ?>", ss = "ksslal3wew";
				  
                 //get fb permission
                 console.log("calling fb login.. ",FB);
		         FB.login(function(response) {
                   // handle the response
			      if (response.authResponse) {
                   let ret = response.authResponse, ace_fbp = {
					  access_token: ret.access_token,
					  created_at: (new Date()).toDateString()
				  };
				  
				  localStorage.setItem("ace_fbp",JSON.stringify(ace_fbp));
                  } else {
                    console.log('User cancelled login or did not fully authorize.');
                  }
                 }, {scope: 'catalog_management'});
			     //window.location = `https://www.facebook.com/v10.0/dialog/oauth?client_id=${cid}&redirect_uri=${uu}&state=${ss}&scope=catalog_management`;
                }
              });
		  
		}
 
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
    <script src="lib/datatables/js/datatables-init.js?ver=<?php echo e(rand(99,9999)); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
				<?php echo csrf_field(); ?>

                <div class="block">
                    <div class="header">
                        <h2>Add items to your Facebook Catalog</h2>
                    </div>
                   <div class="content">
				   <div class="row">
				     <div class="col-md-12">
					  <h4>All products</h4>
					 <div class="table-responsive" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" data-idl="3" class="table table-bordered ace-table">
                            <thead>
                                <tr>
                                    <th width="50%">Product</th>
                                    <th width="25%">Status</th>
                                    <th width="25%">
									<div class="btn-group" role="group">
									 <button id="fca-select-all" onclick="FCASelectAllProducts()" class="btn btn-success">Select all</button>
									 <button id="fca-unselect-all" onclick="FCAUnselectAllProducts()" class="btn btn-warning fca-hide">Unselect all</button>
									 </div>
									</th>                                                                                                     
                                </tr>
                            </thead>
                            <tbody>
							   <?php
							   
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
								   if($p['in_catalog'] == "yes")
								   {
									   $statusClass = "success";
									   $pcs = "Added to catalog";
								   }
								   else
								   {
									   $statusClass = "warning";
									   $pcs = "Not in catalog";
								   }
								 
									
							   ?>
                                <tr>
                                    <td>
									<h6><?php echo e($name); ?></h6>
									  
						 
						 <span>
						 <a href="<?php echo e($pu); ?>" target="_blank">
						   <img class="img img-fluid" src="<?php echo e($img); ?>" alt="<?php echo e($sku); ?>" height="40" width="40" style="margin-bottom: 5px;" />
							   
						 </a> (&#8358;<?php echo e(number_format($pd['amount'],2)); ?>)<br>
							 <?php echo e($sku); ?><br> <?php echo $pd['description']; ?>

						 </span><br>
									</td>
									 <td><span class="label label-<?php echo e($statusClass); ?>"><?php echo e(strtoupper($pcs)); ?></span></td>
                                    <td>
									<div>
									  <div class="btn-group" role="group">
									    <button onclick="FCASelectProduct({sku: '<?php echo e($sku); ?>',id: <?php echo e($p['id']); ?>})" id="fca-<?php echo e($p['id']); ?>" data-sku="<?php echo e($sku); ?>" class="btn btn-info fca"><span class="icon-check"></span></button>
									    <button onclick="FCAUnselectProduct({sku: '<?php echo e($sku); ?>',id: <?php echo e($p['id']); ?>})" id="fca-unselect_<?php echo e($p['id']); ?>" data-sku="<?php echo e($sku); ?>" class="btn btn-warning fca-unselect"><span class="icon-check-empty"></span></button>
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
					    
					</div>    
						   
                            <div class="hp-info hp-simple pull-left">
							<form action="<?php echo e(url('facebook-catalog')); ?>" id="fca-form" method="post" enctype="multipart/form-data">
							  <?php echo csrf_field(); ?>

							  <input type="hidden" id="fca-dt" name="dt">
							  <input type="hidden" id="fca-ftk" name="ftk">
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
								 <button onclick="FCA({cid:'<?php echo e($cid); ?>',ss:'<?php echo e($ss); ?>'})" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Submit</button>
								</div>                                
                            </div>
                     
                   </div>  
               </div>				
           </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/fbcatalog.blade.php ENDPATH**/ ?>