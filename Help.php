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
            <h1>Help & Support</h1>
    
            <h2>FAQs</h2>
            <ul>
                <li><strong>How do I make a booking?</strong>  
                    <p>You can book directly through our website by selecting your desired travel package and completing the payment process.</p>
                </li>
                <li><strong>Can I modify or cancel my booking?</strong>  
                    <p>Yes, modifications and cancellations are allowed, but may be subject to specific terms and charges. Check our cancellation policy for details.</p>
                </li>
                <li><strong>What payment methods are accepted?</strong>  
                    <p>We accept only BKash and Rocket payment till now but other payment options will be available in near future.</p>
                </li>
            </ul>
    
            <h2>Contact Support</h2>
            <p>If you didn’t find the answer to your question, our support team is here to help. You can reach us through:</p>
            <ul>
                <li><strong>Email:</strong> <a href="mailto:support@pothik.com">support@pothik.com</a></li>
                <li><strong>Phone:</strong> +123-456-7890 (Available 9 AM to 6 PM, Monday to Friday)</li>
                <li><strong>Live Chat:</strong> Access the chat feature on our website for real-time assistance.</li>
            </ul>
    
            <h2>Technical Issues</h2>
            <p>Encountering a technical problem? Try the following steps:</p>
            <ul>
                <li>Clear your browser cache and cookies.</li>
                <li>Ensure your browser is updated to the latest version.</li>
                <li>If the issue persists, contact us with details and screenshots at <a href="mailto:support@pothik.com">support@pothik.com</a>.</li>
            </ul>
    
            <h2>Feedback</h2>
            <p>We value your feedback! Share your suggestions or experiences with us to help us improve our services.</p>
            <p>Email your feedback to: <a href="mailto:feedback@pothik.com">feedback@pothik.com</a></p>
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
    <script>
        function toggleMenu() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('active');
        }
    </script>
  </body>
  </html>
  