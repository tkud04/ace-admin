$(document).ready(function(){
	$('#add-discount-input').hide();
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
});