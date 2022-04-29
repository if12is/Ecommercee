<?php
ob_start();
session_start();
$pageTitle = 'Shop';
include 'config.php';

$status = "";
// $NoNavBar;
if (isset($_POST['code']) && $_POST['code'] != "") {
	$code = $_POST['code'];
	$result = $con->prepare("SELECT * FROM items WHERE code=$code");
	$result->execute();
	$items = $result->fetchAll();
	$name = $items['Name'];
	$desc = $items['Description'];
	$code = $items['code'];
	$price = $items['Price'];
	$image = $items['Imge'];

	$cartArray = array(
		$code => array(
			'name' => $name,
			'desc' => $desc,
			'code' => $code,
			'price' => $price,
			'quantity' => 1,
			'image' => $image
		)
	);


	if (empty($_SESSION["shopping_cart"])) {
		$_SESSION["shopping_cart"] = $cartArray;
		$status = "<div class='alert alert-success'>Product is added to your cart!</div>";
	} else {
		$array_keys = array_keys($_SESSION["shopping_cart"]);
		if (in_array($code, $array_keys)) {
			$status = "<div class='alert alert-danger' >
		Product is already added to your cart!</div>";
		} else {
			$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"], $cartArray);
			$status = "<div class='alert alert-success'>Product is added to your cart!</div>";
		}
	}
}

?>

<!-- PreLoader-->
<div class="loader">
	<div class="loader-inner">
		<div class="circle"></div>
	</div>
</div>
<!--PreLoader Ends -->


<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p>Fresh and Organic</p>
					<h1>Shop</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end breadcrumb section -->

<!-- products -->
<div class="product-section mt-150 mb-150">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<div class="product-filters">
					<ul>
						<li class="active" data-filter="*">All</li>
						<li data-filter=".strawberry">Strawberry</li>
						<li data-filter=".berry">Berry</li>
						<li data-filter=".lemon">Lemon</li>
					</ul>
				</div>
			</div>
		</div>
		<?php
		if (!empty($_SESSION["shopping_cart"])) {
			$cart_count = count(array_keys($_SESSION["shopping_cart"]));
		?>
			<div class="cart_div">
				<a href="cart.php"><img src="cart-icon.png" /> Cart<span><?php echo $cart_count; ?></span></a>
			</div>
		<?php
		}
		$result = $con->prepare("SELECT * FROM items");
		while ($items = $result->fetchAll()) {
			echo "<div class='product_wrapper'>
				  <form method='post' action=''>
				  <input type='hidden' name='code' value=" . $row['code'] . " />
				  <div class='image'><img src='" . $row['image'] . "' /></div>
				  <div class='name'>" . $row['name'] . "</div>
					 <div class='price'>$" . $row['price'] . "</div>
				  <button type='submit' class='buy'>Buy Now</button>
				  </form>
					 </div>";
		}
		?>
		<div class="row product-lists">
			<?php
			foreach ($items as $item) {
				echo '<div class="col-lg-4 col-md-6 text-center strawberry">
				<div class="single-product-item">
					<div class="product-image">
						<a href="single-product.php"><img src="assets/img/products/product-img-1.jpg" alt=""></a>
					</div>
					<h3>Strawberry</h3>
					<p class="product-price"><span>Per Kg</span> 85$ </p>
					<a href="cart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
				</div>
			</div>';
			}
			?>
		</div>
		<div class="message_box my-4 mx-3">
			<?php echo $status; ?>
		</div>
		<div class="row">
			<div class="col-lg-12 text-center">
				<div class="pagination-wrap">
					<ul>
						<li><a href="#">Prev</a></li>
						<li><a href="#">1</a></li>
						<li><a class="active" href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">Next</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end products -->


<?php
include $tmpl . 'footer.php';
?>