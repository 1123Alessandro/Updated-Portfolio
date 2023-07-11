<%-- 
    Document   : item
    Created on : 11 29, 22, 5:21:07 PM
    Author     : reiva
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.util.*" %>
<%@page import="model.*" %>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product View Page</title>
  <link href="item.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
</head>

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

<body>
      <%
          HashMap<String, Product> stock = new Storage().getStock();
          // imma fix this later if (!stock.containsKey(request.getParameter("product")) || request.getParameter("product") == null) response.sendError(HttpServletResponse.SC_NOT_FOUND);
          if (!stock.keySet().contains(request.getParameter("product"))) response.sendError(500);
          Product watch = stock.get(request.getParameter("product"));
      %>
  <main class="item-container">
    <div class="item-flex">
      <section class="item-header">
        <div class="image-box">
            <%
                out.println("<img src='" + request.getParameter("product") + ".jpg' width='400px' alt='" + watch.getName() + "' >");
            %>
          <!-- <img src="mercury.jpg" width="400px" alt="Mission to Mercury watch" /> -->
        </div>
        <div class="text-box">
          <div class="item-name">
              <%
                  out.println("<h1>" + watch.getName() + "</h1>");
                  out.println("<h2>" + watch.getColor() + "</h2>");
              %>
            <!-- <h1>Mission to Mercury</h1>
            <h2>DEEP GREY COLOR</h2> --> 
          </div>
          <form method="post" action="AddToCart" class="item-cart">
            <div class="price">
                <input type="hidden" name="name" value="<% out.println(watch.getName()); %>"/>
                <input type="hidden" name="color" value="<% out.println(watch.getColor()); %>"/>
                <input type="hidden" name="imgName" value="<%out.print(request.getParameter("product"));%>"/>
                <input type="hidden" name="discount" value="<% out.println(watch.getDiscount()); %>" >
                
              <h6><% out.println("-" + watch.getDiscount() + "%"); %></h6>
              <h1><% out.println(String.format("$%.2f", watch.getPrice())); %></h1>
              <h3>$260.00</h3>
            </div>
            <div class="item-quantity">
              <h2>Quantity</h2>
              <div class="item-counter">
                <span class="item-sub">-</span> <!-- Decrements the quantity -->
                <input type="text" id="quantity" name="quantity" />
                <span class="item-add">+</span> <!-- Increments the quantity -->
              </div>
            </div>
            <div class="btn">
              <button class="add" type="submit">Add to Cart</button>
            </div>
          </form>
          <div class="item-details">
            <h2>Product Details</h2>
            <i class="fas fa-check-circle"><span class="i-text">Water Resistant</span></i>
            <i class="fas fa-check-circle"><span class="i-text">Velcro Strap Material</span></i>
            <i class="fas fa-check-circle"><span class="i-text">Bioceramic Case Material</span></i>
          </div>
        </div>
      </section>
      <section class="item-footer">
        <i class="fas fa-money-check"><span class="i-text">24 MONTHS WARRANTY</span></i>
        <i class="fas fa-truck"><span class="i-text">EASY RETURN</span></i>
        <i class="fas fa-lock"><span class="i-text">100% SECURE PURCHASE</span></i>
      </section>
    </div>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      console.log('Item is loaded');
      const add = document.querySelector(".item-add");
      const sub = document.querySelector(".item-sub");
      let num = document.getElementById("quantity").value = 1;
      console.log("Current Quantity is: " + num);
      add.addEventListener("click", () => {
        num++;
        document.getElementById("quantity").value = num;
        console.log("Incremented: " + num);
      });

      sub.addEventListener("click", () => {
        if (num > 1) {
          num--;
          document.getElementById("quantity").value = num;
          console.log("Decremented: " + num);
        }
      });
    });
  </script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>