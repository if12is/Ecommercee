	<!-- header -->

	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="home.php">
								<img src="themes/img/logoo.png" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li class="current-list-item"><a href="home.php">Home</a>
									<ul class="sub-menu">
										<li><a href="index.php">Static Home</a></li>
										<li><a href="index_2.php">Slider Home</a></li>
									</ul>
								</li>
								<li><a href="about.php">About</a></li>
								<li><a href="#">Pages</a>
									<ul class="sub-menu">
										<li><a href="404.php">404 page</a></li>
										<li><a href="about.php">About</a></li>
										<li><a href="cart.php">Cart</a></li>
										<li><a href="checkout.php">Check Out</a></li>
										<li><a href="contact.php">Contact</a></li>
										<li><a href="news.php">News</a></li>
										<li><a href="shop.php">Shop</a></li>
									</ul>
								</li>
								<li><a href="news.php">News</a>
									<ul class="sub-menu">
										<li><a href="news.php">News</a></li>
										<li><a href="single-news.php">Single News</a></li>
									</ul>
								</li>
								<li><a href="contact.php">Contact</a></li>
								<li><a href="shop.php">Shop</a>
									<ul class="sub-menu">
										<li><a href="shop.php">Shop</a></li>
										<li><a href="checkout.php">Check Out</a></li>
										<li><a href="single-product.php">Single Product</a></li>
										<li><a href="cart.php">Cart</a></li>
									</ul>
								</li>
								<li>
									<div class="header-icons">
										<a class="shopping-cart" href="cart.php"><i class="fas fa-shopping-cart"></i>
											<span class="badge rounded-pill badge-notification bg-danger" style="position: absolute;top: 13px;right: 54px;width: 15px;height: 15px;display: flex;justify-content: center;align-items: center;">
												<span>1</span>
										</a>

										<!-- user icon start -->
										<?php
										if (isset($_SESSION['login'])) {
											echo '<div class="dropdown">';
										}
										?>
										<a class="mobile-hide sign-in" style="right: 95px;" href="login.php" <?php
																												if (isset($_SESSION['login'])) {
																													echo 'class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"';
																												}
																												?>><i class="fas 
									<?php
									if (isset($_SESSION['login'])) {
										echo 'fa-user';
									} else {
										echo 'fa-sign-in-alt';
									}
									?>
									"></i>
											<?php
											if (isset($_SESSION['login'])) {
												echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
								<li><a class="dropdown-item" href="#">Action</a></li>
								<li><a class="dropdown-item" href="#">Another action</a></li>
								<li><a class="dropdown-item" href="#">Something else here</a></li>
								</ul>';
											}
											?>
										</a>
										<?php
										if (isset($_SESSION['login'])) {
											echo '</div>';
										}
										?>
									</div>
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon shopping-cart-show" href="#"><i class="fas fa-shopping-cart"></i>
							<span class="badge rounded-pill badge-notification bg-danger" style="position: absolute;top: -2px;right: -4px;width: 15px;height: 15px;display: flex;justify-content: center;align-items: center;">
								<span>1</span>
						</a>
						<!-- user icon start -->
						<?php
						if (isset($_SESSION['login'])) {
							echo '<div class="dropdown">';
						}
						?>
						<a class="mobile-show search-bar-icon login-show" style="right: 95px;" href="login.php" <?php
																												if (isset($_SESSION['login'])) {
																													echo 'class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"';
																												}
																												?>><i class="fas 
						<?php
						if (isset($_SESSION['login'])) {
							echo 'fa-user';
						} else {
							echo 'fa-sign-in-alt';
						}
						?>
						"></i>
							<?php
							if (isset($_SESSION['login'])) {
								echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
								<li><a class="dropdown-item" href="#">Action</a></li>
								<li><a class="dropdown-item" href="#">Another action</a></li>
								<li><a class="dropdown-item" href="#">Something else here</a></li>
								</ul>';
							}
							?>
						</a>
						<?php
						if (isset($_SESSION['login'])) {
							echo '</div>';
						}
						?>
						<!-- user icon End -->
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->