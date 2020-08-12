<?php $__env->startSection('title',"Add Orders"); ?>

<?php $__env->startSection('styles'); ?>
  <!-- DataTables CSS -->
  <link href="lib/datatables/css/buttons.bootstrap.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/buttons.dataTables.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" /> 
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script>
 $(document).ready(() =>{
 $('.bao-hide').hide();
 
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
<script>
let categories = [], products = [], orders = [],
   customerTypes = [], users = [], baoCounter = 0, orderCount = 0;
 
 <?php $__currentLoopData = $c; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 	<?php if($cc['status'] == "enabled"): ?>
	  categories.push("<?php echo e($cc['category']); ?>");
	<?php endif; ?>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

 <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 	<?php if($cc['status'] == "enabled"): ?>
	  products.push({
		  sku: "<?php echo e($p['sku']); ?>", 
		  img: "<?php echo e($p['imggs'][0]); ?>", 
		  qty: "<?php echo e($p['qty']); ?>", 
		  amount: "<?php echo e($p['pd']['amount']); ?>", 
		  category: "<?php echo e($p['pd']['category']); ?>", 
		  });
	<?php endif; ?>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

 <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 	<?php if($u['status'] == "enabled"): ?>
	  users.push({
		  id: "<?php echo e($u['id']); ?>", 
		  name: "<?php echo e($u['fname']); ?> <?php echo e($u['lname']); ?>", 
		  email: "<?php echo e($u['email']); ?>" ,
		  state: "<?php echo e(ucwords($u['sd']['state'])); ?>" 
		  });
	<?php endif; ?>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 
 customerTypes = [
  {key:"user",value:"Registered user"},
  {key:"anon",value:"Guest"}
 ];
 
 let ddData = [];
	
	 products.map(p => {
		ddData.push({
		   text: p.sku,
           value: p.sku,
		   qty: p.qty,
           selected: false,
           description: p.sku + " (N" + p.amount + ") | " + p.qty + " pcs left",
           imageSrc: p.img
		});
	 });
</script>
			<div class="col-md-12">
				<input type="hidden" id="tk" value="<?php echo e(csrf_token()); ?>">
                <div class="block">
                    <div class="header">
                        <h2>Add new orders</h2><br>
                        <h4 style="margin:20px; padding: 10px; border: 1px dashed #fff; with: 50%;"><span class="label label-success text-uppercase">Tip:</span> Use the <em>Products</em> widget to add products to your order. It can be used mutliple times.</h4>
                    </div>
                   <div class="content">
				    <form action="<?php echo e(url('new-order')); ?>" id="bao-form" method="post" enctype="multipart/form-data">
					  <?php echo csrf_field(); ?>

					 <div class="table-responsive" role="grid">
					     
                        <table id="bao-table" cellpadding="0" cellspacing="0" width="100%" data-idl="3" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th width="30%">Customer</th>
                                    <th>Products</th>
                                    <th>Notes</th>
                                    <th>Total(&#8358;)</th>
                                    <th>Actions</th>                                                                                                      
                                </tr>
                            </thead>
                            <tbody>
							   							   
                            </tbody>
                        </table>                                        

                    </div><br>
					
					 <div class="hp-info hp-simple pull-left">
					      
							
							  <input type="hidden" id="bao-dt" name="dt">
							 
                                <div class="hp-sm" id="button-box">
								 <button onclick="BAOAddRow(); return false;" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Add new order</button>
							
								 <h3 id="bao-select-order-error" class="label label-danger text-uppercase bao-hide mr-5 mb-5">Please add a new order</h3>
								 <h3 id="bao-select-validation-error" class="label label-danger text-uppercase bao-hide">All fields are required</h3>
								 <br>
								 <button onclick="BAO(); return false;" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Submit</button>
								</div>
								<div class="hp-sm" id="result-box">
								 <h4 id="bao-loading">Adding orders.. <img src="img/loading.gif" class="img img-fluid" alt="Loading" width="50" height="50"></h4><br>
								 <h5>Orders added: <span class="label label-success" id="result-ctr">0</span></h5>
								</div>
                                <div class="hp-sm" id="finish-box">
								 <h4>Processing complete!</h4>
								</div>                                
                       </div>
					  </form>
                   </div>  
               </div>				
           </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/bao.blade.php ENDPATH**/ ?>