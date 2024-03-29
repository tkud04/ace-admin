<?php $__env->startSection('title',"Edit Sender"); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
			<form method="post" action="<?php echo e(url('sender')); ?>" id="edit-sender-form" enctype="multipart/form-data">
				<?php echo csrf_field(); ?>

				<input type="hidden" id="spp-s" value="show">
                <div class="block">
                    <div class="header">
                        <h2>Edit SMTP sender (to power the system's email)</h2>
                    </div>
                    <div class="content controls">
					<div class="form-row">
                                <div class="col-md-3">Name:</div>
								<div class="col-md-9">
							      <input type="text" class="form-control" name="name" id="as-name" placeholder="Sender name e.g Ace Luxury Store" value="<?php echo e($s['sn']); ?>" required/>
								 </div>
								</div>
						<div class="form-row" id="server-form-row">
                            <div class="col-md-3">Server:</div>
                            <div class="col-md-9">
							  <select class="form-control" id="server" name="server">
							    <option value="none">Select SMTP server</option>
								<?php
								 $servers = ['gmail' => "Gmail",'yahoo' => "Yahoo mail",'other' => "Other"];
								foreach($servers as $key => $value){
								$ss = $s['type'] == $key ? " selected='selected'" : "";
								?>
								 <option value="<?php echo e($key); ?>"<?php echo e($ss); ?>><?php echo e($value); ?></option>
								<?php
								}
								?>
							  </select>
							</div>
                        </div>
                        <div id="as-other">
						<div class="form-row">
							   <div class="col-md-3">SMTP host:</div>
							   <div class="col-md-9">
							      <input type="text" class="form-control" name="ss" id="as-server" placeholder="Server address e.g smtp.gmail.com" value="<?php echo e($s['ss']); ?>"/>
								 </div>
								</div>
								<div class="form-row">
							   <div class="col-md-3">SMTP port:</div>
							   <div class="col-md-9">
							      <input type="number" class="form-control" name="sp" id="as-sp" placeholder="Port e.g 587" value="<?php echo e($s['sp']); ?>"/>
								 </div>
								</div>
								<div class="form-row">
                                <div class="col-md-3">Encryption:</div>
								<div class="col-md-9">
							      <select class="form-control" name="sec" id="as-sec" style="margin-bottom: 5px;">
							        <option value="nonee">Select encryption</option>
								    <?php
								     $secs = ['tls' => "TLS",'ssl' => "SSL",'none' => "No encryption"];
								     foreach($secs as $key => $value){
										$ss = $s['sec'] == $key ? " selected='selected'" : "";
								    ?>
								    <option value="<?php echo e($key); ?>"<?php echo e($ss); ?>><?php echo e($value); ?></option>
								    <?php
								    }
								    ?>
							      </select>
								 </div>
								</div>
							  </div>
								<div class="form-row">
                                <div class="col-md-3">Username</div>
								<div class="col-md-9">
							      <input type="text" class="form-control" name="username" id="as-username" placeholder="Login username/email"value="<?php echo e($s['su']); ?>" required/>
								 </div>
								</div>
								<div class="form-row">
                                <div class="col-md-3">Password</div>
								<div class="col-md-7">
							      <input type="password" class="form-control" name="password" id="as-password" placeholder="Password" value="<?php echo e($s['spp']); ?>" required/>
								 </div>
								<div class="col-md-2">
									<button id="spp-show" class="btn-default btn-block btn-clean">Show</button>
								</div>
								</div>
                        
						<div class="form-row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
							  <center>
							    <button type="submit" id="add-sender-submit" class="btn btn-default btn-block btn-clean">Submit</button>
							  </center>
							</div>
                            <div class="col-md-4"></div>							
                        </div>
                                              
                    </div>
                </div>  
            </form>				
            </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/sender.blade.php ENDPATH**/ ?>