@extends('layout')

@section('title',"Edit Order")

@section('content')
			<div class="col-md-12">
			<form method="post" action="{{url('edit-order')}}" enctype="multipart/form-data">
				{!! csrf_field() !!}
				<input type="hidden" name="xf" value="{{$xf}}">
				<?php
                           	   $items = $o['items'];
							 $totals = $o['totals'];
							 $statusClass = $o['status'] == "paid" ? "success" : "danger";
							 $uu = "#";
							   ?>
                <div class="block">
                    <div class="header">
                        <h2>Edit order information</h2>
                    </div>
                    <div class="content controls">
					     <div class="form-row">
                            <div class="col-md-3">Reference number</div>
                           <div class="col-md-9">
							  <input type="text" class="form-control" value="{{$o['reference']}}" readonly>
						   </div>
                        </div><br>
						<div class="form-row">
                            <div class="col-md-3">Payment code</div>
                           <div class="col-md-9">
							  <input type="text" class="form-control" value="{{$o['payment_code']}}" readonly>
						   </div>
                        </div><br>
						<div class="form-row">
                            <div class="col-md-3">Items</div>
                           <div class="col-md-9">
							  <textarea class="form-control" rows="5" readonly>
							    <?php
						 foreach($items as $i)
						 {
							 $product = $i['product'];
							 $pd = $product['pd'];
							 $qty = $i['qty'];
							 $pu = url('edit-product')."?id=".$product['sku'];
							 $tu = url('edit-order')."?r=".$o['reference'];
						 ?>
						 {{$product['sku']}}    &#8358;{{number_format($pd['amount'],2)}}     (x{{$qty}})
						 <?php
						 }
						?>
							  </textarea>
						   </div>
                        </div><br>
						<div class="form-row">
                            <div class="col-md-3">Total</div>
                           <div class="col-md-9">
							  <input type="text" class="form-control" value="&#8358;{{number_format($o['amount'],2)}}">
						   </div>
                        </div><br>
					   
                       
                       
						<div class="form-row">
                            <div class="col-md-3">Status:</div>
                           <div class="col-md-9">
							  <select class="form-control" name="status">
							    <option value="none">Select status</option>
								<?php
								 $statuses = ['unpaid' => "Unpaid",'paid' => "Paid"];
								
								foreach($statuses as $key=> $value){
									$ss = $key == $o['status'] ? "selected='selected'" : "";
								?>
								 <option value="{{$key}}" {{$ss}}>{{$value}}</option>
								<?php
								}
								?>
							  </select>
							</div>
                        </div><br>
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
@stop