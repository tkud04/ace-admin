<?php $__env->startSection('title',"Settings"); ?>

<?php $__env->startSection('content'); ?>
   <?php
								 $statuses = ['none' => "Select tracking status",
								              'pickup' => "Scheduled for Pickup",
								              'transit' => "In Transit",
								              'delivered' => "Package delivered",
								              'return' => "Package Returned",
								              'receiver_not_present' => "Receiver Not Present at Delivery Address",
											 ];
								?>
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
                
               
                
            </div>
            
            <div class="col-md-5">
               
                <div class="block block-drop-shadow">                    
                        <div class="head bg-dot20">
                        <h2>SMTP Senders</h2>
                        
                        <div class="head-subtitle">SMTP details used by the system to send emails</div>                        
                        
                        <div class="head-panel nm">
						<br>
						  <?php
						   $sendersCount = count($senders);
						   
						  if($sendersCount < 1)
						   {
						  ?>	  
						  <h4>No senders added yet.</h4>
						  <a href="<?php echo e(url('add-sender')); ?>" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Add one now</a> 
					      <?php
						   }
						  else
						  {
						    $ct = "sender";
						    
						   
						   if($sendersCount > 1)
						   {
							   $ct = "senders";
							
						   }
						  ?>
							<h4><?php echo e($sendersCount); ?> <?php echo e($ct); ?> added.</h4>
							<?php if(count($sender) > 0): ?> 
							<h5>Current Sender: <?php echo e($sender['sn']); ?> (<?php echo e($sender['se']); ?>).</h5>
							<h6>Last updated: <?php echo e($settings['smtp']['updated']); ?> </h6>
							<?php endif; ?>
                            <a href="<?php echo e(url('senders')); ?>" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">View <?php echo e($ct); ?></a> 
						  <?php						
						  }
                          ?>               
                        </div>                        
                    </div>                    
                                       
                    
                </div> 
				
				<div class="block block-drop-shadow">                    
                        <div class="head bg-dot20">
                        <h2>Discounts</h2>
                        
                        <div class="head-subtitle">The discounts used by the system</div>                        
                        
                        <div class="head-panel nm">
						<br>
						  <?php
						  $nud = $settings['nud']['value'];
						
						  ?>	  
						  <div id="settings-discount-side1">
						  
							<h4>New user signup: &#8358;<span id="settings-nud"><?php echo e(number_format($nud,2)); ?></span></h4>
                            <a href="javascript:void(0)" id="settings-discount-btn" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Edit</a> 
						 </div>
						 <div id = "settings-discount-side2">
						   <form id="settings-discount-form">
						   	<input type="hidden" id="tk-discount" value="<?php echo e(csrf_token()); ?>">
						    <div class="form-group">
							  <span class="control-label">New user signup discount (&#8358;)</span>
							  <input type="number" class="form-control" id="settings-discount-nud" placeholder="Enter amount" value="<?php echo e($nud); ?>" required>
							   <span class="label label-danger" id="settings-discount-nud-error">A value of at least 1 is required</span>
							</div>
							
						    <button type="submit" id="settings-discount-submit" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Submit</button>
						    <h4 id="settings-discount-loading">Updating discount.. <img src="img/loading.gif" class="img img-fluid" alt="Loading" width="50" height="50"></h4><br>
						   </form>
                        </div>                        
                    </div>                    
                                       
                    
                </div> 
                </div>
				
				<div class="block block-drop-shadow">                    
                        <div class="head bg-dot20">
                        <h2>Delivery fees</h2>
                        
                        <div class="head-subtitle">Current delivery fees used by the system</div>                        
                        
                        <div class="head-panel nm">
						<br>
						  <?php
						  $delivery1 = $settings['d1']['value'];
						  $delivery2 = $settings['d2']['value'];
						
						  ?>	  
						  <div id="settings-delivery-side1">
						  
							<h4>Southwest states (Lagos, Ondo, Ekiti, Osun, Oyo, Ogun): &#8358;<span id="settings-d1"><?php echo e(number_format($delivery1,2)); ?></span></h4>
							<h4>Other states: &#8358;<span id="settings-d2"><?php echo e(number_format($delivery2,2)); ?></span></h4>
                            <a href="javascript:void(0)" id="settings-delivery-btn" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Edit</a> 
						 </div>
						 <div id = "settings-delivery-side2">
						   <form id="settings-delivery-form">
						   	<input type="hidden" id="tk" value="<?php echo e(csrf_token()); ?>">
						    <div class="form-group">
							  <span class="control-label">Fee for Southwest states</span>
							  <input type="number" class="form-control" id="settings-delivery-d1" placeholder="Lagos, Ondo, Ekiti, Osun, Oyo, Ogun" value="<?php echo e($delivery1); ?>" required>
							</div>
							<div class="form-group">
							  <span class="control-label">Fee for other states</span>
							  <input type="number" class="form-control" id="settings-delivery-d2" placeholder="Other states" value="<?php echo e($delivery2); ?>" required>
							</div>
						    <button type="submit" id="settings-delivery-submit" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Submit</button>
						    <h4 id="settings-delivery-loading">Updating delivery fees.. <img src="img/loading.gif" class="img img-fluid" alt="Loading" width="50" height="50"></h4><br>
						   </form>
                        </div>                        
                    </div>                    
                                       
                    
                </div> 
                </div>
				
				
				

            </div> 
			<div class="col-md-5">
         
				
				
				<div class="block block-drop-shadow">                    
                    <div class="head bg-dot20">
                        <h2>Bank Account</h2>
                        
                        <div class="head-subtitle">Update payment info for bank payments</div>                        
                        
                        <div class="head-panel nm">
						<br>
                         <div id="settings-bank-side1">
						   <?php
						      $bank = $settings['bank'];
							  
							  if(count($bank) < 1)
							  {
								  $bank = [
								    'bname' => "not filled",
								    'acname' => "not filled",
								    'acnum' => "not filled",
								  ];
							  }
						   ?>
							<h4>Bank name: <span id="settings-bname"><?php echo e($bank['bname']); ?></span></h4>
							<h4>Account name: <span id="settings-acname"><?php echo e($bank['acname']); ?></span></h4>
							<h4>Account number: <span id="settings-acnum"><?php echo e($bank['acnum']); ?></span></h4>
							<a href="javascript:void(0)" id="settings-bank-btn" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Edit</a> 
						 </div>
						 <div id = "settings-bank-side2">
						   <form id="settings-bank-form">
						   	<input type="hidden" id="tk-bank" value="<?php echo e(csrf_token()); ?>">
						    <div class="form-group">
							  <span class="control-label">Select bank</span>
							  <select class="form-control" id="settings-bank-bname">
							    <option value="none">Select bank</option>
							<?php
							 foreach($banks as $key => $value)
							 {
								 $ss = $key == $banks[$bank['bname']] ? "selected='selected'" : "";
							?>
							 <option value="<?php echo e($key); ?>" <?php echo e($ss); ?>><?php echo e($value); ?></option>
							<?php
							 }
							?>
							  </select>
							</div>
							<div class="form-group">
							  <span class="control-label">Account name</span>
							  <input type="text" class="form-control" id="settings-bank-acname" placeholder="Account name" value="<?php echo e($bank['acname']); ?>">
							</div>
							<div class="form-group">
							  <span class="control-label">Account number</span>
							  <input type="number" class="form-control" id="settings-bank-acnum" placeholder="Account number" value="<?php echo e($bank['acnum']); ?>">
							</div>
						    <button type="submit" id="settings-bank-submit" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Submit</button>
						    <h4 id="settings-bank-loading">Updating bank account.. <img src="img/loading.gif" class="img img-fluid" alt="Loading" width="50" height="50"></h4><br>
						   </form>
                        </div>   
                        </div>                      
                    </div>                    
                                       
                    
                </div>
				
				<?php
				  $pc = count($plugins);
				?>
				<div class="block block-drop-shadow">                    
                   <div class="head bg-dot20">
                      <h2>Plugins</h2>  
                      <div class="head-subtitle">Install your plugins by adding their code snippets here</div>                        
                        
                      <div class="head-panel nm">
						<br>
						  	  
						  <h4>Current plugins installed: <b><?php echo e($pc); ?></b></h4>
						   <?php if($pc < 1): ?>
							   <a href="<?php echo e(url('add-plugin')); ?>" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Add one now</a>
						   <?php else: ?>
						   <div>
						   <?php $__currentLoopData = $plugins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						   <blockquote><?php echo e($p['name']); ?> - last updated: <em><?php echo e($p['updated']); ?></em></blockquote>
						   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						   </div>       
                          <a href="<?php echo e(url('plugins')); ?>" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">View plugins</a>  
                          <?php endif; ?>                      
  						</div>    
					
                    </div>                    
                                       
                    
                </div>
				 
		</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/settings.blade.php ENDPATH**/ ?>