@extends('layout')

@section('title',"Update Product Stock")

@section('styles')
  <!-- DataTables CSS -->
  <link href="lib/datatables/css/buttons.bootstrap.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/buttons.dataTables.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" /> 
@stop


@section('scripts')
 <script>
 $(document).ready(() =>{
 $('.bup-hide').hide();
 
 });
 </script>

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
                        <h2>Update stock and product name for multiple products</h2>
                    </div>
                   <div class="content">
					 <div class="table-responsive" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" data-idl="3" class="table table-bordered ace-table">
                            <thead>
                                <tr>
                                    <th width="70%">Product</th>
                                    <th width="20%">Details</th>
                                                                                                                                          
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
								   $name = $p['name'];
								   $pd = $p['pd'];
							       $img = $p['imggs'][0];
							       $qty = $p['qty'];
								   $pu = url('edit-product')."?id=".$sku;
									
							   ?>
                                <tr>
                                    <td>
									<h6>{{$name}}</h6>
									  
						 
						 <span>
						 <a href="{{$pu}}" target="_blank">
						   <img class="img img-fluid" src="{{$img}}" alt="{{$sku}}" height="40" width="40" style="margin-bottom: 5px;" />
							   
						 </a> (&#8358;{{number_format($pd['amount'],2)}})<br>
							 {{$sku}}<br> {!! $pd['description'] !!}
						 </span><br>
									</td>
                                    <td>
									<div id="bup-{{$sku}}-side1">
									  <span class="label label-info sink">{{$qty}}</span>
									  <div class="btn-group" role="group">
									    <button onclick="BUPEditStock({sku: '{{$sku}}',qty: '{{$qty}}'})" class="btn btn-warning p">Edit</button>
									  </div>
									</div>
									<div id="bup-{{$sku}}-side2" class="bup-hide">
									  <input type="text" class="form-control" onchange="BUPSaveEdit('name',{sku: '{{$sku}}',value: this.value})" onload="BUPSaveEdit('name',{sku: '{{$sku}}',value: this.value})" placeholder="Name" value="{{$name}}">
									  <input type="number" class="form-control" onchange="BUPSaveEdit('qty',{sku: '{{$sku}}',value: this.value})" placeholder="New stock">
									  <div class="btn-group" role="group">
									   <button onclick="BUPCancelEditStock({sku: '{{$sku}}'})" class="btn btn-warning p">Cancel</button>
									  </div>
									</div>
									
									</td>
									                                                                     
                                </tr>
                               <?php
							   }
							 }
                               ?>							   
                            </tbody>
                        </table>                                        

                    </div><br>
						   
						   
                            <div class="hp-info hp-simple pull-left">
							<form action="{{url('bup')}}" id="bup-form" method="post" enctype="multipart/form-data">
							  {!! csrf_field() !!}
							  <input type="hidden" id="bup-dt" name="dt">
							  </form>
                                <div class="hp-sm">
								 <h3 id="bup-select-product-error" class="label label-danger text-uppercase bup-hide mr-5 mb-5">Please select a product</h3>
								 <h3 id="bup-select-qty-error" class="label label-danger text-uppercase bup-hide">Some required details are missing</h3>
								 <br>
								 <button onclick="BUP()" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Submit</button>
								</div>                                
                            </div>
                   </div>  
               </div>				
           </div>
@stop