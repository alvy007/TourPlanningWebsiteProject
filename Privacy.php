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
            <h1>Privacy Policy</h1>
    
            <h2>1. Data We Collect</h2>
            <ul>
                <li><strong>Personal Data:</strong> Includes your name, contact details, payment information, and other details necessary for processing bookings and providing personalized services.</li>
                <li><strong>Non-Personal Data:</strong> Includes browsing behavior, device information, and other aggregated data to analyze website performance and improve user experience.</li>
            </ul>
    
            <h2>2. How We Use Your Data</h2>
            <ul>
                <li>To process bookings and reservations efficiently.</li>
                <li>To send you updates, confirmations, and promotional offers.</li>
                <li>To improve our website, services, and user experience.</li>
                <li>To comply with legal obligations or obtain your explicit consent for certain uses.</li>
            </ul>
    
            <h2>3. Sharing of Data</h2>
            <ul>
                <li>We may share your information with trusted service providers (e.g., payment processors, travel partners) to fulfill your requests.</li>
                <li>Your data will only be shared when required by law, for legal compliance, or with your explicit consent.</li>
            </ul>
    
            <h2>4. Cookies and Tracking Technologies</h2>
            <ul>
                <li>We use cookies and similar technologies to:  
                    <ul>
                        <li>Enable essential website functionality.</li>
                        <li>Analyze website traffic and performance.</li>
                        <li>Deliver personalized marketing and advertising.</li>
                    </ul>
                </li>
                <li>You can manage cookie settings through your browser preferences.</li>
            </ul>
    
            <h2>5. Data Security Measures</h2>
            <ul>
                <li>We implement industry-standard security measures, such as SSL encryption and regular system audits, to protect your data.</li>
                <li>While we take every precaution, no security system is entirely foolproof.</li>
            </ul>
    
            <h2>6. Your Rights</h2>
            <ul>
                <li><strong>Access, Correct, or Delete Data:</strong> You can request access to, correction of, or deletion of your personal data at any time.</li>
                <li><strong>Opt-Out of Marketing:</strong> You can unsubscribe from marketing communications through the links provided in our emails or by contacting us directly.</li>
            </ul>
    
            <h2>7. Third-Party Links</h2>
            <p>Our website may contain links to third-party websites. Pothik is not responsible for the privacy practices of these external sites and encourages you to review their policies.</p>
    
            <h2>8. Children’s Privacy</h2>
            <p>We do not knowingly collect personal data from children under 13. If such data is inadvertently collected, we will delete it promptly upon discovery.</p>
    
            <h2>9. Policy Updates</h2>
            <p>This privacy policy may be updated periodically to reflect changes in our practices or for legal compliance. We encourage users to review this policy regularly.</p>
    
            <h2>10. Contact Us</h2>
            <p>For any privacy-related concerns or inquiries, you can contact us via email at <a href="mailto:support@pothik.com">support@pothik.com</a>.</p>
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
  