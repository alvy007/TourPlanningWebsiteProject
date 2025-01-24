

<link rel="preconnect" href="https://fonts.googleapis.com">
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link href="https://fonts.googleapis.com/css2?family=Inder&family=Inria+Serif:ital,
 wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Kaisei+HarunoUmi:wght@400;500;700&f
 amily=Kameron:wght@400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family
 =Overlock:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Poppins:ital,wght@0,
 100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,
 600;1,700;1,800;1,900&display=swap" rel="stylesheet">


 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anaheim:wght@400..800&family=Inder&family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Kaisei+HarunoUmi:wght@400;500;700&family=Kameron:wght@400..700&family=Oleo+Script:wght@400;700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Overlock:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

<!-- CSS for header and footer -->
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    header {
        background-color: rgba(255, 255, 255, 0.8);
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
    }

    .navbar .logo img {
        height: 50px;
    }

    .navbar .nav-links {
        display: flex;
        gap: 15px;
    }

    .navbar .nav-links a {
        text-decoration: none;
        color: #333;
        font-weight: bold;
        transition: color 0.3s;
    }

    .navbar .nav-links a:hover {
        color: #007B5E;
    }

    .navbar .sign-in a {
        text-decoration: none;
        background-color: #007B5E;
        color: white;
        padding: 8px 15px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .navbar .sign-in a:hover {
        background-color: #00563d;
    }

    .search-section-container {
        height: 880px;
        background: url('background...transport.png') no-repeat center center;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .search-section {
        text-align: center;
        padding: 20px;
    }

    .search-section .tabs {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    

    .search-section .tabs div {
        padding: 10px 20px;
        background-color: white;
        margin: 0 5px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        cursor: pointer;
    }

    .search-section .tabs .active {
        font-weight: bold;
        border: 2px solid #007B5E;
    }

    .search-section .tabs a {
        text-decoration: none;
        
        transition: background-color 0.3s;
    }

    .search-box {
        position: relative; /* Enable positioning for child elements */
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        display: inline-block;
        text-align: left;
        width: 70%;
        height: 300px; /* Ensure sufficient height for button placement */
    }
    
    .search-box .next-btn {
        display: inline-block;
        background-color: #007B5E;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        position: absolute; /* Position the button absolutely within the search box */
        bottom: 20px; /* Place it near the bottom */
        left: 50%; /* Center it horizontally */
        transform: translateX(-50%); /* Adjust for perfect centering */
    }

    .search-box input {
        width: calc(50% - 20px);
        padding: 10px;
        margin: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .search-box input[type="date"] {
        width: calc(25% - 20px);
    }

    .search-box .input-group {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .search-box .radio-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 10px;
    }

    .search-box .radio-group label {
        margin-left: 5px;
        margin-right: 15px;
        font-size: 14px;
    }

    

    .search-box .next-btn:hover {
        background-color: #00563d;
    }

    footer {
        background-color: #054D59;
        color: white;
        padding: 20px 0;
    }

    footer .footer-content {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    footer .footer-links,
    footer .payment-methods,
    footer .contact {
        flex: 1;
        margin: 10px;
        min-width: 200px;
    }

    footer h3 {
        margin-bottom: 15px;
        font-size: 18px;
    }

    footer a {
        color: white;
        text-decoration: none;
        display: block;
        margin: 5px 0;
        font-size: 14px;
    }

    footer a:hover {
        text-decoration: underline;
    }

    footer .payment-methods img {
        height: 30px;
        margin: 5px 10px 0 0;
        display: inline-block;
    }

    footer .logo {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
        text-align: center;
    }

    footer .logo img {
        height: 50px;
        margin-right: 10px;
    }

    footer .logo p {
        font-size: 14px;
        margin: 0;
    }

    @media (max-width: 768px) {
        .navbar .nav-links {
            flex-wrap: wrap;
        }

        .search-box input {
            width: calc(100% - 20px);
        }

        footer .footer-content {
            flex-direction: column;
            text-align: center;
        }

        footer .logo {
            justify-content: center;
        }
    }
</style>


 <!--  HOW WE CULTURE section css -->
 <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .culture-section {
    display: flex;
    flex-direction: column;
    color: rgba(255, 255, 255, 1);
    font: 400 40px/40px Kaisei HarunoUmi, -apple-system, Roboto, Helvetica, sans-serif;
  }
  
  .hero-container {
    display: flex;
    flex-direction: column;
    box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
    position: relative;
    min-height: 688px;
    width: 100%;
    align-items: end;
    justify-content: center;
    padding: 94px 80px;
  }
  
  .hero-background {
    position: absolute;
    inset: 0;
    height: 100%;
    width: 100%;
    object-fit: cover;
    object-position: center;
  }
  
  .content-wrapper {
    position: relative;
    display: flex;
    width: 100%;
    max-width: 1166px;
    flex-direction: column;
  }
  
  .top-border {
    aspect-ratio: 41.67;
    object-fit: contain;
    object-position: center;
    width: 100%;
  }
  
  .culture-heading {
    
    font-size: 60px;
    font-weight: 900;
  }
  
  .culture-text {
    font-size: 30px;
    font-weight: 500;
  }
  
  .message-container {
    align-self: center;
    margin: 86px 0 0 25px;
  }
  
  .bottom-border {
    aspect-ratio: 41.67;
    object-fit: contain;
    object-position: center;
    width: 100%;
    margin-top: 103px;
  }
  
  @media (max-width: 991px) {
    .hero-container {
      max-width: 100%;
      padding: 100px 20px 0;
    }
    
    .content-wrapper {
      max-width: 100%;
    }
    
    .top-border {
      max-width: 100%;
      margin-right: 9px;
    }
    
    .message-container {
      max-width: 100%;
      margin-top: 40px;
    }
    
    .bottom-border {
      max-width: 100%;
      margin-top: 40px;
    }
  }
  
  
  
  
  </style>
  
  
  
  
  
  
  <!-- WE ARE HIRING NOW texting  css -->
  <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .careers-container {
      background-color: #fff;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      align-items: end;
      padding: 89px 80px;
    }
    
    .main-heading {
      color: #000;
      align-self: center;
      margin-left: 48px;
      font: 700 64px/1 Inria Serif, sans-serif;
    }
    
    .divider {
      color: #000;
      align-self: center;
      margin: 38px 0 0 53px;
      font: 400 24px/1 Inder, sans-serif;
    }
    
    .intro-text {
      color: #000;
      align-self: center;
      width: 735px;
      margin: 57px 0 0 96px;
      font: 400 20px/20px Inria Serif, -apple-system, Roboto, Helvetica, sans-serif;
    }
    
    .talent-section {
      width: 100%;
      max-width: 1060px;
      margin: 149px 29px 0 0;
    }
    
    .talent-content {
      gap: 20px;
      display: flex;
    }
    
    .talent-heading-wrapper {
      display: flex;
      flex-direction: column;
      line-height: normal;
      width: 32%;
      margin-left: 0;
    }
    
    .talent-heading {
      color: #d82d2d;
      margin-left: -4px;
      font: 400 64px/64px Inria Serif, -apple-system, Roboto, Helvetica, sans-serif;
    }
    
    .talent-text-wrapper {
      display: flex;
      flex-direction: column;
      line-height: normal;
      width: 68%;
      margin-left: 20px;
    }
    
    .talent-text {
      color: #000;
      align-self: stretch;
      margin: auto 0;
      font: 400 20px/20px Inria Serif, -apple-system, Roboto, Helvetica, sans-serif;
    }
    
    .flexibility-section {
      margin-top: 93px;
      width: 100%;
      max-width: 1146px;
    }
    
    .flexibility-content {
      gap: 20px;
      display: flex;
    }
    
    .flexibility-text-wrapper {
      display: flex;
      flex-direction: column;
      line-height: normal;
      width: 50%;
      margin-left: 0;
    }
    
    .flexibility-text {
      color: #000;
      margin-top: 50px;
      font: 400 20px/20px Inria Serif, -apple-system, Roboto, Helvetica, sans-serif;
    }
    
    .flexibility-heading-wrapper {
      display: flex;
      flex-direction: column;
      line-height: normal;
      width: 50%;
      margin-left: 20px;
    }
    
    .flexibility-heading {
      color: #d82d2d;
      font: 400 64px/64px Inria Serif, -apple-system, Roboto, Helvetica, sans-serif;
    }
    
    .learning-section {
      width: 100%;
      max-width: 1093px;
      margin: 89px 29px 0 0;
    }
    
    .learning-content {
      gap: 20px;
      display: flex;
    }
    
    .learning-heading-wrapper {
      display: flex;
      flex-direction: column;
      line-height: normal;
      width: 39%;
      margin-left: 0;
    }
    
    .learning-heading {
      color: #d82d2d;
      font: 400 64px/64px Inria Serif, -apple-system, Roboto, Helvetica, sans-serif;
    }
    
    .learning-text-wrapper {
      display: flex;
      flex-direction: column;
      line-height: normal;
      width: 61%;
      margin-left: 20px;
    }
    
    .learning-text {
      color: #000;
      margin-top: 43px;
      font: 400 20px/20px Inria Serif, -apple-system, Roboto, Helvetica, sans-serif;
    }
    
    .values-section {
      margin-top: 104px;
      width: 100%;
      max-width: 1155px;
    }
    
    .values-content {
      gap: 20px;
      display: flex;
    }
    
    
    .values-text-wrapper {
      display: flex;
      flex-direction: column;
      line-height: normal;
      width: 57%;
      margin-left: 0;
    }
    
    .values-text {
      color: #000;
      font: 400 20px/20px Inria Serif, -apple-system, Roboto, Helvetica, sans-serif;
    }
    
    .values-heading-wrapper {
      display: flex;
      flex-direction: column;
      line-height: normal;
      width: 43%;
      margin-left: 20px;
    }
    
    .values-heading {
      color: #d82d2d;
      align-self: stretch;
      margin: auto 0;
      font: 400 64px/1 Inria Serif, sans-serif;
    }
    
    @media (max-width: 991px) {
      .careers-container {
        padding: 0 20px;
      }
      
      .main-heading {
        max-width: 100%;
        font-size: 40px;
      }
      
      .intro-text {
        max-width: 100%;
        margin-top: 40px;
      }
      
      .talent-section {
        max-width: 100%;
        margin: 40px 10px 0 0;
      }
      
      .talent-content {
        flex-direction: column;
        align-items: stretch;
        gap: 0;
      }
      
      .talent-heading-wrapper,
      .talent-text-wrapper {
        width: 100%;
      }
      
      .talent-heading {
        margin-top: 40px;
        font-size: 40px;
        line-height: 44px;
      }
      
      .talent-text {
        margin-top: 40px;
      }
      
      .flexibility-section {
        max-width: 100%;
        margin-top: 40px;
      }
      
      .flexibility-content {
        flex-direction: column;
        align-items: stretch;
        gap: 0;
      }
      
      .flexibility-text-wrapper,
      .flexibility-heading-wrapper {
        width: 100%;
      }
      
      .flexibility-heading {
        max-width: 100%;
        margin-top: 40px;
        font-size: 40px;
        line-height: 44px;
      }
      
      .learning-section {
        max-width: 100%;
        margin: 40px 10px 0 0;
      }
      
      .learning-content {
        flex-direction: column;
        align-items: stretch;
        gap: 0;
      }
      
      .learning-heading-wrapper,
      .learning-text-wrapper {
        width: 100%;
      }
      
      .learning-heading {
        margin-top: 40px;
        font-size: 40px;
        line-height: 44px;
      }
      
      .learning-text {
        max-width: 100%;
        margin-top: 40px;
      }
      
      .values-section {
        max-width: 100%;
        margin: 40px 10px 0 0;
      }
      
      .values-content {
        flex-direction: column;
        align-items: stretch;
        gap: 0;
      }
      
      .values-text-wrapper,
      .values-heading-wrapper {
        width: 100%;
      }
      
      .values-heading {
        max-width: 100%;
        margin-top: 40px;
        font-size: 40px;
      }
    }
  
  
  
  
     
  </style>
  
  
  
  
    <!-- hiring conten CSS  -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

    .hiring-container {
      display: flex;
      flex-direction: column;
      position: relative;
      min-height: 644px;
      width: 100%;
      align-items: center;
      padding: 119px 61px;
    }
    
    .background-image {
      position: absolute;
      inset: 0;
      height: 100%;
      width: 100%;
      object-fit: cover;
      object-position: center;
    }
    
    .hiring-title {
      position: relative;
      font-size: 70px;
      font-weight: 700;
      align-self: center;
      margin-left: 168px;
    }
    
    .hiring-description {
      position: relative;
      font-family: Kameron, sans-serif;
      align-self: center;
      font-size: medium;
      line-height: 32px;
      margin: 76px 0 0 -5px;
    }
    
    .cta-wrapper {
      position: relative;
      background-color: rgba(255, 253, 253, 1);
      display: flex;
      width: 403px;
      max-width: 100%;
      flex-direction: column;
      justify-content: center;
      margin: 65px 0 -28px 56px;
      padding: 18px;
    }
    
    .cta-button {
      background-color: rgba(105, 92, 92, 1);
      margin-left: 9px;
      padding: 40px 84px;
      border: none;
      cursor: pointer;
      color: inherit;
      font: inherit;
    }
    
    @media (max-width: 991px) {
      .hiring-container {
        max-width: 100%;
        padding: 0 20px 100px;
      }
    
      .hiring-title {
        max-width: 100%;
        font-size: 40px;
      }
    
      .hiring-description {
        max-width: 100%;
        margin-top: 40px;
        font-size: 50px;
      }
    
      .cta-wrapper {
        margin: 40px 0 10px;
      }
    
      .cta-button {
        padding: 0 20px;
      }
    }
    
    .visually-hidden {
      position: absolute;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0, 0, 0, 0);
      white-space: nowrap;
      border: 0;
    }
  
  
   </style>
  
  
  
  
  
    <!-- Reason WHY WE SHOULDN"T JOIN   css -->
     <style>
      .reasons-section {
        background-color: rgba(207, 232, 253, 0.8);
        display: flex;
        width: 100%;
        flex-direction: column;
        padding: 97px 28px 36px;
      }
      
      .section-title {
        color: #000;
        align-self: center;
        font: 700 48px/1 Poppins, sans-serif;
      }
      
      .reasons-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 66px;
      }
      
      .reason-card {
        background-color: #fff;
        flex: 1 1 calc(33.33% - 20px);
        padding: 32px 20px;
        display: flex;
        align-items: flex-start;
        min-width: 300px;
      }
      
      .reason-icon {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background-color: rgba(208, 229, 248, 0.8);
        margin-right: 20px;
        flex-shrink: 0;
      }
      
      .reason-text {
        color: #000;
        font: 400 15px/1.5 'Kaisei HarunoUmi', serif;
        margin: auto 0;
      }
      
      @media (max-width: 991px) {
        .reasons-section {
          padding: 40px 20px;
        }
      
        .section-title {
          font-size: 40px;
        }
      
        .reasons-grid {
          flex-direction: column;
          margin-top: 40px;
        }
      
        .reason-card {
          width: 100%;
          margin: 10px 0;
          flex-direction: column;
          align-items: center;
          text-align: center;
        }
      
        .reason-icon {
          margin: 0 0 20px 0;
        }
      }
  
  
     </style>
  
  
  
  
  
  
    <!-- JOIN OUR TEAM section css -->
   <style>

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .join-team-container {
      background-color: rgba(36, 161, 182, 1);
      display: flex;
      width: 100%;
      flex-direction: column;
      align-items: end;
      padding: 77px 51px 34px;
    }
    
    .content-wrapper {
      align-self: stretch;
    }
    
    .flex-container {
      gap: 20px;
      display: flex;
    }
    
    .image-column {
      display: flex;
      flex-direction: column;
      line-height: normal;
      width: 55%;
      margin-left: 0;
    }
    
    .team-image {
      aspect-ratio: 1.62;
      object-fit: contain;
      object-position: center;
      width: 100%;
      margin-top: 19px;
      max-width: 528px;
    }
    
    .form-column {
      display: flex;
      flex-direction: column;
      line-height: normal;
      width: 45%;
      margin-left: 20px;
    }
    
    .form-content {
      display: flex;
      flex-grow: 1;
      flex-direction: column;
      font-weight: 400;
      line-height: 1;
    }
    
    .heading-primary {
      color: rgba(255, 255, 255, 1);
      font: 64px Kameron, sans-serif;
    }
    
    .form-wrapper {
      display: flex;
      margin-top: 13px;
      width: 100%;
      flex-direction: column;
      color: rgba(0, 0, 0, 1);
      padding: 0 11px;
      font: 16px Poppins, sans-serif;
    }
    
    .signup-text-container {
      align-self: end;
      display: flex;
      align-items: center;
      gap: 10px;
      color: rgba(255, 255, 255, 1);
      justify-content: center;
      padding: 10px;
      font: 24px/24px Kaisei HarunoUmi, -apple-system, Roboto, Helvetica, sans-serif;
    }
    
    .signup-text-wrapper {
      align-self: stretch;
      display: flex;
      min-width: 240px;
      width: 509px;
      align-items: center;
      gap: 10px;
      justify-content: center;
      margin: auto 0;
    }
    
    .signup-text {
      align-self: stretch;
      width: 100%;
      min-width: 240px;
      gap: 10px;
      flex: 1;
      padding-left: 66px;
      margin: auto 0;
    }
    
    .name-fields {
      display: flex;
      margin-top: 53px;
      gap: 14px;
      flex-wrap: wrap;
    }
    
    .input-field {
      background-color: rgba(255, 253, 253, 1);
      flex-grow: 1;
      width: fit-content;
      padding: 15px 23px;
    }
    
    .email-field {
      background-color: rgba(255, 253, 253, 1);
      margin-top: 26px;
      padding: 11px 17px 18px;
    }
    
    .mobile-field {
      background-color: rgba(255, 253, 253, 1);
      align-self: start;
      display: flex;
      margin-top: 34px;
      gap: 12px;
      white-space: nowrap;
      padding: 13px 10px;
    }
    
    .checkbox {
      background-color: rgba(16, 164, 56, 1);
      display: flex;
      width: 23px;
      height: 20px;
    }
    
    .mobile-text {
      flex-basis: auto;
      flex-grow: 1;
    }
    
    .career-heading {
      color: rgba(255, 255, 255, 1);
      align-self: start;
      margin-top: 31px;
      font: 20px Inria Serif, sans-serif;
    }
    
    .department-select {
      background-color: rgba(255, 253, 253, 1);
      margin-top: 13px;
      padding: 17px 26px;
    }
    
    .consent-text {
      color: rgba(255, 253, 253, 1);
      margin: 49px 41px 0 64px;
      font: 400 22px/22px Inria Serif, -apple-system, Roboto, Helvetica, sans-serif;
    }
    
    .submit-button {
      background-color: rgba(16, 2, 2, 1);
      color: rgba(255, 255, 255, 1);
      white-space: nowrap;
      margin: 41px 238px 0 0;
      padding: 12px 56px;
      font: 700 32px/1 Pragati Narrow, -apple-system, Roboto, Helvetica, sans-serif;
      border: none;
      cursor: pointer;
    }
    
    .privacy-notice {
      color: rgba(255, 253, 253, 1);
      margin: 37px 101px 0 3px;
      font: 700 13px/13px Anaheim, sans-serif;
    }
    
    .privacy-link {
      font-family: Oleo Script, sans-serif;
      text-decoration: underline;
      color: rgba(255, 253, 253, 1);
    }
    
    .heading-text {
      font-family: Poppins, -apple-system, Roboto, Helvetica, sans-serif;
      font-weight: 700;
      font-size: 75px;
    }
    
    .visually-hidden {
      position: absolute;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0, 0, 0, 0);
      border: 0;
    }
    
    @media (max-width: 991px) {
      .join-team-container {
        max-width: 100%;
        padding: 0 20px;
      }
      
      .content-wrapper {
        max-width: 100%;
      }
      
      .flex-container {
        flex-direction: column;
        align-items: stretch;
        gap: 0;
      }
      
      .image-column {
        width: 100%;
      }
      
      .team-image {
        max-width: 100%;
        margin-top: 40px;
      }
      
      .form-column {
        width: 100%;
      }
      
      .form-content {
        max-width: 100%;
        margin-top: 40px;
      }
      
      .heading-primary {
        max-width: 100%;
        font-size: 40px;
      }
      
      .form-wrapper {
        max-width: 100%;
      }
      
      .signup-text-wrapper {
        max-width: 100%;
      }
      
      .signup-text {
        max-width: 100%;
      }
      
      .name-fields {
        max-width: 100%;
        margin-top: 40px;
      }
      
      .email-field {
        max-width: 100%;
        padding-right: 20px;
      }
      
      .mobile-field {
        white-space: initial;
      }
      
      .career-heading {
        margin-left: 2px;
      }
      
      .department-select {
        max-width: 100%;
        padding: 0 20px;
      }
      
      .consent-text {
        max-width: 100%;
        margin: 40px 10px 0 0;
      }
      
      .submit-button {
        white-space: initial;
        margin: 40px 10px 0 0;
        padding: 0 20px;
      }
      
      .privacy-notice {
        max-width: 100%;
        margin-right: 10px;
      }
    }
  </style>


  <!-- NECESSARY FONTS  -->
 
  


  <?php
// Start session


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


<section class="banner-container" role="banner" aria-label="Hero Banner">
    <img
      loading="lazy"
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/ff00300856b6fe1b7b5ba8e483e4474196d73d3308e24648a0c8667358f40e9a?placeholderIfAbsent=true&apiKey=6e0ac3fd00014f908819e8f9b6ed104d"
      class="banner-image"
      alt="Hero banner showcasing our main message"
      role="img"
      width="1440"
      height="645"
    />
    </section>



<!-- HOW WE CULTURE -->
    <div class="culture-section">
        <div class="hero-container">
          <img
            loading="lazy"
            src="https://cdn.builder.io/api/v1/image/assets/TEMP/1763fc49d5430d3b90cbf2863a40a4b65aab89efed8cd168bba86935f78cd76f?placeholderIfAbsent=true&apiKey=6e0ac3fd00014f908819e8f9b6ed104d"
            class="hero-background"
            alt="Company culture background image"
          />
          <div class="content-wrapper">
            <img
              loading="lazy"
              src="https://cdn.builder.io/api/v1/image/assets/TEMP/eea90b372346d5effdfdd1edd4b507b7c186930693cc32ae4e79c28b7ad3871b?placeholderIfAbsent=true&apiKey=6e0ac3fd00014f908819e8f9b6ed104d"
              class="top-border"
              alt=""
            />
            <div class="message-container">
              <span class="culture-heading">How We CULTURED</span>
             
            </div>
             
            <div class="message-container">
               
              <br />
              <br />
              <span class="culture-text">
                At Pathik we do not believe in the word 
              </span>
              <br />
              <span class="culture-text">
                employee, everyone here is a team player,
              </span>
              <br />
              <span class="culture-text">
                which is what makes the workplace so lively
              </span>
              <br />
              <span class="culture-text">and full of energy.</span>
            </div>
            <img
              loading="lazy"
              src="https://cdn.builder.io/api/v1/image/assets/TEMP/fd07cc1b5225a045c695c50940b4d046070630d4cc5f6d9492ea0de7f7c8af87?placeholderIfAbsent=true&apiKey=6e0ac3fd00014f908819e8f9b6ed104d"
              class="bottom-border"
              alt=""
            />
          </div>
        </div>
      </div>



<!-- WE ARE LOOKING FOR YOU -->
      <section class="careers-container" role="region" aria-label="Careers Information">
        <h1 class="main-heading">We are looking for you!</h1>
        <div class="divider">__________</div>
        <p class="intro-text">
          Are you searching for an engaging career opportunity that offers both, a meaningful experience in a new country and a chance to enhance your portfolio? Then we are theright place for you! At Elite, we are constantly looking for hard working new talents that have a fresh perspective and creative ideas.
        </p>
        
        <div class="talent-section">
          <div class="talent-content">
            <div class="talent-heading-wrapper">
              <h2 class="talent-heading">We believe in talent</h2>
            </div>
            <div class="talent-text-wrapper">
              <p class="talent-text">We believe that in this world there are some absolutely awesome people who have the imagination and skills to create extraordinary things. If that's you, we want to work with you.</p>
            </div>
          </div>
        </div>
        
        <div class="flexibility-section">
          <div class="flexibility-content">
            <div class="flexibility-text-wrapper">
              <p class="flexibility-text">Elite is an organization based on full-time work. However, there are many people who for different reasons including family and studies, are looking for challenging and rewarding part-time work. We offer work opportunities to talented people who want certain flexibility.</p>
            </div>
            <div class="flexibility-heading-wrapper">
              <h2 class="flexibility-heading">Can offer flexible fulltime work</h2>
            </div>
          </div>
        </div>
        
        <div class="learning-section">
          <div class="learning-content">
            <div class="learning-heading-wrapper">
              <h2 class="learning-heading">Learning opportunties</h2>
            </div>
            <div class="learning-text-wrapper">
              <p class="learning-text">As German certified instructors (Ausbilder, IHK), we offer young talents and students an opportunity to widen their horizon in a professional, European managed company based in a foreign country. Positions available are for either permanent employment or on an internship basis.</p>
            </div>
          </div>
        </div>
        
        <div class="values-section">
          <div class="values-content">
            <div class="values-text-wrapper">
              <p class="values-text">At our company we take human resources seriously. Our managers are trained to ensure a harassment free work environment, provide clear objectives and offer opportunities for career development. The management understands the importance in provide working culture that is built on giving regular performance feedback, positive affirmations and mentoring opportunities. We value in ensuring our employees are highly motivated and support their journey to success.</p>
            </div>
            <div class="values-heading-wrapper">
              <h2 class="values-heading">Elite values you</h2>
            </div>
          </div>
        </div>
      </section>




<!-- hiring conten -->
     <section class="hiring-container" aria-labelledby="hiring-title">
        <img
          src="https://cdn.builder.io/api/v1/image/assets/TEMP/ee9fd434c997bb63fb41e3e2211dc5f276049921d89f404b072562fe73389d8f?placeholderIfAbsent=true&apiKey=6e0ac3fd00014f908819e8f9b6ed104d"
          class="background-image"
          alt=""
          role="presentation"
        />
        <h1 id="hiring-title" class="hiring-title">     We're hiring, right now!</h1>
        <p class="hiring-description">
          Want to join our team? Take a look at
          <br />
          our current job listing and apply now.
        </p>
        <div class="cta-wrapper">
          <button class="cta-button" onclick="window.location.href='/jobs'" aria-label="View all job listings">
            View Job List
          </button>
        </div>
      </section>





    <!-- Reason why WE SHOULD"NOT  join pathik -->
    <section class="reasons-section" aria-labelledby="reasons-title">
    <h2 id="reasons-title" class="section-title">Reasons why you shouldn't join PATHIK</h2>
    
    <div class="reasons-grid">
      <article class="reason-card">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/7cbc658d7dea9113105617e942ec7ea8902187c7fad1709d4162454580b66c47?placeholderIfAbsent=true&apiKey=6e0ac3fd00014f908819e8f9b6ed104d" alt="Surprise party icon" class="reason-icon">
        <p class="reason-text">You hate surprise parties; because we have a lot of them.</p>
      </article>
  
      <article class="reason-card">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/5c8179200e08a628361eb4e87a882e73f0046d7133f7aa157cb3a5ea0579dd18?placeholderIfAbsent=true&apiKey=6e0ac3fd00014f908819e8f9b6ed104d" alt="Food icon" class="reason-icon">
        <p class="reason-text">You don't like to have a delicious lunch at the office; because our food is free.</p>
      </article>
  
      <article class="reason-card">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/f98cd746e6ac7d8b254b42bfe3250ffdd4c47a014e12f404c20c504db45b795b?placeholderIfAbsent=true&apiKey=6e0ac3fd00014f908819e8f9b6ed104d" alt="Clock icon" class="reason-icon">
        <p class="reason-text">You like working long hours to show-off; because we love finish work in time and go home early.</p>
      </article>
  
      <article class="reason-card">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/9a348b277e5a63c86a4cb3f79b7ff23d4ac746e6f6f87fff9d3c2b498faf4b1e?placeholderIfAbsent=true&apiKey=6e0ac3fd00014f908819e8f9b6ed104d" alt="Money icon" class="reason-icon">
        <p class="reason-text">You believe, money is everything and work environment is nothing.</p>
      </article>
  
      <article class="reason-card">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/d2f5ddd26ab9e59552c0d950bbc877ff824211eead5c4599d58881d31b2c936e?placeholderIfAbsent=true&apiKey=6e0ac3fd00014f908819e8f9b6ed104d" alt="Travel icon" class="reason-icon">
        <p class="reason-text">You hate travelling, seeing a new country and eating new cuisines do not interest you, you'd rather stay home.</p>
      </article>
  
      <article class="reason-card">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/5a8f6fdc91ccbd4ef07d23e3a7904a7b0a59d71be76ec6640ca082fa84d54c1f?placeholderIfAbsent=true&apiKey=6e0ac3fd00014f908819e8f9b6ed104d" alt="Goal icon" class="reason-icon">
        <p class="reason-text">You are content with just dreaming. We dream, we turn it into a goal and we achieve that goal.</p>
      </article>
  
      <article class="reason-card">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/bfb8368d4b21a4ddbeed39523afb83db9c9edcfd211d9ae179055c8b4e3dfb41?placeholderIfAbsent=true&apiKey=6e0ac3fd00014f908819e8f9b6ed104d" alt="Team icon" class="reason-icon">
        <p class="reason-text">You are a one-man army (Read: Lionel Messi); we would rather have team-player</p>
      </article>
  
      <article class="reason-card">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/8ee2eb527f2f56266f3d5d6612927328f37ed70890850f23cfa104c499b8fd05?placeholderIfAbsent=true&apiKey=6e0ac3fd00014f908819e8f9b6ed104d" alt="Boss icon" class="reason-icon">
        <p class="reason-text">You want to call everyone 'Boss' or 'Sir' or 'Ma'am'; because here we want you to behave 'Like a Boss</p>
      </article>
  
      <article class="reason-card">
        <img src="http://b.io/ext_9-" alt="Jokes icon" class="reason-icon">
        <p class="reason-text">You don't like puns or bad jokes; because the spirit of Chandler Bing lives in us.</p>
      </article>
    </div>
    </section>




    <!--JOIN OUR TEAM segment -->
  <div class="join-team-container">
    <div class="content-wrapper">
      <div class="flex-container">
        <div class="image-column">
          <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/7854c6ae87f9ca1266b0ee255e83bc977f437507dde660916395563405a16145?placeholderIfAbsent=true&apiKey=6e0ac3fd00014f908819e8f9b6ed104d" class="team-image" alt="Join our team illustration" />
        </div>
        <div class="form-column">
          <div class="form-content">
            <div class="heading-primary">
              <span class="heading-text">JOIN OUR TEAM</span>
            </div>
            <form class="form-wrapper">
              <div class="signup-text-container">
                <div class="signup-text-wrapper">
                  <div class="signup-text">Sign up to receive the latest news and job alerts.</div>
                </div>
              </div>
              <div class="name-fields">
                <label for="firstName" class="visually-hidden">First name</label>
                <input type="text" id="firstName" class="input-field" placeholder="First name" required />
                
                <label for="lastName" class="visually-hidden">Last name</label>
                <input type="text" id="lastName" class="input-field" placeholder="Last name" required />
              </div>
              
              <label for="email" class="visually-hidden">Email</label>
              <input type="email" id="email" class="email-field" placeholder="Email abc@gmail.com" required />
              
              <label for="Mobile" class="visually-hidden">Mobile Number</label>
                <input type="text" id="Mobile" class="input-field" placeholder="Mobile Number" required />
                
               
              
              <h2 class="career-heading">What career area(s) are you interested in?</h2>
              
              <label for="department" class="visually-hidden">Department selection</label>
              <select id="department" class="department-select" required>
                <option value="">Please choose the departments</option>
              </select>
              
              <div class="consent-text">
                I agree to be contacted about career opportunities<br />
                across Pathik Companey through mobile text,<br />
                emails, and phone calls.
              </div>
              
              <button type="submit" class="submit-button">JOIN</button>
              
              <div class="privacy-notice">
                By clicking 'I agree', I agree to be contacted about careers at Travel + Leisure Co. and its<br />
                business lines through mobile text, emails, and phone calls. By continuing I agree to<br />
                the POTHIK policy .
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
















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
            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/fbb7b65e7686947de7c4c2aabb5373738d595aa8f2cb75ee298bcc11f89159e7?placeholderIfAbsent=true&apiKey=6e0ac3fd00014f908819e8f9b6ed104d" alt="bKash">
            <img src=" https://cdn.builder.io/api/v1/image/assets/TEMP/f80abf7602dc6fa6c414975ae70d34f9379f1120711e806d2fe1d5ffc0af5830?placeholderIfAbsent=true&apiKey=6e0ac3fd00014f908819e8f9b6ed104d" alt="Nagad">
        </div>
        <div class="contact">
            <h3>Need Help?</h3>
            <p>pothikbd@gmail.com<br>+8801885434861</p>
            <p>We’re here for you 24/7! Reach out to us through Messenger or call anytime, day or night, for support.</p>
        </div>
    </div>
    <div class="logo">
        <img src=" https://cdn.builder.io/api/v1/image/assets/TEMP/44287fadc8cbe5145be64373dbf3177bc87eed20f30a0d6df23008c82524fd20?placeholderIfAbsent=true&apiKey=6e0ac3fd00014f908819e8f9b6ed104d" alt="Footer Logo">
        <p>&copy; 2024 Pothik Ltd. All Rights Reserved.</p>
    </div>
</footer>