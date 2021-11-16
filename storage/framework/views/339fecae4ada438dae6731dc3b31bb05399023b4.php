<?php $__env->startSection('title',"Update Product Stock"); ?>

<?php $__env->startSection('styles'); ?>
  <!-- DataTables CSS -->
  <link href="lib/datatables/css/buttons.bootstrap.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/buttons.dataTables.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" /> 
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
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
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
 <script>
 let  fbp = localStorage.getItem('ace_fbp'), uu = "https://admin.aceluxurystore.com/bup";
 $(document).ready(() =>{
 $('.bup-hide').hide();
 
 <?php
 $cid = env('FACEBOOK_APP_ID');
 $sec = env('FACEBOOK_APP_SECRET');
 $fbp = "true";
 
 if($code != ""){
	 $fbp = "false";
 ?>
  getFBToken({code: '<?php echo e($code); ?>',cid: '<?php echo e($cid); ?>',edf: '<?php echo e($sec); ?>',redirect_uri: uu});
 <?php
 }
 ?>
 
 //get fb permission
		FB.login(function(response) {
             // handle the response
			 console.log("response: ", response);
            }, {scope: 'catalog_management'});
		
			/**
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
			     window.location = `https://www.facebook.com/v10.0/dialog/oauth?client_id=${cid}&redirect_uri=${uu}&state=${ss}&scope=catalog_management`;
                }
              });
		  
		}
		**/
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
					 <div class="table-responsive" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" data-idl="3" class="table table-bordered ace-table">
                            <thead>
                                <tr>
                                    <th width="70%">Product</th>
                                    <th width="20%">Details</th>
                                                                                                                                          
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
								   $name = $p['name'];
								   $pd = $p['pd'];
							       $img = $p['imggs'][0];
							       $qty = $p['qty'];
								   $pu = url('edit-product')."?id=".$sku;
									
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
                                    <td>
									<div id="bup-<?php echo e($sku); ?>-side1">
									  <span class="label label-info sink"><?php echo e($qty); ?></span>
									  <div class="btn-group" role="group">
									    <button onclick="BUPEditStock({sku: '<?php echo e($sku); ?>',qty: '<?php echo e($qty); ?>',origName: '<?php echo e($name); ?>'})" class="btn btn-warning p">Edit</button>
									  </div>
									</div>
									<div id="bup-<?php echo e($sku); ?>-side2" class="bup-hide">
									  <input type="text" class="form-control" onchange="BUPSaveEdit('name',{sku: '<?php echo e($sku); ?>',value: this.value})" onload="BUPSaveEdit('name',{sku: '<?php echo e($sku); ?>',value: this.value})" placeholder="Name" value="<?php echo e($name); ?>">
									  <input type="number" class="form-control" onchange="BUPSaveEdit('qty',{sku: '<?php echo e($sku); ?>',value: this.value})" placeholder="New stock">
									  <div class="btn-group" role="group">
									   <button onclick="BUPCancelEditStock({sku: '<?php echo e($sku); ?>'})" class="btn btn-warning p">Cancel</button>
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
						   
						   
                            <div class="hp-info hp-simple pull-left">
							<form action="<?php echo e(url('bup')); ?>" id="bup-form" method="post" enctype="multipart/form-data">
							  <?php echo csrf_field(); ?>

							  <input type="hidden" id="bup-dt" name="dt">
							  <input type="hidden" id="bup-ftk" name="ftk">
							  </form>
                                <div class="hp-sm">
								 <h3 id="bup-select-product-error" class="label label-danger text-uppercase bup-hide mr-5 mb-5">Please select a product</h3>
								 <h3 id="bup-select-qty-error" class="label label-danger text-uppercase bup-hide">Some required details are missing</h3>
								 <br>
								 <button onclick="BUP()" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Submit</button>
								</div>                                
                            </div>
                   </div>  
               </div>				
           </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/bup.blade.php ENDPATH**/ ?>