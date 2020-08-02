@extends('layout')

@section('title',"Dashboard")

@section('content')
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
                                <span>{{$user->fname}}</span>
									{{$user->lname}}
                            </a>                            
                            <a href="#" class="informer informer-four">
                                <span>{{strtoupper($user->role)}}</span>
                                Role
                            </a>                                                        
                            <img src="img/icon.png" class="img-circle img-thumbnail"/>
                        </div>
                    </div>
                    <div class="content list-group list-group-icons">
                        <a href="{{url('logout')}}" class="list-group-item"><span class="icon-off"></span>Logout<i class="icon-angle-right pull-right"></i></a>
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
                                <span class="hp-sm">Amount: &#8358;{{number_format($profits['total'],2)}} </span>
                            </div>   
							<div class="hp-info hp-simple pull-left hp-inline">
                                <span class="hp-main">Total profit today</span>
                                <span class="hp-sm">Amount: &#8358;{{number_format($profits['today'],2)}} </span>
                            </div>                 
                            <div class="hp-info hp-simple pull-left hp-inline">
                                <span class="hp-main">Total profit this month</span>
                                 <span class="hp-sm">Amount: &#8358;{{number_format($profits['month'],2)}} </span>
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
                                <input type="text" data-fgColor="#3F97FE" data-min="0" data-max="100" data-width="100" data-height="100" value="{{$stats['o_total']}}" data-readOnly="true"/>
                            </div>                              
                        </div>
                        <div class="head-panel nm">
                            <div class="hp-info hp-simple pull-left">
                                <span class="hp-main">Today's orders</span>
                                <span class="hp-sm">{{$stats['o_today']}}</span>                                
                            </div>
                            <div class="hp-info hp-simple pull-right">
                                <span class="hp-main">Total orders this month</span>
                                <span class="hp-sm">{{$stats['o_month']}}</span>                                
                            </div>                            
                        </div>
						<div class="head-panel nm" style="padding-top: 5px">
                            <div class="hp-info hp-simple pull-left">
                                <span class="hp-main">Total paid orders</span>
                                <span class="hp-sm">{{$stats['o_paid']}}</span>                                
                            </div>
                            <div class="hp-info hp-simple pull-right">
                                <span class="hp-main">Total unpaid orders</span>
                                <span class="hp-sm">{{$stats['o_unpaid']}}</span>                                
                            </div>                            
                        </div>                        
                    </div>                    
                    
                </div>    				

                <div class="block block-drop-shadow">                    
                        <div class="head bg-dot20">
                        <h2>Confirm payments</h2>
                        
                        <div class="head-subtitle">Confirm bank payment for multiple orders</div>                        
                        
                        <div class="head-panel nm">
						<br>
						  <?php
						  $unpaidOrders = $ordersCollection->where('status',"unpaid");
						   $uocount = count($unpaidOrders);
						   
						  if($uocount < 1)
						   {
						  ?>	  
						  <h4>No unpaid orders to confirm today.</h4>
					      <?php
						   }
						  else
						  {
						   $ot = "order"; $ct = "payment";
						   
						   if($uocount > 1)
						   {
							   $ot = "orders";
							   $ct = "payments";
						   }
						  ?>
							<h4>{{$uocount}} unpaid {{$ot}} on your website.</h4>
                            <a href="{{url('bcp')}}" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Confirm {{$ct}}</a> 
						  <?php						
						  }
                          ?>               
                        </div>                        
                    </div>                    
                                       
                    
                </div> 
				
				<div class="block block-drop-shadow">                    
                   <div class="head bg-dot20">
                      <h2>Upload Products</h2>  
                      <div class="head-subtitle text-warning">Pro tips:</div>                        
                        
                      <div class="head-panel nm">
						  <p>
						  Upload at least 2 images for each product.<br>
						  A good product description should be between 30 to 100 characters long.
						  </p>
					                   
                          <a href="{{url('buup')}}" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Upload products</a>						  
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
                                <input type="text" data-fgColor="#3F97FE" data-min="0" data-width="100" data-height="100" value="{{$stats['total']}}" data-readOnly="true"/>
                            </div>                              
                        </div>
                        <div class="head-panel nm">
                            <div class="hp-info hp-simple pull-left">
                                <span class="hp-main">Enabled products</span>
                                <span class="hp-sm">{{$stats['enabled']}}</span>                                
                            </div>
                            <div class="hp-info hp-simple pull-right">
                                <span class="hp-main">Disabled products</span>
                                <span class="hp-sm">{{$stats['disabled']}}</span>                                
                            </div>                            
                        </div>                        
                    </div>                    
                                       
                    
                </div>
				
				
				<div class="block block-drop-shadow">                    
                    <div class="head bg-dot20">
                        <h2>Track orders</h2>
                        
                        <div class="head-subtitle">Update tracking info for multiple orders</div>                        
                        
                        <div class="head-panel nm">
						<br>
						  <?php
						  $paidOrders = $ordersCollection->where('status',"paid");
						   $pocount = count($paidOrders);
						   
						  if($pocount < 1)
						   {
						  ?>	  
						  <h4>No paid orders to track today.</h4>
					      <?php
						   }
						  else
						  {
						   $ot = "order"; 
						   
						   if($pocount > 1)
						   {
							   $ot = "orders";
						   }
						  ?>
							<h4>{{$pocount}} paid {{$ot}} on your website.</h4>
							<?php
							 $untrackedOrders = $paidOrders->where('current_tracking',null);
						  $uto = count($untrackedOrders);
						  
						  if($uto > 0)
						  {
						  ?>
						  <h5 style="color:red;">{{$uto}} order(s) have not been tracked yet.</h5>
					      <?php
						  }
						  ?>             
                            <a href="{{url('but')}}" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Track {{$ot}}</a> 
						  <?php						
						  }
                          ?>               
                        </div>                      
                    </div>                    
                                       
                    
                </div>
				
				<div class="block block-drop-shadow">                    
                   <div class="head bg-dot20">
                      <h2>Update Stock</h2>  
                      <div class="head-subtitle">Update stock for multiple products</div>                        
                        
                      <div class="head-panel nm">
						<br>
						  <?php
						  $pcount = count($products);
						  
						   $pt = "product";
						   
						   if($pcount > 1)
						   {
							   $pt = "products";
						   }
						  ?>	  
						  <h4>{{$pcount." ".$pt}} currently on your website.</h4>
						  <?php
						  $lsp = count($lowStockProducts);
						  
						  if($lsp > 0)
						  {
						  ?>
						  <h5 style="color:red;">{{$lsp}} product(s) have below 10 pieces left.</h5>
					      <?php
						  }
						  ?>             
                          <a href="{{url('bup')}}" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Update {{$pt}}</a>						  
                        </div>    
					
                    </div>                    
                                       
                    
                </div>
				 
		</div>
@stop