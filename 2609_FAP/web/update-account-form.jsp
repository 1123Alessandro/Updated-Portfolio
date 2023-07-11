<%-- 
    Document   : update-account-form
    Created on : 05 8, 23, 9:25:19 AM
    Author     : Lenci
--%>

<%@page import="java.sql.*"%>
<%@page import="model.Security"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <%
            ResultSet profile = (ResultSet) request.getAttribute("profile");
            String publicKey = getServletContext().getInitParameter("key");
            byte[] key = publicKey.getBytes();
            while (profile.next()) {
        %>

        <form method="post" action="UpdateAccount">
            <input type="hidden" name="update" value="true">
            <input type="text" name="acc_id" value="<%=profile.getInt("ACC_ID")%>" readonly>
            <input type="text" name="fname" placeholder="first name" value="<%=profile.getString("ACC_FNAME")%>">  
            <input type="text" name="lname" placeholder="last name" value="<%=profile.getString("ACC_LNAME")%>">      
            <input type="text" name="email" placeholder="email" value="<%=profile.getString("ACC_EMAIL")%>">      
            <input type="text" name="password" placeholder="password" value="<%=Security.decrypt(profile.getString("ACC_PASS"), key)%>">         

            <input type="submit" value="submit">
        </form>

        <%
            }
        %>
    </body>
</html>
