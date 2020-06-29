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
								$cs = $o['current_status'];
									
							   ?>
                                <tr>
                                    <td>
									<h6>ACE_{{$o['reference']}}</h6>
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
						 <a href="{{$pu}}" target="_blank">
						   <img class="img img-fluid" src="{{$img}}" alt="{{$sku}}" height="40" width="40" style="margin-bottom: 5px;" />
							   {{$sku}}
						 </a> (x{{$qty}})
						 </span><br>
						 <?php
						 }
						?>
									</td>
                                    <td><span class="label label-info">{{strtoupper($statuses[$cs])}}</span></td>
									<td>
									 <div class="btn-group" role="group">
									 <button onclick="trackingSelectOrder({reference: '{{$o['reference']}}'})" id="{{$o['reference']}}" class="btn btn-info r"><span class="icon-check"></span></button>
									 <button onclick="trackingUnselectOrder({reference: '{{$o['reference']}}'})" id="tracking-unselect_{{$o['reference']}}" class="btn btn-warning tracking-unselect"><span class="icon-check-empty"></span></button>
									 </div>
									</td>                                                                     
                                </tr>
                               <?php
							   }
                               ?>							   
                            </tbody>
                        </table>                                        

                    </div>
						   
						   
                            <div class="hp-info hp-simple pull-left">
							<form action="{{url('but')}}" id="but-form" method="post" enctype="multipart/form-data">
							  {!! csrf_field() !!}
							  <input type="hidden" id="dt" name="dt">
							  <input type="hidden" id="action" name="action">
							</form>
                                <span class="hp-main">Update tracking:</span>
                                <div class="hp-sm">
								 <select id="update-tracking-btn">
								
								@foreach($statuses as $key=> $value)
								 <option value="{{$key}}">{{$value}}</option>
								@endforeach
								 </select><br>
								 <h3 id="tracking-select-order-error" class="label label-danger text-uppercase">Please select an order</h3>
								 <h3 id="tracking-select-status-error" class="label label-danger text-uppercase">Please select tracking status</h3>
								 <br>
								 <button onclick="updateTracking()" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Submit</button>
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
                                <input type="text" data-fgColor="#3F97FE" data-min="0" data-max="100" data-width="100" data-height="100" value="{{$stats['total']}}" data-readOnly="true"/>
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
		</div>
@stop