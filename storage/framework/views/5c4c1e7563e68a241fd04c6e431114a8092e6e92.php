<?php $__env->startSection('title',"Reports"); ?>

<?php $__env->startSection('scripts'); ?>
<script>
 $(document).ready(() =>{
 $('#reports-loading').hide();
 $('#reports-2-loading').hide();
 });
 </script>

<!-- Morris Charts -->
<link href="<?php echo e(asset('lib/morris-bundle/morris.css')); ?>" rel="stylesheet">
<script src="<?php echo e(asset('lib/morris-bundle/raphael.min.js')); ?>"></script>
<script src="<?php echo e(asset('lib/morris-bundle/morris.js')); ?>"></script>
<script src="<?php echo e(asset('lib/morris-bundle/morris-init.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


			<div class="col-md-12">
				<?php echo csrf_field(); ?>

                <div class="block">
                    <div class="header">
                        <h2>View graphical reports of all transactions</h2>
                    </div>
                    <div class="content">
					<div class="row">
					  <div class="col-md-6">
					   <h2>Total Revenue</h2>
                      <form>
					   <div class="row">
					    <div class="col-md-12">
					    <div class="form-group">
						  <span class="control-label">From</span>
						  <input type="date" id="reports-from" class="form-control">
						</div>
						<div class="form-group">
						  <span class="control-label">To</span>
						  <input type="date" id="reports-to" class="form-control">
						</div>
						<div class="form-group">
						  <span class="control-label">Range</span>
						  <select class="form-control" id="reports-range">
                           <?php
                            $ranges = ['daily' => "Days",'weekly' => "Weeks",'monthly' => "Months"];
							
							foreach($ranges as $k => $v)
							{
                           ?>						   
						   <option value="<?php echo e($k); ?>"><?php echo e($v); ?></option>
						   <?php
                            }
                           ?>
						  </select>
						</div>
						</div>
						<div class="col-md-12">
						  <a href="javascript:void(0)" id="reports-btn" class="btn btn-primary">SUBMIT</a>
						  <h4 id="reports-loading">Fetching report.. <img src="img/loading.gif" class="img img-fluid" alt="Processing" width="50" height="50"></h4>
						</div>
					   </div><br>
					   <div class="row" style="margin-top: 15px;">
					     <div class="col-md-12">
						   <div id="reports-bar">Fill the form above and click Submit to get reports</div>
						 </div>
					   </div>
					  </form>
                    </div> 
					<div class="col-md-6">
					<h2>Best Selling Products</h2>
                      <form>
					   <div class="row">
					    <div class="col-md-12">
					    <div class="form-group">
						  <span class="control-label">From</span>
						  <input type="date" id="reports-2-from" class="form-control">
						</div>
						<div class="form-group">
						  <span class="control-label">To</span>
						  <input type="date" id="reports-2-to" class="form-control">
						</div>
						</div>
						<div class="col-md-12">
						  <a href="javascript:void(0)" id="reports-2-btn" class="btn btn-primary">SUBMIT</a>
						  <h4 id="reports-2-loading">Fetching report.. <img src="img/loading.gif" class="img img-fluid" alt="Processing" width="50" height="50"></h4>
						</div>
					   </div><br>
					   <div class="row" style="margin-top: 15px;">
					     <div class="col-md-12">
						   <div id="reports-2-donut">Fill the form above and click Submit to get reports</div>
						 </div>
					   </div>
					  </form>
                    </div>  
                    </div>  
                    </div>  
                </div>				
           </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/reports.blade.php ENDPATH**/ ?>