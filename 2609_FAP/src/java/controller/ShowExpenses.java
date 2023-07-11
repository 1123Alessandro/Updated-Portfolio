/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Servlet.java to edit this template
 */
package controller;

import java.io.*;
import java.sql.*;
import javax.servlet.*;
import javax.servlet.http.*;

/**
 *
 * @author araza
 */
public class ShowExpenses extends HttpServlet {
    
    Connection conn;
    
    @Override
    public void init(ServletConfig config) throws ServletException {
        super.init(config);
        
        ServletContext context = config.getServletContext();
        
        try {
            Class.forName(context.getInitParameter("jdbcClassName"));
            String username = context.getInitParameter("dbUser");
            String password = context.getInitParameter("dbPass");
            StringBuffer url = new StringBuffer(context.getInitParameter("jdbcDriverUrl"))
		    .append("://")
		    .append(context.getInitParameter("dbHost"))
		    .append(":")
		    .append(context.getInitParameter("dbPort"))
		    .append("/")
		    .append(context.getInitParameter("dbName"));
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
            response.setContentType("text/html;charset=UTF-8");
	    try {
		    HttpSession session = request.getSession();
		    String accid = (String) session.getAttribute("ACC_ID");

		    // no account session logged in
		    if (accid == null) request.getRequestDispatcher("login.jsp").forward(request, response);

		    // if session is already created
		    else {
			    String filter = (String) request.getParameter("filter");

			    // lists all available filter options in the expenses page
			    String sql = "SELECT * FROM BUDGET WHERE ACC_ID = ?";
			    PreparedStatement prep = conn.prepareStatement(sql);
			    prep.setString(1, accid);
			    ResultSet options = prep.executeQuery();
			    request.setAttribute("filters", options);

			    // to display all expenses
			    if (filter == null) {
				    String query = "SELECT * FROM EXPENSE WHERE ACC_ID = ?";;
				    PreparedStatement ps = conn.prepareStatement(query);
				    ps.setString(1, accid);
				    ResultSet rs = ps.executeQuery();
				    request.setAttribute("expenses", rs);
				    request.getRequestDispatcher("expenses.jsp").forward(request, response);
			    }
			    else {
				    String query = "SELECT * FROM EXPENSE WHERE ACC_ID = ? AND BUD_NAME = ?";
				    PreparedStatement ps = conn.prepareStatement(query);
				    ps.setString(1, accid);
				    ps.setString(2, filter);
				    ResultSet rs = ps.executeQuery();
				    request.setAttribute("expenses", rs);
				    request.getRequestDispatcher("expenses.jsp").forward(request, response);
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
