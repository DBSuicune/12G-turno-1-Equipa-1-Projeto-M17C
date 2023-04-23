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
	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="js.js"></script>

	<style>
		.single-product {
		border: 1px solid #ddd;
		padding: 10px;
		background-color: #fff;
		box-shadow: 0 0 10px rgba(0,0,0,0.1);
		border-radius: 5px;
		}
		.single-product img {
		max-width: 100%;
		}
		.single-product h6 {
		margin-top: 10px;
		}
		.price {
		display: flex;
		justify-content: space-between;
		align-items: center;
		}
		.price h6 {
		margin: 0;
		font-weight: 600;
		}
		.price .l-through {
		margin: 0 10px 0 0;
		color: #999;
		font-weight: 400;
		font-size: 14px;
		text-decoration: line-through;
		}

		.owl-nav {
			border-radius: 13px;
			z-index: 999;
			bottom: 0!important;
			background-color: rgba(0,0,0,0.4);
		}

	</style>


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
								<a href="category.php" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
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
		<div class="container">
			<div class="row fullscreen align-items-center justify-content-start">
				<div class="col-lg-12">
					<div class="active-banner-slider owl-carousel" id="first-3-itens">
						<!-- single-slide -->
						<div class="row single-slide align-items-center d-flex">
							<div class="col-lg-5 col-md-6">
								<div class="banner-content">
									<h1>Nova Coleção <br>T-shirt!</h1>
									<p>Veja A nossa nova coleção de t-shirts com todo o tipo de desenhos e estilos para todas as idades e gostos</p>
									
								</div>
							</div>
							<div class="col-lg-7">
								<div class="banner-img">
									<img class="img-fluid" src="img/products/gogh.png" alt="">
								</div>
							</div>
						</div>
						<!-- single-slide -->
						<div class="row single-slide align-items-center d-flex">
							<div class="col-lg-5">
								<div class="banner-content">
									<h1>Nova Coleção<br>Shrek!</h1>
									<p>Explore a nossa nova coleção de produtos da categoria shrek, perfeita para os pequenotes</p>
									
								</div>
							</div>
							<div class="col-lg-7">
								<div class="banner-img">
									<img class="img-fluid" src="img/products/shrek.png" alt="">
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End banner Area -->

	<!-- start features Area -->
	<section class="features-area section_gap">
		<div class="container">
			<div class="row features-inner">
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon1.png" alt="">
						</div>
						<h6>Entrega Gratis</h6>
						<p>Entrega gratis em todos os produtos</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon2.png" alt="">
						</div>
						<h6>Politica de retorno</h6>
						<p>Devoluções disponiveis para todos os produtos</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon3.png" alt="">
						</div>
						<h6>suporte 24/7</h6>
						<p>Sempre atentos para lhe ajudar</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon4.png" alt="">
						</div>
						<h6>Pagamento seguro</h6>
						<p>Ultimas novidades de segurança</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end features Area -->

	

	<!-- start product Area -->
	<section class="owl-carousel active-product-area section_gap">
		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Ultimas novidades</h1>
							<p>Veja Todos os nosso produtos mais recentes </p>
						</div>
					</div>
				</div>
				<div class="row" id="last_news">
					<!-- single product -->
					<?php
					include "db.php";
					
					$sql = "SELECT products.id, products.Name as product_name, products.Description, products.price, product_photo.photo, products.date_created from products
					Inner JOIN product_photo ON products.id = product_photo.product_id Order by products.date_created DESC LIMIT 8
					;";

					$result = mysqli_query($conn, $sql);
					$rows = array();

					while($row = mysqli_fetch_assoc($result)) {
						$rows[] = $row;
					}
					$products = $rows;
					$numbers= array();					
					for ($i=0; $i<8; $i++){
						do{
							$random = rand(0, count($products)-1);
						}while(in_array($random, $numbers));
						$numbers[] = $random;
						echo '<!-- single product -->';
						echo '<div class="col-lg-3 col-md-6">';
						echo '	<div class="single-product">';
						echo '		<img class="img-fluid"  style="height:300px; width:300px; object-fit:contain;cursor:pointer;" src="img/products/' . $products[$random]['photo'] . '" onclick="single_product(' . $products[$random]['id'] . ')")>';
						echo '		<div class="product-details">';
						echo '			<h6>' . $products[$random]['product_name'] . '</h6>';
						echo '			<div class="price">';
						echo '				<h6>' . $products[$random]['price'] . '€</h6>';										
						echo '			</div>';
						echo '			<div class="prd-bottom">';
						echo '				<a href="#" class="social-info" onclick="add_item_cart(' . $products[$random]['id'] . ')">';
						echo '					<span class="ti-bag"></span>';
						echo '					<p class="hover-text">carrinho</p>';
						echo '				</a>';
						echo '				<a href="#" class="social-info" onclick="wishlist()">';
						echo '					<span class="lnr lnr-heart"></span>';
						echo '					<p class="hover-text">Desejos</p>';
						echo '				</a>';									
						echo '			</div>';
						echo '		</div>';
						echo '	</div>';
						echo '</div>';
					}
					
					?>


					
					
					
					

					

					
				</div>
			</div>
		</div>
		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Produtos por vir</h1>
							<p>Verifique todos os produtos que estão a caminho da nossa loja</p>
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
									
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end product Area -->

	<!-- Start brand Area -->
	<section class="brand-area section_gap">
		<div class="container">
			<div class="row">
				<a class="col single-img ma" href="https://www.aemtg.pt" target="_blank">
					<img class="img-fluid d-block mx-auto" src="img/brand/1.png" alt="">
				</a>
				<a class="col single-img ma" href="https://dge.mec.pt" target="_blank">
					<img class="img-fluid d-block mx-auto" src="img/brand/2.png" alt="">
				</a>
				<a class="col single-img ma" href="https://www.w3schools.com/" target="_blank">
					<img class="img-fluid d-block mx-auto" src="img/brand/3.png" alt="">
				</a>
				<a class="col single-img ma" href="https://github.com/DBSuicune/12G-turno-1-Equipa-1-Projeto-M17C" target="_blank">
					<img class="img-fluid d-block mx-auto" src="img/brand/4.png" alt="">
				</a>
				
			</div>
		</div>
	</section>
	<!-- End brand Area -->

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
							<li><img style="width: 56px; height: 56px;" src="img/products/0a02e539-dcbc-43e1-bd1a-c2dc1a146198_1.png" alt=""></li>
							<li><img style="width: 56px; height: 56px;" src="img/products/08a7c076b6746f34a16902ce2610cc10c5e1064b.jpg" alt=""></li>
							<li><img style="width: 56px; height: 56px;" src="img/products/100_cheiroso.jpg" alt=""></li>
							<li><img style="width: 56px; height: 56px;" src="img/products/FpHa_BIaQAET34I.png" alt=""></li>
							<li><img style="width: 56px; height: 56px;" src="img/products/gogh.png" alt=""></li>
							<li><img style="width: 56px; height: 56px;" src="img/products/lidl-tenis.png" alt=""></li>
							<li><img style="width: 56px; height: 56px;" src="img/products/hmgoepprod.png" alt=""></li>
							<li><img style="width: 56px; height: 56px;" src="img/products/shrek.png" alt=""></li>
							
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