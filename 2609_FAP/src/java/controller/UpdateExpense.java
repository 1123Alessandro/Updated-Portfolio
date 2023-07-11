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
public class UpdateExpense extends HttpServlet {

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
                    HttpSession session = request.getSession();
                    String accid = (String) session.getAttribute("ACC_ID");
		    // MVC
		    String mvc = request.getParameter("update");
		    if (mvc == null) {
			    Statement stmt = conn.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_READ_ONLY);
			    ResultSet rs = stmt.executeQuery("SELECT * FROM EXPENSE WHERE EXP_CODE = " + request.getParameter("exp_code"));
			    request.setAttribute("record", rs);
                            String query = "SELECT * FROM BUDGET WHERE ACC_ID = ?";
			    PreparedStatement ps = conn.prepareStatement(query);
			    ps.setString(1, accid);
			    rs = ps.executeQuery();
			    request.setAttribute("budgs", rs);
			    request.getRequestDispatcher("update-expense-form.jsp").forward(request, response);
		    }
		    else {
			    int exp_code = Integer.parseInt(request.getParameter("exp_code"));
			    int price = Integer.parseInt(request.getParameter("price"));
			    String type = request.getParameter("type");
			    String date = request.getParameter("date");
			    String updateQuery = "UPDATE EXPENSE SET EXP_CODE = ?, EXP_PRICE = ?, EXP_DATE = ?, BUD_NAME = ? WHERE EXP_CODE = " + exp_code;
			    PreparedStatement ps = conn.prepareStatement(updateQuery);
			    ps.setInt(1, exp_code);
			    ps.setInt(2, price);
			    ps.setString(3, date);
			    ps.setString(4, type);
			    int i = ps.executeUpdate(); // TODO: use status later
			    request.setAttribute("updated", true);
			    request.getRequestDispatcher("LandingPage").forward(request, response);
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
