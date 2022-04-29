<?php
ob_start();
session_start();
$pageTitle = '404-Error';
include 'config.php';
?>


<!--PreLoader-->
<div class="loader">
	<div class="loader-inner">
		<div class="circle"></div>
	</div>
</div>
<!--PreLoader Ends-->

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p>Fresh adn Organic</p>
					<h1>404 - Not Found</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end breadcrumb section -->
<!-- error section -->
<div class="full-height-section error-section">
	<div class="full-height-tablecell">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="error-text">
						<i class="far fa-sad-cry"></i>
						<h1>Oops! Not Found.</h1>
						<p>The page you requested for is not found.</p>
						<a href="index.php" class="boxed-btn">Back to Home</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end error section -->


<?php
include $tmpl . 'footer.php';
?>