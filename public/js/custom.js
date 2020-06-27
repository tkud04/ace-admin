	let trackingOrders = [], trackingAction = "none";
   

$(document).ready(function(){
	$('#add-discount-input').hide();
	
	$('#tracking-unselect-all').hide();
	
	if($("#add-discount-type").val() == "single"){} 
	else {$('#sku-form-row').hide(); }
	
        $("#update-tracking-btn").change((e) =>{
			trackingAction = $(this).val();
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
		  
});

function updateTracking(){
	console.log('we are here');
	console.log(trackingOrders);
	console.log(trackingAction);
	
}

function showBulkSelectButton(type,op){
	switch(op){
		case "selectAll":
		  $(`#${type}-select-all`).hide();
		$(`#${type}-unselect-all`).fadeIn();
		break;
		case "unselectAll":
		  $(`#${type}-unselect-all`).hide();
		$(`#${type}-select-all`).fadeIn();
		break;
	}
}

function trackingSelectAllOrders(){
	console.log("selecting all orders");
    bs = $('button.r');
	
	if(bs){
		console.log(bs.length);
		for(let i = 0; i < bs.length; i++){
			b = bs[i];
			trackingSelectOrder({reference: b.id});
		}
	    showBulkSelectButton("tracking","selectAll");
	
	}
}

function trackingUnselectAllOrders(){
	console.log("unselecting all orders");
     bs = $('button.r');
	
	if(bs){
		console.log(bs.length);
		for(let i = 0; i < bs.length; i++){
			b = bs[i];
			trackingUnselectOrder({reference: b.id});
		}
		showBulkSelectButton("tracking","unselectAll");
	}
}

function trackingSelectOrder(o){
	if(o.reference){
	  console.log(`selecting order ${o.reference}`);
	  b = $(`button#${o.reference}`);
	  if(b){
		  b.attr('disabled',true);
		  b.removeClass('btn-info');
		  b.addClass('btn-warning');
		  b.html("Selected");
		  let ss = trackingOrders.find(i => i.reference == o.reference);
		  //console.log('us: ',us);
		  if(ss){
			ss.selected = true;  
		  }
		  else{
			trackingOrders.push({reference: o.reference,selected: true});  
		  }
		  
		  
	  }
	  
	}
}

function trackingUnselectOrder(o){
	if(o.reference){
	  console.log(`unselecting order ${o.reference}`);
	  b = $(`button#${o.reference}`);
	  if(b){
		  b.attr('disabled',false);
		  b.removeClass('btn-warning');
		  b.addClass('btn-info');
		  b.html("Select");
		  let us = trackingOrders.find(i => i.reference == o.reference);
		  //console.log('us: ',us);
		  us.selected = false;
	  }
	  
	}
}