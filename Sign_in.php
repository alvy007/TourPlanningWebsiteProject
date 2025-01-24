<?php
session_start();
require_once 'connect.db.php'; 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        
        $sql = "SELECT user_id, name, email, phone, password FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            
            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();

                // Direct string comparison for password (No hashing)
                if ($password === $user['password']) {
                    $user_id = $user['user_id']; 
                    
                    header("Location: index.php?user_id=" . urlencode($user_id));
                    exit();
                }
            }
            $stmt->close();
        }
    }

    header("Location: Sign_in.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="varsatile.css">
    <link rel="stylesheet" href="singin.css">
    <link rel="stylesheet" href="style.css">
    <title>signin</title>
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
            <li class="nav-item">
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
       <div class="signinpage mx-auto">
        <div class="d-flex justify-content-center mt-3">

          <svg height="80" width="80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-6">
            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
          </svg>
        </div>
        
        <h3 class="text-white d-flex justify-content-center">Sign In</h3>
        <div style="width: 10%; height:2px; background-color:white;" class="d-flex mx-auto justify-content-center mb-3"></div>
        <form method="post" action="Sign_in.php" class="container  From">
          <div class="mb-3 Input" >
            <div class="d-flex">
              <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="white" class="size-2" style="height: 3rem;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              </svg>
              <input 
                type="email" 
                class="form-control" 
                id="email" 
                name="email" 
                required 
                style="height:3rem" 
                placeholder="Enter your email"
              />
              <style>
                input::placeholder {
                  color: rgb(255, 255, 255); /* Change the placeholder color */
                  font-style: italic; /* Optional: Add styling */
                }
              </style>
            </div>

            <!-- Password Input -->
            <div class="d-flex mt-3">
              <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="white" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
              </svg>
              <input type="hidden" name="user_id" value="<?php echo $user_id?>">
              <input 
                type="password" 
                class="form-control" 
                id="password" 
                name="password" 
                required 
                placeholder="Enter your password" 
                style="height:3rem"
              />
            </div>
           <button type="submit" class="btn btn-primary" style=" border-radius: 25px; height:3rem; border: 2px rgb(255, 255, 255) solid;">Login</button>
           <!-- <a href="" class="text-primary mx-auto my-0" style="position:relative; top:-15px">Forgotten password?</a> -->
        
                
            
            <p style="color:white; weight:regular; position:relative;  top:36px; left:10px ">Dont have any account? </p>
           <a href="Register.php" class="btn btn-success pt-2" style=" border-radius: 25px; height:3rem; border: 2px rgb(255, 255, 255) solid;">
           Register
           </a>
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