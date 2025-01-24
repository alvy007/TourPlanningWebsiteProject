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
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playwrite+AU+SA:wght@100..400&display=swap" rel="stylesheet">
<script src="script.js" defer></script>
    <title>Pothik</title>
</head>
<body class="m-0 p-0">
   <header class=" pb-5 position-static" id="mynavbar">
    <nav class="navbar navbar-expand-lg fixed-top " id="navbar" >
      <div class="container">
        <!-- Brand Name -->
        <a class="navbar-brand" href="#">POTHIK</a>
  
        <!-- Toggler Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
  
        <!-- Collapsible Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <!-- Centered Navigation Links -->
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
            <a class="nav-link" href="<?php echo $user_id === 0 ? 'index.php' : 'index.php?user_id=' . $user_id; ?>">HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo $user_id === 0 ? 'disabled' : ''; ?>" href="Destination.php?user_id=<?php echo $user_id; ?>">TRIP PLAN</a>
            </li>
            <li class="nav-item">
            <a class="nav-link <?php echo $user_id === 0 ? 'disabled' : ''; ?>" href="BookingsStatic.php?user_id=<?php echo $user_id; ?>">BOOKINGS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $user_id === 0 ? 'Blog.php' : 'Blog.php?user_id=' . $user_id; ?>">BLOG</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $user_id === 0 ? 'AboutUs.php' : 'AboutUs.php?user_id=' . $user_id; ?>">ABOUT US</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $user_id === 0 ? 'Help.php' : 'Help.php?user_id=' . $user_id; ?>">HELP</a>
            </li>
          </ul>
          

          
              
          
            
          
              <?php if ($user_id > 0): ?>
                  <!-- Display user ID -->
                  <label for="id" style="background-color:transparent; width: 50px; margin-right: 10px; text-align: center">
                      <?php echo $user_id; ?>
                  </label>
                  <!-- Show Logout button if user_id is set -->
                  <form method="POST" class="d-inline">
                      <button type="submit" name="logout" class="btn btn-danger">Logout</button>
                  </form>
              <?php else: ?>
                  <!-- Show Sign In button if user_id is 0 -->
                  <a class="btn btn-primary" href="Sign_in.php">Sign In</a>
              <?php endif; ?>
          

          
         
        </div>
      </div>
    </nav>
   </header>
   <section>
    <div class="my-5 p-0 w-50 " id="hero">
        <h1 class="d-felx justify-content-center fw-bold">
            Explore and Learn
        </h1>
        <form class="d-flex" role="search" id="searchbar" onsubmit="searchGoogle(event)">
          <input
            class="form-control me-2"
            type="search"
            placeholder="Discover Places . . ."
            aria-label="Search"
            id="searchInput"
          />
          <button class="btn btn-dark bg-dark bordar-white" type="submit">Search</button>
        </form>

        <script>
          // JavaScript to handle the search
          function searchGoogle(event) {
            event.preventDefault(); // Prevent the default form submission
            const query = document.getElementById('searchInput').value; // Get the input value
            if (query.trim() !== '') {
              // Redirect to Google search with the query
              const googleSearchUrl = `https://www.google.com/search?q=${encodeURIComponent(query)}`;
              window.location.href = googleSearchUrl; // Redirect to Google
            } else {
              alert('Please enter a search term.'); // Alert if the input is empty
            }
          }
        </script>
      </div>

       <article class="container">
        <div class="pt-1 ms-3" id="art">
            <p class="h1">
                Discover the Wonders of Bangladesh
            </p>
            <p >
                Embrace the full splendro of Bangladesh with POTHIK. Explore the countrys history , culture  and natural beauty with our expert guides and 
                carratifull services. From the majactic Sundarbans to the ancient city of Bagerhat, we will take you on a journey of a lifetime. Book you trip 
                now and get ready to experience the best of Bangladesh. 
            </p>
    
        </div>
       </article>
      
   </section>
   <section id="Hero">
     <div class="container service rounded-5">
        <h1>OUR SERVICES</h1>
        <div id="underline"></div>
        <ul>
          <li
            class="container rounded pt-1 border border-secondary"
            onclick="showFeatureUnavailableMessage()"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.2"
              stroke="green"
              class="size-6"
              width="40"
              height="40"
              opacity="0.7"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z"
              />
            </svg>
            <h4>Ticket Booking</h4>
            <p>We book all kind ticket for your destinaion.</p>
          </li>
          <li
            class="rounded pt-1 container border border-secondary"
            onclick="showFeatureUnavailableMessage()"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              strokeWidth="1.2"
              stroke="blue"
              className="size-6"
              width="45"
              height="38"
              opacity="0.7"
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819"
              />
            </svg>
            <h4>Hotel Booking</h4>
            <p>You can easily book your according to your budget hotel.</p>
          </li>
          <li
            class="container rounded pt-1 border border-secondary"
            onclick="showFeatureUnavailableMessage()"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.2"
              stroke="red"
              class="size-6"
              width="40"
              height="40"
              opacity="0.7"
              transform="rotate(-45)"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"
              />
            </svg>
            <h4>Tour Plan</h4>
            <p>Plan your trip with our ready and coustom pack.</p>
          </li>
        </ul>

        <script>
          // Function to show the unavailable message
          function showFeatureUnavailableMessage() {
            alert(
              "We apologize for the inconvenience, but this feature will be available soon. Thank you for your patience!"
            );
          }
        </script>

        
     </div>
   </section>
   <section style="margin-top: 250px;" id="card">
       <div class="card container vip-card" style="background-color:aqua;">
        <div class="card-body">
          <p class="card-text">Want a luxurious, stress-free journey? Upgrade to Premium Membership for exclusive perks and unforgettable tours!</p>
          <div class="d-flex justify-content-end">
            <a href="#" style="text-decoration: none; color:red;">Get Vip</a>
          </div>
        </div>
      </div>

   </section>
   <section style="position: relative; top:120px; " >
    <div class="container package rounded bg-white" style="box-shadow: 5px 5px 10px 2px rgba(0, 0, 0, 0.5); height:40rem">
        <div class="gap-3 Button" role="group" aria-label="Package Types"  >
            <button type="button" class="btn btn-white border border-1 border-dark package-btn active" data-category="adventure">Adventure</button>
            <button type="button" class="btn btn-white border border-1 border-dark  package-btn"  data-category="heritage-trails">Heritage Trails</button>
            <button type="button" class="btn border btn-white border-1 border-dark  package-btn" data-category="city-trails">City Trails</button>
            <button type="button" class="btn btn-white border-1 border-dark  package-btn" data-category="hidden-gems">Hidden Gems</button>
            <button type="button" class="btn btn-white border-1 border-dark  package-btn" data-category="wild-escapes">Wild Escapes</button>
          </div>
          <div id="cardSlider" class="d-flex overflow-hidden position-relative justify-content-center " style="top: 15%;">
            <div class="card package-card mx-3" data-category="city-trails">
              <img src="packages_imgae/CityTrails1.jpg" class="card-img-top" alt="Dhaka City">
              <div class="card-body">
                <h5 class="card-title">All in Dhaka City</h5>
                <p class="card-text">2 Days, 1 Night <br> 10K Tk/Person</p>
                <button class="btn btn-primary">Watch now</button>
                <button class="btn btn-secondary">Save Pack</button>
              </div>
            </div>
            <div class="card package-card mx-3" data-category="city-trails">
              <img src="packages_imgae/Tangail.png" class="card-img-top" alt="Tangail City">
              <div class="card-body">
                <h5 class="card-title">All in Tangail City</h5>
                <p class="card-text">2 Days, 1 Night <br> 10K Tk/Person</p>
                <button class="btn btn-primary">Watch now</button>
                <button class="btn btn-secondary">Save Pack</button>
              </div>
            </div>
            <div class="card package-card mx-3" data-category="city-trails">
              <img src="packages_imgae/Mymensingh .png" class="card-img-top" alt="Mymensingh City">
              <div class="card-body">
                <h5 class="card-title">All in Mymensingh City</h5>
                <p class="card-text">2 Days, 1 Night <br> 10K Tk/Person</p>
                <button class="btn btn-primary">Watch now</button>
                <button class="btn btn-secondary">Save Pack</button>
              </div>
            </div>
            <div class="card package-card mx-3" data-category="city-trails">
              <img src="packages_imgae/shyllet.jpg" class="card-img-top" alt="Syllhet City">
              <div class="card-body">
                <h5 class="card-title">All in Syllhet</h5>
                <p class="card-text">2 Days, 1 Night <br> 10K Tk/Person</p>
                <button class="btn btn-primary">Watch now</button>
                <button class="btn btn-secondary">Save Pack</button>
              </div>
            </div>
            <div class="card package-card mx-3" data-category="city-trails">
              <img src="packages_imgae/Mymensingh .png" class="card-img-top" alt="Mymensingh City">
              <div class="card-body">
                <h5 class="card-title">All in Mymensingh City</h5>
                <p class="card-text">2 Days, 1 Night <br> 10K Tk/Person</p>
                <button class="btn btn-primary">Watch now</button>
                <button class="btn btn-secondary">Save Pack</button>
              </div>
            </div>
            <div class="card package-card mx-3" data-category="city-trails">
              <img src="packages_imgae/Mymensingh .png" class="card-img-top" alt="Mymensingh City">
              <div class="card-body">
                <h5 class="card-title">All in Mymensingh City</h5>
                <p class="card-text">2 Days, 1 Night <br> 10K Tk/Person</p>
                <button class="btn btn-primary">Watch now</button>
                <button class="btn btn-secondary">Save Pack</button>
              </div>
            </div>
            <div class="card package-card mx-3" data-category="city-trails">
              <img src="packages_imgae/Mymensingh .png" class="card-img-top" alt="Mymensingh City">
              <div class="card-body">
                <h5 class="card-title">All in Mymensingh City</h5>
                <p class="card-text">2 Days, 1 Night <br> 10K Tk/Person</p>
                <button class="btn btn-primary">Watch now</button>
                <button class="btn btn-secondary">Save Pack</button>
              </div>
            </div>
            <div class="card package-card mx-3" data-category="city-trails">
              <img src="packages_imgae/Mymensingh .png" class="card-img-top" alt="Mymensingh City">
              <div class="card-body">
                <h5 class="card-title">All in Mymensingh City</h5>
                <p class="card-text">2 Days, 1 Night <br> 10K Tk/Person</p>
                <button class="btn btn-primary">Watch now</button>
                <button class="btn btn-secondary">Save Pack</button>
              </div>
            </div>
             <div class="card package-card mx-3" data-category="city-trails">
              <img src="packages_imgae/CityTrails1.jpg" class="card-img-top" alt="Dhaka City">
              <div class="card-body">
                <h5 class="card-title">All in Dhaka City</h5>
                <p class="card-text">2 Days, 1 Night <br> 10K Tk/Person</p>
                <button class="btn btn-primary">Watch now</button>
                <button class="btn btn-secondary">Save Pack</button>
              </div>
            </div>
          </div>
    </div>
    <div class="d-flex justify-content-center  gap-4" style="position: relative; top:-50px">
      <button id="prevArrow">
        
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="size-6" width="35" height="35" class="mt-auto" >
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
          </svg> 
      </button>
      <button  id="nextArrow">

        <svg class="mt-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="size-6" width="35" height="35" transform="rotate(180)" >
         <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
       </svg>   
      </button>

    </div>

   </section>
   <div style="width: 100%; height:100px" id="footer-up-image">
    <img src="packages_imgae/shyllet.jpg" alt="" style="height: 300px;">
    <div class="overlay"></div>
   </div>

   <footer>
    <div class="footer-links">
        <div class="footer-section">
            <h3>Discover</h3>
            <a href="<?php echo $user_id === 0 ? 'index.php' : 'index.php?user_id=' . $user_id; ?>">Home</a><br>
                <a href="<?php echo $user_id === 0 ? 'Term.php' : 'Term.php?user_id=' . $user_id; ?>">Term</a><br>
                <a href="<?php echo $user_id === 0 ? 'Talent.php' : 'Talent.php?user_id=' . $user_id; ?>">Talent & Culture</a><br>
                <a href="<?php echo $user_id === 0 ? 'Refund.php' : 'Refund.php?user_id=' . $user_id; ?>">Refund Policy</a><br>
                <a href="<?php echo $user_id === 0 ? 'Privacy.php' : 'Privacy.php?user_id=' . $user_id; ?>">Privacy Policy</a><br>
        </div>

        <div class="footer-section footer-payment">
            <h3>Payment Methods</h3>
            <img src="v709_290.png" alt="bKash">
            <img src="v709_289.png" alt="Rocket">
        </div>

        <div class="footer-section">
            <h3>Need Help?</h3>
            <p>pothikbd@gmail.com<br>+8801885434861</p>
        
        </div>
    </div>

    <div class="footer-logo">
        <img src="vvvvvv-01[1] 1.png" alt="Footer Logo">
        <p>&copy; 2024 Pothik Ltd. All Rights Reserved.</p>
    </div>
</footer>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('navbar');

      function handleScroll() {
          if (window.scrollY > 0) {
              navbar.classList.add('scrolled');
          } else {
              navbar.classList.remove('scrolled');
          }
        }


    window.addEventListener('scroll', handleScroll);
      // Initial check on page load
    handleScroll()
  });
</script>
</body>
</html>