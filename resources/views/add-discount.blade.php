@extends('layout')

@section('title',"Add Discount")

@section('content')
			<div class="col-md-12">
			<form method="post" action="{{url('new-discount')}}" enctype="multipart/form-data">
				{!! csrf_field() !!}
                <div class="block">
                    <div class="header">
                        <h2>Add new discount</h2>
                    </div>
                    <div class="content controls">
					<div class="form-row">
                                <div class="col-md-3">Type:</div>
								<div class="col-md-9">
							      <select class="form-control" id="add-discount-type" name="type" style="margin-bottom: 5px;">
							        <option value="none">Select type</option>
								    <?php
								     $types = ['single' => "Single",'general' => "General"];
								     foreach($types as $key => $value){
								    ?>
								    <option value="{{$key}}">{{$value}}</option>
								    <?php
								    }
								    ?>
							      </select>
								 </div>
								</div>
						<div class="form-row" id="sku-form-row">
                            <div class="col-md-3">Product:</div>
                            <div class="col-md-9">
							  <select class="form-control" name="sku">
							    <option value="none">Select product</option>
								<?php
								foreach($products as $p){
								//$ss = $product['status'] == $key ? " selected='selected'" : "";
								?>
								 <option value="{{$p['sku']}}">{{$p['sku']}}</option>
								<?php
								}
								?>
							  </select>
							</div>
                        </div>
						<div class="form-row">
                                <div class="col-md-3">Discount type:</div>
								<div class="col-md-9">
							      <select class="form-control" name="discount_type" style="margin-bottom: 5px;">
							        <option value="none">Select discount type</option>
								    <?php
								     $discTypes = ['flat' => "Flat(NGN)",'percentage' => "Percentage(%)"];
								     foreach($discTypes as $key => $value){
								    ?>
								    <option value="{{$key}}">{{$value}}</option>
								    <?php
								    }
								    ?>
							      </select>
								 </div>
								</div>
								<div class="form-row">
                                <div class="col-md-3">Discount:</div>
								<div class="col-md-9">
							      <input type="number" class="form-control" name="discount" id="discount" placeholder="Discount in NGN or in %" value=""/>
							    </div>
							   </div>           
						<div class="form-row">
                            <div class="col-md-3">Status:</div>
                            <div class="col-md-9">
							  <select class="form-control" name="status">
								<?php
								$statuses = ['enabled' => "Enabled",'disabled' => "Disabled"];
								foreach($statuses as $key => $value){
								//$ss = $product['status'] == $key ? " selected='selected'" : "";
								?>
								 <option value="{{$key}}">{{$value}}</option>
								<?php
								}
								?>
							  </select>
							</div>
                        </div>
                        
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