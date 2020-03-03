# PittMart
## Overview
This project builds an online grocery store for the residents in US. PHP and Javascript have been used to build the basic framework of web pages and MySQL has been used for creating database in the back-end. The database stores all the information regarding customers, orders, products, employees and stores. As an online shopping system, we provide Register and Login functions for the customers. Anyone can create an account and set password in order to login the system in the future. We also created a Shopping cart function which allows people to put in the products that they are interested in. We also allow the customers to register or login to purchase products in the shopping cart after they click Check out and then fill out the shipping and payment information. Our website also provides a recommendation function that can recommend three products that the currently logged-in customer will most likely be going to buy. This is achieved by finding the nearest neighbor of this customer. There are three types of users who could access the system which are Visitor, Customer and Admin. A Visitor is allowed to browse the online grocery store and add goods to the shopping cart. A Customer could purchase the available products after creating an account and logging into the system and make payment. An Admin is the role who has the admin password. The admin is able to view and edit the information of the products, customers and orders, as well as view the sales statistics obtained from data aggregation functions. 
## E-R Diagram
## Description
For this PittMart database, we create seven tables, customers, stores, order_detail, cart, employees,products, product_kinds.
customers: customer_id is the primary key. This table stores the customers’ personal information. One customer can have multiple order details.
stores: store_id is primary key, no_of_employees means the number of employees of each store. One store has many employees. One store corresponds to many order details.
order_detail: order_detail_id is primary key. p_id means product id, it’s a foreign key referring to product_id from table products. One order detail id corresponds to one product, but one product id can correspond to multiple order detail ids. c_id means customer id, and it’s a foreign key referring to customer_id from table customers. store_id is a foreign key referring to store_id from table stores. employee_id is a foreign key referring to the employee_id from table employees. One employee corresponds to multiple order details. o_id means order id, shipping_st means shipping street and qty means the quantity of the product associated with this order_detail_id.
employees: employee_id is the primary key. store_id is the foreign key referring to the store_id from table stores. job_title contains two job types: manager and store assistant. One store has multiple employees.
products: product_id is the primary key. product_kind_id is the foreign key referring to the product_kind_id from table product_kinds. 
product_kinds: product_kind_id is the primary key. One product kind correspond to multiple products.
cart: table cart is a temporary table, which means the items in the cart will be removed after the customer makes payment. id is the primary key, c_id is the foreign key referring to the customer_id from table customers and p_id is the foreign key referring to the product_id from table products. One cart id corresponds to one product whose quantity can be more than one. One customer can have more than one cart id.
For the design of our database schema, we chose to use one order_detail table instead of using one order table plus one order_detail table, which is more preferable based on the normalization rule. Our way is “denormalization”. The reason is that this way can reduce join and speed up searching when the database size is large.
## Front-End Design
## Data Analyses Functions in The Admin Page
The admin is defined as the person who has the admin password. After entering the admin password, the admin will be able to add/delete/update products, delete/update customers, delete/update orders, and view below statistical results.
a.	Sales volume comparison by product category in a pie chart
b.	Sales volume comparison by business account customers in different business categories in a pie chart
c.	Monthly revenue of PittMart in a line chart
d.	Monthly gross profit of PittMart in a line chart
e.	Top ten best sellers by sales volume and the corresponding gross profit data in a horizontal bar chart
f.	Top ten most profitable stores by gross profit and the corresponding revenue data in a horizontal bar chart
## Implementation
The PittMart system was implemented using JavaScript, PHP and MySQL. We adopted the Bootstrap as the front-end framework and use the jQuery library to handle HTML events. We employed the Chart.js library for data visualization and Geocode API for google map visualization.

Most functionality of our system was encapsulated in main.js and action.php. Specifically, main.js acts as a dispatcher, which listens the HTML events, call action.php to generate HTML and write the output to the web pages.  For example, when the home page (index.php and profile.php) is loaded, the function product() in main.js will be called. product() will then call action.php by posting getProduct=1, which in turn construct a SQL query “SELECT * FROM products LIMIT $start,$limit” to search the database for obtaining product information, and write results to a particular HTML division whose id is get_product.
## Data Mining
We also implemented a KNN based collective filtering algorithm for recommending products for the logged in customer (in action.php). We first obtain the list of n product ids and the list of m customer ids from the current database. For each customer, we query the
order_details table and to obtain his/her purchase history profile in terms of product ids with quantities he/she has purchased. We define the similarity ri,j of two customer i and j as the Pearson correlation between their purchase history profiles xi and xj as follows. For the current customer (who has logged in), we will find customer id of his/her nearest neighbor (i.e. with the maximal
similarity), and query the database to obtain top three products the nearest neighbor has purchased most:
SELECT * FROM products JOIN (SELECT o.p_id  FROM order_detail as o WHERE
o.c_id=$neasret_neighbor GROUP BY o.p_id order by sum(o.qty) desc limit 3) as p
ON products.product_id =p.p_id;
## Testing and Error Handling 
1. When the inventory_amount of a certain product is 0, the customer cannot add this product to the shopping cart, and the customer will see this message “Sorry, the product is temporarily out of stock.”. This is handled in action.php.
2. The customer cannot log in if the password he/she enters does not match the record. This is handled in login.php.
3. The customer cannot register if the password and re-entered password are not the same. This is handled in register.php.
4. At the shopping cart page, if the customer accidentally inputs 0 or a negative number for the Qty, the system automatically changes the Qty to 1. This is handled in main.js. If the input is a decimal number, the system converts the input to the nearest integer.
## Limitations and Future Work
1. More search filters are to be added, for example, the price range. When the user inputs a keyword in the search box, he/she will be able to add the price range filer and the products selected will be in that price range. 
2. The current search function is based on the keyword match and is using “%like%” syntax. The more mature search function will be able to handle the spell check, and will be able to support synonyms, which can help the customer to find the products the he/she is really looking for. This is one of the goals that we would like to achieve for this system.
3. The sort function is to be added, for example, sort by relevance, sort by price, sort by popularity.
4. For the admin page, add new product function, the current system does not support adding new category while it only supports adding products of the existing five categories. It is to be implemented later.

