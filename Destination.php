<?php 
session_start();
require_once 'connect.db.php';

$error = "Please fill up the box";

// Fetch destination values from the database
$destinations = [];
$sql = "SELECT name FROM destination";
$result = $conn->query($sql);
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $destinations[] = $row['name'];
    }
} else {
    $error = "No destinations found.";
}

// Initialize variables
$start_date = "";
$end_date = "";
$user_id=isset($_GET['user_id']) ? htmlspecialchars($_GET['user_id']) : '';
// echo $user_id;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button'])) {
    $destination = htmlspecialchars($_POST['destination']);
    $start_date = htmlspecialchars($_POST['start_date']);
    $end_date = htmlspecialchars($_POST['end_date']);
    $adults = intval($_POST['adults']);
    $children = intval($_POST['children']);
    $user_id = intval($_POST['user_id']);

    if ($end_date < $start_date) {
        $error = "End date cannot be earlier than start date.";
    } else {
        // Redirect with query parameters
        $query = http_build_query([
            'destination' => $destination,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'adults' => $adults,
            'children' => $children,
            'user_id'=> $user_id
        ]);

        header("Location: Transport.php?$query");
        exit();
    }
}
if (isset($_POST['logout'])) {
    $user_id = 0; // Reset user_id
    header("Location: index.php?user_id=0"); // Redirect to homepage with user_id=0
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pothik - Destination</title>
    <link rel="stylesheet" href="transportstyle.css">
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const form = document.querySelector('form');

        // Set the min date for the start_date input to current date + 15 days
        const today = new Date();
        const minStartDate = new Date(today);
        minStartDate.setDate(minStartDate.getDate() + 15);

        const formatDate = (date) => {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        };

        startDateInput.min = formatDate(minStartDate);

        // Update the min attribute of the end_date when the start_date changes
        startDateInput.addEventListener('change', function () {
            const startDate = startDateInput.value;
            endDateInput.min = startDate;

            // Clear end_date if it is earlier than the new start_date
            if (endDateInput.value && endDateInput.value < startDate) {
                endDateInput.value = '';
            }
        });

        // Validate before form submission
        form.addEventListener('submit', function (e) {
            const startDate = startDateInput.value;
            const endDate = endDateInput.value;

            if (endDate < startDate) {
                e.preventDefault();
                alert('End date cannot be earlier than start date.');
            }
        });
    });
</script>

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
        <form action="Destination.php" method="post">
            <div class="search-section">
                <div class="tabs">
                    <div class="tab active"><a href="#">Destination</a></div>
                    <div class="tab"><a href="Transport.php">Transport</a></div>
                    <div class="tab"><a href="TourGuide.php">Tour Guide</a></div>
                    <div class="tab"><a href="Hotel.php">Hotel</a></div>
                </div>

                <div class="search-box">
                    
                    <select id="destination" name="destination" class="full-width" required style="margin: 10px 2px; color: #000; background-color: #fff; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;">
                        <option value="" disabled selected>Select Destination</option>
                        <?php foreach ($destinations as $destination): ?>
                            <option value="<?= htmlspecialchars($destination) ?>"><?= htmlspecialchars($destination) ?></option>
                        <?php endforeach; ?>
                    </select>

                    <div class="input-group" style="width:100%">
                        <div style="width:100%">
                            <label for="start_date">From:</label>
                            <input type="date" id="start_date" name="start_date" value="<?= htmlspecialchars($start_date) ?>" required>
                        </div>
                        <div style="width:100%">
                            <label for="end_date">To:</label>
                            <input type="date" id="end_date" name="end_date" min="<?= htmlspecialchars($start_date) ?>" value="<?= htmlspecialchars($end_date) ?>" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="hidden" name="user_id" value="<?php echo$user_id; ?>">
                        <input type="number" id="adults" name="adults" placeholder="Adults" min="0" required>
                        <input type="number" id="children" name="children" placeholder="Children" min="0" required>
                    </div>
                    <button type="submit" name="button" class="next-btn">NEXT</button>  
                </div>
            </div>
        </form>
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
