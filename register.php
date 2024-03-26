<?php
include("db-connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check which form is submitted
    if (isset($_POST['level']) && ($_POST['level'] == '1' || $_POST['level'] == '2')) {
        // Form data for both staff and student
        $name= $_POST['name'];
		$SID = $_POST['SID'];
        $email = $_POST['email'];
        $phoneNum = $_POST['phoneNum'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $level = $_POST['level'];

		// Check if SID or email already exists
        $checkQuery = "SELECT * FROM users WHERE Snum = '$SID' OR Email = '$email'";
        $result = $conn->query($checkQuery);

        if ($result->num_rows > 0) {
            echo "<script>alert('SID or Email already exists. Please use a different SID or Email.');</script>";
        } else {
        // Insert data into the database
        $sql = "INSERT INTO users (name, sNum, Email, phoneNum, password, level) VALUES ('$name','$SID','$email','$phoneNum','$password', '$level')";
       if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registration successful'); window.location.href = 'index.php';</script>";
            exit(); // Stop further execution to prevent the HTML code below from being processed
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <link rel="manifest" href="/manifest.json">
  <style>
  
	  @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
	  
	*{
	  margin: 0;
	  padding: 0;
	  box-sizing: border-box;
	  font-family: 'Poppins', sans-serif;
	}
	
	html,body{
	  display: grid;
	  height: 100%;
	  width: 100%;
	  place-items: center;
	  background: linear-gradient(109.6deg, rgba(0, 0, 0, 0.93) 11.2%, rgb(63, 61, 61) 78.9%);
	}
	
	::selection{
	  background: #fa4299;
	  color: #fff;
	}
	
	.wrapper{
	  overflow: hidden;
	  max-width: 390px;
	  background: #fff;
	  padding: 30px;
	  border-radius: 5px;
	  box-shadow: 0px 15px 20px rgba(0,0,0,0.1);
	}
	
	.wrapper .title-text{
	  display: flex;
	  width: 200%;
	}
	
	.wrapper .title{
	  width: 50%;
	  font-size: 35px;
	  font-weight: 600;
	  text-align: center;
	  transition: all 0.6s cubic-bezier(0.68,-0.55,0.265,1.55);
	}
	
	.wrapper .slide-controls{
	  position: relative;
	  display: flex;
	  height: 50px;
	  width: 100%;
	  overflow: hidden;
	  margin: 30px 0 10px 0;
	  justify-content: space-between;
	  border: 1px solid lightgrey;
	  border-radius: 5px;
	}
	
	.slide-controls .slide{
	  height: 100%;
	  width: 100%;
	  color: #fff;
	  font-size: 18px;
	  font-weight: 500;
	  text-align: center;
	  line-height: 48px;
	  cursor: pointer;
	  z-index: 1;
	  transition: all 0.6s ease;
	}
	
	.slide-controls label.Student{
	  color: #000;
	}
	
	.slide-controls .slider-tab{
	  position: absolute;
	  height: 100%;
	  width: 50%;
	  left: 0;
	  z-index: 0;
	  border-radius: 5px;
	  background: linear-gradient(109.6deg, rgba(0, 0, 0, 0.93) 11.2%, rgb(63, 61, 61) 78.9%);
	  transition: all 0.6s cubic-bezier(0.68,-0.55,0.265,1.55);
	}
	
	input[type="radio"]{
	  display: none;
	}
	
	#Student:checked ~ .slider-tab{
	  left: 50%;
	}
	
	#Student:checked ~ label.Student{
	  color: #fff;
	  cursor: default;
	  user-select: none;
	}
	
	#Student:checked ~ label.Staff{
	  color: #000;
	}
	
	#Staff:checked ~ label.Student{
	  color: #000;
	}
	
	#Staff:checked ~ label.Staff{
	  cursor: default;
	  user-select: none;
	}
	
	.wrapper .form-container{
	  width: 100%;
	  overflow: hidden;
	}
	
	.form-container .form-inner{
	  display: flex;
	  width: 200%;
	}
	
	.form-container .form-inner form{
	  width: 50%;
	  transition: all 0.6s cubic-bezier(0.68,-0.55,0.265,1.55);
	}
	
	.form-inner form .field{
	  height: 50px;
	  width: 100%;
	  margin-top: 20px;
	}
	
	.form-inner form .field input{
	  height: 100%;
	  width: 100%;
	  outline: none;
	  padding-left: 15px;
	  border-radius: 5px;
	  border: 1px solid lightgrey;
	  border-bottom-width: 2px;
	  font-size: 17px;
	  transition: all 0.3s ease;
	}
	
	.form-inner form .field input:focus{
	  border-color: black;
	  /* box-shadow: inset 0 0 3px black; */
	}
	
	.form-inner form .field input::placeholder{
	  color: #1f1d1e;
	  transition: all 0.3s ease;
	}
	
	form .field input:focus::placeholder{
	  color: #b3b3b3;
	}
	
	form .btn{
	  height: 50px;
	  width: 100%;
	  border-radius: 5px;
	  position: relative;
	  overflow: hidden;
	}
	
	form .btn .btn-layer{
	  height: 100%;
	  width: 300%;
	  position: absolute;
	  left: -100%;
	  background: linear-gradient(109.6deg, rgba(0, 0, 0, 0.93) 11.2%, rgb(63, 61, 61) 78.9%);
	  border-radius: 5px;
	  transition: all 0.4s ease;;
	}
	
	form .btn:hover .btn-layer{
	  left: 0;
	}
	
	form .btn input[type="submit"]{
	  height: 100%;
	  width: 100%;
	  z-index: 1;
	  position: relative;
	  background: none;
	  border: none;
	  color: #fff;
	  padding-left: 0;
	  border-radius: 5px;
	  font-size: 20px;
	  font-weight: 500;
	  cursor: pointer;


	}

	@media only screen and (max-width: 600px) {
      .wrapper {
        max-width: 100%;
      }
      .wrapper .title {
        font-size: 20px;
      }
      .slide-controls .slide {
        font-size: 12px;
      }
      .form-inner form .field input {
        font-size: 12px;
      }
      form .btn input[type="submit"] {
        font-size: 14px;
      }
	}

  </style>
  <body>
    <div class="wrapper">
      <div class="title-text">
        <div class="title Signup">Signup Form</div>
      </div>
      <div class="form-container">
        <div class="slide-controls">
          <input type="radio" name="slide" id="Staff" checked>
          <input type="radio" name="slide" id="Student">
          <label for="Staff" class="slide Staff">Admin</label>
          <label for="Student" class="slide Student">Staff</label>
          <div class="slider-tab"></div>
        </div>
		
        <div class="form-inner">
          <form action="#" method="post" class="Staff">
            <div class="field">
              <input type="text" name="name" placeholder="Your Name" required>
            </div>
			<div class="field">
              <input type="text" name="SID" placeholder="Admin ID" required>
            </div>
            <div class="field">
              <input type="text" name="email" placeholder="Email" required>
            </div>
			<div class="field">
              <input type="text" name="phoneNum" placeholder="Phone Number" required>
            </div>
            <div class="field">
              <input type="password" name="password" placeholder="password" required>
			  <input type="hidden" name="level" value="1" required>
            </div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Signup">
            </div>
            </form>
          <form action="#" method="post" class="Staff">
			<div class="field">
              <input type="text" name="name" placeholder="Your Name" required>
            </div>
            <div class="field">
              <input type="text" name="SID" placeholder="Staff ID" required>
            </div>
            <div class="field">
              <input type="text" name="email" placeholder="Email" required>
            </div>
			<div class="field">
              <input type="text" name="phoneNum" placeholder="Phone Number" required>
            </div>
            <div class="field">
              <input type="password" name="password" placeholder="password" required>
			  <input type="hidden" name="level" value="2" required>
            </div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Signup">
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
	  const StaffForm = document.querySelector("form.Staff");
	  const StaffBtn = document.querySelector("label.Staff");
	  const StudentBtn = document.querySelector("label.Student");

	  StudentBtn.onclick = (() => {
		StaffForm.style.marginLeft = "-50%";
		StaffText.style.marginLeft = "-50%";
	  });

	  StaffBtn.onclick = (() => {
		StaffForm.style.marginLeft = "0%";
		StaffText.style.marginLeft = "0%";
	  });
</script>


  </body>
</html>
