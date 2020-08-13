   
$(document).ready(function(){
	$('#add-discount-input').hide();
	$('#result-box').hide();
	$('#finish-box').hide();
	
	$('#settings-delivery-side2').hide();
	$('#settings-delivery-loading').hide();
	
	$('#as-other').hide();
	
	hideUnselects();
	hideSelectErrors();
	if($("#add-discount-type").val() == "single"){} 
	else {$('#sku-form-row').hide(); }
	
        $("select.customer-type").change((e) =>{
			e.preventDefault();
			let ct = $(this).val();
			console.log("ct: ",ct);
		});
		
		$("#server").change((e) =>{
			e.preventDefault();
			let server = $("#server").val();
			console.log("server: ",server);
			
			if(server == "other"){
				$('#as-other').fadeIn();     
            }
            else{
				$('#as-other').hide();     
            }
			
		});
		 $("#add-sender-form").submit(function(e){            
		       e.preventDefault();
			   let valid = true;
			   let name = $('#as-name').val(), username = $('#as-username').val(),
			   pass = $('#as-password').val(), s = $('#server').val(),
			   ss = $('#as-server').val(), sp = $('#as-sp').val(), sec = $('#as-sec').val();
			   
			   if(name == "" || username == "" || pass == "" || s == "none"){
				   valid = false;
			   }
			   else{
				   if(s == "other"){
					   if(ss == "" || sp == "" || sec == "nonee") valid = false;
				   }
			   }
			   
			   if(valid){
				 $('#add-sender-form'). submit();
			    //updateDeliveryFees({d1: d1, d2: d2});  
			   }
			   else{
				   alert("Please fill all required fields");
			   }
             
		  });
		
		$("#update-tracking-btn").change((e) =>{
			e.preventDefault();
			let vv = $("#update-tracking-btn").val();
			trackingAction = vv;
		});
		$("#cp-btn").change((e) =>{
			e.preventDefault();
			let cc = $("#cp-btn").val();
			cpAction = cc;
		});
		
		$("input.form-control.images").change((e) =>{
			e.preventDefault();
			let cc = $(this)[0].files;
			console.log(cc);
		});
		
        $("#toggle-discount-btn").click(function(e){            
		   e.preventDefault();
            let hasDiscountField = $('#add_discount');
            let hasDiscount = hasDiscountField.val();
            
			if(hasDiscount == "yes"){
			 hasDiscountField.val("no");
             $('#toggle-discount-btn').html("Add discount");			 
             $('#add-discount-button').fadeIn();			 
             $('#discount').val("");			 
			}
			else if(hasDiscount == "no"){
			 hasDiscountField.val("yes");
             $('#toggle-discount-btn').html("Remove discount");
             $('#add-discount-button').hide();			 
             //$('#discount').val("");			 
			}
			
            $('#add-discount-input').fadeToggle();            
			});
			
			$("#add-discount-type").change(function(e){            
		       e.preventDefault();
               let dtype = $(this).val();
            
			   if(dtype == "single"){			 
                $('#sku-form-row').fadeIn();			 
			   }
			   else{
			    $('#sku-form-row').hide();			 
			   }
		  });
		  
		  $("#settings-delivery-btn").click(function(e){            
		       e.preventDefault();
              $('#settings-delivery-side1').hide();
              $('#settings-delivery-side2').fadeIn();
		  });

		  $("#settings-delivery-form").submit(function(e){            
		       e.preventDefault();
			   let d1 = $('#settings-delivery-d1').val(), d2 = $('#settings-delivery-d2').val();
			   
			   if(d1 == "" || parseInt(d1) < 1 || d2 == "" || parseInt(d2) < 1){
				   alert("All fields are required");
			   }
			   else{
				   
			   }
             $('#settings-delivery-submit').hide();
		     $('#settings-delivery-loading').fadeIn();
			 updateDeliveryFees({d1: d1, d2: d2});
		  });
		  
});