<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="manifest" href="manifest.json">

  <!-- ios support-->
  <link rel="apple-touch-icon" href="img/logo-96x96.png">
  <meta name="apple-mobile-web-app-status-bar" content="#aa7700">
  <meta name="theme-color" content="FFE1C4">
  <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    html,
    body {
      display: grid;
      height: 100%;
      width: 100%;
      place-items: center;
      background: linear-gradient(109.6deg, rgba(0, 0, 0, 0.93) 11.2%, rgb(63, 61, 61) 78.9%);
    }

    ::selection {
      background: #fa4299;
      color: #fff;
    }

    .wrapper {
      overflow: hidden;
      max-width: 90%;
      background: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.1);
    }

    .wrapper .title-text {
      display: flex;
      width: 200%;
    }

    .wrapper .title {
      width: 50%;
      font-size: 25px;
      font-weight: 600;
      text-align: center;
      transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .wrapper .slide-controls {
      position: relative;
      display: flex;
      height: 50px;
      width: 100%;
      overflow: hidden;
      margin: 10px 0;
      justify-content: space-between;
      border: 1px solid lightgrey;
      border-radius: 5px;
    }

    .slide-controls .slide {
      flex: 1;
      color: #fff;
      font-size: 14px;
      font-weight: 500;
      text-align: center;
      line-height: 48px;
      cursor: pointer;
      z-index: 1;
      transition: all 0.6s ease;
    }

    .slide-controls .slider-tab {
      position: absolute;
      height: 100%;
      width: 50%;
      left: 0;
      z-index: 0;
      border-radius: 5px;
      background: linear-gradient(109.6deg, rgba(0, 0, 0, 0.93) 11.2%, rgb(63, 61, 61) 78.9%);
      transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    input[type="radio"] {
      display: none;
    }

    #Staff:checked~.slider-tab {
      left: 50%;
    }

    #Staff:checked~label.Staff {
      color: #fff;
      cursor: default;
      user-select: none;
    }

    #Staff:checked~label.Admin {
      color: #000;
    }

    #Admin:checked~label.Staff {
      color: #000;
    }

    #Admin:checked~label.Admin {
      cursor: default;
      user-select: none;
    }

    .wrapper .form-container {
      width: 100%;
      overflow: hidden;
    }

    .form-container .form-inner {
      display: flex;
      width: 200%;
    }

    .form-container .form-inner form {
      width: 50%;
      transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .form-inner form .field {
      height: 50px;
      width: 100%;
      margin-top: 20px;
    }

    .form-inner form .field input {
      height: 100%;
      width: 100%;
      outline: none;
      padding-left: 15px;
      border-radius: 5px;
      border: 1px solid lightgrey;
      border-bottom-width: 2px;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .form-inner form .field input:focus {
      border-color: black;
      /* box-shadow: inset 0 0 3px black; */
    }

    .form-inner form .field input::placeholder {
      color: #1f1d1e;
      transition: all 0.3s ease;
    }

    form .field input:focus::placeholder {
      color: #b3b3b3;
    }

    form .btn {
      height: 50px;
      width: 100%;
      border-radius: 5px;
      position: relative;
      overflow: hidden;
    }

    form .btn .btn-layer {
      height: 100%;
      width: 300%;
      position: absolute;
      left: -100%;
      background: linear-gradient(109.6deg, rgba(0, 0, 0, 0.93) 11.2%, rgb(63, 61, 61) 78.9%);
      border-radius: 5px;
      transition: all 0.4s ease;
    }

    form .btn:hover .btn-layer {
      left: 0;
    }

    form .btn input[type="submit"] {
      height: 100%;
      width: 100%;
      z-index: 1;
      position: relative;
      background: none;
      border: none;
      color: #fff;
      padding-left: 0;
      border-radius: 5px;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
    }

  </style>
</head>

<body>
  <div class="wrapper">
    <div class="title-text">
      <div class="title Signup">Login Form</div>
</div>

        <div class="form-container">
            <div class="slide-controls">
                <input type="radio" name="slide" id="Admin" checked>
                <input type="radio" name="slide" id="Staff">
                <label for="Admin" class="slide Admin">Admin</label>
                <label for="Staff" class="slide Staff">Staff</label>
                <div class="slider-tab"></div>
            </div>

            <div class="form-inner">
                <form action="login.php" method="post" class="Admin">
                    <!-- Existing Staff form fields -->
                    <div class="field">
                        <input type="text" name="sNum" placeholder="Admin ID" required>
                    </div>
                    <div class="field">
                        <input type="password" name="password" placeholder="password" required>
                    </div>
                    <!-- Add other fields if necessary -->
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" name="formClass" value="admin">
                    </div>
                </form>

                <form action="login.php" method="post" class="Staff">
                    <!-- Existing Student form fields -->
                    <div class="field">
                        <input type="text" name="sNum" placeholder="Staff ID" required>
                    </div>
                    <div class="field">
                        <input type="password" name="password" placeholder="password" required>
                    </div>
                    <!-- Add other fields if necessary -->
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" name="formClass" value="staff">
                    </div>
                </form>
            </div>
            <br><div class="signup-link">Not a member? <a href="register.php">Signup now</a></div>
        </div>
    </div>

    <script>
    const AdminForm = document.querySelector("form.Admin");
    const AdminBtn = document.querySelector("label.Admin");
    const StaffForm = document.querySelector("form.Staff");
    const StaffBtn = document.querySelector("label.Staff");

    StaffBtn.onclick = (() => {
        AdminForm.style.marginLeft = "-50%";
    });

    AdminBtn.onclick = (() => {
        AdminForm.style.marginLeft = "0%";
    });
</script>


	<script src="js/app.js"></script>
  <script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.9.0/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.9.0/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyCI69EJz4u1YAJablbBO_YcheNMY5obezE",
    authDomain: "meetingschedule-pwa.firebaseapp.com",
    projectId: "meetingschedule-pwa",
    storageBucket: "meetingschedule-pwa.appspot.com",
    messagingSenderId: "1041297280313",
    appId: "1:1041297280313:web:414b0c63f1f503556b6ce8",
    measurementId: "G-9VQBSSYC6C"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
</script>
</body>
</html>
