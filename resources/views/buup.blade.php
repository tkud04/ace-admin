@extends('layout')

@section('title',"Upload Products")

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
					     
                        <table id="buup-table" cellpadding="0" cellspacing="0" width="100%" data-idl="3" class="table table-bordered ace-table">
                            <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th width="40%">Description</th>
                                    <th width="10%">Price(&#8358;)</th>
                                    <th>Stock</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Actions</th>                                                                                                      
                                </tr>
                            </thead>
                            <tbody>
							   							   
                            </tbody>
                        </table>                                        

                    </div><br>
                   </div>  
               </div>				
           </div>
@stop