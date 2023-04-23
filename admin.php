<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>Karma Shop</title>
	<!--
		CSS
		============================================= -->
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/ion.rangeSlider.css" />
	<link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/admin.css">
	
	<script>
		// função para fechar o popup com o escape
		document.addEventListener('keydown', function(event) {
		if (event.key === "Escape" || event.key === "Esc") {
			if (document.getElementById('pop-up').style.display == "block") {
				closePopup();
			}
		}
		});
		function show_big_image(url){			
			const popup = document.createElement('div');
			popup.classList.add('BigImagePopup');
			const content = document.createElement('div');
			content.classList.add('popup-content');
			const img = document.createElement('img');
			img.setAttribute('src', url);
			img.style.width = '500px';
			img.style.height = '500px';
			content.appendChild(img);
			popup.appendChild(content);
			document.body.appendChild(popup);
			popup.addEventListener('click', function(e) {
				if (e.target === popup) {
					popup.remove();
				}
			});			
		}

		// função para enviar os dados para adicionar uma categoria
		function add_category(){
			let category = prompt("Introduza o nome da nova categoria: ");			
			$.ajax({
				url: 'add_category.php',
				type: 'POST',
				data: {category: category},
				success: function(data){
					console.log(data);	
					update_category();				
				},
				error: function(data){
					alert("Erro ao adicionar categoria!\nTente novamente mais tarde ou tente mudar o nome da categoria.");
					update_category();
				}
			});	  		
		}
		function update_category(){
    		$('#category').children().remove();
			$.ajax({
				url: 'get_category.php',
				type: 'POST',
				success: function(data){
					let categories = JSON.parse(data);
					for (i in categories) {
						$('#category').append(`
							<div>
								<label>
									<input type="checkbox" name="category[]" value="${categories[i].id}">
									<span>${categories[i].Name}</span>
								</label>
							</div>
						`);
					}					
					$('#category').append(`
						<div>
							<label>									
								<span style="width: 25px;text-align: center;" onclick="add_category()">+</span>
							</label>
						</div>
					`);
				}
			});		
		}

		function send_product_data(){
			document.getElementById('infos').classList.remove = 'alert alert-danger';
			let name = document.getElementById('product-name').value;
			let description = document.getElementById('product-description').value;
			let price = document.getElementById('product-price').value;
			price = parseFloat(price);
			let category = document.getElementsByName('category[]');category
			let category_id = [];			
			for (i in category) {
				if (category[i].checked) {
					category_id.push(category[i].value);
				}
			}
			let image = document.getElementById('imageFile').files[0];
			if (image == undefined) {
				document.getElementById('infos').classList = 'alert alert-danger';
				alert("Tem de selecionar uma imagem!");
				return;
			}
			let form_data = new FormData();
			image = image.name;
			form_data.append('name', name);
			form_data.append('description', description);
			form_data.append('price', price);
			form_data.append('category', category_id);
			form_data.append('image', image);
			$.ajax({
				url: 'add_product.php',
				type: 'POST',
				data: form_data,
				contentType: false,
				cache: false,
				processData: false,
				success: function(data){
					saveImage('products');
					console.log(data);
					alert('Produto adicionado com sucesso!');
					closePopup();
				},
				error: function(jqXHR, textStatus, errorThrown){
    			    var errorResponse = JSON.parse(jqXHR.responseText);
    				alert(errorResponse.error);
					document.getElementById('infos').classList = 'alert alert-danger';
    			}
			});
			
			
		}


		function popup(){
			window.scrollTo(0,0); 
			document.getElementById('pop-up').style.display = "block";
			document.body.style.overflow = "hidden";				
		}
		function closePopup(){
			document.getElementById('pop-up').style.display = "none";
			document.body.style.overflow = "auto";
			document.getElementById('infos').classList = '';			
			$('#infos').children().remove();
		}
        function previewImage() {
            const fileInput = document.getElementById('imageFile');
            const previewImage = document.getElementById('previewImage');
            const file = fileInput.files[0];
            const reader = new FileReader();


            reader.addEventListener('load', function() {
                previewImage.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
		function see_purchase(){
			popup();
			const infosDiv = document.getElementById('infos');
			const newDiv = document.createElement('div');
			newDiv.classList.add('display-buys');
			infosDiv.appendChild(newDiv);
			$('.display-buys').children().remove();
			document.getElementById('infos').innerHTML = `
				<table>
					<tr>
						<th>ID</th>
						<th>Utilizador</th>						
						<th>produtos</th>
						<th>Data da compra</th>
						<th>Estado</th>
					</tr>
				</table>
			`;
			$.ajax({
				url: 'get_purchase.php',
				type: 'POST',
				success: function(data){
					let purchases = JSON.parse(data);
					for (purchase in purchases) {
						$('table').append(`
							<tr>
								<td>${purchases[purchase].id}</td>
								<td>${purchases[purchase].user_name}</td>
								<td class= "ul-products-${purchases[purchase].id}"> 
									
								</td>
								<td>${purchases[purchase].date}</td>
								<td id="state-${purchases[purchase].id}"></td>							
							</tr>
						`);		
						const td = document.getElementById('state-' + purchases[purchase].id);		
						if (purchases[purchase].state_name == "pendente") {
							td.style.color = "purple";
							const selectInput = document.createElement("select");
							selectInput.setAttribute("id", "select-" + purchases[purchase].id);
							selectInput.setAttribute("onchange", "verify_state_change(" + purchases[purchase].id + ")");
							selectInput.innerHTML = `							
								<option disabled value="pendente" selected>Pendente</option>
								<option value="aceito">aceito</option>
								<option value="recusado">recusado</option>							
							`;
							td.append(selectInput);				
							
						} else if (purchases[purchase].state_name == "aceito") {
							td.style.color = "green";
							td.textContent = "aceito";
						} else if (purchases[purchase].state_name == "recusado") {
							td.style.color = "red";
							td.textContent = "recusado";
						}
						purchase_itens_update(purchases[purchase].id);						
					}		
				}
			});	
		}
		function verify_state_change($id){
			if (confirm("Tem a certeza que quer alterar o estado da compra?")) {
			update_purchase_state($id, document.getElementById('select-' + $id).value);
			}
		}
		function update_purchase_state(id, state){
			$.ajax({
				url: 'update_purchase_state.php',
				type: 'POST',
				data: {id: id, state: state},
				success: function(data){
					console.log(data);
					see_purchase();
				},
				error: function(jqXHR, textStatus, errorThrown){					
				    var errorResponse = JSON.parse(jqXHR.responseText);
					alert(errorResponse.error);
				}
				
			});
		}

		function purchase_itens_update(id){			
			$.ajax({
				url: 'get_purchase_itens.php',
				type: 'POST',
				data: {id: id},
				success: function(data){					
					let itens = JSON.parse(data);
					for (item in itens) {
						$(`.ul-products-${id}`).append(`
							<ul style="list-style:inside">
								<li>${itens[item].Name}</li>								
							</ul>
						`);
					}		
				}				
			});			


		}




		function add_product(){
			popup();
			update_category();						
			document.getElementById('infos').innerHTML = `
			<h1>Adicionar Produto</h1>	
			<div class="add-product">						
					<div class="image">
						<img id="previewImage" alt="Preview Image" width="350" src="img/users/default.png"> <br>
						<input type="file" id="imageFile" name="imageFile" onchange="previewImage()" required> <br>						
					</div>
					<div class="product-information">
						<p>Nome do Produto</p>
						<input type="text" name="product-name" id="product-name" required>
						<p>Descrição do produto</p>
						<textarea name="product-description" id="product-description" cols="100" rows="10"></textarea>
						<p>Preço</p>
						<input type="number" name="product-price" id="product-price" required>
						<p>Categoria</p>
						<div class="category" id="category">	
						</div>	
					</div>
			</div>
				<div class="add-product-submit">
					<button onclick="send_product_data()">Adicionar</button>
				</div>   
 			`;
		}
		function see_products(){
			popup();
			const infosDiv = document.getElementById('infos');
			const newDiv = document.createElement('div');
			newDiv.classList.add('display-products');
			infosDiv.appendChild(newDiv);
			$('.display-products').children().remove();
			$.ajax({
				url: 'get_products.php',
				type: 'POST',
				success: function(data){
					let products = JSON.parse(data);
					for (item in products) {
						$('.display-products').append(`
						<div class="product">
							<h2>${products[item].product_name}</h2>
							<p>${products[item].Description}</p>
							<p>Price: ${products[item].price}</p>                            
							<a href="single-product.php?id=${products[item].id}">Product ${products[item].id} Link</a> <br>
							<img style="width: 100px;  height: 100px;" src="img/products/${products[item].photo}" alt="${products[item].product_name} Image Preview" onclick="show_big_image('img/products/${products[item].photo}')">
						</div>
						`);
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert('error');

				}
			});


		}
		function see_users(){
			popup();
			const infosDiv = document.getElementById('infos');
			const newDiv = document.createElement('div');
			newDiv.classList.add('display-users');
			infosDiv.appendChild(newDiv);
			$('.display-users').children().remove();
			document.getElementById('infos').innerHTML = `
				<table>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Join Date</th>
						<th>Birthday</th>
						<th>Email</th>
						<th>Phone</th>
					</tr>
				</table>
			`;
			$.ajax({
				url: 'get_users.php',
				type: 'POST',
				success: function(data){
					let users = JSON.parse(data);
					for (user in users) {
						$('table').append(`
							<tr>
							<td>${users[user].id}</td>
							<td>${users[user].name}</td>
							<td>${users[user].Join_Date}</td>
							<td>${users[user].Birthday}</td>
							<td>${users[user].email}</td>
							<td>${users[user].phone}</td>
					</tr>
						`);
					}				
					
				}
			});	
			
		}

		function saveImage(type){			
			if (type == 'users' || type == 'products'){
			let image = document.getElementById('imageFile').files[0];
			let form_data = new FormData();
			form_data.append('type', type);
			form_data.append('image', image);
			$.ajax({
				url: 'saveImage.php',
				type: 'POST',
				data: form_data,
				contentType: false,
				cache: false,
				processData: false,
				success: function(data){
					console.log(data);
				},
				error: function(jqXHR, textStatus, errorThrown){
				    alert("Error: " + errorThrown + "\n" + jqXHR.responseText);
				}				
			});
			}		
		}




    </script>

</head>

<body>

	<!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="index.php"><img src="img/logo.png" alt=""></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
							<li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Shop</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="category.php">Shop Category</a></li>
									
									
								</ul>
							</li>
							
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Pages</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
									
									
								</ul>
							</li>
							<li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="nav-item"><a href="cart.php" class="cart"><span class="ti-bag"></span></a></li>
							<li class="nav-item">
								<button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div class="search_input" id="search_input_box">
			<div class="container">
				<form class="d-flex justify-content-between">
					<input type="text" class="form-control" id="search_input" placeholder="Search Here">
					<button type="submit" class="btn"></button>
					<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
				</form>
			</div>
		</div>
	</header>
	<!-- End Header Area -->

	<!-- start banner Area -->
	<section class="banner-area">
		<div class="color-filter"></div>
		<div class="container" >
			<div class="row fullscreen align-items-center justify-content-start">
                <div id="center" style="z-index: 2;">
				    <div class="adm-square" onclick="see_purchase()">
                        <p >Ver Pagamentos</p> 
                    </div>
                    <div class="adm-square" onclick="add_product()">
                        <p>Adicionar produtos</p>                       
                    </div>
                    <div class="adm-square" onclick="see_products()">
                        <p>Ver Produtos</p>                        
                    </div>
                    <div class="adm-square" onclick="see_users()">
                        <p>Ver Utilizadores</p>                        
                    </div>
                </div>

			</div>
		</div>
	</section>
	<!-- End banner Area -->

    <!-- Start popup zone -->   


    <div id="pop-up" class="hidden">
        <div id="close" onclick="closePopup()">
            <p></p>            
        </div>
        <div id="infos">							

        </div>
        

    </div>

    <!-- End popup zone -->
	

	<!-- start product Area -->
	<section class="owl-carousel active-product-area section_gap">
		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Latest Products</h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
								dolore
								magna aliqua.</p>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/p1.jpg" alt="">
							<div class="product-details">
								<h6>addidas New Hammer sole
									for Sports person</h6>
								<div class="price">
									<h6>$150.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
								<div class="prd-bottom">

									<a href="" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-sync"></span>
										<p class="hover-text">compare</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/p2.jpg" alt="">
							<div class="product-details">
								<h6>addidas New Hammer sole
									for Sports person</h6>
								<div class="price">
									<h6>$150.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
								<div class="prd-bottom">

									<a href="" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-sync"></span>
										<p class="hover-text">compare</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/p3.jpg" alt="">
							<div class="product-details">
								<h6>addidas New Hammer sole
									for Sports person</h6>
								<div class="price">
									<h6>$150.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
								<div class="prd-bottom">
									<a href="" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-sync"></span>
										<p class="hover-text">compare</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/p4.jpg" alt="">
							<div class="product-details">
								<h6>addidas New Hammer sole
									for Sports person</h6>
								<div class="price">
									<h6>$150.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
								<div class="prd-bottom">

									<a href="" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-sync"></span>
										<p class="hover-text">compare</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/p5.jpg" alt="">
							<div class="product-details">
								<h6>addidas New Hammer sole
									for Sports person</h6>
								<div class="price">
									<h6>$150.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
								<div class="prd-bottom">

									<a href="" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-sync"></span>
										<p class="hover-text">compare</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/p6.jpg" alt="">
							<div class="product-details">
								<h6>addidas New Hammer sole
									for Sports person</h6>
								<div class="price">
									<h6>$150.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
								<div class="prd-bottom">

									<a href="" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-sync"></span>
										<p class="hover-text">compare</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/p7.jpg" alt="">
							<div class="product-details">
								<h6>addidas New Hammer sole
									for Sports person</h6>
								<div class="price">
									<h6>$150.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
								<div class="prd-bottom">

									<a href="" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-sync"></span>
										<p class="hover-text">compare</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/p8.jpg" alt="">
							<div class="product-details">
								<h6>addidas New Hammer sole
									for Sports person</h6>
								<div class="price">
									<h6>$150.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
								<div class="prd-bottom">

									<a href="" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-sync"></span>
										<p class="hover-text">compare</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Coming Products</h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
								dolore
								magna aliqua.</p>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/p6.jpg" alt="">
							<div class="product-details">
								<h6>addidas New Hammer sole
									for Sports person</h6>
								<div class="price">
									<h6>$150.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
								<div class="prd-bottom">

									<a href="" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-sync"></span>
										<p class="hover-text">compare</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/p8.jpg" alt="">
							<div class="product-details">
								<h6>addidas New Hammer sole
									for Sports person</h6>
								<div class="price">
									<h6>$150.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
								<div class="prd-bottom">

									<a href="" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-sync"></span>
										<p class="hover-text">compare</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/p3.jpg" alt="">
							<div class="product-details">
								<h6>addidas New Hammer sole
									for Sports person</h6>
								<div class="price">
									<h6>$150.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
								<div class="prd-bottom">

									<a href="" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-sync"></span>
										<p class="hover-text">compare</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/p5.jpg" alt="">
							<div class="product-details">
								<h6>addidas New Hammer sole
									for Sports person</h6>
								<div class="price">
									<h6>$150.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
								<div class="prd-bottom">

									<a href="" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-sync"></span>
										<p class="hover-text">compare</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/p1.jpg" alt="">
							<div class="product-details">
								<h6>addidas New Hammer sole
									for Sports person</h6>
								<div class="price">
									<h6>$150.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
								<div class="prd-bottom">

									<a href="" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-sync"></span>
										<p class="hover-text">compare</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/p4.jpg" alt="">
							<div class="product-details">
								<h6>addidas New Hammer sole
									for Sports person</h6>
								<div class="price">
									<h6>$150.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
								<div class="prd-bottom">

									<a href="" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-sync"></span>
										<p class="hover-text">compare</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/p1.jpg" alt="">
							<div class="product-details">
								<h6>addidas New Hammer sole
									for Sports person</h6>
								<div class="price">
									<h6>$150.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
								<div class="prd-bottom">

									<a href="" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-sync"></span>
										<p class="hover-text">compare</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/p8.jpg" alt="">
							<div class="product-details">
								<h6>addidas New Hammer sole
									for Sports person</h6>
								<div class="price">
									<h6>$150.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
								<div class="prd-bottom">

									<a href="" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">add to bag</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-heart"></span>
										<p class="hover-text">Wishlist</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-sync"></span>
										<p class="hover-text">compare</p>
									</a>
									<a href="" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end product Area -->

	<!-- start footer Area -->
	<footer class="footer-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Sobre Nós</h6>
						<p>
							Karma é uma loja de venda de roupa e acessórios de moda, com uma vasta gama de produtos para todos os gostos e idades.
						</p>
					</div>
				</div>
				<div class="col-lg-4  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Noticias</h6>
						<p>Fique a par de qualquer atualização</p>
						<div class="" id="mc_embed_signup">

							<form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
							 method="get" class="form-inline">

								<div class="d-flex flex-row">

									<input class="form-control" name="EMAIL" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email '"
									 required="" type="email">


									<button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
									<div style="position: absolute; left: -5000px;">
										<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
									</div>

									<!-- <div class="col-lg-4 col-md-4">
												<button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
											</div>  -->
								</div>
								<div class="info"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget mail-chimp">
						<h6 class="mb-20">Instragram Feed</h6>
						<ul class="instafeed d-flex flex-wrap">
							<li><img src="img/i1.jpg" alt=""></li>
							<li><img src="img/i2.jpg" alt=""></li>
							<li><img src="img/i3.jpg" alt=""></li>
							<li><img src="img/i4.jpg" alt=""></li>
							<li><img src="img/i5.jpg" alt=""></li>
							<li><img src="img/i6.jpg" alt=""></li>
							<li><img src="img/i7.jpg" alt=""></li>
							<li><img src="img/i8.jpg" alt=""></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Redes Sociais</h6>
						<p>Siga o nosso trabalho online</p>
						<div class="footer-social d-flex align-items-center">
							<a href="error" target="_blank"><i class="fa fa-facebook"></i></a>
							<a href="error" target="_blank"><i class="fa fa-twitter"></i></a>
							<a href="error" target="_blank"><i class="fa fa-dribbble"></i></a>
							<a href="error" target="_blank"><i class="fa fa-behance"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
				<p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</p>
			</div>
		</div>
	</footer>
	<!-- End footer Area -->

	<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/countdown.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>