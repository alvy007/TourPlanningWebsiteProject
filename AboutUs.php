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
            <h1>About Us</h1>
    
            <h2>Our Mission</h2>
            <p>At <strong>Pothik</strong>, our mission is to revolutionize travel by offering seamless, personalized, and unforgettable experiences. We strive to connect people with their dream destinations while prioritizing convenience and customer satisfaction.</p>
    
            <h2>Who We Are</h2>
            <p>We are a dedicated team of travel enthusiasts, tech experts, and customer service professionals committed to creating a platform that simplifies travel planning and booking. With years of experience in the travel industry, we understand the challenges travelers face and aim to provide solutions that enhance every journey.</p>
    
            <h2>What We Offer</h2>
            <ul>
                <li><strong>Customizable Travel Packages:</strong> Tailored itineraries to meet your preferences and needs.</li>
                <li><strong>Comprehensive Services:</strong> From flights and hotels to guided tours and transportation, we handle it all.</li>
                <li><strong>User-Friendly Platform:</strong> An intuitive booking process to save you time and effort.</li>
            </ul>
    
            <h2>Why Choose Us?</h2>
            <ul>
                <li><strong>Expertise:</strong> Years of experience in crafting memorable travel experiences.</li>
                <li><strong>Customer Focus:</strong> We prioritize your needs and work tirelessly to exceed your expectations.</li>
                <li><strong>Transparency:</strong> No hidden fees—just clear and honest pricing.</li>
            </ul>
    
            <h2>Contact Us</h2>
            <p>Have questions or want to know more? Reach out to us at <a href="mailto:support@pothik.com">support@pothik.com</a>, and our team will be happy to assist you.</p>
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
  