<?php

ob_start();
session_start();
$pageTitle = 'Home';

include 'config.php';

// if (isset($_SESSION['member'])) {
// start carousal
?>
<div id="carouselExampleCaptions" class="carousel slide mb-4 h-75 " data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://images.pexels.com/photos/5650045/pexels-photo-5650045.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="d-block w-100" alt="Wild Landscape" />
            <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://images.pexels.com/photos/5632397/pexels-photo-5632397.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1 class=" d-block w-100" alt="Camera" />
            <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://images.pexels.com/photos/5632399/pexels-photo-5632399.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="d-block w-100" alt="Exotic Fruits" />
            <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<?php
// End carousal

$NumComment = 4;
$statement = $con->prepare("SELECT items.* ,categories.Name AS category_name ,users.Username FROM items
        INNER JOIN categories ON categories.ID = items.Cat_ID
        INNER JOIN users ON users.UserID = items.Member_ID
        ORDER BY Item_ID DESC
        LIMIT $NumComment
        ");
$statement->execute();
$items = $statement->fetchAll();
if (!empty($items)) {
?>
    <div class="container">
        <div class="row">
            <?php
            foreach ($items as $item) {
                echo '<div class="col-3">';
                echo '<div class="card">';
                echo '<img src="https://images.pexels.com/photos/5650045/pexels-photo-5650045.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Fissure in Sandstone"/>';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $item['Name'] . '</h5>';
                echo '<p class="card-text">' . $item['Description'] . '</p>';
                echo '<p class="card-text">' . $item['Price'] . '</p>';
                echo '<a href="#!" class="btn btn-primary">More</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
<?php
}
// }
?>

<?php
include $tmpl . 'footer.php';
