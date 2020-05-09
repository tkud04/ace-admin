<?php $__env->startSection('title',$product['sku']); ?>

<?php $__env->startSection('content'); ?>
			<div class="col-md-12">
			<form method="post" action="<?php echo e(url('edit-product')); ?>" enctype="multipart/form-data">
				<?php echo csrf_field(); ?>

                <div class="block">
                    <div class="header">
                        <h2>Edit product information</h2>
                    </div>
                    <div class="content controls">
                        <div class="form-row">
                            <div class="col-md-3">SKU:</div>
                            <div class="col-md-9"><input type="text" name="xf" class="form-control" placeholder="Will be generated" value="<?php echo e($product['sku']); ?>" readonly/></div>
                        </div>
						<div class="form-row">
                            <div class="col-md-3">Description:</div>
                            <div class="col-md-9"><textarea class="form-control" name="description" placeholder="Brief description.."><?php echo e($product['pd']['description']); ?></textarea></div>
                        </div> 
						<div class="form-row">
                            <div class="col-md-3">Price(&#8358;):</div>
                            <div class="col-md-9"><input type="number" class="form-control" name="amount" placeholder="Price in NGN" value="<?php echo e($product['pd']['amount']); ?>"/></div>
                        </div> 
						<div class="form-row">
                            <div class="col-md-3">Quantity:</div>
                            <div class="col-md-9"><input type="number" class="form-control" name="qty" placeholder="Current stock e.g 10" value="<?php echo e($product['qty']); ?>"/></div>
                        </div> 
						<div class="form-row">
                            <div class="col-md-3">Discount:</div>
                           <div class="col-md-9">
						   		<input type="hidden" name="add_discount" id="add_discount" value="no"/>
						      <div id="add-discount-button">
							     <center>
								 <?php
								 if(isset($discounts) && count($discounts) > 0)
								 {
									foreach($discounts as $d)
									{
										$dtype = $d['discount_type'];
										$discount = $d['discount'];
										$rt = "";
										
										switch($dtype)
										{
											case "flat":
											 $rt = "&#8358;".number_format($discount,2);
											break;
											case "percentage":
											 $rt = $discount."%";
											break;
										}
										
										$du = url("delete-discount")."?xf=".$d['id'];
								 ?>
							     <p><b><?php echo e(strtoupper($d['type'])); ?></b> - <?php echo $rt; ?> - <a href="<?php echo e($du); ?>" class="btn btn-default btn-clean">Delete</a></p>
								 <?php
							        }
								 }
								 else
								 {
								 ?>
                                  <p>No discount</p>
                                 <?php								 
								 }
								 ?>
							     </center>
							  </div>
							  <div>
							    <center>
							      <a href="javascript:void(0)" id="toggle-discount-btn" class="btn btn-default btn-clean">Add discount</a>
							    </center>	<br>
							  </div>
						      <div id="add-discount-input">
							  <div class="form-row">
                                <div class="col-md-3">Discount type:</div>
								<div class="col-md-9">
							      <select class="form-control" name="discount_type" style="margin-bottom: 5px;">
							        <option value="none">Select discount type</option>
								    <?php
								     $discTypes = ['flat' => "Flat(NGN)",'percentage' => "Percentage(%)"];
								     foreach($discTypes as $key => $value){
								    ?>
								    <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
								    <?php
								    }
								    ?>
							      </select>
								 </div>
								</div>
								<div class="form-row">
                                <div class="col-md-3">Discount:</div>
								<div class="col-md-9">
							      <input type="number" class="form-control" name="discount" id="discount" placeholder="Discount in NGN or in %" value=""/>
							    </div>
							   </div>
							  </div>
						     
							</div>
                        </div>
						<div class="form-row">
                            <div class="col-md-3">Category:</div>
                            <div class="col-md-9">
							  <select class="form-control" name="category">
							    <option value="none">Select category</option>
								<?php
								foreach($categories as $c){
								$ss = $c['category'] == $product['pd']['category'] ? " selected='selected'" : "";
								?>
								 <option value="<?php echo e($c['category']); ?>" <?php echo e($ss); ?>><?php echo e($c['name']); ?></option>
								<?php
								}
								?>
							  </select>
							</div>
                        </div>
						<div class="form-row">
                            <div class="col-md-3">Status:</div>
                            <div class="col-md-9">
							  <select class="form-control" name="status">
							    <option value="none">Select status</option>
								<?php
								$statuses = ['enabled' => "Enabled",'disabled' => "Disabled"];
								foreach($statuses as $key => $value){
								$ss = $product['status'] == $key ? " selected='selected'" : "";
								?>
								 <option value="<?php echo e($key); ?>" <?php echo e($ss); ?>><?php echo e($value); ?></option>
								<?php
								}
								?>
							  </select>
							</div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3">Stock status:</div>
                           <div class="col-md-9">
							  <select class="form-control" name="in_stock">
							    <option value="none">Select stock status</option>
								<?php
								 $stockStatuses = ['in_stock' => "In stock",'new' => "New",'out_of_stock' => "Out of stock"];
								
								foreach($stockStatuses as $key=> $value){
									$ss = $key == $product['pd']['in_stock'] ? " selected='selected'" : "";
								?>
								 <option value="<?php echo e($key); ?>" <?php echo e($ss); ?>><?php echo e($value); ?></option>
								<?php
								}
								?>
							  </select>
							</div>
                        </div>
						<div class="form-row">
                            <div class="col-md-3">Images:</div>
                            <div class="col-md-9">
							   <ul class="list-inline">
							    <?php
								  $imggs = $product['imggs'];
								  $imgs = $product['imgs'];
								  
								  for($ii = 0; $ii < count($imggs); $ii++){
									  $i = $imggs[$ii];
									  $diu = url("delete-img")."?xf=".$imgs[$ii]['id'];
                                ?>
								<li>
								  <img class="img img-responsive" src="<?php echo e($i); ?>" width="200" height="300" style="margin-bottom: 3px;">
								  <a href="<?php echo e($diu); ?>" class="btn btn-default btn-block btn-clean">Delete</a>
								</li>
                                <?php
								  }
                                ?>
                               </ul>
							    <p class="form-control-plaintext text-left"><i class="fa fa-asterik"></i> Upload product images (<b>Recommended dimension: 700 x 700</b>)</p><br>
								<input type="file" name="img[]" id="img-1" class="form-control" >
								<input type="file" name="img[]" id="img-2" class="form-control" >		<br><br>						   
							</div>
							
                        </div>
						<div class="form-row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
							  <center>
							    <button type="submit" class="btn btn-default btn-block btn-clean">Submit</button>
							  </center>
							</div>
                            <div class="col-md-4"></div>							
                        </div>
                                              
                    </div>
                </div>  
            </form>				
            </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace-admin\resources\views/edit-product.blade.php ENDPATH**/ ?>