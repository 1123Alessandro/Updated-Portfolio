/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package model;

/**
 *
 * @author araza
 */
public final class Product {
    
    private String name;
    private String color;
    private String imgName;
    private double price;
    private double discount;

    public Product(String name, String color, String imgName, double discount) {
        this.name = name;
        this.color = color;
        this.price = 260 - 260*(discount/100); 
        this.imgName = imgName;
        this.discount = discount;
    }
    public String getName() {
        return name;
    }

    public String getColor() {
        return color;
    }

    public double getPrice() {
        return price;
    }
    
    public String getImgName(){
        return imgName;
    }

    public double getDiscount() {
        return discount;
    }
}
