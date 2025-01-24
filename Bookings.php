<?php
// Start session
session_start();

// Database connection
require_once 'connect.db.php'; // Replace with your database connection file

function getGuideId($conn, $destination) {
    $guideQuery = "
        SELECT * 
        FROM tourguide 
        WHERE availability = 1 
        AND address LIKE (SELECT district FROM destination WHERE name = ?) 
        LIMIT 1";
    
    $stmt = $conn->prepare($guideQuery);
    if ($stmt) {
        $stmt->bind_param("s", $destination);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stmt->close();
            return $row;
        }
        $stmt->close();
    } else {
        echo "Error preparing guide query: " . $conn->error;
        exit();
    }
    return null;
}


function getDestinationDetails($conn, $destination) {
    $sql = "SELECT * FROM destination WHERE name = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $destination);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stmt->close();
            return $row;
        }
        $stmt->close();
    }
    return null;
}

function getHotelId($conn, $hotel_name) {
    $hotelQuery = "SELECT * FROM hotel WHERE name = ?";
    $stmt = $conn->prepare($hotelQuery);
    if ($stmt) {
        $stmt->bind_param("s", $hotel_name);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stmt->close();
            return $row;
        }
        $stmt->close();
    }
    return null;
}

function getTransportId($conn, $totalPassengers) {
    $transportQuery = "SELECT * FROM transport WHERE capacity >= ? AND availability = 1 ORDER BY capacity ASC LIMIT 1";
    $stmt = $conn->prepare($transportQuery);
    if ($stmt) {
        $stmt->bind_param("i", $totalPassengers);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stmt->close();
            return $row;
        }
        $stmt->close();
    }
    return null;
}

function insertTravelPackage($conn, $user_id, $transport_id, $hotel_id, $guide_id, $start_date, $end_date, $adults, $children) {
    $sql = "INSERT INTO travelpackage (user_id, transport_id, hotel_id, guide_id, start_date, end_date, adults, children) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("iiiissii", $user_id, $transport_id, $hotel_id, $guide_id, $start_date, $end_date, $adults, $children);
        if ($stmt->execute()) {
            $package_id = $conn->insert_id;
            $stmt->close();
            return $package_id;
        }
        echo "Error inserting travel package: " . $stmt->error;
        $stmt->close();
    }
    return null;
}

function updateAvailability($conn, $table, $column, $value, $id_column, $id) {
    $sql = "UPDATE $table SET $column = ? WHERE $id_column = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ii", $value, $id);
        $stmt->execute();
        $stmt->close();
    }
}

function insertDestinationPackage($conn, $destination_id, $package_id) {
    $sql = "INSERT INTO destinationpackage (destination_id, package_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ii", $destination_id, $package_id);
        $stmt->execute();
        $stmt->close();
    }
}

function fetchAndInsertTransportDetails($conn, $package_id, $transport_id, $tour_type, $date_diff) {
    $sql = "SELECT type, price_per_day, phone, driver_name FROM transport WHERE transport_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $transport_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $total_price = $tour_type === 'pick_drop' ? 3 * $row['price_per_day'] : $row['price_per_day'] * $date_diff;
            $pick_drop = $tour_type === 'pick_drop' ? 'Pick And Drop' : 'Entire Tour';
            $transport_type=$row['type'];
            $driver_name=$row['driver_name'];
            $driver_phone=$row['phone'];

            $sql_insert = "INSERT INTO transportpackage (package_id, transport_id, pick_up, total_price) VALUES (?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            if ($stmt_insert) {
                $stmt_insert->bind_param("iisd", $package_id, $transport_id, $pick_drop, $total_price);
                $stmt_insert->execute();
                $stmt_insert->close();
            }
        }
        $stmt->close();
    }
}

function fetchAndInsertGuideDetails($conn, $package_id, $guide_id, $date_diff) {
    $sql = "SELECT name, phone, daily_rate FROM tourguide WHERE guide_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $guide_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $guide_total_price = $row['daily_rate'] * $date_diff;

            $sql_insert = "INSERT INTO tourguidepackage (guide_id, package_id, total_price) VALUES (?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            if ($stmt_insert) {
                $stmt_insert->bind_param("iid", $guide_id, $package_id, $guide_total_price);
                $stmt_insert->execute();
                $stmt_insert->close();
            }
        }
        $stmt->close();
    }
}

function fetchAndInsertHotelDetails($conn, $package_id, $hotel_id, $start_date, $end_date, $rooms, $adults, $children, $date_diff) {
    $sql = "SELECT location, price_per_night FROM hotel WHERE hotel_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $hotel_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hotel_total_price = $row['price_per_night'] * $date_diff * $rooms;

            $sql_insert = "INSERT INTO hotelpackage (package_id, hotel_id, check_in, check_out, booked_rooms, adult_guests, children_guests, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            if ($stmt_insert) {
                $stmt_insert->bind_param("iissiiid", $package_id, $hotel_id, $start_date, $end_date, $rooms, $adults, $children, $hotel_total_price);
                $stmt_insert->execute();
                $stmt_insert->close();
            }
        }
        $stmt->close();
    }
}

function payment($conn, $package_id) {

    $hotelPrice = 0;
    $guidePrice = 0;
    $transportPrice = 0;

    // Query to get total price from hotelpackage
    $sql = "SELECT total_price FROM hotelpackage WHERE package_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $package_id);
        $stmt->execute();
        $stmt->bind_result($hotelPrice);
        $stmt->fetch();
        $stmt->close();
    } else {
        echo "Error preparing hotelpackage query: " . $conn->error;
        return null;
    }

    // Query to get total price from tourguidepackage
    $sql1 = "SELECT total_price FROM tourguidepackage WHERE package_id = ?";
    $stmt1 = $conn->prepare($sql1);
    if ($stmt1) {
        $stmt1->bind_param("i", $package_id);
        $stmt1->execute();
        $stmt1->bind_result($guidePrice);
        $stmt1->fetch();
        $stmt1->close();
    } else {
        echo "Error preparing tourguidepackage query: " . $conn->error;
        return null;
    }

    // Query to get total price from transportpackage
    $sql2 = "SELECT total_price FROM transportpackage WHERE package_id = ?";
    $stmt2 = $conn->prepare($sql2);
    if ($stmt2) {
        $stmt2->bind_param("i", $package_id);
        $stmt2->execute();
        $stmt2->bind_result($transportPrice);
        $stmt2->fetch();
        $stmt2->close();
    } else {
        echo "Error preparing transportpackage query: " . $conn->error;
        return null;
    }

    // Return all values as an associative array
    return [
        'hotelPrice' => $hotelPrice,
        'guidePrice' => $guidePrice,
        'transportPrice' => $transportPrice
    ];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $package_id = intval($_POST['package_id'] ?? 0);
    $total_cost = htmlspecialchars($_POST['total_cost'] ?? '');
    $payment_method = htmlspecialchars($_POST['payment_method'] ?? '');
    $transaction_id = htmlspecialchars($_POST['transaction'] ?? '');
    $otp = htmlspecialchars($_POST['otp'] ?? '');
    $user_id = intval($_POST['user_id'] ?? 0);

    // Validate fields
    if (empty($package_id) || empty($total_cost) || empty($payment_method) || empty($transaction_id) || empty($otp)) {
        die("All fields are required.");
    }

    // Simulate OTP validation
    $valid_otp = $_SESSION['generated_otp'] ?? '123456';
    if ($otp !== $valid_otp) {
        die("Invalid OTP.");
    }

    // Database connection
    

    // Insert payment details
    $sql_payment = "INSERT INTO payment (package_id, transaction_id, payment_method, total_cost, paid_amount) 
                    VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql_payment);
    $paid_amount = $total_cost;
    $stmt->bind_param("sssdd", $package_id, $transaction_id, $payment_method, $total_cost, $paid_amount);

    if ($stmt->execute()) {
        // Redirect to BookingsStatic.php
        header("Location: BookingsStatic.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    
} else{
    $destination = isset($_GET['destination']) ? htmlspecialchars(trim($_GET['destination'])) : '';
    $start_date = isset($_GET['start_date']) ? htmlspecialchars(trim($_GET['start_date'])) : '';
    $end_date = isset($_GET['end_date']) ? htmlspecialchars(trim($_GET['end_date'])) : '';
    $adults = isset($_GET['adults']) ? intval($_GET['adults']) : 0;
    $children = isset($_GET['children']) ? intval($_GET['children']) : 0;
    $tour_type = isset($_GET['tour_type']) ? htmlspecialchars($_GET['tour_type']) : '';
    $tourGuideSelection = isset($_GET['tour_guide']) ? htmlspecialchars(trim($_GET['tour_guide'])) : '';
    $hotel_name = isset($_GET['hotel_name']) ? htmlspecialchars(trim($_GET['hotel_name'])) : '';
    $rooms = isset($_GET['rooms']) ? intval($_GET['rooms']) : 0;
    $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

}


// Main execution



$date_diff = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24);
$totalPassengers = $adults + $children;


$destinationDetails = getDestinationDetails($conn, $destination);

    $district = $destinationDetails['district'];
    $destination_id = $destinationDetails['destination_id'];

$transportDetails = getTransportId($conn, $totalPassengers);
    $transport_id= $transportDetails['transport_id'];
    $transport_type = $transportDetails['type'];
    $driver_name = $transportDetails['driver_name'];
    $driver_phone = $transportDetails['phone'];

$guideDetails =getGuideId($conn, $destination);
    $guide_id= $guideDetails["guide_id"];
    $guide_name = $guideDetails["name"];
    $guide_phone = $guideDetails["phone"];

$hotelDetails = getHotelId($conn, $hotel_name);
    $hotel_id = $hotelDetails["hotel_id"];
    $hotel_location= $hotelDetails["location"];
    $availabe_rooms = $hotelDetails["availability_"];

$package_id = insertTravelPackage($conn, $user_id, $transport_id, $hotel_id, $guide_id, $start_date, $end_date, $adults, $children);









if ($rooms > 0) {
    updateAvailability($conn, 'hotel', 'availability_', $availabe_rooms-$rooms, 'hotel_id', $hotel_id);
}
if ($transport_id) {
    updateAvailability($conn, 'transport', 'availability', 0, 'transport_id', $transport_id);
}
if ($guide_id) {
    updateAvailability($conn, 'tourguide', 'availability', 0, 'guide_id', $guide_id);
}

if ($package_id && $destination_id > 0) {
    insertDestinationPackage($conn, $destination_id, $package_id);
}

if ($transport_id > 0) {
    fetchAndInsertTransportDetails($conn, $package_id, $transport_id, $tour_type, $date_diff);
}

if ($guide_id > 0) {
    fetchAndInsertGuideDetails($conn, $package_id, $guide_id, $date_diff);
}

if ($hotel_id > 0) {
    fetchAndInsertHotelDetails($conn, $package_id, $hotel_id, $start_date, $end_date, $rooms, $adults, $children, $date_diff);
}

$paymentDetails = payment($conn, $package_id);
    $hotel_cost = $paymentDetails["hotelPrice"];
    $guide_cost = $paymentDetails["guidePrice"];
    $transport_cost = $paymentDetails["transportPrice"];
    $total_cost = $hotel_cost + $guide_cost + $transport_cost + ($adults*100 + $children*50) + ($hotel_cost + $guide_cost + $transport_cost + ($adults*100 + $children*50))*0.15 ;
    $total_cost = ceil($total_cost);

    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     // Sanitize and validate form inputs
    //     $payment_method = htmlspecialchars($_POST['payment_method'] ?? '');
    //     $contact_number = htmlspecialchars($_POST['contact_number'] ?? '');
    //     $transaction_id = htmlspecialchars($_POST['transaction'] ?? '');
    //     $otp = htmlspecialchars($_POST['otp'] ?? '');
    
    //     // Validate required fields
    //     if (empty($payment_method) || empty($transaction_id) || empty($otp)) {
    //         echo "All fields are required. Please fill in all the details.";
    //         exit();
    //     }
    
    //     // Validate OTP (you can add additional checks based on your backend OTP logic)
    //     if ($otp !== '123456') { // Example validation
    //         echo "Invalid OTP. Please try again.";
    //         exit();
    //     }
    
    //     // Simulate payment process (you can replace this with actual logic, such as API calls)
    //     echo "Payment successful!<br>";
    //     echo "Payment Method: " . $payment_method . "<br>";
    //     echo "Transaction ID: " . $transaction_id . "<br>";
    //     echo "Contact Number: " . $contact_number . "<br>";
    
    //     // Redirect to a success page (optional)
    //     // header("Location: success.php");
    //     exit();
    // } else {
    //     echo "Invalid request method.";
    //     exit();
    // }

    

    // echo "<h3>Debug Information:</h3>";
    // echo "Destination: " . $destination . "<br>";
    // echo "Start Date: " . $start_date . "<br>";
    // echo "End Date: " . $end_date . "<br>";
    // echo "Adults: " . $adults . "<br>";
    // echo "Children: " . $children . "<br>";
    // echo "Tour Type: " . $tour_type . "<br>";
    // echo "Tour Guide Selection: " . $tourGuideSelection . "<br>";
    // echo "Hotel Name: " . $hotel_name . "<br>";
    // echo "Rooms: " . $rooms . "<br>";
    // echo "User ID: " . $user_id . "<br>";
    // echo "Date Difference: " . $date_diff . " days<br>";
    // echo "Total Passengers: " . $totalPassengers . "<br>";
    
    // echo "Destination Details: District - " . $district . ", Destination ID - " . $destination_id . "<br>";
    
    // if ($transportDetails) {
    //     echo "Transport Details: ID - " . $transport_id . ", Type - " . $transport_type . ", Driver Name - " . $driver_name . ", Driver Phone - " . $driver_phone . "<br>";
    // } else {
    //     echo "No transport details found.<br>";
    // }
    
    // if ($guideDetails) {
    //     echo "Guide Details: ID - " . $guide_id . ", Name - " . $guide_name . ", Phone - " . $guide_phone . "<br>";
    // } else {
    //     echo "No guide details found.<br>";
    // }
    
    // if ($hotelDetails) {
    //     echo "Hotel Details: ID - " . $hotel_id . ", Location - " . $hotel_location . "<br>";
    // } else {
    //     echo "No hotel details found.<br>";
    // }
    
    // echo "Travel Package ID: " . ($package_id ? $package_id : "Package creation failed") . "<br>";
    


$conn->close();
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="varsatile.css">
    <link rel="stylesheet" href="singin.css">
    <title>Bill</title>
    <style>
        body{
            background-image: none;
        }
        .bill{
            scroll-behavior: auto;
            margin-top: 5%;
            width: 1300px;
            height: 1000px;
            background-color: rgb(255, 255, 255);
        }
        .bill_info{
            width: 50% ;
            height: 90%;
            background-color: rgba(255, 255, 255, 0.564);

        }
        input{
            border: none;
            position: relative;
            width: 5px;
        } 
        input:hover{
            cursor: auto;
        }
        .bill_info input:active{
            border: none;
        } 
        .bill_info li{
            list-style: none;
            display: flex;
            width: 70%;

        }
        .bill_info li span{
            position: relative;
            

        }
        .pay_method{
            width: 50% ;
            height: 90%;
            background-color: rgba(255, 255, 255, 0.564);
        }
        #mynavbar{
           background-color: white; 
        }

    </style>
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
      <div class="container d-md-flex justify-content-center align-item-center bill">
        <div class=" bill_info flex-column" style="margin-left: 12%;">
            <h3>Package Information</h3>
            <hr style="width: 43%; color:black">
           
            <ul style="list-style: none; padding: 0;" class="mt-4" >
                <section>
                
                    <li style="display: flex; align-items: center; margin-bottom: 10px;">
                      <label for="" style="flex: 1; margin-right:10px">Package Id</label>
                      <span >:</span>
                      <input type="int" name="package_id" value="<?php echo $package_id; ?>" readonly style="flex: 2;">
                    </li>
                    <li style="display: flex; align-items: center; margin-bottom: 10px;" class="">
                      <label for="" style="flex: 1;  margin-right:10px">Destination</label>
                      <span >:</span>
                      <input type="text" name="destination" value="<?php echo $destination; ?>" readonly style="flex: 2;">
                    </li>
                    <li style="display: flex; align-items: center; margin-bottom: 10px;">
                      <label for="" style="flex: 1;  margin-right:10px">Travel Dates</label>
                      <span>:</span>
                      <input type="text" name="dates" value="<?php echo $start_date.' - '.$end_date; ?>" readonly style="flex: 2;">
                    </li>
                    <li style="display: flex; align-items: center; margin-bottom: 10px;">
                      <label for="" style="flex: 1;">Total Travelers</label>
                      <span>:</span>
                      <?php $travellers= $adults+$children; ?>
                      <input type="int" name="travelers" value="<?php echo $travellers; ?>" readonly style="flex: 2;">
                    </li>
                </section>
                
                
                <!-- // $data = fetchAndInsertTransportDetails($conn, $package_id, $transport_id, $tour_type, $date_diff); -->
                

                <section class="transport mt-4">
                    <li style="display: flex; align-items: center; margin-bottom: 10px;">
                        <label for="" style="flex: 1;" class="h5">Transport Details</label>
                    </li>
                    <li style="display: flex; align-items: center; margin-bottom: 10px;">
                        <label for="" style="flex: 1;">Vehicle Type</label>
                        <span>:</span>
                        <input type="text" name="transport_type" value="<?php echo $transport_type; ?>" readonly style="flex: 2;">
                    </li>
                    <li style="display: flex; align-items: center; margin-bottom: 10px;">
                        <label for="" style="flex: 1;">Driver Name</label>
                        <span>:</span>
                        <input type="text" name="driver_name" value="<?php echo $driver_name; ?>" readonly style="flex: 2;">
                    </li>
                    <li style="display: flex; align-items: center; margin-bottom: 10px;">
                        <label for="" style="flex: 1;">Phone</label>
                        <span>:</span>
                        <input type="text" name="driver_phone" value="<?php echo $driver_phone; ?>" readonly style="flex: 2;">
                    </li>
                    <!-- <li style="display: flex; align-items: center; margin-bottom: 10px;">
                        <label for="" style="flex: 1;">Tour Type</label>
                        <span>:</span>
                        <input type="text" name="pick_drop" value="<?php echo $data['pick_drop']; ?>" readonly style="flex: 2;">
                    </li>
                    <li style="display: flex; align-items: center; margin-bottom: 10px;">
                        <label for="" style="flex: 1;">Total Price</label>
                        <span>:</span>
                        <input type="text" name="total_price" value="<?php echo $data['total_price']; ?>" readonly style="flex: 2;">
                    </li> -->
                </section>
                <section>
                    <li style="display: flex; align-items: center; margin-bottom: 10px;">
                        <label for="" style="flex: 1;" class="h5">Hotel Details </label>
                      </li>
                    <li style="display: flex; align-items: center; margin-bottom: 10px;">
                        <label for="" style="flex: 1;">Hotel Name</label>
                        <span>:</span>
                        <input type="text" name="hotel_name" value="<?php echo $hotel_name; ?>" readonly style="flex: 2;">
                      </li>
                     
                    <li style="display: flex; align-items: center; margin-bottom: 10px;">
                      <label for="" style="flex: 1;">Location</label>
                      <span >:</span>
                      <input type="text" name="hotel_location" value="<?php echo $hotel_location;?>" readonly style="flex: 2;">
                    </li>
                    <!-- <li style="display: flex; align-items: center; margin-bottom: 10px;">
                        <label for="" style="flex: 1;">Contact Number</label>
                        <span >:</span>
                        <input type="text" readonly style="flex: 2;">
                      </li> -->
                      <li style="display: flex; align-items: center; margin-bottom: 10px;">
                        <label for="" style="flex: 1;">Number of Rooms</label>
                        <span >:</span>
                        <input type="int" name="rooms" value="<?php echo $rooms;?>" readonly style="flex: 2;">
                      </li>
                      <li style="display: flex; align-items: center; margin-bottom: 10px;">
                        <label for="" style="flex: 1;">Check In</label>
                        <span >:</span>
                        <input type="text" name="check_in" value="<?php echo $start_date;?>" readonly style="flex: 2;">
                      </li>
                      <li style="display: flex; align-items: center; margin-bottom: 10px;">
                        <label for="" style="flex: 1;">Check Out</label>
                        <span >:</span>
                        <input type="text" name="check_out" value="<?php echo $end_date;?>" readonly style="flex: 2;">
                      </li>
                </section>
                <section>
                    <li style="display: flex; align-items: center; margin-bottom: 10px;">
                        <label for="" style="flex: 1;" class="h5">Guide Details </label>
                      </li>
                      <li style="display: flex; align-items: center; margin-bottom: 10px;">
                        <li style="display: flex; align-items: center; margin-bottom: 10px;">
                            <label for="" style="flex: 1;">Name</label>
                            <span >:</span>
                            <input type="text" name="guide_name" value="<?php echo $guide_name; ?>" readonly style="flex: 2;">
                          </li>
                        <label for="" style="flex: 1;">Contact Number</label>
                        <span >:</span>
                        <input type="text" name="guide_phone" value="<?php echo $guide_phone ; ?>" readonly style="flex: 2;">
                      </li>


                </section>
                <a href="<?php echo 'Destination.php?user_id='.$user_id ;?>" style="width: 50%;">
                    

                        <button class="btn btn-primary mt-3" name="edit" type="submit" style="width: 50%">Edit</button>
                    

                </a>
                <a href="<?php echo 'index.php?user_id='.$user_id ;?>" style="width: 50%;">
                    

                        <button class="btn btn-danger mt-3" type="submit" style="width: 50%">Cancel</button>
                    

                </a>
            </ul>
          </div>
          
        <div class="pay_method ">
            <div class="container" style="margin-left: 20%;">

                <h3 class="d-flex">Billing</h3>
                <hr style="width: 43%; color:black" >
                <li style="display: flex; align-items: center; margin-bottom: 10px;">
                    <label for="" style="flex: 1;">Transport Cost </label>
                    <span>:</span>
                    <input type="decimal" name="transport_cost" value="<?php echo $transport_cost;?>" readonly style="flex: 2;">
                  </li>
                  <li style="display: flex; align-items: center; margin-bottom: 10px;">
                    <label for="" style="flex: 1;">Guide Cost </label>
                    <span>:</span>
                    <input type="decimal" name="guide_cost" value="<?php echo $guide_cost;?>" readonly style="flex: 2;">
                  </li>
                  <li style="display: flex; align-items: center; margin-bottom: 10px;">
                    <label for="" style="flex: 1;">Hotel Cost </label>
                    <span>:</span>
                    <input type="decimal" name="hotel_cost" value="<?php echo $hotel_cost;?>" readonly style="flex: 2;">
                  </li>
                  <li style="display: flex; align-items: center; margin-bottom: 10px;">
                    <label for="" style="flex: 1;">Vat</label>
                    <span>:</span>
                    <input type="text" value="15%" readonly style="flex: 2;">
                  </li>
                  <hr style="width: 43%; color:black">
                  
                  <li style="display: flex; align-items: center; margin-bottom: 10px;">
                    <label for="" style="flex: 1;
                    color:brown" class="h6">Total Cost </label>
                    <span>:</span>
                    <input type="decimal" name="total_cost" value="<?php echo $total_cost;?>" readonly style="flex: 2;">
                  </li>
                  
    
    
                  
    
    
                  <button class="btn btn-primary mt-5" type="button" style="width: 50%;" onclick="showPaymentProcess()">Pay</button>

                  <div id="payment-process" class="mt-5" style="display: none; background-color: beige; width: 100%; padding: 10px 0px 0 25px; position: relative; margin-right: 20px;">
                    <h3>Payment Process</h3>
                    <form id="billing-form" method="POST" action="Bookings.php">
                        <input type="hidden" name="package_id" value="<?php echo $package_id;?>">
                        <input type="hidden" name="total_cost" value="<?php echo $total_cost;?>">
                        <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                        <div class="form-group">
                            <label for="payment-method">Payment Method</label>
                            <select id="payment-method" name="payment_method" required onchange="togglePaymentFields()">
                            <option value="bkash">Bkash</option>
                            <option value="nogod">Rocket</option>
                            </select>
                        </div>
                        
                        <li style="display: flex; align-items: center; margin-top: 10px;">
                            <label for="contact_number" style="flex: 1;">Send Money To</label>
                            <span>:</span>
                            <input type="text" name="contact_number" value="01885434863" readonly style="flex: 2;">
                        </li>
                        
                        <li style="display: flex; align-items: center; margin-top: 10px;">
                            <label for="transaction" style="flex: 1;">Transaction ID</label>
                            <span>:</span>
                            <input type="text" id="transaction" name="transaction" value="" required style="flex: 2; cursor: text;">
                        </li>
                        
                        <button id="otpRequestBtn" type="button" style="width: 100%; height: 35px; margin-top: 10px;" onclick="requestOtp()">Request OTP</button>
                        
                        <div id="otpForm" class="form-container" style="display: none;">
                            <li style="display: flex; align-items: center; margin-top: 10px;">
                            <label for="otpCode" style="flex: 1;">Enter OTP</label>
                            <span>:</span>
                            <input type="text" id="otpCode" name="otp" required style="flex: 2; cursor: text;">
                            </li>
                            <p class="prompt">You will receive your OTP within 2 hours.</p>
                            <button type="submit" name="pay" style="width: 100%; height: 35px; margin-top: 10px;">Verify</button>
                        </div>
                    </form>
                  </div>
                  
                  
                  <script>
                    function requestOtp(){
                        const otpCode = document.getElementById("otpForm");
                        otpCode.style.display = "block";
                        

                    }
                    function showPaymentProcess() {
                      // Get the payment process container
                      const paymentProcess = document.getElementById("payment-process");
                      
                      // Show it by changing the display style
                      paymentProcess.style.display = "block";
                    }
                  </script>
                  
            </div>
        </div>

      </div>
      <footer style="position:relative; top:400px">
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
      
    
</body>
</html>