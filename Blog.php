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
                <a class="nav-link <?php echo $user_id === 0 ? 'disabled' : ''; ?>" href="<?php echo $user_id === 0 ? '#' : 'Destination.php?user_id=' . $user_id; ?>">TRIP PLAN</a>

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
    <section class="blog-section">
        <div class="blog-header">
            <div class="header-overlay">
                
            </div>
        </div>
        <h1>BLOG POSTS</h1>
        <div class="blog-posts">
            <!-- Blog Post 1 -->
            <div class="blog-post">
                <img src="Screenshot_5 2.png" alt="Mount Karangetang">
                <div class="tags">Asia • Hiking • Indonesia</div>
                <h3>Climbing Mount Karangetang Volcano in Siau, Sulawesi</h3>
                <p>Mount Karangetang is an awesome Jurassic Park-looking volcano...</p>
                <a href="#" class="read-more">Read More &gt;&gt;</a>
            </div>
            <!-- Blog Post 2 -->
            <div class="blog-post">
                <img src="Screenshot_6.png" alt="Morocco Itinerary">
                <div class="tags">Asia • Desert • Rajasthan</div>
                <h3>10 Day Morocco Itinerary: Marrakesh, Fes, Sahara</h3>
                <p>Morocco is an amazing place to travel. If you have 10 days in the country...</p>
                <a href="#" class="read-more">Read More &gt;&gt;</a>
            </div>
            <!-- Blog Post 3 -->
            <div class="blog-post">
                <img src="Screenshot_7 2.png" alt="Dhiguria Island">
                <div class="tags">Asia • Sea Beach • Bangladesh</div>
                <h3>How to Visit Dhiguria Island: Budget Paradise in Bangladesh</h3>
                <p>Dhiguria Island is probably the most beautiful island you've never heard of...</p>
                <a href="#" class="read-more">Read More &gt;&gt;</a>
            </div>
            <!-- Blog Post 4 -->
            <div class="blog-post">
                <img src="photo-1624295934425-f86034d47e10.png" alt="Sonargaon Travel Guide">
                <div class="tags">Asia • Bangladesh • Sonargaon</div>
                <h3>Sonargaon Travel Guide: Visiting Museum and Other Attractions</h3>
                <p>The Sonargaon Museum, officially known as the Folk Art and Craft Museum...</p>
                <a href="#" class="read-more">Read More &gt;&gt;</a>
            </div>
            <!-- Blog Post 5 -->
            <div class="blog-post">
                <img src="photo-1642179335770-82d5ffc4b439.png" alt="Sylhet">
                <div class="tags">Asia • River • Sylhet • Bangladesh</div>
                <h3>Sylhet: A Place of Haven in Bangladesh, Jaflong &amp; Ratargul</h3>
                <p>Sylhet, a picturesque region in northeastern Bangladesh, is known for...</p>
                <a href="#" class="read-more">Read More &gt;&gt;</a>
            </div>
            <!-- Blog Post 6 -->
            <div class="blog-post">
                <img src="gettyimages-630146012-1024x1024.png" alt="Sreemangal">
                <div class="tags">Tea • Bangladesh • Sreemangal</div>
                <h3>Sreemangal: Top Things to Do in the Place</h3>
                <p>Sreemangal, often referred to as the "Tea Capital of Bangladesh," is a charming...</p>
                <a href="#" class="read-more">Read More &gt;&gt;</a>
            </div>
        </div>
        <div class="pagination">
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">...</a>
            <a href="#">10</a>
            <a href="#">&gt;</a>
        </div>
        <div class="get-header">
            
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
