<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>contactus</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <style>
    body {
    background-color: #f9f9f9; /* Light background color */
}

section {
    padding: 0px 0; /* Add padding to the section */
}

.co7 {
    text-align: center;
    margin-top: 50px; /* Add space above the title */
    color: #333; /* Dark text color */
    font-size: 40px;
}

.contact7 {
    display: flex;
    align-items: center;
    justify-content: space-around;
    background-color: #fff; /* White background */
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1); /* Add shadow */
    border-radius: 10px; /* Rounded corners */
}

.im {
    height: 100%; /* Adjust image height */
    width: 100%; /* Adjust image width */
    object-fit: cover; /* Ensure image covers its container */
    border-top-left-radius: 10px; /* Rounded corners for top-left */
    border-bottom-left-radius: 10px; /* Rounded corners for bottom-left */
}

.form {
    padding: 30px; /* Add padding inside form container */
}

.form h2 {
    text-align: center;
    margin-bottom: 20px; /* Add space below heading */
    color: #333; /* Dark text color */
}

.form-group {
    margin-bottom: 20px; /* Add space between form groups */
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px; /* Add space below label */
    color: #555; /* Darker text color */
}

.inp, .msg {
    width: 100%; /* Make inputs and textarea full width */
    padding: 10px; /* Adjust padding */
    border: 1px solid #ccc; /* Add border */
    border-radius: 5px; /* Rounded corners */
}

.msg {
    height: 150px; /* Adjust textarea height */
}

.btn {
    width: 100%; /* Make button full width */
    background-color: #ea1538;
    color: white;
    padding: 15px 0; /* Adjust padding */
    border: none;
    border-radius: 5px; /* Rounded corners */
    cursor: pointer;
}

.btn:hover {
    background-color: #c20c2e; /* Darker background color on hover */
}
</style>

</head>


<body>
    <?php include 'nav.php'; ?>

    <section>
        <h1 class="co7">Contact Us</h1>
        <div class="contact" id="contactus">
            <div class="contact7">
                <div>
                    <img src="picture/p7.jpg" alt="" class="im">
                </div>
                <div class="form">
                    <form>
                        <h2>Contact us</h2>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" id="name" class="inp" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" class="inp" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone No:</label>
                            <input type="tel" id="phone" class="inp" placeholder="Enter your phone number">
                        </div>
                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea id="message" class="msg" placeholder="Enter your message"></textarea>
                        </div>
                        <div class="ff">
                            <button type="submit" class="btn">SEND</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php include 'footer.php'; ?>

</body>

</html>
