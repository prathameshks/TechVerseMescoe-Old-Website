<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Contact Us | TechVerse MESCOE</title>
    <link rel="shortcut icon" href="/icon/favicon.ico" type="image/x-icon">
    <meta name="keywords" content="techverse, techversemescoe,mescoe,college,club,pune,MESCOE, Pune, Techverse, student club, technical environment, technology, innovation, collaboration, skills, knowledge">
    <meta name="description" content="Techverse is a student-led club at MESCOE in Pune that provides a dynamic technical environment for students to learn, collaborate and innovate. Our mission is to empower students with the skills and knowledge to excel in the ever-evolving tech industry.">
    <meta name="author" content="techverse,MESCOE,Pune">

    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mycss.css">
    <!-- responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- awesome fontfamily -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout inner_page">
    <?php include("assets/header.html"); ?>

    <div class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage text_align_center">
                        <h2>Contact Us</h2>
                    </div>
                </div>
                <div class=" col-md-10 offset-md-1">
                    <form id="request" class="main_form">
                        <div class="row">
                            <div class="col-md-6 ">
                                <input id="name" class="contactus" placeholder="Full Name" type="text" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <input id="email" class="contactus" placeholder="Email" type="email" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <input id="ph_number" class="contactus" placeholder="Phone number" type="number" name="ph_number" required>
                            </div>
                            <div class="col-md-6">
                                <textarea id="msg" class="textarea" placeholder="Message" type="text" name="message" required></textarea>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" id="submit_contact_form" class="send_btn">Send</button>
                            </div>
                        </div>
                    </form>
                    <div id="message" class="text_align_center" style="display: none;">
                        <p id="message_text"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <?php include("assets/footer.html"); ?>

    <!-- Javascript files-->
    <script src="js/jquery.min.js "></script>
    <script src="js/bootstrap.bundle.min.js "></script>
    <script src="js/jquery-3.0.0.min.js "></script>
    <script src="js/custom.js "></script>
    <!-- my js files  -->
    <script>
        document.getElementById("nav_contact").classList.add("active");
    </script>

    <script>
        function handle_form_response(result) {
            if (result['type'] == 'res' && result['code'] == "success") {
                document.getElementById('request').style.display = "none";
                document.getElementById('message').style.display = "block";
                document.getElementById('message_text').innerHTML = "Thank You Your Form is Submitted Successfully, We will Reach out to you Shortly";
            } else if (result['type'] == 'error' && result['desc'] == "blank") {
                // document.getElementById('request').style.display = "none";
                document.getElementById('message').style.display = "block";
                document.getElementById('message_text').innerHTML = "Please Enter a Valid "+result['code'];
            }
        }

        document.querySelector('#request').addEventListener('submit', function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "assets/php/submit_contact.php",
                data: {
                    name: document.getElementById("name").value,
                    email: document.getElementById("email").value,
                    ph_number: document.getElementById("ph_number").value,
                    message: document.getElementById("msg").value
                },
                // data:formData,
                success: function(response) {
                    message = JSON.parse(response);
                    console.log(message);
                    handle_form_response(message);
                    // setcart();
                    // handle_otp_send(message['email_verification'], message['otp_send']);
                }
            });
        });
    </script>
</body>

</html>