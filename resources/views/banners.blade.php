@extends('layout')

@section('title',"Banners")

@section('content')
			<div class="col-md-12">
				{!! csrf_field() !!}
                <div class="block">
                    <div class="header">
                        <h2>List of ads</h2>
                    </div>
                    <div class="content">
                       <div id="DataTables_Table_2_wrapper" class="dataTables_wrapper" role="grid">
					     
                        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                            <thead>
                                <tr>
                                    <th width="20%">ID</th>
                                    <th width="20%">Image</th>
                                    <th width="20%">Subtitle</th>
                                    <th width="20%">Title</th>                                                                       
                                    <th width="20%">Actions</th>                                                                       
                                </tr>
                            </thead>
                            <tbody>
							   @foreach($banners as $b)
							   <?php
                           	    $imgg = $b['img'];
	                            $subtitle = $b['subtitle'];
	                            $title = $b['title'];
							   ?>
                                <tr>
                                    <td>{{$b['id']}}</td>
                                    <td><a href="{{$imgg}}" target="_blank">{{$imgg}}</a></td>
                                    <td>{{$subtitle}}</td>
                                    <td>{{$title}}</td>                                                                     
                                    <td>
									  <?php
									   $uu = url('edit-banner')."?id=".$b['id'];
									   
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