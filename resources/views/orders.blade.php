@extends('layout')

@section('title',"Orders")

@section('content')
			<div class="col-md-12">
				{!! csrf_field() !!}
                <div class="block">
                    <div class="header">
                        <h2>List of orders in the system</h2>
                    </div>
                    <div class="content">
                       <div id="DataTables_Table_2_wrapper" class="dataTables_wrapper" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                            <thead>
                                <tr>
                                    <th width="20%">Date</th>
                                    <th width="20%">Reference #</th>
                                    <th width="20%">Items</th>                                                                       
                                    <th width="20%">Status</th>                                                                       
                                    <th width="20%">Actions</th>                                                                       
                                </tr>
                            </thead>
                            <tbody>
							  <?php
					  if(count($orders) > 0)
					  {
						 foreach($orders as $o)
						 {
							 $items = $o['items'];
							 $totals = $o['totals'];
							 $statusClass = $o['status'] == "paid" ? "success" : "danger";
							 $uu = "#";
				    ?>
                      <tr>
					   <td>{{$o['date']}}</td>
					   <td>{{$o['reference']}}</td>
					    <td>
						<?php
						 foreach($items as $i)
						 {
							 $product = $i['product'];
							 $qty = $i['qty'];
							 $pu = url('edit-product')."?id=".$product['sku'];
							 $tu = url('edit-order')."?r=".$o['reference'];
							 $ttu = url('track')."?o=".$o['reference'];
						 ?>
						 <a href="{{$pu}}" target="_blank">{{$product['sku']}}</a> (x{{$qty}})<br>
						 <?php
						 }
						?>
						<b>Total: &#8358;{{number_format($o['amount'],2)}}</b>
					   </td>	  
					   <td><span class="label label-{{$statusClass}}">{{strtoupper($o['status'])}}</span></td>
					   <td>
					     <a class="btn btn-primary" href="{{$tu}}">View</span>&nbsp;&nbsp;
					     <a class="btn btn-warning" href="{{$ttu}}">Track</span>
					   </td>
					 </tr>
					<?php
						 }  
					  }
                    ?>				               
                            </tbody>
                        </table>                                        

                    </div>
                </div>  
            </div>				
           </div>
@stop