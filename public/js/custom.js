	let trackingOrders = [], trackingAction = "none", cpOrders = [], cpAction = "none", pqProducts = [], pqAction = "0";
	let BUPlist = [], BUUPlist = [];
   

$(document).ready(function(){
	$('#add-discount-input').hide();
	
	hideUnselects();
	hideSelectErrors();
	if($("#add-discount-type").val() == "single"){} 
	else {$('#sku-form-row').hide(); }
	
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
	hideSelectErrors();
	
	if(trackingOrders.length < 1 || trackingAction == "none"){
		if(trackingOrders.length < 1){
			showSelectError('tracking','order');
		}
		if(trackingAction == "none"){
			showSelectError('tracking','status');
		}
	}
	else{
	
	let isAllUnselected = true;
	
	for(let i = 0; i < trackingOrders.length; i++){
		if(trackingOrders[i].selected) isAllUnselected = false;
	}
	
	if(isAllUnselected){
		showSelectError('tracking','order');
	}
	else{
		$('#dt').val(JSON.stringify(trackingOrders));
		$('#action').val(trackingAction);
		
		$('#but-form').submit();
	}
  }
}

function updateBankPayments(){
	hideSelectErrors();
	
	if(cpOrders.length < 1 || cpAction == "none"){
		if(cpOrders.length < 1){
			showSelectError('cp','order');
		}
		if(cpAction == "none"){
			showSelectError('cp','status');
		}
	}
	else{
	
	let cpIsAllUnselected = true;
	
	for(let i = 0; i < cpOrders.length; i++){
		if(cpOrders[i].selected) cpIsAllUnselected = false;
	}
	
	if(cpIsAllUnselected){
		showSelectError('cp','order');
	}
	else{
		$('#cp-dt').val(JSON.stringify(cpOrders));
		$('#cp-action').val(cpAction);
		
		$('#bcp-form').submit();
	}
  }
}

function updateProducts(){
	hideSelectErrors();
	pqAction = $('#pq-qty').val();
	if(pqProducts.length < 1 || (pqAction == "0" || pqAction == "")){
		if(pqProducts.length < 1){
			showSelectError('pq','product');
		}
		if(pqAction == "0" || pqAction == ""){
			showSelectError('pq','qty');
		}
	}
	else{
	
	let pqIsAllUnselected = true;
	
	for(let i = 0; i < pqProducts.length; i++){
		if(pqProducts[i].selected) pqIsAllUnselected = false;
	}
	
	if(pqIsAllUnselected){
		showSelectError('pq','product');
	}
	else{
		$('#pq-dt').val(JSON.stringify(pqProducts));
		$('#pq-action').val(pqAction);
		
		$('#bup-form').submit();
	}
  }
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
		   
		   $(`#tracking-unselect_${o.reference}`).fadeIn();
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
		  $(`#tracking-unselect_${o.reference}`).hide();
		  let us = trackingOrders.find(i => i.reference == o.reference);
		  //console.log('us: ',us);
		  if(us){
		    us.selected = false;
		  }
	  }
	  
	}
}

function cpSelectAllOrders(){
	console.log("selecting all orders");
    bs = $('button.cp');
	
	if(bs){
		console.log(bs.length);
		for(let i = 0; i < bs.length; i++){
			b = bs[i];
			cpSelectOrder({reference: b.id.substring(3)});
		}
	    showBulkSelectButton("cp","selectAll");
	
	}
}

function cpUnselectAllOrders(){
	console.log("unselecting all orders");
     bs = $('button.cp');
	
	if(bs){
		console.log(bs.length);
		for(let i = 0; i < bs.length; i++){
			b = bs[i];
			cpUnselectOrder({reference: b.id});
		}
		showBulkSelectButton("cp","unselectAll");
	}
}

function cpSelectOrder(o){
	if(o.reference){
	  console.log(`cp selecting order ${o.reference}`);
	  b = $(`button#cp-${o.reference}`);
	  if(b){
		   b.attr('disabled',true);
		   
		   $(`#cp-unselect_${o.reference}`).fadeIn();
		  let ss = cpOrders.find(i => i.reference == o.reference);
		  //console.log('us: ',us);
		  if(ss){
			ss.selected = true;  
		  }
		  else{
			cpOrders.push({reference: o.reference,selected: true});  
		  }
		  
		  
	  }
	  
	}
}

function cpUnselectOrder(o){
	if(o.reference){
	  console.log(`unselecting order ${o.reference}`);
	  b = $(`button#cp-${o.reference}`);
	  
	  if(b){
		  b.attr('disabled',false);
		  $(`#cp-unselect_${o.reference}`).hide();
		  let us = cpOrders.find(i => i.reference == o.reference);
		  //console.log('us: ',us);
		  
		  if(us){
		    us.selected = false;
		  }
	  }
	  
	}
}

function pqSelectAllProducts(){
	console.log("selecting all products");
    bs = $('button.p');
	
	if(bs){
		console.log(bs.length);
		for(let i = 0; i < bs.length; i++){
			b = bs[i];
			pqSelectProduct({sku: b.id.substring(3)});
		}
	    showBulkSelectButton("pq","selectAll");
	
	}
}

function pqUnselectAllProducts(){
	console.log("unselecting all products");
     bs = $('button.p');
	
	if(bs){
		console.log(bs.length);
		for(let i = 0; i < bs.length; i++){
			b = bs[i];
			pqUnselectProduct({sku: b.id.substring(3)});
		}
		showBulkSelectButton("pq","unselectAll");
	}
}

function pqSelectProduct(prd){
	if(prd.sku){
	  console.log(`pq selecting product ${prd.sku}`);
	  p = $(`button#pq-${prd.sku}`);
	  if(p){
		   p.attr('disabled',true);
		   
		   $(`#pq-unselect_${prd.sku}`).fadeIn();
		  let pp = pqProducts.find(i => i.sku == prd.sku);
		  console.log('pp: ',pp);
		 
		  if(pp){
			pp.selected = true;  
		  }
		  else{
			pqProducts.push({sku: prd.sku,selected: true});  
		  }
	
		  
		  
	  }
	  
	}
}

function pqUnselectProduct(p){
	if(p.sku){
	  console.log(`pq unselecting product ${p.sku}`);
	  b = $(`button#pq-${p.sku}`);
	  
	  if(b){
		  b.attr('disabled',false);
		  $(`#pq-unselect_${p.sku}`).hide();
		  let us = pqProducts.find(i => i.sku == p.sku);
		  //console.log('us: ',us);
		   if(us){
		     us.selected = false;
		   }
	  }
	  
	}
}

function hideUnselects(){
	$('#tracking-unselect-all').hide();
	$('.tracking-unselect').hide();
	$('#cp-unselect-all').hide();
	$('.cp-unselect').hide();
	$('#pq-unselect-all').hide();
	$('.pq-unselect').hide();
}

function hideSelectErrors(){
	$('#tracking-select-order-error').hide();
	$('#tracking-select-status-error').hide();
	$('#cp-select-order-error').hide();
	$('#cp-select-status-error').hide();
	$('#pq-select-product-error').hide();
	$('#pq-select-qty-error').hide();
}

function showSelectError(type,err){
	$(`#${type}-select-${err}-error`).fadeIn();
}

function BUUPAddRow(){
	
}

function BUPEditStock(dt){
	$(`#bup-${dt.sku}-side1`).hide();
	$(`#bup-${dt.sku}-side2`).fadeIn();
	let BUPitem = BUPlist.find(i => i.sku == dt.sku);
		  console.log('BUPitem: ',BUPitem);
		 
		  if(BUPitem){
			BUPitem.selected = true;  
		  }
		  else{
			BUPlist.push({sku: dt.sku,selected: true});  
		  }
}

function BUPCancelEditStock(dt){
	$(`#bup-${dt.sku}-side2`).hide();
	$(`#bup-${dt.sku}-side1`).fadeIn();
	let BUPitem = BUPlist.find(i => i.sku == dt.sku);
		  console.log('BUPitem: ',BUPitem);
		 
		  if(BUPitem){
			BUPitem.selected = false;  
		  }
}

function hideElems(cls){
	switch(cls){
		case 'bup':
		  $('#bup-select-product-error').hide();
		  $('#bup-select-qty-error').hide();
		break;
		
		case 'buup':
		  $('#buup-select-product-error').hide();
		  $('#buup-select-qty-error').hide();
		break;
	}
}

function BUP(){
	hideElems('bup');
	console.log("BUPlist length: ",BUPlist.length);
	if(BUPlist.length < 1){
		showSelectError('bup','product');
	}
	else{
	ret = [],  BUPIsAllUnselected = true, hasUnfilledQty = false;
	
	for(let i = 0; i < BUPlist.length; i++){
		let BUPitem = BUPlist[i];
		if(BUPitem.selected){
			let BUPItemQty = $(`#bup-${BUPitem.sku}-side2 > input[type=number]`).val();
			console.log("qty: ",BUPItemQty);
			if(BUPItemQty && parseInt(BUPItemQty) > 0){
				ret.push({sku: BUPitem.sku,qty: BUPItemQty});
			}
			else{
				hasUnfilledQty = true;
			}
			BUPIsAllUnselected = false;
		}
	}
	   if(hasUnfilledQty){
		   showSelectError('bup','qty');
	   }
	   else if(BUPIsAllUnselected){
		showSelectError('bup','product');
	   }
	   else{
		 console.log("ret: ",ret);
		$('#bup-dt').val(JSON.stringify(ret));
		$('#bup-form').submit();   
	   }
  }
}

function BUUP(){
	hideElems('buup');
	console.log("BUUPlist length: ",BUUPlist.length);
	if(BUUPlist.length < 1){
		showSelectError('buup','product');
	}
	else{
	ret = [], hasUnfilledQty = false;
	/**
	for(let i = 0; i < BUPlist.length; i++){
		let BUPitem = BUPlist[i];
		if(BUPitem.selected){
			let BUPItemQty = $(`#bup-${BUPitem.sku}-side2 > input[type=number]`).val();
			console.log("qty: ",BUPItemQty);
			if(BUPItemQty && parseInt(BUPItemQty) > 0){
				ret.push({sku: BUPitem.sku,qty: BUPItemQty});
			}
			else{
				hasUnfilledQty = true;
			}
			BUPIsAllUnselected = false;
		}
	}
	   if(hasUnfilledQty){
		   showSelectError('bup','qty');
	   }
	   else if(BUPIsAllUnselected){
		showSelectError('bup','product');
	   }
	   else{
		 console.log("ret: ",ret);
		$('#bup-dt').val(JSON.stringify(ret));
		$('#bup-form').submit();   
	   }
	   **/
  }
}

