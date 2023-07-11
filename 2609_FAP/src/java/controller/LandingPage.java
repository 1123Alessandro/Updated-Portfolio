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
public class LandingPage extends HttpServlet {

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
		    if (accid == null) request.getRequestDispatcher("landing-page.jsp").forward(request, response);
		    else {
			    if (conn == null) response.sendError(403);
			    String budget = (String) request.getParameter("budget");
			    String date = (String) request.getParameter("date");

			    // list all budget types
			    String sql = "select * from budget where acc_id = ?";
			    PreparedStatement prep = conn.prepareStatement(sql);
			    prep.setString(1, accid);
			    ResultSet options = prep.executeQuery();
			    request.setAttribute("filters", options);

			    // check status of each budget for the alerts section of the landing page
			    sql = "select count(*) as numb from budget where acc_id = ?";
			    prep = conn.prepareStatement(sql);
			    prep.setString(1, accid);
			    ResultSet res = prep.executeQuery();
			    res.next();
			    int cc = res.getInt("NUMB");
			    String[] alerts = new String[cc];
			    ResultSet buds = conn.createStatement().executeQuery("SELECT * from budget where acc_id = "+accid);
			    int i = 0;
			    while (buds.next()) {
				    sql = "select round(sum(exp_price), 2) as sum, sum(exp_price) > (select bud_limit from budget where bud_name = ? and acc_id = ?) as result from expense where acc_id = ? and bud_name = ?";
				    prep = conn.prepareStatement(sql);
				    prep.setString(1, buds.getString("BUD_NAME"));
				    prep.setString(2, accid);
                                    prep.setString(3, accid);
				    prep.setString(4, buds.getString("BUD_NAME"));
				    res = prep.executeQuery();
				    res.next();
                                    // Double sum = Double.parseDouble(res.getString("SUM"));
				    alerts[i] = (res.getInt("RESULT") == 1) ? ("Your budget for " + buds.getString("BUD_NAME") + " has been exceeded.") : 
                                            ("Php " + ((res.getString("SUM") == null) ? 0 : res.getString("SUM")) + " is spent in the " + buds.getString("BUD_NAME") + " budget.");
                                    i++;
			    }
			    request.setAttribute("alertos", alerts);

			    if (budget == null) {
				    String query = "SELECT *, SUM(EXP_PRICE) AS EXP_TOTAL FROM EXPENSE WHERE ACC_ID = ? GROUP BY EXP_DATE ORDER BY EXP_DATE";
				    PreparedStatement ps = conn.prepareStatement(query);
				    ps.setString(1, accid);
				    ResultSet rs = ps.executeQuery();
				    request.setAttribute("data", rs);
				    request.getRequestDispatcher("landing-page.jsp").forward(request, response);
			    }
			    else if (date.length() == 0) {
				    String query = "select *, sum(exp_price) as exp_total from expense where acc_id = ? and bud_name = ? group by exp_date order by exp_date";
				    PreparedStatement ps = conn.prepareStatement(query);
				    ps.setString(1, accid);
				    ps.setString(2, budget);
				    ResultSet rs = ps.executeQuery();
				    request.setAttribute("data", rs);
				    request.getRequestDispatcher("landing-page.jsp").forward(request, response);
			    }
			    else {
				    String query = "select *, sum(exp_price) as exp_total from expense where acc_id = ? and bud_name = ? and exp_date > ? group by exp_date order by exp_date";
				    PreparedStatement ps = conn.prepareStatement(query);
				    ps.setString(1, accid);
				    ps.setString(2, budget);
				    ps.setString(3, date);
				    ResultSet rs = ps.executeQuery();
				    request.setAttribute("data", rs);
				    request.getRequestDispatcher("landing-page.jsp").forward(request, response);
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
