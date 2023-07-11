<%-- 
    Document   : login
    Created on : Nov 19, 2022, 5:45:35 PM
    Author     : paige
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login Page</title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <%
            // For using the back button to return to login
            // kills the session
            response.setHeader("Cache-Control", "no-cache, no-store, must-revalidate");
            response.setHeader("Expires", "0");
            session.invalidate();
        %>
        <form method="post" action="LogSession">
            <div class="login-box">
                <!--Title-->
                <h1>Login</h1>

                <!--Username-->
                <div class="textbox">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" name="username" placeholder="Username">
                </div>

                <!--Password-->
                <div class="textbox">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" name="password" placeholder="Password">
                </div>

                <!--Button-->
                <!-- <% out.println("<input type='hidden' name='goto' value='" + (String) request.getAttribute("goto") + "'>"); %> -->
                <button name="sign-in" type="submit">Sign-in</button>
            </div>
        </form>
    </body>
</html>