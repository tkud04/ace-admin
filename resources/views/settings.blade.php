@extends('layout')

@section('title',"Settings")

@section('content')
   <?php
								 $statuses = ['none' => "Select tracking status",
								              'pickup' => "Scheduled for Pickup",
								              'transit' => "In Transit",
								              'delivered' => "Package delivered",
								              'return' => "Package Returned",
								              'receiver_not_present' => "Receiver Not Present at Delivery Address",
											 ];
								?>
            <div class="col-md-2">
                
                <div class="block block-drop-shadow">
                    <div class="user bg-default bg-light-rtl">
                        <div class="info">                                                                                
                            <a href="#" class="informer informer-three">
                                <span>{{$user->fname}}</span>
									{{$user->lname}}
                            </a>                            
                            <a href="#" class="informer informer-four">
                                <span>{{strtoupper($user->role)}}</span>
                                Role
                            </a>                                                        
                            <img src="img/icon.png" class="img-circle img-thumbnail"/>
                        </div>
                    </div>
                    <div class="content list-group list-group-icons">
                        <a href="{{url('logout')}}" class="list-group-item"><span class="icon-off"></span>Logout<i class="icon-angle-right pull-right"></i></a>
                    </div>
                </div> 
                
               
                
            </div>
            
            <div class="col-md-5">
               
                <div class="block block-drop-shadow">                    
                        <div class="head bg-dot20">
                        <h2>SMTP Senders</h2>
                        
                        <div class="head-subtitle">SMTP details used by the system to send emails</div>                        
                        
                        <div class="head-panel nm">
						<br>
						  <?php
						   $smtpCount = count($smtp);
						   
						  if($smtpCount < 1)
						   {
						  ?>	  
						  <h4>No senders added yet.</h4>
						  <a href="{{url('add-sender')}}" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Add one now</a> 
					      <?php
						   }
						  else
						  {
						    $ct = "sender";
						    
						   
						   if($smtpCount > 1)
						   {
							   $ct = "senders";
							
						   }
						  ?>
							<h4>{{$smtpCount}} {{$ct}} added.</h4>
							@if(count($sender) > 0) 
							<h5>Current Sender: {{$sender['sn']}} ({{$sender['se']}}).</h5>
							<h6>Last updated: {{$settings['smtp']['updated']}} </h6>
							@endif
                            <a href="{{url('senders')}}" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">View {{$ct}}</a> 
						  <?php						
						  }
                          ?>               
                        </div>                        
                    </div>                    
                                       
                    
                </div> 
				
				<div class="block block-drop-shadow">                    
                        <div class="head bg-dot20">
                        <h2>Delivery fees</h2>
                        
                        <div class="head-subtitle">Current delivery fees used by the system</div>                        
                        
                        <div class="head-panel nm">
						<br>
						  <?php
						  $delivery1 = 1000;
						  $delivery2 = 2000;
						
						  ?>	  
						  
							<h4>Lagos, Ondo, Ekiti, Osun, Oyo, Ogun: <span id="settings-d1">{{$delivery1}}</span></h4>
							<h4>Other states: <span id="settings-d2">{{$delivery2}}</span></h4>
                            <a href="javascript:void(0)" id="settings-delivery-btn" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Edit</a> 
						           
                        </div>                        
                    </div>                    
                                       
                    
                </div> 
				
				

            </div> 
			<div class="col-md-5">
         
				
				
				<div class="block block-drop-shadow">                    
                    <div class="head bg-dot20">
                        <h2>Bank Account</h2>
                        
                        <div class="head-subtitle">Update payment info for bank payments</div>                        
                        
                        <div class="head-panel nm">
						<br>
						  
							<h4>working..</h4>
							   <a href="javascript:void(0)" id="settings-bank-btn" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Edit</a>  
                        </div>                      
                    </div>                    
                                       
                    
                </div>
				
				<div class="block block-drop-shadow">                    
                   <div class="head bg-dot20">
                      <h2>Something</h2>  
                      <div class="head-subtitle">Something will be here</div>                        
                        
                      <div class="head-panel nm">
						<br>
						  	  
						  <h4>Current data.</h4>
						           
                          <a href="javascript:void(0)" id="settings-bankh-btn" class="btn btn-default btn-block btn-clean" style="margin-top: 5px;">Edit</a>  
                        </div>    
					
                    </div>                    
                                       
                    
                </div>
				 
		</div>
@stop