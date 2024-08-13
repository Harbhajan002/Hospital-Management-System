<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="Hospital.css">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/lgo-removebg.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Hospital Home</title>
</head>

<body>
    <div class="section-a">
    
        <header>
            <div class="logo"><img src="./assets/lgo-removebg.png" alt="">
                <p>Hospital</p>
            </div>
            <div class="menu">
                <ul>
                    <a href="#"><li>HOME</li></a>
                    <a href="#service"> <li>SERVICE</li></a>
                    <a href="#about"><li>ABOUT US</li></a>
                    <a href=""><li>CONTACT</li></a>
                   
                    
                    
                    <li><a href="patient-login.php"><button>Book Appointment</button></a></li>
                </ul>
                
            </div>
            <div class="hamburger" id="hamburger">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            
        </header>
    </div>
    <div class="side-menu active" id="side_menu">
    <ul>
                    <a href="#"><li>HOME</li></a>
                    <a href="#service"> <li>SERVICE</li></a>
                    <a href="#about"><li>ABOUT US</li></a>
                    <a href=""><li>CONTACT</li></a>
                   
                    
                    
                    <li><a href="patient-login.php"><button>Book Appointment</button></a></li>
                </ul>
                
    </div>
    <div class="main-container">
       <div class="silder-section">
         <img src="./assets/hospital-image2.avif
         " alt="">
         <h1>Your Health, Our Priority:</h1>
         <p>General Physicians at Your Service!</p>
       </div>
       <div class="login-section">
        <h2>Login</h2>
        <div class="login-card">
            <div class="cards">
                <img src="./assets/hos-image.jpg" alt="paitent">
                <div class="text-area">
                    <h3>Patient Login</h3>
                    <button><a  href="patient-login.php">Click</a></button>
                </div>
            </div>
            <div class="cards">
                <img src="./assets/hospital.jpg" alt="paitent">
                <div class="text-area">
                    <h3>Admin Login</h3>
                    <button><a  href="admin-login.php">Click</a></button>
                </div>
            </div>
            <div class="cards">
                <img src="./assets/hospital.jpg" alt="paitent">
                <div class="text-area">
                    <h3>Doctor Login</h3>
                    <button><a  href="DOCTOR-login.php">Click</a></button>
                </div>
            </div>
        </div>
       </div>
       <div class="about-medical" id="about">
        <div class="about-img">
        <img src="./assets/hospital-image2.avif" alt="">
        </div>
       
        <div class="about-content" >
            <h2>About Medical</h2>
        <p>We realised that it is not merely a transaction of health services between a patient and doctor. It is trust that fosters a healthy relationship in the journey of health.
        <br>
        As we move with the times, we realise that technology has a huge role in making our services way more efficient. And by its application, way more human as well.
        <br>
        We have a dream. Our dream is to be available to you round the clock, wherever you are and whenever you want. We want to be just one tap away from you, and this will be the beginning of consumer-centric healthcare.
        </p>
        <p>
        <ul><li>Symptoms and Diagnosis</li>
        <li>Treatment and Medications</li>
        <li>Preventive Measures and Lifestyle Changes</li><li>
        Follow-up and Additional Concerns</li></ul>
        </p>
        </div>
       </div>
       <div class="about-our">
        <div> <h2>Doctors, Life Savers</h2>
        <p>Our superspecialist doctors provide the highest quality of care through a team-based, doctor-led model. Trained at some of the world's most renowned institutions, our highly experienced doctors are distinguished experts in their respective specialities. Our doctors work full-time and exclusively across Medanta hospitals. In addition to offering superspecialised care in their own field, the Medanta organisational structure enables every doctor to help create a culture of 
            collaboration and multispecialty care integration.</p></div>
       
       </div>
       <div class="services" id="service">
                <h2 >Our Key Features</h2>
                <div class="service-section">
                <p class="service-name"><i class="fa fa-thin fa-hand-holding-hand"></i><br><br>Trusted Tertiary Care Center</p>
                <p class="service-name"><i class="fa-sharp fa-solid fa-heart-pulse"></i><br><br>Trusted Medical Professionals</p>
                <p class="service-name"><i class="fa-sharp fa-solid fa-stethoscope"></i><br><br>Insurance, ECHS, ESIC, CGHS, PMJAY & More</p>
                <p class="service-name"><i class="fa-duotone fa-solid fa-user-nurse"></i><br><br>Emergency Help Available 24/7</p>
                <p class="service-name"><i class="fa-sharp-duotone fa-solid fa-pump-medical"></i><br><br>Emergency Help Available 24/7</p>
                <p class="service-name"><i class="fa-solid fa-truck-medical"></i><br><br>Emergency Help Available 24/7</p>
                </div>
       </div>
      
    </div>

<!-- new  -->
 <footer>
    <div class="section">
    <img src="./assets/lgo-removebg.png" alt="">
        <p>We drive immense pride and pleasure to introduce ourselves as one of the most reputed super–speciality hospitals in Chandigarh, equipped with ultra–modern and state-of-the-art facilities for comprehensive medical care.</p>
    </div>  
    <div class="section">
        <h2>Quick Links</h2>
     
        <ul>
            <a href="#"><li>HOME</li></a>
            <a href="#service"> <li>SERVICE</li></a>
            <a href="#about"><li>ABOUT US</li></a>
            <a href=""><li>CONTACT</li></a>
         </ul>
    </div>
    <div class="section">
       <h2>Serivce </h2>
       <ul>
       <?php           
        include("connect.php");                 
              
                $sql = "SELECT *  FROM department ";
                   $stmt = $connect->prepare($sql);
                //    $stmt->bind_param("i",$centreId);
                   $stmt->execute();
                   $result = $stmt->get_result();
               if ($result->num_rows>0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                      <li> <?php echo $row['depart_name'] ?> </li>
                      <?php
                  }
                }
    
  ?>  
  </ul>
    </div>
  
    <div class="section">
       <h2>Contact Us</h2>
       <ul>
           <li><i class="fa-sharp fa-solid fa-phone-volume"></i>91-464646464</li>
           <li><i class="fa fa-sharp fa-light fa-envelope"></i>healthcare@gmail.in</li>
           <li><i class="fa-sharp fa-solid fa-location-dot"></i>SCO 47-mumbai</li>
         </ul>
    </div>
 </footer>
 <div class="copyright">
 <p>Copyright ©2023  Hospital. All Rights Reserved Disclaimer.</p>
 </div>
 


    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const hamburger = document.getElementById("hamburger");
    const sideMenu = document.getElementById("side_menu");

    // Toggle sidebar visibility on hamburger click
    hamburger.addEventListener("click", () => {
        hamburger.classList.toggle('cross');
        sideMenu.classList.toggle('active');
    });

    // Get all anchor tags inside the side menu
    const menuLinks = sideMenu.querySelectorAll('a');
    console.log(menuLinks);  // Check if it correctly selects the anchor tags

    // Add click event to each anchor tag
    menuLinks.forEach(link => {
        link.addEventListener("click", () => {
            // Hide the sidebar after clicking a link
            hamburger.classList.remove('cross');

            sideMenu.classList.add('active');  // Use remove instead of add
            console.log("Link clicked and sidebar hidden");
        });
    });
});

</script>
</html>