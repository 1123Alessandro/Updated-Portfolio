<%-- 
    Document   : login
    Created on : Apr 29, 2023, 4:02:23 AM
    Author     : araza
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="javax.servlet.*" %>
<%@page import="javax.servlet.http.*" %>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="login-style.css" />
        <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"
        />
        <title>Document</title>
    </head>
    <body>
        <%
            Integer attempts = (Integer) request.getAttribute("attempts");
            Boolean register = (Boolean) request.getAttribute("register");
            Boolean duplicate = (Boolean) request.getAttribute("duplicate");

            if (attempts != null) {
                if (attempts < 1)
                    response.sendError(403);
                else {
        %>
        <!--TODO: same idea with the landing page-->
        <!--stylize the alert-->
        <h2> Account Does not Exist! Please Try Again </h2>
        <%
                }
            }
            if (register != null) {
        %>
        <h3>Alert: Account registered succesfully</h3>
        <%
            }
            if (duplicate != null) {
        %>
        <h3>Alert: Account already exists</h3>
        <%
            }
        %>
        <div class="container">
            <div class="left">
                <h1>Ca-ching!</h1>
                <img src="image.png" alt="Login Image" class="hero" />
                <h2>Welcome!</h2>
                <p>Start simplifying your finances with ease and power.</p>
            </div>
            <div class="right">
                <h2 class="heading">Login</h2>
                <form class="login-form" method="POST" action="Login">
		    <input type="hidden" name="login" value="true">
                    <div class="login-form-content">
                        <div class="form-item">
                            <span class="icon"><i class="bi bi-envelope-at"></i></span>
                            <input name="email" type="text" id="email" placeholder="you@example.com" />
                        </div>
                        <div class="form-item">
                            <span class="icon"><i class="bi bi-key"></i></span>
                            <input
			      name="password"
                              type="password"
                              id="password"
                              placeholder="At least 8 characters"
                            />
                        </div>
			<!-- TODO: discuss remember me feature -->
                        <div class="form-item">
                            <div class="checkbox">
                              <input type="checkbox" id="rememberMeCheckbox" />
                              <label for="rememberMeCheckbox" id="checkboxLabel"
                                >Remember Me</label>
                            </div>
                        </div>
                        <button type="submit">Sign In</button>
			<button onclick="window.location.href = 'register.jsp';" type="button">Create an account</button>
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
        <!--<a href="register.jsp"><input type="button" value="Register" class="button"></a>-->
    </body>
</html>
