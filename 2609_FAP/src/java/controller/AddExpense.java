/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Servlet.java to edit this template
 */
package controller;

import java.io.*;
import java.sql.*;
import javax.servlet.*;
import javax.servlet.http.*;
import model.Security;

/**
 *
 * @author araza
 */
public class AddExpense extends HttpServlet {

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
		    if (mvc == null) {
			    String query = "SELECT * FROM BUDGET WHERE ACC_ID = ?";
			    PreparedStatement ps = conn.prepareStatement(query);
			    ps.setString(1, accid);
			    ResultSet rs = ps.executeQuery();
			    request.setAttribute("budgs", rs);
			    request.getRequestDispatcher("add-expense-form.jsp").forward(request, response);
		    }
		    else {
			    accid = (String) request.getSession().getAttribute("ACC_ID");
			    int price = Integer.parseInt(request.getParameter("price"));
			    String type = request.getParameter("type");
			    String date = request.getParameter("date");
			    if (conn != null) {
				    String query = "INSERT INTO EXPENSE(EXP_PRICE, EXP_DATE, BUD_NAME, ACC_ID) VALUES (?, ?, ?, ?)";
				    PreparedStatement pstmt = conn.prepareStatement(query);
				    pstmt.setInt(1, price);
				    pstmt.setString(2, date);
				    pstmt.setString(3, type);
				    pstmt.setInt(4, Integer.parseInt(accid));
				    pstmt.executeUpdate(); 
				    request.setAttribute("added", true);
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
