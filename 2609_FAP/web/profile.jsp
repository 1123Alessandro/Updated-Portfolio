<%-- 
    Document   : profile
    Created on : 05 8, 23, 8:45:15 AM
    Author     : Lenci
--%>

<%@page import="model.Security"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.sql.*" %>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Ca-ching!</title>
        <link rel="stylesheet" href="profile-style.css" />
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
            <%
                ResultSet profile = (ResultSet) request.getAttribute("profile");
                String publicKey = getServletContext().getInitParameter("key");
                byte[] key = publicKey.getBytes();
                while (profile.next()) {
            %>
            <div class="profile">
                <form action="UpdateAccount" method="POST" id="update-acc">
                    <input type="hidden" name="update" value="true">
                    <input type="hidden" name="acc_id" value="<%= profile.getInt("ACC_ID")%>">
                    <div class="profile-upper">
                        <i class="bi bi-person-circle"></i>
                        <div class="fields">
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="<%= profile.getString("ACC_FNAME")%> <%= profile.getString("ACC_LNAME")%>"
                                disabled
                                />
                            <input
                                type="text"
                                id="type"
                                name="occupation"
                                value="<%= profile.getString("ACC_OCCUPATION")%>"
                                disabled
                                />
                            <input
                                type="text"
                                id="address"
                                name="address"
                                value="<%= profile.getString("ACC_ADDRESS")%>"
                                disabled
                                />
                        </div>
                    </div>
                    <hr class="solid" />
                    <div class="profile-lower">
                        <div class="fields-lower">
                            <div class="input-row">
                                <label for="phone-number">Phone Number</label>
                                <input
                                    type="text"
                                    id="phone-number"
                                    name="phone-number"
                                    value="<%=profile.getString("ACC_PHONE")%>"
                                    required
                                    disabled
                                    />
                            </div>
                                    
                                     <div class="input-row">
                <label for="occupation">Marital Status</label>
                <select id="occupation" name="status" value="<%= profile.getString("ACC_STATUS")%>">
                    <option disabled selected value=""><%= profile.getString("ACC_STATUS") %></option>
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="divorced">Divorced</option>
                    <option value="none">Prefer not to say</option>
                </select>
              </div>
                            
                            <div class="input-row">
                                <label for="email">Email</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="<%= profile.getString("ACC_EMAIL")%>"
                                    required
                                    disabled
                                    />
                            </div>
                            <div class="input-row">
                                <label for="password">Password</label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    value="<%= Security.decrypt(profile.getString("ACC_PASS"), key)%>"
                                    minlength="8"
                                    required
                                    disabled
                                    />
                            </div>
                        </div>
                    </div>
                    <div id="btn-container">
                        <button type="button" id="edit-btn">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button" id="update-btn" style="display: none">
                            <i class="bi bi-check-lg"></i>
                        </button>
                    </div>
                </form>
                <p id="status-msg"></p>
            </div>
            <%
                }
            %>
        </div>
        <div class="exit">
                <a href="Logout"><input type=button value="Logout" class="out"></a>
        </div>

<!--        <form action="Logout">
            <input type="submit" value="Logout">
        </form>-->
    </body>
    <script src="profile-script.js"></script>
</html>
