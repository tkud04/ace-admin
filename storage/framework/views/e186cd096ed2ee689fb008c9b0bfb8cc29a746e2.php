<?php $__env->startSection('title',$product['sku']); ?>

<?php $__env->startSection('content'); ?>
            <div class="col-md-2">
                
                <div class="block block-drop-shadow">
				  <div class="head np" style="background: url('img/example/user_bg.jpg') top center no-repeat;">
                    <div class="user bg-default bg-light-rtl">
                        <div class="info">                                                                                
                            <a href="#" class="informer informer-three">
                                <span><?php echo e($driver['fname']); ?></span>
									<?php echo e($driver['lname']); ?>

                            </a>                            
                            <a href="#" class="informer informer-four">
                                <span>Driver</span>
                                Role
                            </a>                                                        
                            <img src="img/icon.png" class="img-circle img-thumbnail"/>
                        </div>
                    </div>
				   </div>
                    <div class="content list-group list-group-icons">
                        <a href="<?php echo e(url('delete-driver')); ?>" class="list-group-item"><span class="icon-off"></span>Suspend driver<i class="icon-angle-right pull-right"></i></a>
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
                        <div class="head-subtitle">Total amount generated from revenue </div>                        
                        <div class="head-panel tac" style="line-height: 0px;">
                            <div class="knob">
                                <input type="text" data-fgColor="#3F97FE" data-min="0" data-max="1024" data-width="100" data-height="100" value="0" data-readOnly="true"/>
                            </div>                              
                        </div>
                        <div class="head-panel nm">
                            <div class="hp-info hp-simple pull-left hp-inline">
                                <span class="hp-main">Total profit today</span>
                                <span class="hp-sm">Amount: &#8358;0 </span>
                            </div>                 
                            <div class="hp-info hp-simple pull-left hp-inline">
                                <span class="hp-main">Total profit this month</span>
                                 <span class="hp-sm">Amount: &#8358;0 </span>
                            </div>                 
                        </div>                        
                    </div>                    
                    
                </div>                
                
            </div>
            
            <div class="col-md-5">
                <?php
				$ed = url('edit-driver')."?id=".$driver['id'];
				$name = $driver['fname']." ".$driver['lname'];
				$email = $driver['email'];
				$phone = $driver['phone'];
				$status = $driver['status'];
				$created_at = $driver['date'];
				$ss = ($status == "enabled") ? "success" : "danger";
				?>
                <div class="block">
                    <div class="head bg-dot20">
                        
                        <h2>Personal Information</h2>
                        <div class="pull-right">
                            <ul class="buttons">
                                <li><a href="<?php echo e($ed); ?>"><span class="icon-pencil"></span></a></li>                                
                            </ul>
                        </div>                        
                        <div class="head-subtitle">Personal information about this driver</div>                                         
                        <div class="content">
						 <div class="row">
						   <div class="col-md-6">
                            <dl class="driver-dl">
						      <dt>Full Name</dt>
						      <dd><?php echo e($name); ?></dd>
						      <dt>Phone number</dt>
						      <dd><?php echo e($phone); ?></dd>
						    </dl>
                           </div>
						   <div class="col-md-6">
                            <dl class="driver-dl">
						      <dt>Email address</dt>
						      <dd><?php echo e($email); ?></dd>
						      <dt>Status</dt>
								<dd><span class="driver-status label label-<?php echo e($ss); ?>"><?php echo e($status); ?></span></dd>
						    </dl>
                           </div>						 
						 </div>
                        </div>
                    </div>                        
                                            
                </div>
                
                <div class="block block-drop-shadow">
                    
                    <div class="header">
                        <h2>Earnings per month (as at <?php echo e(date("F Y")); ?>)</h2>
                    </div>
                    
                    <div class="content">
                        <div class="chart" id="chart_user_1" style="height: 200px;"></div>
                    </div>
                    
                </div>
                
            </div>            
            
            <div class="col-md-5">
                
                <div class="block">
                    <div class="head bg-dot20">
                        <h2>Activity</h2>
                        <div class="pull-right">
                            <ul class="buttons">
                                <li><a href="#"><span class="icon-cogs"></span></a></li>
                            </ul>
                        </div>                                                
                    </div>
                    <div class="timeline">                       
                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <span class="icon-ok"></span>
                            </div>
                            <div class="timeline-info">
                                <div class="timeline-info-content">
                                    <p>John Doe omplete this task list:</p>
                                    <p class="text-muted">Account was created.</p>
                                </div>
                                <div class="timeline-info-date"><?php echo e($created_at); ?></div>
                            </div>
                        </div>                            
                   
                    </div>
                    <div class="footer bg-dot20 tac">
                        <a href="#">Load more...</a>
                    </div>
                </div>
                
            </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/product.blade.php ENDPATH**/ ?>