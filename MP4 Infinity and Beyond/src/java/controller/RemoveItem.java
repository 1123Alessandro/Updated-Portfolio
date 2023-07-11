/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Servlet.java to edit this template
 */
package controller;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.HashMap;
import java.util.Iterator;
import java.util.Map;
import java.util.Map.Entry;
import java.util.Set;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import model.Product;
/**
 *
 * @author nigel
 */
public class RemoveItem extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code> methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try ( PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            /*out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet RemoveItem</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Servlet RemoveItem at " + request.getContextPath() + "</h1>");
            out.println("</body>");
            out.println("</html>");*/

            
            HttpSession session = request.getSession();
            HashMap<Product, Integer> cart = (HashMap) session.getAttribute("cart");
            String name = request.getParameter("name");
            String color = request.getParameter("color");
            double price = Double.parseDouble(request.getParameter("price"));
            
            for (Map.Entry<Product, Integer> order: cart.entrySet()) {
                Product prod = order.getKey();
                if (prod.getName().equals(name) && prod.getColor().equals(color) && prod.getPrice() == price) {
                    cart.remove(order.getKey(), order.getValue());
                    break;
                }
            }
            response.sendRedirect("Cart");
            
            /* if(session.getAttribute("cart") != null){
                HashMap<Product, Integer> pushcart = (HashMap)session.getAttribute("cart");
                String name = request.getParameter("name");
                String color = request.getParameter("color");
                double price = Double.parseDouble(request.getParameter("price"));
                
                Set<Entry<Product, Integer>> entrySet = pushcart.entrySet();
                Iterator<Entry<Product, Integer>> itr = entrySet.iterator();
                while(itr.hasNext()){
                    Entry<Product, Integer> entry = itr.next();
                    Product p = entry.getKey();
                     if(p.getName().equals(name) && p.getColor().equals(color) && p.getPrice() == price){
                        itr.remove();
                        session.setAttribute("cart", pushcart);
                        response.sendRedirect("cart.jsp");
                     }
                }
            } */
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
