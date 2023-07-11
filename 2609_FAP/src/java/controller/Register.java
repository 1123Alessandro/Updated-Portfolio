package controller;

import java.io.*;
import java.sql.*;
import javax.servlet.*;
import javax.servlet.http.*;
import model.Security;

public class Register extends HttpServlet {

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

    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        //retrieve key using servlet context and convert to bytes
        String publicKey = getServletContext().getInitParameter("key");
        byte[] key = publicKey.getBytes();

        String fname = request.getParameter("firstName");
        String lname = request.getParameter("lastName");
        String occupation = request.getParameter("occupation");
        String address = request.getParameter("address");
        String phone = request.getParameter("phone");
        String status = request.getParameter("status");
        String email = request.getParameter("email");
        String ePass = Security.encrypt(request.getParameter("password"), key);
        try {
            String mvc = request.getParameter("register");
            if (mvc == null) {
                request.getRequestDispatcher("register.jsp").forward(request, response);
            }
            if (conn != null) {
                Statement st = conn.createStatement();
                ResultSet duplicates = st.executeQuery("SELECT * FROM ACCOUNT WHERE ACC_EMAIL='" + email + "'");
                int i = 0;

                String query = "INSERT INTO ACCOUNT(ACC_FNAME, ACC_LNAME, ACC_OCCUPATION, ACC_ADDRESS, ACC_PHONE, ACC_STATUS, ACC_EMAIL, ACC_PASS)"
                        + "VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
                PreparedStatement pstmt = conn.prepareStatement(query);
                pstmt.setString(1, fname);
                pstmt.setString(2, lname);
                pstmt.setString(3, occupation);
                pstmt.setString(4, address);
                pstmt.setString(5, phone);
                pstmt.setString(6, status);
                pstmt.setString(7, email);
                pstmt.setString(8, ePass);

                //checks if account already exists
                while (duplicates.next()) {
                    i++;
                    if (i > 0) {
                        request.setAttribute("duplicate", true);
                        request.getRequestDispatcher("login.jsp").forward(request, response);
                    } //no duplicates, insert to db
                    else {
                        pstmt.executeUpdate();
                        request.setAttribute("register", true);
                        request.getRequestDispatcher("login.jsp").forward(request, response);
                    }
                }

            }

        } catch (SQLException sqle) {
            response.sendRedirect("error.jsp");

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
