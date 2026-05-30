<?php
include 'common/config.php';
include 'common/header.php';


$bannerQuery = "SELECT * FROM banners WHERE status='active' LIMIT 1";
$bannerResult = mysqli_query($conn, $bannerQuery);
$banner = mysqli_fetch_assoc($bannerResult);



$mostSearchedQuery = "SELECT * FROM most_searched_cars WHERE status='active' ORDER BY id DESC";
$mostSearchedResult = mysqli_query($conn, $mostSearchedQuery);



$latestCarsQuery = "SELECT * FROM latest_cars WHERE status='active' ORDER BY id DESC";
$latestCarsResult = mysqli_query($conn, $latestCarsQuery);
?>


<section class="banner">
    <div class="container banner-flex">

        <?php if ($banner) { ?>
            <div class="banner-text">
                <h1><?= htmlspecialchars($banner['title']) ?></h1>
                <p><?= htmlspecialchars($banner['subtitle']) ?></p>
                <a href="car-form.php" class="banner-btn">Get Car Details</a>
            </div>

            <div class="banner-image">
                <img src="assets/images/banners/<?= $banner['image'] ?>" alt="Banner Image">
            </div>
        <?php } else { ?>
            <h2>No banner added</h2>
        <?php } ?>

    </div>
</section>


<section class="most-searched">
    <div class="container">
        <h2 class="section-title">Most Searched Cars</h2>

        <div class="car-grid">
            <?php if (mysqli_num_rows($mostSearchedResult) > 0) { ?>
                <?php while ($car = mysqli_fetch_assoc($mostSearchedResult)) { ?>
                    <div class="car-card">
                        <img src="assets/images/cars/<?= $car['image'] ?>" alt="<?= htmlspecialchars($car['car_name']) ?>">
                        <h3><?= htmlspecialchars($car['car_name']) ?></h3>
                        <p><?= htmlspecialchars($car['car_type']) ?></p>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>No cars available</p>
            <?php } ?>
        </div>
    </div>
</section>


<section class="latest-cars">
    <div class="container">
        <h2 class="section-title">Latest Cars</h2>
        <p class="section-subtitle">Check out the newest car launches in India</p>

        <?php if (mysqli_num_rows($latestCarsResult) > 0) { ?>
            <?php while ($car = mysqli_fetch_assoc($latestCarsResult)) { ?>
                <div class="latest-card">
                    <img src="assets/images/cars/<?= $car['image'] ?>" alt="<?= htmlspecialchars($car['car_name']) ?>">
                    <div class="latest-info">
                        <h3><?= htmlspecialchars($car['car_name']) ?></h3>
                        <p>Expected Price: <?= htmlspecialchars($car['price']) ?></p>
                        <span>Launch Year: <?= htmlspecialchars($car['launch_year']) ?></span>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p>No latest cars available</p>
        <?php } ?>
    </div>
</section>

<?php include 'common/footer.php'; ?>
