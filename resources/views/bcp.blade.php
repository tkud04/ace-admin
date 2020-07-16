@extends('layout')

@section('title',"Confirm Payments")

@section('content')
			<div class="col-md-12">
				{!! csrf_field() !!}
                <div class="block">
                    <div class="header">
                        <h2>Confirm bank payment for multiple orders</h2>
                    </div>
                   <div class="content">
						   <div class="dataTables_wrapper" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" data-idl="3" class="table table-bordered table-striped sortable">
                            <thead>
                                <tr>
                                    <th width="70%">Order</th>
                                    <th width="20%">Status</th>
                                    <th width="10%">
									 <button id="cp-select-all" onclick="cpSelectAllOrders()" class="btn btn-success">Select all</button>
									 <button id="cp-unselect-all" onclick="cpUnselectAllOrders()" class="btn btn-success">Unselect all</button>
									</th>                                                                                                      
                                </tr>
                            </thead>
                            <tbody>
							   <?php
							   $uss = [];
							   
							   foreach($orders as $o)
							   {
								 if($o['status'] == "unpaid")
								 {
								   $items = $o['items'];
								    $statusClass = $o['status'] == "paid" ? "success" : "danger";
									
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
                                    <td><span class="label label-{{$statusClass}} sink">{{strtoupper($o['status'])}}</span></td>
									<td>
									 <div class="btn-group" role="group">
									 <button onclick="cpSelectOrder({reference: '{{$o['reference']}}'})" id="cp-{{$o['reference']}}" class="btn btn-info cp"><span class="icon-check"></span></button>
									 <button onclick="cpUnselectOrder({reference: '{{$o['reference']}}'})" id="cp-unselect_{{$o['reference']}}" class="btn btn-warning cp-unselect"><span class="icon-check-empty"></span></button>
									 </div>
									</td>                                                                     
                                </tr>
                               <?php
							    }
							   }
                               ?>							   
                            </tbody>
                        </table>                                        

                    </div>
					
					<div class="hp-info hp-simple pull-left">
							<form action="{{url('bcp')}}" id="bcp-form" method="post" enctype="multipart/form-data">
							  {!! csrf_field() !!}
							  <input type="hidden" id="cp-dt" name="dt">
							  <input type="hidden" id="cp-action" name="action">
							</form>
                                <span class="hp-main">Select action:</span>
                                <div class="hp-sm">
								 <select id="cp-btn">
								  <option value="none">Select action</option>
								  <option value="confirm">Confirm payment</option>
								 </select><br>
								 <h3 id="cp-select-order-error" class="label label-danger text-uppercase">Please select an order</h3>
								 <h3 id="cp-select-status-error" class="label label-danger text-uppercase">Please select action</h3>
								 <br>
								 <button onclick="updateBankPayments()" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Submit</button>
								</div>                                
                            </div>
                   </div>  
               </div>				
           </div>
@stop