<%-- 
    Document   : shop
    Created on : 11 29, 22, 5:04:30 PM
    Author     : reiva
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.util.Random" %>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shop</title>
        <link rel="stylesheet" href="shop.css">
    </head>

    <body>
        <%
            response.setHeader("Cache-Control", "no-cache, no-store, must-revalidate");
            response.setHeader("Expires", "0");
            Random randy = new Random();
            if (randy.nextInt(11) == 10) response.sendError(418);
        %>
        <!--Header section-->
        <header>
            <input type="checkbox" name="" id="toggle">
            <label for="toggle"><ion-icon name="menu"></ion-icon></label>

            <a href="/MP4_Infinity_and_Beyond" class="logo">Galaxy<span>.</span></a>

            <nav class="navbar">
                <a href="#home">Home</a>
                <a href="#about">About</a>
                <a href="#products">Products</a>
                <a href="#review">Review</a>
                <a href="#contact">Contact</a>
            </nav>

            <div class="icons">
                    <!-- <span class="icon"><ion-icon name="heart"></ion-icon></span>
                </a> -->
                <a href="Cart">
                    <span class="icon"><ion-icon name="cart"></ion-icon></span>
                </a>
                <a href="Account">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                </a>
            </div>
        </header>

        <!--Home section-->
        <section class="home" id="home">
            <div class="content">
                <h3>
                    BIOCERAMIC MOON<span class="s">S</span>WATCH COLLECTION
                </h3>
                <span><i>Reach for the planets</i></span>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                <a href="#products" class="btn">Shop now</a>
            </div>
        </section>

        <!--About section-->
        <section class="about" id="about">
        <h1 class="heading">
            <span>About</span> us
            <div class="row">
                <div class="video-container">
                    <video src="Making of the MoonSwatch.mp4" loop autoplay muted></video>
                <h3>Best watch sellers</h3>
                </div>

                <div class="content">
                    <h3>Why choose us?</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem iure atque in ex id reiciendis, blanditiis maiores accusamus minus? Similique inventore tenetur ut, beatae reprehenderit itaque nulla sint ratione sunt?</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae asperiores molestiae cumque libero odio eius illo! Voluptatibus labore earum voluptatem veniam, possimus dignissimos repellendus ea assumenda, suscipit sint eveniet culpa.</p>
                </div>
            </div>
        </h1>
        </section>

        <!--Icons section-->
        <section class="icons-container">
            <div class="icons">
                <img src="free-delivery.png" alt="Free delivery icon">
                <div class="info">
                    <h3>Free delivery</h3>
                    <span>on all orders</span>
                </div>
            </div>
            
            <div class="icons">
                <img src="money-back.png" alt="Money-back guarantee icon">
                <div class="info">
                    <h3>10 days returns</h3>
                    <span>money-back guarantee</span>
                </div>
            </div>
            
            <div class="icons">
                <img src="price-tag.png" alt="Gift icon">
                <div class="info">
                    <h3>Offer and gifts</h3>
                    <span>on all orders</span>
                </div>
            </div>
            
            <div class="icons">
                <img src="credit-card.png" alt="Credit card icon">
                <div class="info">
                    <h3>Secure payments</h3>
                    <span>protected by paypal</span>
                </div>
            </div>
        </section>

        <!--Products section-->
        <section class="products" id="products">
            <h1 class="heading">
                latest <span>products</span>
            </h1>

            <div class="box-container">
                <!--Mission to the Sun-->
                <div class="box">
                    <span class="discount">-10%</span>
                    <div class="image">
                        <img src="sun.jpg" alt="Mission to the Sun watch">
                        <div class="icons">
                            <!-- <a href="#" class="icon"><ion-icon name="heart-outline"></ion-icon></a> -->
                            <form method="get" action="Product">
                                <input type="hidden" name="product" value="sun">
                                <button type="submit" class="cart-btn"><ion-icon name="cart-outline"></ion-icon>Add to cart</button>
                            </form>
                        </div>
                    </div>
                    <div class="content">
                        <h3>Mission to the Sun</h3>
                        <div class="price">$234.00<span>$260.00</span></div>
                    </div>
                </div>

                <!--Mission to Mercury-->
                <div class="box">
                    <span class="discount">-18%</span>
                    <div class="image">
                        <img src="mercury.jpg" alt="Mission to Mercury watch">
                        <div class="icons">
                            <form method="get" action="Product">
                                <input type="hidden" name="product" value="mercury">
                                <button type="submit" class="cart-btn"><ion-icon name="cart-outline"></ion-icon>Add to cart</button>
                            </form>
                        </div>
                    </div>
                    <div class="content">
                        <h3>Mission to Mercury</h3>
                        <div class="price">$213.20<span>$260.00</span></div>
                    </div>
                </div>

                <!--Mission to Venus-->
                <div class="box">
                    <span class="discount">-3%</span>
                    <div class="image">
                        <img src="venus.jpg" alt="Mission to Venus watch">
                        <div class="icons">
                            <form method="get" action="Product">
                                <input type="hidden" name="product" value="venus">
                                <button type="submit" class="cart-btn"><ion-icon name="cart-outline"></ion-icon>Add to cart</button>
                            </form>
                        </div>
                    </div>
                    <div class="content">
                        <h3>Mission to Venus</h3>
                        <div class="price">$252.20<span>$260.00</span></div>
                    </div>
                </div>
                
                <!--Mission on Earth-->
                <div class="box">
                    <span class="discount">-17%</span>
                    <div class="image">
                        <img src="earth.jpg" alt="Mission on Earth watch">
                        <div class="icons">
                            <form method="get" action="Product">
                                <input type="hidden" name="product" value="earth">
                                <button type="submit" class="cart-btn"><ion-icon name="cart-outline"></ion-icon>Add to cart</button>
                            </form>
                        </div>
                    </div>
                    <div class="content">
                        <h3>Mission on Earth</h3>
                        <div class="price">$215.80<span>$260.00</span></div>
                    </div>
                </div>

                <!--Mission to the Moon-->
                <div class="box">
                    <span class="discount">-15%</span>
                    <div class="image">
                        <img src="moon.jpg" alt="Mission to the Moon watch">
                        <div class="icons">
                            <form method="get" action="Product">
                                <input type="hidden" name="product" value="moon">
                                <button type="submit" class="cart-btn"><ion-icon name="cart-outline"></ion-icon>Add to cart</button>
                            </form>
                        </div>
                    </div>
                    <div class="content">
                        <h3>Mission to the Moon</h3>
                        <div class="price">$221.00<span>$260.00</span></div>
                    </div>
                </div>

                <!--Mission to Mars-->
                <div class="box">
                    <span class="discount">-7%</span>
                    <div class="image">
                        <img src="mars.jpg" alt="Mission to Mars watch">
                        <div class="icons">
                            <form method="get" action="Product">
                                <input type="hidden" name="product" value="mars">
                                <button type="submit" class="cart-btn"><ion-icon name="cart-outline"></ion-icon>Add to cart</button>
                            </form>
                        </div>
                    </div>
                    <div class="content">
                        <h3>Mission to Mars</h3>
                        <div class="price">$241.80<span>$260.00</span></div>
                    </div>
                </div>

                <!--Mission to Jupiter-->
                <div class="box">
                    <span class="discount">-12%</span>
                    <div class="image">
                        <img src="jupiter.jpg" alt="Mission to Jupiter watch">
                        <div class="icons">
                            <form method="get" action="Product">
                                <input type="hidden" name="product" value="jupiter">
                                <button type="submit" class="cart-btn"><ion-icon name="cart-outline"></ion-icon>Add to cart</button>
                            </form>
                        </div>
                    </div>
                    <div class="content">
                        <h3>Mission to Jupiter</h3>
                        <div class="price">$228.80<span>$260.00</span></div>
                    </div>
                </div>

                <!--Mission to Saturn-->
                <div class="box">
                    <span class="discount">-5%</span>
                    <div class="image">
                        <img src="saturn.jpg" alt="Mission to Saturn watch">
                        <div class="icons">
                            <form method="get" action="Product">
                                <input type="hidden" name="product" value="saturn">
                                <button type="submit" class="cart-btn"><ion-icon name="cart-outline"></ion-icon>Add to cart</button>
                            </form>
                        </div>
                    </div>
                    <div class="content">
                        <h3>Mission to Saturn</h3>
                        <div class="price">$247.00<span>$260.00</span></div>
                    </div>
                </div>

                <!--Mission to Uranus-->
                <div class="box">
                    <span class="discount">-8%</span>
                    <div class="image">
                        <img src="uranus.jpg" alt="Mission to Uranus watch">
                        <div class="icons">
                            <form method="get" action="Product">
                                <input type="hidden" name="product" value="uranus">
                                <button type="submit" class="cart-btn"><ion-icon name="cart-outline"></ion-icon>Add to cart</button>
                            </form>
                        </div>
                    </div>
                    <div class="content">
                        <h3>Mission to Uranus</h3>
                        <div class="price">$239.20<span>$260.00</span></div>
                    </div>
                </div>

                <!--Mission to Neptune-->
                <div class="box">
                    <span class="discount">-9%</span>
                    <div class="image">
                        <img src="neptune.jpg" alt="Mission to Neptune watch">
                        <div class="icons">
                            <form method="get" action="Product">
                                <input type="hidden" name="product" value="neptune">
                                <button type="submit" class="cart-btn"><ion-icon name="cart-outline"></ion-icon>Add to cart</button>
                            </form>
                        </div>
                    </div>
                    <div class="content">
                        <h3>Mission to Neptune</h3>
                        <div class="price">$236.60<span>$260.00</span></div>
                    </div>
                </div>

                <!--Mission to Pluto-->
                <div class="box">
                    <span class="discount">-20%</span>
                    <div class="image">
                        <img src="pluto.jpg" alt="Mission to Pluto watch">
                        <div class="icons">
                            <form method="get" action="Product">
                                <input type="hidden" name="product" value="pluto">
                                <button type="submit" class="cart-btn"><ion-icon name="cart-outline"></ion-icon>Add to cart</button>
                            </form>
                        </div>
                    </div>
                    <div class="content">
                        <h3>Mission to Pluto</h3>
                        <div class="price">$208.00<span>$260.00</span></div>
                    </div>
                </div>
            </div>
        </section>

        <!--Review section-->
        <section class="review" id="review">
            <h1 class="heading">Customer's <span>review</span></h1>
            <div class="box-container">
                <div class="box">
                    <div class="stars">
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, quibusdam. Omnis eos explicabo nihil adipisci ratione cumque laudantium officiis libero, dolor, quas necessitatibus possimus rem magni! Facere ullam officia aliquid!</p>
                    <div class="user">
                        <img src="chris.jpg" alt="Chris">
                        <div class="user-info">
                            <h3>Chris Evans</h3>
                            <span>Happy customer</span>
                        </div>
                    </div>
                </div>

                <div class="box">
                    <div class="stars">
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, quibusdam. Omnis eos explicabo nihil adipisci ratione cumque laudantium officiis libero, dolor, quas necessitatibus possimus rem magni! Facere ullam officia aliquid!</p>
                    <div class="user">
                        <img src="steve.jpg" alt="Steve">
                        <div class="user-info">
                            <h3>Steve Harvey</h3>
                            <span>Happy customer</span>
                        </div>
                    </div>
                </div>

                <div class="box">
                    <div class="stars">
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, quibusdam. Omnis eos explicabo nihil adipisci ratione cumque laudantium officiis libero, dolor, quas necessitatibus possimus rem magni! Facere ullam officia aliquid!</p>
                    <div class="user">
                        <img src="cillian.jpg" alt="Cillian">
                        <div class="user-info">
                            <h3>Cillian Murphy</h3>
                            <span>Happy customer</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--Contact section-->
        <section class="contact" id="contact">
            <h1 class="heading"><span>Contact</span> Us</h1>
            <div class="row">
                <form action="">
                    <input type="text" placeholder="Name" class="box">
                    <input type="email" placeholder="Email" class="box">
                    <input type="number" placeholder="Contact number" class="box">
                    <textarea name="comments" class="box" placeholder="Any comments or suggestions?" rows="10" cols="30"></textarea>
                    <input type="submit" value="Send message" class="btn">
                </form>
                <div class="image">
                    <img src="among-us.jpg" alt="Among us wallpaper">
                </div>
            </div>
        </section>

        <!--Footer section-->
        <section class="footer">
            <div class="box-container">
                <div class="box">
                    <h3>Quick Links</h3>
                    <a href="#">Home</a>
                    <a href="#about">About</a>
                    <a href="#products">Products</a>
                    <a href="#review">Review</a>
                    <a href="#contact">Contact</a>
                </div>
                
                <div class="box">
                    <h3>Extra Links</h3>
                    <a href="Cart">My Order</a>
                    <a href="Account">My Account</a>
                </div>

                <div class="box">
                    <h3>Locations</h3>
                    <a href="#">India</a>
                    <a href="#">USA</a>
                    <a href="#">Japan</a>
                    <a href="#">France</a>
                    <a href="#">Australia</a>
                </div>

                <div class="box">
                    <h3>Contact Information</h3>
                    <a href="#">+123-456-7890</a>
                    <a href="#">example@gmail.com</a>
                    <a href="#">Washington, USA</a>
                    <img src="credit.png" alt="Credit card logos">
                </div>
            </div>

            <div class="credit">
                Created by <span>Group 10</span> | All rights reserved
            </div>
        </section>

        <!--Import icons-->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>
