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
import model.Security;

/**
 *
 * @author Lenci
 */
public class UpdateAccount extends HttpServlet {

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
            // MVC
            String mvc = request.getParameter("update");
            if (mvc == null) {
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery("SELECT * FROM ACCOUNT WHERE ACC_ID = " + request.getParameter("acc_id"));
//                            System.out.println("exp code ============================ " + request.getParameter("exp_code"));
                request.setAttribute("profile", rs);
                request.getRequestDispatcher("update-account-form.jsp").forward(request, response);
            } else {
                int acc_id = Integer.parseInt(request.getParameter("acc_id"));
                String name = request.getParameter("name");
                String[] fullN = name.split(" ");

                // Loop for people that have three names
                // e.g. Jose Abad Santos
                String pre_fname = "";
                String fname = "";
                String lname = fullN[fullN.length - 1];
                for (int c = 0; c < fullN.length - 1; c++) {
                    pre_fname += fullN[c] + " ";
                }
                for (int d = 0; d < pre_fname.length() - 1; d++) // just to remove that last space at the end of the first name
                {
                    fname += pre_fname.charAt(d);
                }
                // String fname = request.getParameter("fname");
                // String lname = request.getParameter("lname");
                String occupation = request.getParameter("occupation");
                String address = request.getParameter("address");
                String phone = request.getParameter("phone-number");
                String status = request.getParameter("status");
                String email = request.getParameter("email");
                String publicKey = getServletContext().getInitParameter("key");
                byte[] key = publicKey.getBytes();
                String ePass = Security.encrypt(request.getParameter("password"), key);
                String updateQuery = "UPDATE ACCOUNT SET ACC_ID = ?, ACC_FNAME = ?,ACC_LNAME = ?, ACC_OCCUPATION = ?, "
                        + "ACC_ADDRESS = ?, ACC_PHONE = ?, ACC_STATUS = ?, ACC_EMAIL = ?, ACC_PASS = ? WHERE ACC_ID = " + acc_id;
                PreparedStatement ps = conn.prepareStatement(updateQuery);
                ps.setInt(1, acc_id);
                ps.setString(2, fname);
                ps.setString(3, lname);
                ps.setString(4, occupation);
                ps.setString(5, address);
                ps.setString(6, phone);
                ps.setString(7, status);
                ps.setString(8, email);
                ps.setString(9, ePass);
                int i = ps.executeUpdate(); // TODO: use status later
                request.setAttribute("profileUpdated", true);
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
