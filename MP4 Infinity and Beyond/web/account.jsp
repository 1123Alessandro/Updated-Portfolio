<%-- 
    Document   : account
    Created on : Nov 30, 2022, 9:26:29 AM
    Author     : araza
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile Page</title>
  <link rel="stylesheet" href="account.css">
</head>

<body>
  <!--Header section-->
  <header>
    <a href="/MP4_Infinity_and_Beyond" class="logo">Galaxy<span>.</span></a>

    <div class="icons">
      <a href="Cart">
        <span class="icon">
          <ion-icon name="cart"></ion-icon>
        </span>
      </a>
      <a href="Account">
        <span class="icon">
          <ion-icon name="person"></ion-icon>
        </span>
      </a>
    </div>
  </header>

  <!--Main section-->
  <main class="account-container">
    <!--Picture-->
    <div class="user-profile">
      <div class="user-avatar">
        <img src="arthur.jpg" alt="Arthur Shelby" id="photo">
        <input type="file" name="change-pic" id="file">
        <label for="file" id="uploadBtn">Choose Photo</label>
      </div>
    </div>

    <!--Account details-->
    <div class="account-box">
      <div class="details-header">
        Account Details
        <hr>
      </div>
      <div class="details-body">
        <div class="details-form">
          <form>
            <!--Username-->
            <div class="username">
              <label class="user" for="usernameInput">Username</label>
              <input type="text" class="form-control" id="usernameInput" placeholder="Enter username"
                value="peakyarthur">
            </div>

            <!--Last name-->
            <div class="lastname">
              <label class="last" for="lastnameInput">Last&nbsp;Name</label>
              <input type="text" class="form-control" id="lastnameInput" placeholder="Enter last name" value="Shelby">
            </div>

            <!--Address-->
            <div class="address">
              <label class="address" for="addressInput">Home&nbsp;Address</label>
              <input type="text" class="form-control" id="addressInput" placeholder="Enter complete address"
                value="Birmingham, England">
            </div>

            <!--Birth date-->
            <div class="birth">
              <label class="birthdate" for="birthInput">Birthdate</label>
              <input type="date" class="form-control" id="birthInput" placeholder="" value="">
            </div>
          </form>
          <form>
            <!--First name-->
            <div class="firstname">
              <label class="first" for="firstnameInput">First&nbsp;Name</label>
              <input type="text" class="form-control" id="firstnameInput" placeholder="Enter first name" value="Arthur">
            </div>

            <!--Organization name-->
            <div class="orgname">
              <label class="org" for="orgnameInput">Organization&nbsp;Name</label>
              <input type="text" class="form-control" id="orgnameInput" placeholder="Enter organization name"
                value="Shelby Company Limited">
            </div>

            <!--Email address-->
            <div class="email">
              <label class="email" for="emailInput">Email&nbsp;Address</label>
              <input type="email" class="form-control" id="emailInput" placeholder="example@gmail.com"
                value="arthurshelby@gmail.com">
            </div>
          </form>
        </div>

        <!--Save changes-->
        <div class="save-logout">
            <form action="/MP4_Infinity_and_Beyond">
                <button class="save" type="submit">Save changes</button>
            </form>
            <form action="LogoutSession">
                <button class="log-out" type="submit">Log out</button>
            </form>
        </div>
      </div>
    </div>
  </main>

  <!--Import icons-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  <script>
    //declearing html elements
    const imgDiv = document.querySelector('.user-avatar');
    const img = document.querySelector('#photo');
    const file = document.querySelector('#file');
    const uploadBtn = document.querySelector('#uploadBtn');

    //hover on avatar
    imgDiv.addEventListener('mouseenter', function () {
      uploadBtn.style.display = "block";
    });

    //hover out avatar
    imgDiv.addEventListener('mouseleave', function () {
      uploadBtn.style.display = "none";
    });

    //choosing image to upload
    file.addEventListener('change', function () {
      const chosenFile = this.files[0];

      if (chosenFile) {
        const reader = new FileReader();

        reader.addEventListener('load', function () {
          img.setAttribute('src', reader.result);
        });

        reader.readAsDataURL(chosenFile);
      }
    });
  </script>
</body>

</html>