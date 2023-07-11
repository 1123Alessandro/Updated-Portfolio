/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package model;

import java.util.*;

/**
 *
 * @author araza
 */
public class Storage {
    
    HashMap<String, Product> stock;

    public Storage() {
        stock = new HashMap<>();
        stock.put("sun", new Product("Mission to the Sun", "GOLDEN YELLO idk bro im only guessing", "sun", 10));
        stock.put("mercury", new Product("Mission to Mercury", "DEEP GREY COLOR", "mercury", 18));
        stock.put("venus", new Product("Mission to Venus", "LIGHT PINK", "venus", 3));
        stock.put("earth", new Product("Mission on Earth", "MATCHA GREEN", "earth", 17));
        stock.put("moon", new Product("Mission to the Moon", "STEEL GRAY", "moon", 15));
        stock.put("mars", new Product("Mission to Mars", "WATERMELON RED", "mars", 7));
        stock.put("jupiter", new Product("Mission to Jupiter", "MOCHA BROWN", "jupiter", 12));
        stock.put("saturn", new Product("Mission to Saturn", "BEIGE", "saturn", 5));
        stock.put("uranus", new Product("Mission to Uranus", "PALE BLUE", "uranus", 8));
        stock.put("neptune", new Product("Mission to Neptune", "FREEZING DEEP BLUE", "neptune", 9));
        stock.put("pluto", new Product("Mission to Pluto", "GRAY AND BURGUNDY", "pluto", 20));
    }

    public HashMap<String, Product> getStock() {
        return stock;
    }
}
