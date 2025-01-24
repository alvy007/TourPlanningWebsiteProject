<?php
// Start session
session_start();

// Retrieve the user_id from the URL or set it to 0 if not provided
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

// Handle logout action
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
    <title>Blog Posts</title>
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

    <main>
       <div class="content-container">
        <!-- Content Header -->
        <div class="content-header">
          <h1>Refund/Re-issue Policy</h1>
        </div>
    
        <!-- Refund Policy Content -->
        <section>
          <h2 class="section-title">1. Refund Policy for Hotels</h2>
          <ul>
            <li><strong>Cancellation by the Guest:</strong>
              <ul>
                <li>Before 7 Days: Full refund, minus any applicable service charges.</li>
                <li>Between 3-7 Days: 50% refund of the total booking amount.</li>
                <li>Less than 3 Days or No-Show: No refund.</li>
              </ul>
            </li>
            <li><strong>Changes to Booking:</strong> Modifications (e.g., changing dates) may incur additional charges or be subject to availability. If the modification results in cancellation, the refund terms above apply.</li>
            <li><strong>Cancellation by Hotel:</strong> If the hotel cancels the booking due to unforeseen circumstances:
              <ul>
                <li>A full refund will be provided.</li>
                <li>Alternatively, assistance will be offered to arrange a similar hotel at no additional cost.</li>
              </ul>
            </li>
          </ul>
    
          <h2 class="section-title">2. Refund Policy for Tours</h2>
          <ul>
            <li><strong>Cancellation by the Guest:</strong>
              <ul>
                <li>Before 15 Days: Full refund, minus any applicable service fees.</li>
                <li>Between 7-14 Days: 50% refund of the total package cost.</li>
                <li>Less than 7 Days or No-Show: No refund.</li>
              </ul>
            </li>
            <li><strong>Changes to the Tour Package:</strong> Changes to the tour itinerary are subject to approval and may incur additional charges. If changes result in cancellation, the refund terms above apply.</li>
            <li><strong>Cancellation by the Tour Operator:</strong> If the tour is canceled due to unforeseen circumstances (e.g., natural disasters or political instability):
              <ul>
                <li>A full refund will be issued.</li>
                <li>Alternatively, customers may opt for a rescheduled tour or a credit voucher for future bookings.</li>
              </ul>
            </li>
          </ul>
    
          <h2 class="section-title">3. Non-Refundable Charges</h2>
          <ul>
            <li>Certain fees, such as transaction charges, booking platform fees, or costs incurred with third-party providers, may not be refundable.</li>
            <li>Any non-refundable components of the hotel or tour package will be explicitly mentioned during the booking process.</li>
          </ul>
    
          <h2 class="section-title">4. Refund Processing</h2>
          <ul>
            <li>Refund requests must be submitted via email to your contact email with your booking details.</li>
            <li>Refunds will be processed within a specific timeframe 14 business days after approval.</li>
          </ul>
        </section>
        </div>

        </main>
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
  