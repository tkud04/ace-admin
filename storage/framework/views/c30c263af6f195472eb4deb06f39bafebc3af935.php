<?php $__env->startSection('title',"Upload Products"); ?>

<?php $__env->startSection('styles'); ?>
  <!-- DataTables CSS -->
  <link href="lib/datatables/css/buttons.bootstrap.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/buttons.dataTables.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" /> 
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script>
 $(document).ready(() =>{
 $('.buup-hide').hide();
 
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
let categories = [], buupCounter = 0;
 
 <?php $__currentLoopData = $c; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 	<?php if($cc['status'] == "enabled"): ?>
	  categories.push("<?php echo e($cc['category']); ?>");
	<?php endif; ?>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</script>
			<div class="col-md-12">
				<?php echo csrf_field(); ?>

                <div class="block">
                    <div class="header">
                        <h2>Update stock for multiple products</h2>
                    </div>
                   <div class="content">
					 <div class="table-responsive" role="grid">
					     
                        <table id="buup-table" cellpadding="0" cellspacing="0" width="100%" data-idl="3" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th width="30%">Description</th>
                                    <th>Price(&#8358;)</th>
                                    <th>Current stock</th>
                                    <th>Category</th>
									<th>Status</th>
                                    <th width="20%">Images</th>
                                    <th>Actions</th>                                                                                                      
                                </tr>
                            </thead>
                            <tbody>
							   							   
                            </tbody>
                        </table>                                        

                    </div><br>
					
					 <div class="hp-info hp-simple pull-left">
					       <button onclick="BUUPAddRow()" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Add new product</button>
							<form action="<?php echo e(url('buup')); ?>" id="buup-form" method="post" enctype="multipart/form-data">
							  <?php echo csrf_field(); ?>

							  <input type="hidden" id="buup-dt" name="dt">
							  </form>
                                <div class="hp-sm">
								 <h3 id="buup-select-product-error" class="label label-danger text-uppercase buup-hide mr-5 mb-5">Please add a new product</h3>
								 <h3 id="buup-select-validation-error" class="label label-danger text-uppercase buup-hide">All fields are required</h3>
								 <br>
								 <button onclick="BUUP()" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Submit</button>
								</div>                                
                            </div>
					
                   </div>  
               </div>				
           </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/buup.blade.php ENDPATH**/ ?>