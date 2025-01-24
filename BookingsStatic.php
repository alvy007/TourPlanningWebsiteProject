<?php
// Start session
session_start();
include("connect.db.php");

// Retrieve the user_id from the URL or set it to 0 if not provided
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

// Handle logout action
if (isset($_POST['logout'])) {
    session_destroy(); // Destroy the session
    header("Location: index.php?user_id=0"); // Redirect to homepage
    exit();
}

// Initialize variables
$destination_name = '';
$package_id = 0;
$start_date = '';
$end_date = '';
$transport = ['driver_name' => '', 'phone' => ''];
$guide = ['name' => '', 'phone' => ''];
$hotel = ['name' => '', 'location' => ''];
$hotel_package = ['check_in' => '', 'check_out' => '', 'booked_rooms' => ''];
$total_cost = '';

if ($user_id > 0) {
    // Fetch the latest travel package details
    $sql = "SELECT package_id, hotel_id, guide_id, transport_id, start_date, end_date 
            FROM travelpackage 
            WHERE user_id = ? 
            ORDER BY created_at DESC LIMIT 1";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $package = $result->fetch_assoc();
        $stmt->close();

        if ($package) {
            $package_id = $package['package_id'];
            $hotel_id = $package['hotel_id'];
            $guide_id = $package['guide_id'];
            $transport_id = $package['transport_id'];
            $start_date = $package['start_date'];
            $end_date = $package['end_date'];

            // Fetch destination name
            $sql = "SELECT d.name 
                    FROM destination d 
                    INNER JOIN destinationpackage dp ON d.destination_id = dp.destination_id 
                    WHERE dp.package_id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param('i', $package_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $destination_name = $result->fetch_assoc()['name'] ?? '';
                $stmt->close();
            }

            // Fetch tour guide details
            $sql = "SELECT name, phone FROM tourguide WHERE guide_id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param('i', $guide_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $guide = $result->fetch_assoc() ?: [];
                $stmt->close();
            }

            // Fetch hotel details
            $sql = "SELECT name, location FROM hotel WHERE hotel_id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param('i', $hotel_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $hotel = $result->fetch_assoc() ?: [];
                $stmt->close();
            }

            // Fetch hotel package details
            $sql = "SELECT check_in, check_out, booked_rooms FROM hotelpackage WHERE package_id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param('i', $package_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $hotel_package = $result->fetch_assoc() ?: [];
                $stmt->close();
            }

            // Fetch transport details
            $sql = "SELECT driver_name, phone FROM transport WHERE transport_id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param('i', $transport_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $transport = $result->fetch_assoc() ?: [];
                $stmt->close();
            }

            // Fetch total cost
            $sql = "SELECT total_cost FROM payment WHERE package_id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param('i', $package_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $total_cost = $result->fetch_assoc()['total_cost'] ?? '';
                $stmt->close();
            }
        }
    } else {
        error_log("Failed to prepare the SQL statement: " . $conn->error);
    }
}
$conn->close();
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
<script src=
 "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js">
    </script>
    <script src=
 "https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js">
    </script>
<script src="script.js" defer></script>
    <title>Pothik</title>
</head>
<body class="m-0 p-0" style="background: white">
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

   <section class="package-details" style="width=50%; height=100%; margin-top:100px">
  <div class="container" style="" >
    
    <div  class="details-form" id="content" >
    <h2 class="section-title">Travel Package Details</h2>

            <div class="row mb-3">
              <div class="col-md-6">
                <label for="destination" class="form-label">Destination Name</label>
                <input type="text" id="destination" class="form-control" value="<?php echo htmlspecialchars($destination_name); ?>" readonly>
              </div>
              <div class="col-md-6">
                <label for="package-id" class="form-label">Package ID</label>
                <input type="text" id="package-id" class="form-control" value="<?php echo htmlspecialchars($package_id); ?>" readonly>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="start-date" class="form-label">Starting Date</label>
                <input type="text" id="start-date" class="form-control" value="<?php echo htmlspecialchars($start_date); ?>" readonly>
              </div>
              <div class="col-md-6">
                <label for="end-date" class="form-label">Ending Date</label>
                <input type="text" id="end-date" class="form-control" value="<?php echo htmlspecialchars($end_date); ?>" readonly>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="driver-name" class="form-label">Car Driver Name</label>
                <input type="text" id="driver-name" class="form-control" value="<?php echo htmlspecialchars($transport['driver_name']); ?>" readonly>
              </div>
              <div class="col-md-6">
                <label for="driver-contact" class="form-label">Driver Contact Number</label>
                <input type="text" id="driver-contact" class="form-control" value="<?php echo htmlspecialchars($transport['phone']); ?>" readonly>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="guide-name" class="form-label">Tour Guide Name</label>
                <input type="text" id="guide-name" class="form-control" value="<?php echo htmlspecialchars($guide['name']); ?>" readonly>
              </div>
              <div class="col-md-6">
                <label for="guide-contact" class="form-label">Tour Guide Contact Number</label>
                <input type="text" id="guide-contact" class="form-control" value="<?php echo htmlspecialchars($guide['phone']); ?>" readonly>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="hotel-name" class="form-label">Hotel Name</label>
                <input type="text" id="hotel-name" class="form-control" value="<?php echo htmlspecialchars($hotel['name']); ?>" readonly>
              </div>
              <div class="col-md-6">
                <label for="hotel-location" class="form-label">Hotel Location</label>
                <input type="text" id="hotel-location" class="form-control" value="<?php echo htmlspecialchars($hotel['location']); ?>" readonly>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="check-in" class="form-label">Check-in Time</label>
                <input type="text" id="check-in" class="form-control" value="<?php echo htmlspecialchars($hotel_package['check_in']); ?>" readonly>
              </div>
              <div class="col-md-6">
                <label for="check-out" class="form-label">Check-out Time</label>
                <input type="text" id="check-out" class="form-control" value="<?php echo htmlspecialchars($hotel_package['check_out']); ?>" readonly>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="rooms" class="form-label">Number of Booked Rooms</label>
                <input type="text" id="rooms" class="form-control" value="<?php echo htmlspecialchars($hotel_package['booked_rooms']); ?>" readonly>
              </div>
              <div class="col-md-6">
                <label for="total-cost" class="form-label">Total Cost</label>
                <input type="text" id="total-cost" class="form-control" value="<?php echo 'BDT '.htmlspecialchars($total_cost); ?>" readonly>
              </div>
            </div>
        
        
      </div>
      <div class="row mb-3">
            <div class="col-md-4">
                <button type="button" id="edit-btn" class="btn btn-warning w-100">Edit</button>
            </div>
            <div class="col-md-4">
            <button type="button" id="download-btn" class="btn btn-primary w-100" onclick="convertHTMLtoPDF()">Download</button>
            </div>
            <div class="col-md-4">
                <button type="button" id="cancel-btn" class="btn btn-danger w-100">Cancel</button>
            </div>
    </div>
    
  </div>
  
</section>

<script type="text/javascript">
        function convertHTMLtoPDF() {
            const { jsPDF } = window.jspdf;
 
            let doc = new jsPDF('l', 'mm', [1500, 1400]);
            let pdfjs = document.querySelector('#content');
 
            doc.html(pdfjs, {
                callback: function(doc) {
                    doc.save("newpdf.pdf");
                },
                x: 12,
                y: 12
            });                
        }            
    </script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const editButton = document.getElementById('edit-btn');
    const cancelButton = document.getElementById('cancel-btn');

    // Function to send email
    function sendEmail(subject, body) {
        const mailto = `mailto:mzihad221257@bscse.uiu.ac.bd?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
        window.location.href = mailto;
    }

    // Add click event listeners to the buttons
    if (editButton) {
        editButton.addEventListener('click', function() {
            sendEmail(
                'Edit Button Clicked', 
                'The Edit button was clicked. Please take the necessary action.'
            );
        });
    }

    if (cancelButton) {
        cancelButton.addEventListener('click', function() {
            sendEmail(
                'Cancel Button Clicked', 
                'The Cancel button was clicked. Please take the necessary action.'
            );
        });
    }
});

</script>





<style>
.package-details {
  display: flex;
  background-color: #f9f9f9;
}

.section-title {
  text-align: center;
  margin-bottom: 20px;
  font-family: 'Playwrite AU SA', sans-serif;
  font-size: 24px;
  color: #333;
}

.details-form .form-label {
  font-weight: bold;
  font-size: 14px;
  color: #555;
}

.details-form .form-control {
  background-color: #e9ecef;
  border: none;
  border-radius: 5px;
  font-size: 14px;
  color: #333;
}

.details-form .form-control[readonly] {
  cursor: not-allowed;
}

.container {
  max-width: 800px;
  margin: auto;
}
</style>

   <footer style="top: 500px">
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
