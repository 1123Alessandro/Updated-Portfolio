<%-- 
    Document   : index
    Created on : Apr 29, 2023, 12:28:40 AM
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
        <link rel="stylesheet" href="landing-page-style.css" />
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

        <main>
            <%
                // alerts for adding, updating, and deleting records
                Boolean add = (Boolean) request.getAttribute("added");
                Boolean update = (Boolean) request.getAttribute("updated");
                Boolean delete = (Boolean) request.getAttribute("deleted");
                Boolean profileUpdate = (Boolean) request.getAttribute("profileUpdated");
                Boolean budgetAdded = (Boolean) request.getAttribute("budgetAdded");
                Boolean budgetDeleted = (Boolean) request.getAttribute("budgetDeleted");

                if (add != null) {
            %>
            <!--TODO: can change these alerts to pop up boxes or whichever-->
            <!--as long as the scriptlets are not removed, any HTML code can be put here for alerts-->
	    <script>
                alert("Alert: Expense added succesfully");
	    </script>
            <%
                }
                if (update != null) {
            %>
	    <script>
                alert("Alert: Expense updated succesfully");
	    </script>
            <%
                }
                if (delete != null) {
            %>
	    <script>
                alert("Alert: Expense deleted succesfully");
	    </script>
            <%
                }
                if (profileUpdate != null) {
            %>
	    <script>
                alert("Alert: Profile updated succesfully");
	    </script>
            <%
                }
                if (budgetAdded != null) {
            %>
	    <script>
                alert("Alert: Budget added succesfully");
	    </script>
            <%
                }
                if (budgetDeleted != null) {
            %>
	    <script>
                alert("Alert: Budget deleted succesfully");
	    </script>
            <%    }
                // ResultSet results = (ResultSet) request.getAttribute("ACC_ID");
                String accid = (String) session.getAttribute("ACC_ID");
                if (accid == null) {
            %>
            <!-- <h2>all the buttons that are for user features in the landing page will redirect to the login page</h2>
            <h2>we will also put the welcome section here since no one logged in yet</h2>
            <form method = "POST" action = "Login">
                <input type="submit" value="Login">
            </form> -->
            <section class="section-1">
                <div class="container">
                    <div class="text">
                        <h1>Simplify your finances with ease and power.</h1>
                        <p>
                            The ultimate online money saver. Our user-friendly landing page offers a glimpse into the power of financial organization,
                            providing you with the tools to track expenses, manage budgets, and achieve your financial goals with ease.
                        </p>
                        <form action="Login" method="POST">
                            <div class="button-container">
                                <button type="submit" class="button red">Start Saving</button>
                                <button type="submit" class="button outline">
                                    <!-- TODO: discuss possible obsolete feature -->
                                    <a href="Login">Explore</a> 
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="img">
                        <img src="image.png" alt="" />
                    </div>
                </div>
            </section>
            <%
            } else {
		ResultSet recs = (ResultSet) request.getAttribute("data");
		String x = "";
		String y = "";
		int ctr = 0;
		while (recs.next()) {
			x += "\"" + recs.getString("EXP_DATE") + "\", ";
			y += recs.getString("EXP_TOTAL") + ", ";
			ctr++;
		}
		x = (x.length() > 0) ? x.substring(0, x.length()-2) : x;
		y = (y.length() > 0) ? y.substring(0, y.length()-2) : y;
		// x = x.substring(0, x.length()-2);
		// y = y.substring(0, y.length()-2);
            %>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
	    </script>
            <section class="section-2" id="section_2">
                <form class="titleActions" action="LandingPage" method="GET" id="forma">
                    <h1>Overview</h1>
                    <div class="select">
                        <!--TODO: create new independent servlet for overview page filter-->
                        <select name="budget" id="format" onchange="submitForm()">
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
                            <!-- <option value="Food">Food</option>
                            <option value="Bills">Bills</option>
                            <option value="Car">Car</option>
			    <option value="Savings">Savings</option> -->
                        </select>
                    </div>
                    <input name="date" type="date" />
                </form>
                <div class="boxes">
                    <div class="leftBox">
			    <%
			    String[] alerts = (String[]) request.getAttribute("alertos");
			    for (String s : alerts) {
			    %>
			    <div class="alert">
				    <i class="bi bi-exclamation-octagon"></i>
				    <h2 class="warning">
					    <%= s %>
				    </h2>
			    </div>
			    <%
			    }
			    %>
                    </div>
                    <div class="rightBox">
			    <%
			    if (ctr > 1) {
			    %>
			    <canvas id='expchart' class='chartt'></canvas>
                            <script>
				    const xval = [<%= x %>];
				    const yval = [<%= y %>];

				    new Chart("expchart", {
				    	type: "line",
				    	data: {
				    		labels: xval,
				    		datasets: [{
				    			backgroundColor: "rgba(197, 237, 172, 0.5)",
				    			borderColor: "rgba(122, 145, 141, 1.0)",
				    			fill: true,
				    			data: yval
				    		}]
				    	},
				    	options: {
				    		legend: {display: false}
				    	}
				    });
                            </script>
			    <%
			    }
			    else if (ctr == 1) {
			    	// TODO: display prompt for one record only
			    %>
			    <div class="oneres">
				    <h1 class="moni">Php <%= y %></h1>
				    <h4 class="day">Expense/s recorded in <%= x.substring(1, x.length()-1) %></h4>
			    </div>
			    <%
			    }
			    else {
			    	// TODO: display prompt for no records
			    %>
			    <div class="oneres">
				    <i class="bi bi-exclamation-octagon"></i>
				    <h4 class="day">No expense records found</h4>
			    </div>
			    <%
			    }
			    %>
		    </div>
                </div>
            </section>
            <%
                }
            %>
        </main>
    </body>
    <script src="landing-page-script.js"></script>
</html>
