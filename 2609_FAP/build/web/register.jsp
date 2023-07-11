<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="register-style.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"
    />
    <title>Document</title>
  </head>
  <body>
    <div class="container">
      <div class="left">
        <h1>Ca-ching!</h1>
        <img src="image.png" alt="Login Image" class="hero" />
        <h2>Welcome!</h2>
        <p>Start simplifying your finances with ease and power.</p>
      </div>
      <div class="right">
        <h2 class="heading">Register</h2>
        <form method="post" action="Register" class="login-form">
            <input type="hidden" name="register" value="true">
            <div class="login-form-content">
                <div class="form-item">
                    <input type="text" name="firstName" id="firstName" required="required" />
                    <span>First Name</span>
                </div>
                <div class="form-item">
                    <input type="text" name="lastName" id="lastName" required="required" />
                    <span>Last Name</span>
                </div>
                
                 <div class="form-item">
                    <input type="text" name="occupation" id="lastName" required="required" />
                    <span>Occupation</span>
                </div>
                
                <div class="form-item">
                    <input type="text" name="address" id="lastName" required="required" />
                    <span>Address</span>
                </div>
                
                 <div class="form-item">
                    <input type="text" name="phone" id="lastName" required="required" />
                    <span>Phone Number</span>
                </div>
                 
                <div class="form-item">
                    <input type="text" name="status" id="lastName" required="required" />
                    <span>Status</span>
                </div>
                
                <div class="form-item">
                    <input type="text" name="email" id="email" required="required" />
                    <span>Email</span>
                </div>
                <div class="form-item">
                    <input type="password" name="password" id="password" required="required" />
                    <span>Password</span>
                </div>
                <button type="submit">Sign Up</button>
            </div>
            <div class="login-form-footer">
                <a href="#">
                    <img
                      width="30"
                      src="https://upload.wikimedia.org/wikipedia/en/0/04/Facebook_f_logo_%282021%29.svg"
                      alt="Facebook Logo"
                    />
                    Facebook
                </a>
                <a href="#">
                    <img
                      width="30"
                      src="https://www.vectorlogo.zone/logos/google/google-icon.svg"
                      alt="Google Logo"
                    />
                    Google
                </a>
            </div>
        </form>
      </div>
    </div>
  </body>
</html>
