@extends('layout')

@section('title',"Products")

@section('content')
			<div class="col-md-12">
				{!! csrf_field() !!}
                <div class="block">
                    <div class="header">
                        <h2>List of products in the system</h2>
                    </div>
                    <div class="content">
                       <div id="DataTables_Table_2_wrapper" class="dataTables_wrapper" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                            <thead>
                                <tr>
                                    <th width="30%">Product</th>
                                    <th width="10%">Current qty</th>
                                    <th width="20%">Amount(&#8358;)</th>
                                    <th width="20%">Status</th>                                                                       
                                    <th width="20%">Actions</th>                                                                       
                                </tr>
                            </thead>
                            <tbody>
							   @foreach($products as $p)
							   <?php
							   $pd = $p['pd'];
							   $status = $p['status'];
							   $ss = ($status == "enabled") ? "success" : "danger";
							   ?>
                                <tr>
                                    <td>{{$p['sku']}}<br>{{$pd['description']}}</td>
                                    <td>{{$p['qty']}}</td>
                                    <td>{{number_format($pd['amount'],2)}}</td>
                                    <td><span class="driver-status label label-{{$ss}}">{{$status}}</span></td>                                                                     
                                    <td>
									  <?php
									   $uu = url('edit-product')."?id=".$p['sku'];
									   
									  ?>
									  <a href="{{$uu}}" class="btn btn-primary">View</button>									  
									</td>                                                                     
                                </tr>
                               @endforeach                       
                            </tbody>
                        </table>                                        

                    </div>
                </div>  
            </div>				
           </div>
@stop