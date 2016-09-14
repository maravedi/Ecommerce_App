CREATE TABLE customer (
	customer_id INT NOT NULL AUTO_INCREMENT, 
	firstname VARCHAR(50), 
	lastname VARCHAR(50), 
	street VARCHAR(50), 
	city VARCHAR(50), 
	state VARCHAR(50), 
	zip VARCHAR(50), 
	country VARCHAR(50), 
	phone VARCHAR(20), 
	email VARCHAR(50),
	PRIMARY KEY (customer_id)
); 


#######################################################

CREATE TABLE product (
	product_id INT NOT NULL AUTO_INCREMENT, 
	cat_id INT,
	product_name VARCHAR(50),
	description VARCHAR(200),
	price DOUBLE,
	quantity INT NOT NULL,
	FOREIGN KEY (cat_id) REFERENCES category(cat_id) ON UPDATE CASCADE ON DELETE RESTRICT,
	PRIMARY KEY (product_id) 
);

#######################################################

CREATE TABLE category (
	cat_id INT NOT NULL AUTO_INCREMENT,
	category_name VARCHAR(100),
	PRIMARY KEY (cat_id)
);


#######################################################

CREATE TABLE orders (
	order_id INT NOT NULL AUTO_INCREMENT,
	customer_id INT,
	product_id INT,
	quantity INT,
	FOREIGN KEY (customer_id) REFERENCES customer(customer_id) ON UPDATE CASCADE ON DELETE RESTRICT,
	FOREIGN KEY (product_id) REFERENCES product(product_id) ON UPDATE CASCADE ON DELETE RESTRICT,
	PRIMARY KEY (order_id)
);

#######################################################

CREATE TABLE login (
	login_id INT NOT NULL AUTO_INCREMENT,
	customer_id INT,
	username VARCHAR(20),
	password VARCHAR(20),
	FOREIGN KEY (customer_id) REFERENCES customer(customer_id) ON UPDATE CASCADE ON DELETE RESTRICT,
	PRIMARY KEY (login_id)
);

#######################################################

CREATE TABLE admin (
	admin_id INT NOT NULL AUTO_INCREMENT,
	admin_name VARCHAR(20),
	admin_password VARCHAR(20),
	PRIMARY KEY (admin_id)
);

#######################################################
#######################################################
#######################################################

INSERT INTO 
	category (cat_id, category_name) 
VALUES 
	(1,'furniture'), 
	(2,'electronics'), 
	(3,'produce'), 
	(4,'pharmacy'), 
	(5,'toys'), 
	(6,'automotive');

#######################################################
INSERT INTO
	product (product_id, cat_id, product_name, description, price, quantity) 
VALUES
	(1, 1, 'chair', 'brown leather chair', 150, 5),
	(2, 1, 'table', 'hard wood table', 100, 10),
	(3, 1, 'desk', 'mahogany desk', 75, 0),
	(4, 2,'laptop', 'dell 520 laptop', 300, 43),
	(5, 2,'ipod', 'apple iPod', 70, 15),
	(6, 2,'camera', 'nikon camera', 150, 15),
	(7, 3,'banana', 'yellow banana', 1, 20),
	(8, 3,'apple', 'granny smith apple', .75, 100),
	(9, 3,'chips', 'bag of frito lay chips', 3, 65),
	(10, 4,'advil', 'bottle of advil headache medicine', 3, 76),
	(11, 4,'nyquil', 'bottle of nyquil', 4, 700),
	(12, 4,'toothpaste', 'tube of toothpaste', 2, 90),
	(13, 5,'truck', 'toy tonka truck', 8, 65),
	(14, 5,'legoes', 'box of legoes', 15, 4),
	(15, 5,'doll', 'barbie doll', 10, 0),
	(16, 6,'tire', 'one automobile tire', 30, 99),
	(17, 6,'polish', 'automotive polish', 5, 14),
	(18, 6,'seat_cover', 'seat cover for automobiles', 20, 54);
#######################################################
INSERT INTO
	customer(customer_id, firstname, lastname, street, city, state, zip, country, phone, email)
VALUES
	(1, 'david', 'frazer', '2400 dane st.', 'high point', 'nc', '27263', 'united states', '3368880000', 'dmfrazer@uncg.edu'),
	(2, 'steven', 'tyler', '900 willoubar st.', 'greensboro', 'nc', '27409', 'united states', '3368700001', 'styler@uncg.edu'),
	(3, 'martin', 'jones', '900 eastchester dr.', 'san francisco', 'ca', '79824', 'united states', '3368600032', 'mjones@uncg.edu'),
	(4, 'donald', 'duck', '1007 w. college dr.', 'chicago', 'il', '34534', 'united states', '3368500042', 'dduck@uncg.edu'),
	(5, 'cameron', 'dancer', '825 5th st.', 'new orleans', 'la', '23455', 'united states', '3368890024', 'cdancer@uncg.edu');
	
	