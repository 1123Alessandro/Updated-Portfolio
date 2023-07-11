/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controller;

import java.io.*;
import java.sql.*;
import javax.servlet.*;
import javax.servlet.http.*;

/**
 *
 * @author Lenci
 */
public class AddBudget extends HttpServlet {

     Connection conn;
    
    @Override
    public void init(ServletConfig config) throws ServletException {
        super.init(config);
        
        ServletContext context = config.getServletContext();
        
        try {
            Class.forName(context.getInitParameter("jdbcClassName"));
            String username = context.getInitParameter("dbUser");
            String password = context.getInitParameter("dbPass");
            StringBuffer url = new StringBuffer(context.getInitParameter("jdbcDriverUrl")).append("://").append(context.getInitParameter("dbHost")).append(":").append(context.getInitParameter("dbPort")).append("/").append(context.getInitParameter("dbName"));
            conn = DriverManager.getConnection(url.toString(), username, password);
        } catch (SQLException sqle) {
            System.out.println("SQLException error occured - " + sqle.getMessage());
        } catch (ClassNotFoundException nfe) {
            System.out.println("ClassNotFoundException error occured - " + nfe.getMessage());
        }
    }

    @Override
    public void destroy() {
        super.destroy(); // Generated from nbfs://nbhost/SystemFileSystem/Templates/Classes/Code/OverriddenMethodBody
        try {
            conn.close();
        } catch (Exception e) {
            System.err.println(e.getMessage());
        }
    }

    protected void processRequest(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
	    try {
		    // verify session
		    HttpSession session = request.getSession();
		    String accid = (String) session.getAttribute("ACC_ID");
		    if (accid == null) request.getRequestDispatcher("login.jsp").forward(request, response);

		    // for applying MVC framework
		    String mvc = request.getParameter("add");
		    if (mvc == null) request.getRequestDispatcher("add-budget-form.jsp").forward(request, response);
		    else {
			    accid = (String) request.getSession().getAttribute("ACC_ID");
			    String name = request.getParameter("BUD_NAME");
			    String deadline = request.getParameter("BUD_DEADLINE");
                            int limit = Integer.parseInt(request.getParameter("BUD_LIMIT"));
			    if (conn != null) {
				    String query = "INSERT INTO BUDGET(BUD_NAME, BUD_DEADLINE, BUD_LIMIT, ACC_ID) VALUES (?, ?, ?, ?)";
				    PreparedStatement pstmt = conn.prepareStatement(query);
				    pstmt.setString(1, name);
				    pstmt.setString(2, deadline);
				    pstmt.setInt(3, limit);
				    pstmt.setInt(4, Integer.parseInt(accid));
				    pstmt.executeUpdate();
				    request.setAttribute("budgetAdded", true);
				    request.getRequestDispatcher("LandingPage").forward(request, response);
			    }
		    }
	    } catch (SQLException sqle) {
		    sqle.printStackTrace();
	    }
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
