/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Servlet.java to edit this template
 */
package controller;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.HashMap;
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
public class AddToCart extends HttpServlet {

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
            out.println("<title>Servlet AddToCart</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Servlet AddToCart at " + "Added to cart" + "</h1>");
            out.println("</body>");
            out.println("</html>");*/
            
            String name = request.getParameter("name");
            String color = request.getParameter("color");
            String imgName = request.getParameter("imgName");
            double discount = Double.parseDouble(request.getParameter("discount"));
            int quantity = Integer.parseInt(request.getParameter("quantity"));
            /*
            out.print("<h1>");
            out.print("Item name: " + name + "<br>");
            out.print("Item color: " + color + "<br>");
            out.print("Item price: " + price + "<br>");
            out.print("Item quantity: " + quantity + "<br>");
            out.print("</h1>"); */
            
            HttpSession session = request.getSession();
            if (session.getAttribute("uname") == null) response.sendRedirect("Login");
            else {
                HashMap<Product, Integer> pushcart = (HashMap)session.getAttribute("cart");
                    boolean is_same = false;
                    Product item = new Product(name, color, imgName, discount);
                    for(Product p : pushcart.keySet()){
                         if(p.getName().equals(name) && p.getColor().equals(color) && p.getDiscount() == discount){
                            is_same = true;
                            // out.print("Same");
                            pushcart.put(p, pushcart.get(p) + quantity);
                         }
                     }
                     if(!is_same){
                        pushcart.put(item, quantity);
                     }
                    // out.print(pushcart);
                    response.sendRedirect("Cart");
            }
                
            /* if(session.getAttribute("cart") == null){
                HashMap<Product, Integer> pushcart = new HashMap<>();
                Product item = new Product(name, color, imgName, price);
                pushcart.put(item, quantity);
                session.setAttribute("cart", pushcart);
                out.print(pushcart);
            }
            else{
                HashMap<Product, Integer> pushcart = (HashMap)session.getAttribute("cart");
                boolean is_same = false;
                Product item = new Product(name, color, imgName, price);
                 for(Product p : pushcart.keySet()){
                     if(p.getName().equals(name) && p.getColor().equals(color) && p.getPrice() == price){
                        is_same = true;
                        out.print("Same");
                        pushcart.put(p, pushcart.get(p) + quantity);
                     }
                 }
                 if(!is_same){
                    pushcart.put(item, quantity);
                 }
                out.print(pushcart);
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
