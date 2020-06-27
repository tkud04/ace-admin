<?php $__env->startSection('title',"Dashboard"); ?>

<?php $__env->startSection('content'); ?>
            <div class="col-md-2">
                
                <div class="block block-drop-shadow">
                    <div class="user bg-default bg-light-rtl">
                        <div class="info">                                                                                
                            <a href="#" class="informer informer-three">
                                <span><?php echo e($user->fname); ?></span>
									<?php echo e($user->lname); ?>

                            </a>                            
                            <a href="#" class="informer informer-four">
                                <span><?php echo e(strtoupper($user->role)); ?></span>
                                Role
                            </a>                                                        
                            <img src="img/icon.png" class="img-circle img-thumbnail"/>
                        </div>
                    </div>
                    <div class="content list-group list-group-icons">
                        <a href="<?php echo e(url('logout')); ?>" class="list-group-item"><span class="icon-off"></span>Logout<i class="icon-angle-right pull-right"></i></a>
                    </div>
                </div> 
                
               
                <div class="block block-drop-shadow">                    
                    <div class="head bg-dot20">
                        <h2>Total profit (&#8358;)</h2>
                        <div class="side pull-right">               
                            <ul class="buttons">                                
                                <li><a href="#"><span class="icon-cogs"></span></a></li>
                            </ul>
                        </div>
                        <div class="head-subtitle">Total amount generated from sales </div>                        
                        <div class="head-panel tac" style="line-height: 0px;">
                                                    
                        </div>
                        <div class="head-panel nm">
                            <div class="hp-info hp-simple pull-left hp-inline">
                                <span class="hp-main">Total profit</span>
                                <span class="hp-sm">Amount: &#8358;<?php echo e(number_format($profits['total'],2)); ?> </span>
                            </div>   
							<div class="hp-info hp-simple pull-left hp-inline">
                                <span class="hp-main">Total profit today</span>
                                <span class="hp-sm">Amount: &#8358;<?php echo e(number_format($profits['today'],2)); ?> </span>
                            </div>                 
                            <div class="hp-info hp-simple pull-left hp-inline">
                                <span class="hp-main">Total profit this month</span>
                                 <span class="hp-sm">Amount: &#8358;<?php echo e(number_format($profits['month'],2)); ?> </span>
                            </div>                 
                        </div>                        
                    </div>                    
                    
                </div>                
                
            </div>
            
            <div class="col-md-5">
               <div class="block block-drop-shadow">                    
                    <div class="head bg-dot20">
                        <h2>Total orders</h2>
                        <div class="side pull-right">               
                            <ul class="buttons">                                
                                <li><a href="#"><span class="icon-cogs"></span></a></li>
                            </ul>
                        </div>
                        <div class="head-subtitle">Total orders on Ace Luxury Stores</div>                        
                        <div class="head-panel nm tac" style="line-height: 0px;">
                            <div class="knob">
                                <input type="text" data-fgColor="#3F97FE" data-min="0" data-max="100" data-width="100" data-height="100" value="<?php echo e($stats['o_total']); ?>" data-readOnly="true"/>
                            </div>                              
                        </div>
                        <div class="head-panel nm">
                            <div class="hp-info hp-simple pull-left">
                                <span class="hp-main">Today's orders</span>
                                <span class="hp-sm"><?php echo e($stats['o_today']); ?></span>                                
                            </div>
                            <div class="hp-info hp-simple pull-right">
                                <span class="hp-main">Total orders this month</span>
                                <span class="hp-sm"><?php echo e($stats['o_month']); ?></span>                                
                            </div>                            
                        </div>
						<div class="head-panel nm" style="padding-top: 5px">
                            <div class="hp-info hp-simple pull-left">
                                <span class="hp-main">Total paid orders</span>
                                <span class="hp-sm"><?php echo e($stats['o_paid']); ?></span>                                
                            </div>
                            <div class="hp-info hp-simple pull-right">
                                <span class="hp-main">Total unpaid orders</span>
                                <span class="hp-sm"><?php echo e($stats['o_unpaid']); ?></span>                                
                            </div>                            
                        </div>                        
                    </div>                    
                    
                </div>    				

               <div class="block block-drop-shadow">                    
                        <div class="head bg-dot20">
                        <h2>Track orders</h2>
                        
                        <div class="head-subtitle">Update tracking info for multiple orders</div>                        
                        
                        <div class="head-panel nm">
						   
						   <div class="dataTables_wrapper" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" data-idl="3" class="table table-bordered table-striped sortable">
                            <thead>
                                <tr>
                                    <th width="70%">Order</th>
                                    <th width="20%">Status</th>
                                    <th width="10%">
									 <button id="tracking-select-all" onclick="trackingSelectAllOrders()" class="btn btn-success">Select all</button>
									 <button id="tracking-unselect-all" onclick="trackingUnselectAllOrders()" class="btn btn-success">Unselect all</button>
									</th>                                                                                                      
                                </tr>
                            </thead>
                            <tbody>
							   <?php
							   $uss = [];
							   
							   foreach($orders as $o)
							   {
								   $items = $o['items'];
								    $statusClass = $o['status'] == "paid" ? "success" : "danger";
									
							   ?>
                                <tr>
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
                                    <td><span class="label label-<?php echo e($statusClass); ?>"><?php echo e(strtoupper($o['status'])); ?></span></td>
									<td>
									 <button onclick="trackingSelectOrder({reference: '<?php echo e($o['reference']); ?>'})" id="<?php echo e($o['reference']); ?>" class="btn btn-info r">Select</button>
									</td>                                                                     
                                </tr>
                               <?php
							   }
                               ?>							   
                            </tbody>
                        </table>                                        

                    </div>
						   
						   
                            <div class="hp-info hp-simple pull-left">
							<form action="<?php echo e(url('but')); ?>" id="but-form" method="post" enctype="multipart/form-data">
							  <?php echo csrf_field(); ?>

							</form>
                                <span class="hp-main">Update tracking:</span>
                                <div class="hp-sm">
								 <select id="update-tracking-btn">
								   <?php
								 $statuses = ['none' => "Select tracking status",
								              'pickup' => "Scheduled for Pickup",
								              'transit' => "In Transit",
								              'delivered' => "Package delivered",
								              'return' => "Package Returned",
								              'receiver_not_present' => "Receiver Not Present at Delivery Address",
											 ];
								?>
								<?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								 <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								 </select><br>
								 <button onclick="updateTracking()" class="btn btn-default btn-block btn-clean">Submit</button>
								</div>                                
                            </div>
                                               
                        </div>                        
                    </div>                    
                                       
                    
                </div>   				


            </div> 
			<div class="col-md-5">
               <div class="block block-drop-shadow">                    
                        <div class="head bg-dot20">
                        <h2>Total products</h2>
                        <div class="side pull-right">               
                            <ul class="buttons">                                
                                <li><a href="#"><span class="icon-cogs"></span></a></li>
                            </ul>
                        </div>
                        <div class="head-subtitle">Total products in store</div>                        
                        <div class="head-panel nm tac" style="line-height: 0px;">
                            <div class="knob">
                                <input type="text" data-fgColor="#3F97FE" data-min="0" data-max="100" data-width="100" data-height="100" value="<?php echo e($stats['total']); ?>" data-readOnly="true"/>
                            </div>                              
                        </div>
                        <div class="head-panel nm">
                            <div class="hp-info hp-simple pull-left">
                                <span class="hp-main">Enabled products</span>
                                <span class="hp-sm"><?php echo e($stats['enabled']); ?></span>                                
                            </div>
                            <div class="hp-info hp-simple pull-right">
                                <span class="hp-main">Disabled products</span>
                                <span class="hp-sm"><?php echo e($stats['disabled']); ?></span>                                
                            </div>                            
                        </div>                        
                    </div>                    
                                       
                    
                </div>
		</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/index.blade.php ENDPATH**/ ?>