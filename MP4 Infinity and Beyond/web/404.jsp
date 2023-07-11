<%-- 
    Document   : 404
    Created on : Nov 20, 2022, 11:00:34 AM
    Author     : araza
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Error 404 Page</title>
  <link href="error.css" rel="stylesheet" type="text/css" />
</head>

<body class="error">
  <!-- Main Section -->
  <main class="error-container">
    <div class="error-flex">
      <!-- Error Details -->
      <div class="error-text">
        <h1>404</h1>
        <h3>It seems like the page is missing or destroyed. Either <span id="bold"> go back </span> or <span
            id="bold">return to the homepage</span> and try again.</h3>
        <div class="error-buttons">
          <a href="shop.jsp"><button class="return" type="button">Return to Page</button></a>
          <a onclick="history.back()"><button class="return" type="button">Go Back</button></a>
        </div>
      </div>
      <!-- Error Image -->
      <div class="error-img">
        <img src="astro2.png" width="600px" alt="astronaut fishing" />
      </div>
    </div>
  </main>
</body>

</html>