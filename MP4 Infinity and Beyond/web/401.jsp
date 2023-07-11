<%-- 
    Document   : 401
    Created on : Dec 3, 2022, 5:52:25 PM
    Author     : araza
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Error 401 Page</title>
  <link href="error.css" rel="stylesheet" type="text/css" />
</head>

<body class="error">
  <!-- Main Section -->
  <main class="error-container">
    <div class="error-flex">
      <!-- Error Details -->
      <div class="error-text">
        <h1>401</h1>
        <h3>You do not have permission to view this page. Either <span id="bold"> go back </span> or <span
            id="bold">return to the homepage</span> and try again.</h3>
        <div class="error-buttons">
          <a href="shop.jsp"><button class="return" type="button">Return to Page</button></a>
          <a onclick="history.back()"><button class="return" type="button">Go Back</button></a>
        </div>
      </div>
      <!-- Error Image -->
      <div class="error-img">
        <img src="astro1.png" width="600px" alt="sitting astronaut" />
      </div>
    </div>
  </main>
</body>

</html>