@extends('layout')

@section('title',"Carts")

@section('content')
			<div class="col-md-12">
				{!! csrf_field() !!}
                <div class="block">
                    <div class="header">
                        <h2>List of current non empty carts in the system</h2>
                    </div>
                    <div class="content">
                       <div id="DataTables_Table_2_wrapper" class="dataTables_wrapper" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                            <thead>
                                <tr>
                                    <th width="20%">Date added</th>
                                    <th width="20%">User</th>
                                    <th width="20%">Items</th>                                                                       
                                    <th width="20%">Status</th>                                                                    
                                </tr>
                            </thead>
                            <tbody>
							  <?php
							  
					  if(count($ccarts) > 0)
					  {
						 foreach($ccarts as $c)
						 {
							 $items = $o['items'];
							 $totals = $o['totals'];
							 $statusClass = $o['status'] == "paid" ? "success" : "danger";
							 $uu = "#";
				    ?>
                      <tr>
					   <td>{{$c['date']}}</td>
					   <td>{{$o['reference']}}</td>
					    <td>
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
						   <img class="img img-fluid" src="{{$img}}" alt="{{$sku}}" height="80" width="80" style="margin-bottom: 5px;" />
							   {{$sku}}
						 </a> (x{{$qty}})
						 </span><br>
						 <?php
						 }
						?>
						<b>Total: &#8358;{{number_format($o['amount'],2)}}</b>
					   </td>	  
					   <td><span class="label label-{{$statusClass}}">{{strtoupper($o['status'])}}</span></td>
					   <td>
					     <a class="btn btn-primary" href="{{$tu}}">View</span>&nbsp;&nbsp;
					     <a class="btn btn-warning" href="{{$ttu}}">Track</span>&nbsp;&nbsp;
					     <a class="btn btn-danger" href="{{$du}}">Delete</span>
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