<?php include 'common/header.php'; ?>

<section class="enquiry-section">
    <div class="container">
        <h2 class="section-title">Car Enquiry Form</h2>
        <p class="section-subtitle">Select your preferred car type and submit your details</p>

        <form class="enquiry-form" method="post" action="save-form.php">

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" placeholder="Enter your name" required>
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" name="phone" placeholder="Enter your phone number" required>
            </div>

            <div class="form-group">
                <label>Email ID</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label>Address</label>
                <textarea name="address" placeholder="Enter your address" required></textarea>
            </div>

            <div class="form-group">
                <label>Preferred Car Type</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="car_type[]" value="Hatchback"> Hatchback</label>
                    <label><input type="checkbox" name="car_type[]" value="Sedan"> Sedan</label>
                    <label><input type="checkbox" name="car_type[]" value="SUV"> SUV</label>
                </div>
            </div>

            <button type="submit" class="submit-btn">Submit Enquiry</button>

        </form>
    </div>
</section>

<?php include 'common/footer.php'; ?>
