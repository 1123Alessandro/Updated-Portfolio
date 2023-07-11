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
public class Login extends HttpServlet {

    Connection conn;
    int loginAttempts = 3;
    
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

            //retrieve key using servlet context and convert to bytes
            String publicKey = getServletContext().getInitParameter("key");
            byte[] key = publicKey.getBytes();
            String ePass = Security.encrypt(request.getParameter("password"), key); 

	    try {
                    String mvc = request.getParameter("login");
                    if (mvc == null) request.getRequestDispatcher("login.jsp").forward(request, response);
		    if (conn != null) {
			    //for login credentials, using parameterized query
                            String loginquery = "SELECT * FROM ACCOUNT WHERE ACC_EMAIL = ? AND ACC_PASS = ?";
                            PreparedStatement ps = conn.prepareStatement(loginquery);
                            ps.setString(1, request.getParameter("email"));
                            ps.setString(2, ePass);
                            ResultSet rs = ps.executeQuery();

			    // correct credentials
			    if (rs.next()) {
				    HttpSession session = request.getSession();
				    session.setAttribute("ACC_ID", rs.getString("ACC_ID"));
				    request.getRequestDispatcher("LandingPage").forward(request, response);
			    }
			    else {
				    loginAttempts--;
				    request.setAttribute("attempts", loginAttempts);
                                    if (loginAttempts < 1) loginAttempts = 3;
				    request.getRequestDispatcher("login.jsp").forward(request, response);
			    }
		    }
	    } catch (SQLException sqle){
                    sqle.printStackTrace();
		    response.sendRedirect("Error.jsp");
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
