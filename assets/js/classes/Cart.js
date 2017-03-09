function Cart(){
	this.products = {};
	this.cart_link = $(".cart_link");
	this.cart = $(".cart");
	this.isDisplayed = false;
}

	Cart.prototype.toggle = function() {
		if(this.isDisplayed){
			this.cart.hide();
			this.isDisplayed = false;
		}else{
			this.cart.show();
			this.isDisplayed = true;
		}
	}

	Cart.prototype.add = function(id, name, msrp, photo) {

		if(!this.products[id]){
			this.products[id] = {
				'id' : id,
				'count' : 1,
				'name' : name,
				'price' : msrp,
				'photo' : photo,
			}
		}else{
			var new_count = this.products[id].count + 1;
			this.products[id] = {
			'id' : id,
			'count' : new_count,
			'name' : name,
			'price' : msrp,
			'photo' : photo,	
			}
		}
		this.draw();

	}

	Cart.prototype.remove = function(id) {

		if(this.products[id] && this.products[id].count > 0){
			this.products[id].count -= 1;
		} 

		if(this.products[id].count===0){
			delete this.products[id];
		}

		this.draw();

	}

	Cart.prototype.draw = function() {

		// var basket = Object.keys(this.products);
		// var basketLen = basket.length;

		$(".cart-container").empty();
		var tr, td, product, input;
		var sum = 0;

		for (var index in this.products){
			product = this.products[index];
			
			var glyphPlus = $("<i class='glyphicon glyphicon-plus' onclick='cart.add("+product['id']+',"' + product['name'] + '",' + product['price'] + ',"' + product['photo'] +"\");'>");
			var glyphMinus = $("<i class='glyphicon glyphicon-minus' onclick='cart.remove("+product['id']+");'>");

			var count = product['count'];
			var price = product['price'];
			var subtotal = count * price;
			tr = $("<tr>");
			input = $("<input>");
			var img = $("<img>");




			td = $('<td>').text(product['name']);
			td2 = $('<td>').append(img.attr("src", product['photo']));
			td3 = $('<td>').append(input.attr('readonly', 'true').attr('name', 'products['+product['id']+']').val(product['count'] /* ou product.name */));
			td4 = $('<td>').append(glyphPlus);
			td5 = $('<td>').append(glyphMinus);
			td6  =$('<td>').text(product['price'] + '€');
			td7  =$('<td>').text(subtotal + '€');

			sum += subtotal;

			tr.append(td);
			tr.append(td2);
			tr.append(td3);
			tr.append(td4);
			tr.append(td5);
			tr.append(td6);
			tr.append(td7);
			$(".cart-container").append(tr);
		}
		$(".total").text(sum + '€');
	}	

	// Cart.prototype.subtotal = function(count, price){
	// 	return count * price;
	// }

	// Cart.prototype.total = function(sum, subtotal) {

	// 	return sum += subtotal;
	// };