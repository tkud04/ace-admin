@extends('layout')

@section('title',"Update Product Stock")

@section('styles')
  <!-- DataTables CSS -->
  <link href="lib/datatables/css/buttons.bootstrap.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/buttons.dataTables.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" /> 
@stop


@section('scripts')
    <!-- DataTables js -->
       <script src="lib/datatables/js/datatables.min.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="lib/datatables/js/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="lib/datatables/js/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="lib/datatables/js/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="lib/datatables/js/datatables-init.js"></script>
@stop

@section('content')
			<div class="col-md-12">
				{!! csrf_field() !!}
                <div class="block">
                    <div class="header">
                        <h2>Update stock for multiple products</h2>
                    </div>
                   <div class="content">
					 <div class="table-responsive" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" data-idl="3" class="table table-bordered ace-table">
                            <thead>
                                <tr>
                                    <th width="70%">Product</th>
                                    <th width="20%">Quantity</th>
                                    <th width="10%">
									 <button id="pq-select-all" onclick="pqSelectAllProducts()" class="btn btn-success">Select all</button>
									 <button id="pq-unselect-all" onclick="pqUnselectAllProducts()" class="btn btn-success">Unselect all</button>
									</th>                                                                                                      
                                </tr>
                            </thead>
                            <tbody>
							   <?php
							   $uss = [];
							   
							   foreach($products as $p)
							   {
								 if($p['status'] == "enabled")
								 {
								   $sku = $p['sku'];
								   $pd = $p['pd'];
							       $img = $p['imggs'][0];
							       $qty = $p['qty'];
								   $pu = url('edit-product')."?id=".$sku;
									
							   ?>
                                <tr>
                                    <td>
									<h6>{{$sku}}</h6>
									  
						 
						 <span>
						 <a href="{{$pu}}" target="_blank">
						   <img class="img img-fluid" src="{{$img}}" alt="{{$sku}}" height="40" width="40" style="margin-bottom: 5px;" />
							   
						 </a> (&#8358;{{number_format($pd['amount'],2)}})<br>
							 {!! $pd['description'] !!}
						 </span><br>
									</td>
                                    <td><span class="label label-info sink">{{$qty}}</span></td>
									<td>
									 <div class="btn-group" role="group">
									 <button onclick="pqSelectProduct({sku: '{{$sku}}'})" id="pq-{{$sku}}" class="btn btn-info p"><span class="icon-check"></span></button>
									 <button onclick="pqUnselectProduct({sku: '{{$sku}}'})" id="pq-unselect_{{$sku}}" class="btn btn-warning pq-unselect"><span class="icon-check-empty"></span></button>
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
							<form action="{{url('bup')}}" id="bup-form" method="post" enctype="multipart/form-data">
							  {!! csrf_field() !!}
							  <input type="hidden" id="pq-dt" name="dt">
							  <input type="hidden" id="pq-action" name="action">
							</form>
                                <span class="hp-main">Enter quantity:</span>
                                <div class="hp-sm">
								 <input type="number" class="form-control" placeholder="Enter quantity" id="pq-qty" aria-label="Username" aria-describedby="basic-addon1"><br>
								 <h3 id="pq-select-product-error" class="label label-danger text-uppercase">Please select a product</h3>
								 <h3 id="pq-select-qty-error" class="label label-danger text-uppercase">Please enter quantity</h3>
								 <br>
								 <button onclick="updateProducts()" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Submit</button>
								</div>                                
                            </div>
                   </div>  
               </div>				
           </div>
@stop