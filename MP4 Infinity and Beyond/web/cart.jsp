<%-- 
    Document   : cart
    Created on : 11 28, 22, 10:00:15 PM
    Author     : reiva
--%>

<%@page import="java.util.*"%>
<%@page import="model.*"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="cart.css" rel="stylesheet" type="text/css" />
  <title>Shopping Cart Page</title>
</head>

<header>
  <a href="/MP4_Infinity_and_Beyond/#products" class="logo">Galaxy<span>.</span></a>

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
  <main class="cart-container">
    <h1 class="cart-heading">
      <ion-icon name="cart-outline"></ion-icon> Your Shopping Cart
    </h1>
    <div class="cart-flex">
      <section class="cart">
        <div class="cart-item-box">
          <h2 class="cart-section-heading">Order Summary:</h2>
          <div class="cart-product-box">
            <!-- Product Card -->
            <!-- <div class="cart-product-card">
              <div class="card">
                <div class="img-box">
                  <img src="mercury.jpg" alt="Mission to Mercury watch" width="80px" class="product-img">
                </div>
                <div class="detail">
                  <h4 class="product-name">Mission to Mercury</h4>
                  <div class="qty-price">
                    <div class="quantity">
                      <span id="qty">Qty: 1</span>
                    </div>
                    <div class="price">
                      $ <span id="price">228.80</span>
                    </div>
                  </div>
                </div>
                <button class="cart-remove">
                  <ion-icon name="close-outline"></ion-icon>
                </button>
              </div>
            </div> -->
            
            <%
                HashMap<Product, Integer> cart = (HashMap) session.getAttribute("cart");
                double shipping = 0;
                double tax = (cart.isEmpty()) ? 0 : 0.10;
                double total = 0;
                for (Product prod : cart.keySet()) {
                    total += prod.getPrice() * cart.get(prod);
            %>
            <div class="cart-product-card">
              <form method="post" action="RemoveItem" class="card">
                <div class="img-box">
                  <img src="<%= prod.getImgName() %>.jpg" alt="<%= prod.getName() %>" width="80px" class="product-img">
                </div>
                <div class="detail">
                  <h4 class="product-name"><%= prod.getName() %></h4>
                  <div class="qty-price">
                    <div class="quantity">
                        <span id="qty"><%= cart.get(prod) %></span>
                    </div>
                    <div class="price">
                        $ <span id="price"><%= String.format("%.2f", prod.getPrice()*cart.get(prod)) %></span>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="name" value="<%= prod.getName() %>">
                <input type="hidden" name="color" value="<%= prod.getColor()%>">
                <input type="hidden" name="price" value="<%= prod.getPrice()%>">
                <button class="cart-remove">
                  <ion-icon name="close-outline"></ion-icon>
                </button>
              </form>
            </div>
            <% } %>
            
          </div>
          
          

        </div>
        <div class="cart-item-price">
          <div class="cart-discount">
            <label for="cart-discount" class="cart-label-default">Gift Card/Discount Code</label>
            <div class="discount">
              <input type="text" name="cart-discount" id="cart-discount" class="cart-input-default">
              <button class="cart-apply">Apply</button>
            </div>
          </div>
          <div class="cart-amount">
            <div class="subtotal">
              <span>Subtotal</span> <span>$ <span id="subtotal"><%= String.format("%.2f", total) %></span></span>
            </div>
            <div class="tax">
                <span>Tax</span> <span>$ <span id="subtotal"><%= String.format("%.2f", tax) %></span></span>
            </div>
            <div class="shipping">
              <span>Shipping</span> <span>$ <span id="subtotal"><%= String.format("%.2f", shipping) %></span></span>
            </div>
            <div class="total">
              <span>Total</span> <span>$ <span id="subtotal"><%= String.format("%.2f", total+tax) %></span></span>
            </div>
          </div>
        </div>
      </section>

      <section class="checkout">
        <h2 class="cart-section-heading">Payment Details</h2>
        <div class="cart-payment-form">
          <div class="payment-method">
            <button class="method">
              <ion-icon name="card"></ion-icon>
              <span>Credit Card</span>
              <ion-icon class="checkmark" name="checkmark-circle-outline"></ion-icon>
            </button>
            <button class="method">
              <ion-icon name="logo-paypal"></ion-icon>
              <span>PayPal</span>
              <ion-icon class="checkmark" name="checkmark-circle-outline"></ion-icon>
            </button>
          </div>
          <form action="#">
            <div class="cardholder-name">
              <label for="cardholder-name" class="cart-label-default">Cardholder Name</label>
              <input type="text" name="cardholder-name" id="cardholder-name" class="cart-input-default">
            </div>
            <div class="card-number">
              <label for="card-number" class="cart-label-default">Card Number</label>
              <input type="number" name="card-number" id="card-number" class="cart-input-default">
            </div>
            <div class="card-flex">
              <div class="expire-date">
                <label for="expire-date" class="cart-label-default">Expiration Date</label>
                <div class="card-flex">
                  <input type="number" name="day" id="expire-date" placeholder="31" min="1" max="31"
                    class="cart-input-default">
                  /
                  <input type="number" name="month" id="expire-date" placeholder="12" min="1" max="12"
                    class="cart-input-default">
                </div>
              </div>
              <div class="cvv">
                <label for="cvv" class="cart-label-default">CVV</label>
                <input type="number" name="cvv" id="cvv" class="cart-input-default">
              </div>
          </form>
        </div>
        <div class="btn">
          <button class="cart-pay">
            <b>Pay</b> $ <span id="pay-amount"></span>
          </button>
        </div>
      </section>
    </div>
  </main>

  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg/com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script>
    const btnList = document.querySelectorAll('.method');
    btnList.forEach(btn => {
      btn.addEventListener('click', () => {
        document.querySelector('.special')?.classList.remove('.special');
        btn.classList.add('.special');
      });
    });
  </script>
</body>

</html>
          <%--
              HashMap<Product, Integer> cart = (HashMap) session.getAttribute("cart");
              double shipping = 0;
              double tax = (cart.isEmpty()) ? 0 : 0.10;
              double total = 0;
              for (Product prod : cart.keySet()) {
                total += prod.getPrice() * cart.get(prod);
                out.println("<div class='cart-product-card'>");
                out.println("<form action='RemoveItem' class='card'>");
                out.println("<div class='img-box'>");
                out.println("<img src='" + prod.getImgName() + ".jpg' alt='" + prod.getName() +"' width='80px' class='product-img'>");
                out.println("</div>");
                out.println("<div class='detail'");
                out.println("<h4 class='product-name'>" + prod.getName() + "</h4>");
                out.println("<div class='qty-price'>");
                out.println("<div class='quantity'>");
                out.println("<span id='qty'>Qty: " + cart.get(prod) + "</span>");
                out.println("</div>");
                out.println("<div class='price'>$");
                out.println("<span id='price'>" + String.format("%.2f", prod.getPrice()*cart.get(prod)) + "</span>");
                out.println("</div>");
                out.println("</div>");
                out.println("</div>");
                out.println("<input type='hidden' name='name' value='" + prod.getName() +"'>");
                out.println("<input type='hidden' name='color' value='" + prod.getColor()+"'>");
                out.println("<input type='hidden' name='price' value='" + prod.getPrice()+"'>");
                out.println("<button type='submit' class='cart-remove'>");
                out.println("<ion-icon name='close-outline'></ion-icon>");
                out.println("</button>");
                out.println("</form>");
                out.println("</div>");
              }
          --%>