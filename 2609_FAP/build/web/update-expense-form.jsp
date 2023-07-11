<%-- 
    Document   : update-expense-form
    Created on : Apr 29, 2023, 10:56:32 PM
    Author     : araza
--%>

<%@page import="java.sql.*"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Ca-ching!</title>
        <link rel="stylesheet" href="update-expense-form-style.css" />
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
                <h1>Edit Expenses</h1>
                <p>
                  With our user-friendly "Edit Page," you have the flexibility to modify and fine-tune your expense entries.
                  Easily edit transaction information, adjust categories, and stay on top of your financial records, 
                  enabling you to maintain precise and up-to-date expense tracking.
                </p>
            </div>
            <img src="Untitled design (1).png" alt="" />
            <div class="expenses-form">
                <%
                ResultSet record = (ResultSet) request.getAttribute("record");
                while (record.next()) {
                %>
                <form action="UpdateExpense" id="form" name="form" onsubmit="return validate()" method="POST">
		    <input type="hidden" name="update" value="true">
		    <input type="hidden" name="exp_code" value="<%= record.getInt("EXP_CODE") %>">
                    <div class="price-form">
                        <label for="price">PRICE</label>
                        <input id="price" name="price" type="text" value="<%= record.getString("EXP_PRICE") %>" />
                    </div>
                    <div class="select">
                        <label class="select-label" for="format">TYPE</label>
			<select name="type" id="format" value="<%= record.getString("BUD_NAME") %>">
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
			<input type="date" id="date" name="date" value="<%= record.getDate("EXP_DATE") %>" />
                    </div>
                    <button type="submit">✓</button>
                </form>
		<%
			}
		%>
            </div>
        </div>
    </body>
    <script src="update-expense-form-script.js"></script>
</html>
