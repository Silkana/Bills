'use strict';
$(document).ready(function(){
	if(!window.cart){
		window.cart = new Cart();
	}


});
	function restock(id, quantity){

		$(".quantity_"+ id).text(parseInt($(".quantity_"+ id).text()) + parseInt($(".quantity2_"+ id).val()));		
		

		console.log(parseInt($(".input_quantity_"+ id).val()));

	}