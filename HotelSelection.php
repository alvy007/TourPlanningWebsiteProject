<?php 
session_start();
require_once 'connect.db.php';

// Initialize variables and error message
$error = "Please fill up the box";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button'])) {
    // Collect form data and sanitize
    $destination = htmlspecialchars($_POST['destination'] ?? '');
    $start_date = htmlspecialchars($_POST['start_date'] ?? '');
    $end_date = htmlspecialchars($_POST['end_date'] ?? '');
    $adults = intval($_POST['adults'] ?? 0);
    $children = intval($_POST['children'] ?? 0);
    $from = htmlspecialchars($_POST['from'] ?? '');
    $to = htmlspecialchars($_POST['to'] ?? '');
    $tour_type = isset($_POST['tour_type']) ? htmlspecialchars($_POST['tour_type']) : '';
    $tourGuideSelection = htmlspecialchars($_POST['tour_guide'] ?? '');
    $rooms = intval($_POST['rooms'] ?? 0);
    $check_in = htmlspecialchars($_POST['start_date'] ?? '');
    $check_out = htmlspecialchars($_POST['end_date'] ?? '');
    $hotel_name = htmlspecialchars($_POST['hotel_name'] ?? '');
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;

    // Redirect with query string
    $query = http_build_query([
        'destination' => $destination,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'adults' => $adults,
        'children' => $children,
        'from' => $from,
        'to' => $to,
        'tour_type'=> $tour_type,
        'tour_guide' => $tourGuideSelection,
        'check_in' => $check_in,
        'check_out' => $check_out,
        'rooms' => $rooms,
        'hotel_name' => $hotel_name,
        'user_id' => $user_id,
    ]);

    header("Location: Bookings.php?$query");
    exit();

} elseif (isset($_POST['logout'])) {
    // Handle logout
    header("Location: index.php?user_id=0");
    exit();
} else {
    // Load query values if present
    $destination = htmlspecialchars($_GET['destination'] ?? '');
    $start_date = htmlspecialchars($_GET['start_date'] ?? '');
    $end_date = htmlspecialchars($_GET['end_date'] ?? '');
    $adults = intval($_GET['adults'] ?? 0);
    $children = intval($_GET['children'] ?? 0);
    $from = htmlspecialchars($_GET['from'] ?? '');
    $to = htmlspecialchars($_GET['to'] ?? '');
    $tour_type = isset($_GET['tour_type']) ? htmlspecialchars($_GET['tour_type']) : '';
    $tourGuideSelection = htmlspecialchars($_GET['tour_guide'] ?? '');
    $rooms = intval($_GET['rooms'] ?? 0);
    $check_in = htmlspecialchars($_GET['start_date'] ?? '');
    $check_out = htmlspecialchars($_GET['end_date'] ?? '');
    $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
}

// Fetch hotel details
$prices = [];
$availabilities = [];
$hotelName = [];
$image = [];

$sql = "SELECT name, image, price_per_night, availability_ 
        FROM hotel 
        WHERE district = (SELECT district FROM destination WHERE name = ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $destination);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $hotelName[] = $row["name"];
            $prices[$row["name"]] = $row["price_per_night"];
            $availabilities[$row["name"]] = $row["availability_"];
            $image[$row["name"]] = $row["image"];
        }
    }

    $stmt->close();
} else {
    echo "Error fetching hotel details: " . $conn->error;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Listings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="transportstyle.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="navbar">
            <div class="logo">
                 <h1 style="font-size: 24px; font-weight: bold; color: #007B5E;">Pothik</h1>
            </div>
            <div class="nav-links">
                <a class="nav-link" href="<?php echo $user_id === 0 ? 'index.php' : 'index.php?user_id=' . $user_id; ?>">HOME</a>
                <a class="nav-link <?php echo $user_id === 0 ? 'disabled' : ''; ?>" href="Destination.php?user_id=<?php echo $user_id; ?>">TRIP PLAN</a>
                <a class="nav-link" href="<?php echo $user_id === 0 ? 'Blog.php' : 'Blog.php?user_id=' . $user_id; ?>">BLOG</a>
                <a class="nav-link <?php echo $user_id === 0 ? 'disabled' : ''; ?>" href="BookingsStatic.php?user_id=<?php echo $user_id; ?>">BOOKINGS</a>
                <a class="nav-link" href="<?php echo $user_id === 0 ? 'AboutUs.php' : 'AboutUs.php?user_id=' . $user_id; ?>">ABOUT US</a>
                <a class="nav-link" href="<?php echo $user_id === 0 ? 'Help.php' : 'Help.php?user_id=' . $user_id; ?>">HELP</a>
            </div>
            <div class="sign-in" style="display:flex">
                <?php if ($user_id > 0): ?>
                  <!-- Display user ID -->
                  <label for="id" style="background-color:transparent; width: 50px; margin-right: 10px; text-align: center">
                      <?php echo $user_id; ?>
                  </label>
                  <!-- Show Logout button if user_id is set -->
                  <form method="POST" class="d-inline">
                      <button type="submit" name="logout"  style="background: red; color:white">Logout</button>
                  </form>
              <?php else: ?>
                  <!-- Show Sign In button if user_id is 0 -->
                  <a class="btn btn-primary" href="Sign_in.php">Sign In</a>
              <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-5">
        <div class="container">
            <?php foreach ($hotelName as $name): ?>
                <form action="HotelSelection.php" method="post">
                    <div class="row mb-4 bg-light p-3 shadow-sm rounded">
                        <div class="col-md-4">
                            <img src="<?= htmlspecialchars($image[$name]) ?>" alt="<?= htmlspecialchars($name) ?>" class="img-fluid rounded">
                        </div>
                        <div class="col-md-5 d-flex flex-column justify-content-center">
                            <h4 class="fw-bold"><?= htmlspecialchars($name) ?></h4>
                            <input type="hidden" name="hotel_name" value="<?= htmlspecialchars($name) ?>">
                        </div>
                        <div class="col-md-3 text-end d-flex flex-column justify-content-center align-items-end">
                            <input type="hidden" name="destination" value="<?= htmlspecialchars($destination) ?>">
                            <input type="hidden" name="start_date" value="<?= htmlspecialchars($start_date) ?>">
                            <input type="hidden" name="end_date" value="<?= htmlspecialchars($end_date) ?>">
                            <input type="hidden" name="adults" value="<?= intval($adults) ?>">
                            <input type="hidden" name="children" value="<?= intval($children) ?>">
                            <input type="hidden" name="from" value="<?= htmlspecialchars($from) ?>">
                            <input type="hidden" name="to" value="<?= htmlspecialchars($to) ?>">
                            <input type="hidden" name="tour_type" value="<?= htmlspecialchars($tour_type) ?>">
                            <input type="hidden" name="tour_guide" value="<?= htmlspecialchars($tourGuideSelection) ?>">
                            <input type="hidden" name="check_in" value="<?= htmlspecialchars($check_in) ?>">
                            <input type="hidden" name="check_out" value="<?= htmlspecialchars($check_out) ?>">
                            <input type="hidden" name="rooms" value="<?= intval($rooms) ?>">
                            <input type="hidden" name="user_id" value="<?= intval($user_id) ?>">
                            

                            <h5 class="fw-bold">BDT <?= htmlspecialchars($prices[$name]) ?></h5>
                            <p class="text-muted">Rooms Available: <?= htmlspecialchars($availabilities[$name]) ?></p>
                            <button 
                                type="submit" 
                                name="button"
                                class="btn btn-primary" 
                                <?= $availabilities[$name] < $rooms ? 'disabled' : '' ?>>
                                SELECT
                            </button>
                        </div>
                    </div>
                </form>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-links">
                <h3>Discover</h3>
                <a href="<?php echo $user_id === 0 ? 'index.php' : 'index.php?user_id=' . $user_id; ?>">Home</a>
                <a href="<?php echo $user_id === 0 ? 'Term.php' : 'Term.php?user_id=' . $user_id; ?>">Term</a>
                <a href="<?php echo $user_id === 0 ? 'Talent.php' : 'Talent.php?user_id=' . $user_id; ?>">Talent & Culture</a>
                <a href="<?php echo $user_id === 0 ? 'Refund.php' : 'Refund.php?user_id=' . $user_id; ?>">Refund Policy</a>
                <a href="<?php echo $user_id === 0 ? 'Privacy.php' : 'Privacy.php?user_id=' . $user_id; ?>">Privacy Policy</a>
            </div>
            <div class="payment-methods">
                <h3>Payment Methods</h3>
                <img src="v709_290.png" alt="bKash">
                <img src="v709_289.png" alt="Rocket">
            </div>
            <div class="contact">
                <h3>Need Help?</h3>
                <p>pothikbd@gmail.com<br>+8801885434861</p>
                <p>We’re here for you 24/7! Reach out to us through Messenger or call anytime, day or night, for support.</p>
            </div>
        </div>
        <div class="logo">
            <img src="vvvvvv-01[1] 1.png" alt="Footer Logo">
            <p>&copy; 2024 Pothik Ltd. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
