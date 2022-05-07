<?php
ob_start();
session_start();
$pageTitle = 'Home';
include 'config.php';
?>


<!-- PreLoader-->
<!-- <div class="loader">
	<div class="loader-inner">
		<div class="circle"></div>
	</div>
</div> -->
<!--PreLoader Ends -->


<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p>See more Details</p>
					<h1>Single Product</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end breadcrumb section -->
<?php

$item_id = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
$statement = $con->prepare("SELECT * FROM items WHERE Item_ID = ? LiMIT 1");
$statement->execute(array($item_id));
$item = $statement->fetch();
$count = $statement->rowCount();
$cid = $item['code'];
if ($count > 0) { ?>
	<!-- single product -->
	<div class="single-product mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<div class="single-product-img">
						<img src="<?php echo $item['Imge'] ?>" alt="">
					</div>
				</div>
				<div class="col-md-7">
					<div class="single-product-content">
						<h3><?php echo $item['Name'] ?></h3>
						<p class="single-product-pricing"><span>Per Kg</span> <?php echo $item['Price'] ?></p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta sint dignissimos, rem commodi cum voluptatem quae reprehenderit repudiandae ea tempora incidunt ipsa, quisquam animi perferendis eos eum modi! Tempora, earum.</p>
						<div class="single-product-form">
							<form action="cart.php?product_id=<?= $item['Item_ID'] ?>" method="post">
								<input type="number" name="quantity" value="1" min="1" placeholder="Quantity" required>
								<input type="hidden" name="product_id" value="<?= $item['Item_ID'] ?>">
							</form>
							<a href="cart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
							<p><strong>Categories: </strong><?php echo $item['code'] ?></p>
						</div>
						<h4>Share:</h4>
						<ul class="product-share">
							<li><a href=""><i class="fab fa-facebook-f"></i></a></li>
							<li><a href=""><i class="fab fa-twitter"></i></a></li>
							<li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
							<li><a href=""><i class="fab fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end single product -->

	<!-- more products -->
	<div class="more-products mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3><span class="orange-text">Related</span> Products</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
					</div>
				</div>
			</div>
			<?php
			$NumComment = 3;
			$statement = $con->prepare("SELECT * FROM items WHERE code ='$cid'
										ORDER BY Item_ID DESC LIMIT $NumComment
					");
			$statement->execute();
			$items = $statement->fetchAll();
			if (!empty($items)) {
			?>

				<div class="row">
					<?php
					foreach ($items as $item) {
						echo '	<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.php?itemid=' . $item['Item_ID'] . '"><img src="' . $item['Imge'] . '" alt=""></a>
						</div>
						<h3>' . $item['Name'] . '</h3>
						<p class="product-price"><span>' . $item['Description'] . '</span>' . $item['Price'] . '</p>
						<a href="cart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
					</div>
				</div>';
					} ?>
				</div>
		</div>
	</div>
	<!-- end more products -->
<?php
			}
		}
?>

<?php
include $tmpl . 'footer.php';
?>