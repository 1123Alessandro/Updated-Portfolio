# CS 2609 Final Academic Project

Applies the servlet features used in CS 2608 as well as integrate databases to the server e.g. Derby or MySQL

## Major Contributions

Focused on JSP Sciplets for view control and database integration.

Large amount of website flow using the Source packages following the MVC format.

## Setup

Dependencies:
1. NetBeans
1. GlassFish
1. Java EE 5
1. commons-codec-1.9.jar
1. mysql-connector-j-8.0.32.jar

Build and Run after resolving compatibility issues.

Database Setup:
```sql
CREATE DATABASE EWalletDB;
use EWalletDB;

CREATE TABLE account ( 
	ACC_ID INT NOT NULL AUTO_INCREMENT,
	ACC_FNAME VARCHAR(45) NULL,
	ACC_LNAME VARCHAR(45) NULL,
	ACC_OCCUPATION VARCHAR(45) NULL,
	ACC_ADDRESS VARCHAR(60) NULL,
	ACC_PHONE VARCHAR(45) NULL,
	ACC_STATUS VARCHAR(45) NULL,
	ACC_EMAIL VARCHAR(45) NULL,
	ACC_PASS VARCHAR(60) NULL,
	PRIMARY KEY (ACC_ID)
);

CREATE TABLE budget (
  BUD_NAME VARCHAR(10) NOT NULL,
  BUD_DEADLINE DATE NOT NULL,
  BUD_LIMIT INT,
  ACC_ID INT REFERENCES account(ACC_ID),
  PRIMARY KEY (BUD_NAME, BUD_DEADLINE)
);

CREATE TABLE expense (
  EXP_CODE INT NOT NULL AUTO_INCREMENT,
  EXP_PRICE FLOAT NULL,
  EXP_DATE DATE NULL,
  BUD_NAME VARCHAR(10) REFERENCES budget(BUD_NAME),
  ACC_ID INT REFERENCES account(ACC_ID),
  PRIMARY KEY (EXP_CODE)
);
```

Optional test data:
```sql
INSERT INTO account (ACC_FNAME, ACC_LNAME, ACC_OCCUPATION, ACC_ADDRESS, ACC_PHONE, ACC_STATUS, ACC_EMAIL, ACC_PASS) VALUES
("carl", "padua","student","Navotas City, Metro Manila", "09276543210", "single", "carl@yahoo.com", "ft2k3w5gnnSQC9mvdFYjZg=="),
("lenci", "cruz","student","Quezon City, Metro Manila", "09159876540", "single", "lenci@yahoo.com", "u1WmmRMKSHoizuwZHBdhfw=="),
("andy", "araza","student","Pasay City, Metro Manila", "09953216540", "single", "andy", "U7gVNnd+DGqHMLVoAUUEbg==");

INSERT INTO budget (BUD_NAME, BUD_DEADLINE, BUD_LIMIT, ACC_ID) VALUES
("food", "2023-02-16", 23000, 3),
("car", "2023-02-16", 45000, 3),
("test", "2023-02-16", 45000, 3),
("travel", "2023-07-29", 28500, 2),
("pet", "2023-03-06", 16000, 2),
("rent", "2023-12-08", 17500, 1),
("clothing", "2023-10-17", 17000, 1),
("subs", "2023-05-01", 23000, 1);

INSERT INTO expense (EXP_PRICE, EXP_DATE, BUD_NAME, ACC_ID) VALUES
(232.68, '2023-07-18', 'subs', 3),
(1334.56, '2023-07-14', 'rent', 3),
(981.71, '2023-09-28', 'subs', 2),
(2105.36, '2023-05-04', 'clothing', 1),
(110.54, '2023-03-12', 'subs', 3),
(1599.53, '2023-05-01', 'pet', 3),
(2857.06, '2023-10-14', 'travel', 2),
(322.78, '2023-03-29', 'pet', 2),
(376.51, '2023-04-28', 'pet', 2),
(500, '2023-06-01', 'food', 3),
(600, '2023-06-01', 'food', 3),
(1000, '2023-06-01', 'car', 3),
(428.15, '2023-02-05', 'travel', 2);

SELECT * FROM account;
SELECT * FROM budget;
SELECT * FROM expense;
```
