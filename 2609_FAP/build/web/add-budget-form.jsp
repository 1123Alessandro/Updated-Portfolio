<%-- 
    Document   : add-budget-form
    Created on : 05 16, 23, 10:56:32 PM
    Author     : Lenci
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <form action="AddBudget" method="POST">
            <input type="hidden" name="add" value="true">
            <label for="BUD_NAME">Budget Name</label><input type="text" name="BUD_NAME"/> 
            <label for="BUD_DEADLINE">Budget Deadline</label><input type="date" name="BUD_DEADLINE"/> 
            <label for="BUD_LIMIT">Budget Limit</label><input type="text" name="BUD_LIMIT"/> 
            <input type="Submit">

    </body>
</html>
