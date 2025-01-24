<?php 
session_start();
require_once 'connect.db.php';

// Default error message
$error = "Please fill up the box";

// Retrieve values from GET request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button'])) {
    $destination = isset($_POST['destination']) ? htmlspecialchars($_POST['destination']) : '';
    $start_date = isset($_POST['start_date']) ? htmlspecialchars($_POST['start_date']) : '';
    $end_date = isset($_POST['end_date']) ? htmlspecialchars($_POST['end_date']) : '';
    $adults = isset($_POST['adults']) ? intval($_POST['adults']) : 0;
    $children = isset($_POST['children']) ? intval($_POST['children']) : 0;
    $from = isset($_POST['from']) ? htmlspecialchars($_POST['from']) : '';
    $to = isset($_POST['to']) ? htmlspecialchars($_POST['to']) : '';
    $tour_type = isset($_POST['tour_type']) ? htmlspecialchars($_POST['tour_type']) : '';
    $tourGuideSelection = isset($_POST['tour_guide']) ? htmlspecialchars($_POST['tour_guide']) : '';
    $rooms= isset($_POST['rooms']) ? intval($_POST['rooms']) :0;
    $check_in= isset($_POST['check_in']) ? htmlspecialchars($_POST['check_in']) :'';
    $check_out= isset($_POST['check_out']) ? htmlspecialchars($_POST['check_out']) :'';
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;

    // Build the query string
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
        'user_id'=> $user_id
    ]);

    // Redirect to the next page with the query string
    header("Location: HotelSelection.php?$query");
    exit();
} elseif (isset($_POST['logout'])) {
    $user_id = 0; // Reset user_id
    header("Location: index.php?user_id=0"); // Redirect to homepage with user_id=0
    exit();
} else {
    // Default values when the page is loaded for the first time
    $destination = isset($_GET['destination']) ? htmlspecialchars($_GET['destination']) : '';
    $start_date = isset($_GET['start_date']) ? htmlspecialchars($_GET['start_date']) : '';
    $end_date = isset($_GET['end_date']) ? htmlspecialchars($_GET['end_date']) : '';
    $adults = isset($_GET['adults']) ? intval($_GET['adults']) : 0;
    $children = isset($_GET['children']) ? intval($_GET['children']) : 0;
    $from = isset($_GET['from']) ? htmlspecialchars($_GET['from']) : '';
    $to = isset($_GET['to']) ? htmlspecialchars($_GET['to']) : '';
    $tour_type = isset($_GET['tour_type']) ? htmlspecialchars($_GET['tour_type']) : '';
    $tourGuideSelection = isset($_GET['tour_guide']) ? htmlspecialchars($_GET['tour_guide']) : '';
    $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
}
echo $tour_type;
echo $tourGuideSelection;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pothik - Destination</title>
    <link rel="stylesheet" href="transportstyle.css">
</head>
<body>
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
            <?php echo $user_id;?>
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

    <section class="search-section-container">
        <div class="search-section">
            <div class="tabs">
                <div class="tab"><a href="Destination.php">Destination</a></div>
                <div class="tab"><a href="Transport.php">Transport</a></div>
                <div class="tab"><a href="TourGuide.php">Tour Guide</a></div>
                <div class="tab active"><a href="#">Hotel</a></div>
            </div>
            <div class="search-box">
                <form action="Hotel.php" method="post">
                    <!-- Hidden input fields to pass values -->
                    <input type="hidden" name="destination" value="<?php echo $destination; ?>">
                    <input type="hidden" name="start_date" value="<?php echo $start_date; ?>">
                    <input type="hidden" name="end_date" value="<?php echo $end_date; ?>">
                    <input type="hidden" name="adults" value="<?php echo $adults; ?>">
                    <input type="hidden" name="children" value="<?php echo $children; ?>">
                    <input type="hidden" name="from" value="<?php echo $from; ?>">
                    <input type="hidden" name="to" value="<?php echo $to; ?>">
                    <input type="hidden" name="tour_type" value="<?php echo $tour_type; ?>">
                    <input type="hidden" name="tour_guide" value="<?php echo $tourGuideSelection; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                    <div class="input-group">
                        <input type="text" id="check_in" name="check_in" placeholder="Check In" value="<?php echo "Check In:".$start_date; ?>" readonly>
                        <input type="text" id="check_out" name="check_out" placeholder="Check Out" value="<?php echo  "Check Out:".$end_date; ?>" readonly>
                    </div>
                    <div class="input-group">
                        <input type="number" id="rooms" name="rooms" placeholder="Rooms" min="1" value="<?php echo isset($_POST['rooms']) ? htmlspecialchars($_POST['rooms']) : ''; ?>" required>
                    </div>
                    <button type="submit" name="button" class="next-btn">NEXT</button>
                </form>
            </div>
        </div>
    </section>

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
