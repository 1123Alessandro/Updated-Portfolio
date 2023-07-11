<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.sql.*" %>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Ca-ching!</title>
        <link rel="stylesheet" href="add-expense-form-style.css" />
        <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"
        />
    </head>
    <body>
        <header>
            <div class="navbar">
                <div class="logo"><a href="LandingPage">Ca-ching!</a></div>
                <ul class="links">
                    <li><a href="LandingPage">Home</a></li>
                    <li><a href="AddExpense">Save!</a></li>
                    <li><a href="ShowExpenses">Expenses</a></li>
                    <li><a href="ShowBudget">Budget</a></li>
                </ul>
                <a href="ShowProfile" class="action-btn">Profile</a>
                <div class="toggle-btn">
                    <i class="bi bi-list"></i>
                </div>
            </div>
            <div class="dropdown-menu">
                <li><a href="LandingPage">Home</a></li>
                <li><a href="AddExpense">Save!</a></li>
                <li><a href="ShowExpenses">Expenses</a></li>
                <li><a href="ShowBudget">Budget</a></li>
                <li><a href="ShowProfile" class="action-btn">Profile</a></li>
            </div>
        </header>
        <div class="main-container">
            <div class="text">
                <h1>Add Expenses</h1>
                <p>
                  Start tracking your expenses seamlessly with our "Add Expenses" page. 
                  Capture and categorize your transactions effortlessly, 
                  empowering you to understand your spending patterns and make smarter financial choices.
                </p>
            </div>
            <img src="Untitled design (1).png" alt="" />
            <div class="expenses-form">
                <form action="AddExpense" id="form" name="form" onsubmit="return validate()" method="POST">
                    <input type="hidden" name="add" value="true">
                    <div class="price-form">
                        <label for="price">PRICE</label>
                        <input id="price" name="price" type="text" placeholder="1230.50"/>
                    </div>
                    <div class="select">
                        <label class="select-label" for="format">TYPE</label>
                        <select name="type" id="format">
                            <option selected disabled>Select</option>
			    <%
			    ResultSet filters = (ResultSet) request.getAttribute("budgs");
			    while (filters.next()) {
			    	String name = filters.getString("BUD_NAME");
			    %>
			    <option value="<%= name %>"><%= name %></option>
			    <% } %>
                        </select>
                    </div>
                    <div class="date-form">
                        <label for="date">DATE</label>
                        <input type="date" name="date" id="date" />
                    </div>
                    <button type="submit">+</button>
                </form>
            </div>
        </div>
    </body>
    <script src="add-expense-form-script.js"></script>
</html>
