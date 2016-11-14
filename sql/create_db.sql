CREATE TABLE Users(
	id INTEGER NOT NULL AUTO_INCREMENT,
    email VARCHAR(80) NOT NULL,
    username VARCHAR(80) NOT NULL,
    password VARCHAR(80) NOT NULL,
    PRIMARY KEY(id)    
);

CREATE TABLE Manufacturers(
	id INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(80) NOT NULL,
    PRIMARY KEY(id)    
);

CREATE TABLE Juices(
	id INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(80) NOT NULL,
	price  NUMERIC(15,2) NOT NULL,
    manufacturer_id INTEGER NOT NULL,
    PRIMARY KEY(id),
	FOREIGN KEY (manufacturer_id) REFERENCES Manufacturers(id)
);

CREATE TABLE DeliveryTypes(
	id INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(80) NOT NULL,
    price NUMERIC(15,2) NOT NULL,
    PRIMARY KEY(id)    
);

CREATE TABLE Orders(
	id INTEGER NOT NULL AUTO_INCREMENT,
    date DATETIME,
    user_id INTEGER,
    delivery_type_id INTEGER,
    PRIMARY KEY(id),
    FOREIGN KEY (user_id) REFERENCES Users(id)
);

CREATE TABLE OrderJuice(
	id INTEGER NOT NULL AUTO_INCREMENT,
    order_id INTEGER NOT NULL,
    juice_id INTEGER NOT NULL,
    count_of_juice Integer NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (order_id) REFERENCES Orders(id),
    FOREIGN KEY (juice_id) REFERENCES Juices(id)
);