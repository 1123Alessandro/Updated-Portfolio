<%-- 
    Document   : budget
    Created on : 05 16, 23, 10:29:47 PM
    Author     : Lenci
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
        <link rel="stylesheet" href="budget-style.css" />
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
      <div class="left-container">
        <div class="upper">
          <div class="upper-two">
            <h1>Hello,</h1>
	    <h3><%= request.getAttribute("name") %></h3>
            <img src="wave.png" alt="" class="wave" />
          </div>
          <div class="upper-one">
            <img src="wings.png" alt="" class="wings" />
	    <h2>PHP <%= request.getAttribute("total") %></h2>
            <p>Total Expense</p>
          </div>
        </div>
        <div class="lower">
          <div class="tg-wrap">
            <table class="tg">
              <thead>
                <tr>
                  <th
                    style="
                      font-family: 'Poppins', sans-serif;
                      font-size: 1.2rem;
                    "
                    class="tg-ih3h"
                    colspan="4"
                  >
                    Budget List
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="tg-0pky">Name</td>
                  <td class="tg-0pky">Limit</td>
                  <td class="tg-0pky">Deadline</td>
                  <td class="tg-0pky"></td>
                  <!--<td class="tg-0pky"></td>-->
                </tr>
		<%
		ResultSet buds = (ResultSet) request.getAttribute("budget");
		while (buds.next()) {
		%>
                <tr>
			<td class="tg-0lax"><%= buds.getString("BUD_NAME") %></td>
			<td class="tg-0lax"><%= buds.getString("BUD_LIMIT") %></td>
			<td class="tg-0lax"><%= buds.getString("BUD_DEADLINE") %></td>
			<td class="tg-0lax">
				<!-- <a href="/"><i class="bi bi-x-square"></i></a> -->
				<form action="DeleteBudget" method="POST">
					<input type="hidden" name="bud_name" value="<%= buds.getString("BUD_NAME") %>">
					<button type="submit"><i class="bi bi-x-square"></i></button>
				</form>
			</td>
		</tr>
		<%
		}
		%>
                <!-- <tr>
                  <td class="tg-0lax">hello</td>
                  <td class="tg-0lax">123.123</td>
                  <td class="tg-0lax">5/19/23</td>
                  <td class="tg-0lax">
                    <a href="/"><i class="bi bi-pencil-square"></i></a>
                  </td>
                  <td class="tg-0lax">
                    <a href="/"><i class="bi bi-x-square"></i></a>
                  </td>
		</tr> -->
              </tbody>
            </table>
          </div>
          <button class="budget">
            <i class="bi bi-plus-lg"></i>
          </button>
        </div>
      </div>
      <div class="right-container" id="right-container">
        <div class="container">
          <div class="left">
            <div class="calendar">
              <div class="month">
                <i class="fas fa-angle-left prev"></i>
                <div class="date">december 2015</div>
                <i class="fas fa-angle-right next"></i>
              </div>
              <div class="weekdays">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
              </div>
              <div class="days"></div>
              <div class="goto-today">
                <div class="goto">
                  <input type="text" placeholder="mm/yyyy" class="date-input" />
                  <button class="goto-btn">Go</button>
                </div>
                <button class="today-btn">Today</button>
              </div>
            </div>
          </div>
          <div class="right">
            <div class="today-date">
              <div class="event-day">wed</div>
              <div class="event-date">12th december 2022</div>
            </div>
            <div class="events"></div>
            <div class="add-event-wrapper">
              <div class="add-event-header">
                <div class="title">Add Event</div>
                <i class="fas fa-times close"></i>
              </div>
              <div class="add-event-body">
                <div class="add-event-input">
                  <input type="text" placeholder="Name" class="event-name" />
                </div>
              </div>
              <div class="add-event-footer">
                <button class="add-event-btn">Add Event</button>
              </div>
            </div>
          </div>
          <button class="add-event">
            <i class="bi-plus-lg"></i>
          </button>
        </div>
      </div>
    </div>
        <script async src="budget-script.js"></script>
</body>
</html>
