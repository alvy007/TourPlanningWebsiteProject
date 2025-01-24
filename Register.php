<?php
// Start session
session_start();

// Include the database connection file
require_once 'connect.db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $passwordcheck = trim($_POST['passwordcheck']);

    // Check for empty fields
    if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($passwordcheck)) {
        die('Please fill in all the fields.');
    }

    // Check if passwords match
    if ($password !== $passwordcheck) {
        die('Passwords do not match.');
    }

    // Check if the email is already registered
    $checkEmailSQL = "SELECT email FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkEmailSQL);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        die('This email is already registered.');
    }
    $stmt->close();

    // Insert user into the database
    $insertSQL = "INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertSQL);
    $stmt->bind_param("ssss", $name, $email, $phone, $password); // Plain-text password storage for demo purposes; use password_hash() in production

    if ($stmt->execute()) {
        // Retrieve the last inserted user ID
        $user_id = $conn->insert_id;

        // Redirect to index.php with the user ID
        header("Location: index.php?user_id=" . urlencode($user_id));
        exit();
    } else {
        die('Error: ' . $conn->error);
    }

    $stmt->close();
    $conn->close();
} 
// else {
//     // Redirect back to the form if accessed via GET
//     header('Location: register_form.php');
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="varsatile.css">
    <link rel="stylesheet" href="singin.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
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
                <a class="nav-link" href="index.php">HOME</a>
            </li>
            <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">TRIP PLAN</a>
            </li>
            <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">BOOKINGS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Blog.php">BLOG</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="AboutUs.php">ABOUT US</a>
            </li>
            <<li class="nav-item">
                <a class="nav-link" href="Help.php">HELP</a>
            </li>
          </ul>
          

          
              
          
            
          
          <ul class="navbar-nav ms-auto bg-primary " id="signin">
                <li class="nav-item">
                  <a class="nav-link text-dark" href="#">SIGN IN</a>
                </li>
              </ul>

          

          
         
        </div>
      </div>
    </nav>
   </header>
       <div class="signinpage mx-auto p-3">
        
        <h3 class="text-white d-flex justify-content-center">Create Account</h3>
        <div style="width: 25%; height:2px; background-color:white;" class="d-flex mx-auto justify-content-center mb-3"></div>
        <form method="post" action="Register.php" class="container  From">
          <div class="mb-3 Input" >
              <input type="text" class="form-control" id="name" name="name" style="height:3rem" placeholder="Your full name"/>
              <style>
                input::placeholder {
                  color: rgb(255, 255, 255); /* Change the placeholder color */
                  font-style: italic; /* Optional: Add styling */
                }
              </style>
            
              <input type="text" class="form-control" id="email" name="email" placeholder="Your Email " style="height:3rem"/>
              <input type="text" class="form-control" id="phone" name="phone" placeholder="Your Phone number " style="height:3rem"/>
              <input type="password" class="form-control" id="password" name="password" placeholder="Set Password" style="height:3rem"/>
              <input type="password" class="form-control" id="passwordcheck" name="passwordcheck" placeholder="Retype the password" style="height:3rem"/>
           
           <button type="submit" class="btn btn-success" style=" border-radius: 25px; height:3rem; border: 2px rgb(255, 255, 255) solid;">
           Sign Up
          </button>
          <div class="mx-auto d-flex d-flex gap-1">
            <p style="position:relative; top:-15px" class="text-white">Already have an account?</p>
            <a href="Sign_in.php" class=" d-flex text-primary mx-auto my-0" style="position:relative; top:-15px" >Login here</a>
          </div>
          </div>
          
        </form>
       </div>

       <footer style="margin-top:-500px">
            <div class="footer-links">
                <div class="footer-section">
                    <h3>Discover</h3>
                    <a href="index.php">Home</a><br>
            <a href="Term.php">Terms</a><br>
            <a href="Talent.php">Talent & Culture</a><br>
            <a href="Refund.php">Refund Policy</a><br>
            <a href="Privacy.php">Privacy Policy</a><br>
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
    
</body>
</html>