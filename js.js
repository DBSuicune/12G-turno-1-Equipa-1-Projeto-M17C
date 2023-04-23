$(document).ready(function(){
    update_display_products();
});

document.getElementById('limit-price').addEventListener('input', update_max_price);
price_filter = 0;
selectedValues = [];

const checkboxes = document.querySelectorAll('input[name="categoria[]"]');
checkboxes.forEach(checkbox => {
  checkbox.addEventListener('change', updateCategoryList);
});
function updateCategoryList() {
    let selectedCheckboxes = document.querySelectorAll('input[name="categoria[]"]:checked');   
  
    selectedCheckboxes.forEach(checkbox => {
        selectedValues.push(checkbox.value);
    });  
    update_display_products(selectedValues,price_filter);
    selectedValues = [];
}

function add_item_cart(id){
    $.ajax({
        url: "add_item_cart.php",
        type: "POST",
        data: {id: id},
        success: function(data){
            alert('id: '+id+' foi adicionado ao carrinho');
        }
    });
}
function single_product(id){
    window.location.href = "single-product.php?id="+id;
}
function wishlist(){
    alert('wishlist nao está disponivel de momento');
}
function update_max_price(){
    value = document.getElementById('limit-price').value;
    document.getElementById('max-price').textContent = value;
    price_filter = value;
    update_display_products(selectedValues,price_filter);
}

function update_display_products(categories = [], price_filter = 0, order = ''){
    document.getElementById('display-products-by-category').innerHTML = '';
    
    var comando = "SELECT DISTINCT products.id, products.Name AS product_name, products.Description, products.price, product_photo.photo, products.date_created FROM products INNER JOIN product_photo ON products.id = product_photo.product_id INNER JOIN product_category ON products.id = product_category.products_id INNER JOIN category ON product_category.category_id = category.id";
    if (categories.length > 0 || price_filter > 0) {
    comando += " WHERE ";
    } 
    
    if (categories.length > 0 && price_filter > 0) {
    comando += "products.price < " + price_filter + " AND ";
    }

    if (categories.length > 0) {
    comando += "category.id IN (" + categories.join(",") + ")"; 
    }
   
    else if (price_filter > 0 && categories.length == 0) {
    comando += "products.price < " + price_filter;
    }
    else if (price_filter > 0) {
    comando += " AND products.price < " + price_filter; 
    }
    if (categories.length > 0) {
        comando += " GROUP BY product_id HAVING COUNT(*) = " + categories.length;
    }    
    $.ajax({
        url: "update_display_products.php",
        type: "POST",
        data: {comando: comando},
        success: function(data){        
        $products = JSON.parse(data);
        $products.forEach($product => {            
            document.getElementById('display-products-by-category').innerHTML+=`
            <!-- single product -->
            <div class="col-lg-3 col-md-6">
            	<div class="single-product">
            		<img class="img-fluid"  style="height:300px; width:300px; object-fit:contain;cursor:pointer;" src="img/products/${$product.photo}" onclick="single_product(${$product.id})")>'
            		<div class="product-details">
            			<h6>${$product.product_name}</h6>
            			<div class="price">
            				<h6>${$product.price}€</h6>								
            			</div>
            			<div class="prd-bottom">
            				<a href="#" class="social-info" onclick="add_item_cart(${$product.id})">
            					<span class="ti-bag"></span>
            					<p class="hover-text">carrinho</p>
            				</a>
            				<a href="#" class="social-info" onclick="wishlist()">
            					<span class="lnr lnr-heart"></span>
            					<p class="hover-text">Desejos</p>
            				</a>							
            			</div>
            		</div>
            	</div>
            </div>
        
        `;

            
        });

        
        
        }

    });


    
}
