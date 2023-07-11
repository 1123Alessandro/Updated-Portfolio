<%-- 
    Document   : expenses
    Created on : Apr 29, 2023, 5:09:14 PM
    Author     : araza
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.sql.*" %>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="expenses-style.css" />
        <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"
        />
        <title>Expenses</title>
    </head>
    <body>
         <!--REMINDER: no one can reach this page unless they have passed through ShowExpenses servlet--> 
         <!--cont: ShowExpenses should pass 2 ResultSet objects: (1) a list of filter types and (2) an expenses table with or without a filter applied--> 
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
            <div class="text-container">
                <h1>Expenses</h1>
                <p>
                  Experience a clear and comprehensive overview of your expenses with our Expenses View page. 
                  Effortlessly track and analyze your spending patterns, empowering you to make informed financial decisions.
                </p>
            </div>
            <div class="sub-container">
		    <div class="select">
			    <form action="ShowExpenses" method="GET" onchange="submitForm()" id="filterrr">
				    <label class="select-label" for="format"></label>
				    <select name="filter" id="format">
					    <option selected disabled>Select</option>
					    <%
					    ResultSet filters = (ResultSet) request.getAttribute("filters");
					    while (filters.next()) {
					    String name = filters.getString("BUD_NAME");
					    %>
					    <option value="<%= name %>"><%= name %></option>
					    <%
					    }
					    %>
				    </select>
			    </form>
			    <!--TODO: style the clear filter button-->
			    <form action="ShowExpenses" method="POST">
				    <input class="clear" type="submit" value="Clear Filter">
			    </form>
		    </div>
                
                <div class="tg-wrap table">
                    <table class="tg" id="myTable">
			    <thead>
				    <tr>
					    <th class="tg-ul38">PRICE</th>
					    <th class="tg-ul38">TYPE</th>
					    <th class="tg-ul38">DATE</th>
					    <th class="tg-ul38"></th>
					    <th class="tg-ul38"></th>
				    </tr>
			    </thead>
			    <tbody>
				    <%
				    	ResultSet expenses = (ResultSet) request.getAttribute("expenses");
					while (expenses.next()) {
				    %>
				    <tr>
					    <td class="tg-0lax"><%= expenses.getString("EXP_PRICE") %></td>
					    <td class="tg-0lax"><%= expenses.getDate("EXP_DATE") %></td>
					    <td class="tg-0lax"><%= expenses.getString("BUD_NAME") %></td>
					    <td class="tg-0lax">
						    <form action="UpdateExpense" method="POST">
							    <input type="hidden" name="exp_code" value="<%= expenses.getInt("EXP_CODE") %>">
							    <button type="submit"><i class="bi bi-pencil-square"></i></button>
						    </form>
					    </td>
					    <td class="tg-0lax">
						    <form action="DeleteExpense" method="POST">
							    <input type="hidden" name="exp_code" value="<%= expenses.getInt("EXP_CODE") %>">
							    <button type="submit"><i class="bi bi-x-square"></i></button>
						    </form>
					    </td>
				    </tr>
                                    <%
                                        }
                                    %>
			    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
    <script src="expenses-script.js"></script>
</html>
