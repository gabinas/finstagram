DROP TABLE Product;
DROP TABLE Image;
DROP TABLE Tag;

CREATE TABLE Product (
    pid             INT NOT NULL AUTO_INCREMENT,
    name            VARCHAR(50) NOT NULL,
    price 		    NUMERIC(10,2) NOT NULL,
	description	    VARCHAR(500),
    discount        INT,
    inventory       INT NOT NULL,
    PRIMARY KEY (pid)
);

CREATE TABLE Image (
    pid    INT NOT NULL,
    imgid  INT NOT NULL AUTO_INCREMENT,
    url    VARCHAR(500),
    PRIMARY KEY (pid, imgid),
    FOREIGN KEY (pid) REFERENCES Product (pid)
        ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Tag (
    pid    INT NOT NULL,
    tag    VARCHAR(20),
    PRIMARY KEY (pid, tag),
    FOREIGN KEY (pid) REFERENCES Product (pid)
        ON UPDATE CASCADE ON DELETE CASCADE
);

# Insert Test Data Here

INSERT INTO Product (name, price, description, discount, inventory) VALUES ("Ball", 20.5, "Round object", 10, 25);
INSERT INTO Tag VALUES (1, "toy");
INSERT INTO Tag VALUES (1, "round");
INSERT INTO Tag VALUES (1, "fun");
INSERT INTO Image (pid, url) VALUES (1, "products/01_01.jpg");
INSERT INTO Image (pid, url) VALUES (1, "products/01_02.jpg");
INSERT INTO Image (pid, url) VALUES (1, "products/01_03.jpg");

INSERT INTO Product (name, price, description, discount, inventory) VALUES ("Pine Cone", 18, "Tree quasi fruit", 0, 52);
INSERT INTO Tag VALUES (2, "nature");
INSERT INTO Tag VALUES (2, "decoration");
INSERT INTO Image (pid, url) VALUES (2, "products/02_01.jpg");
INSERT INTO Image (pid, url) VALUES (2, "products/02_02.jpg");
INSERT INTO Image (pid, url) VALUES (2, "products/02_03.jpg");

INSERT INTO Product (name, price, description, discount, inventory) VALUES ("Sand Castle Building Service", 499, "For a low price hire experts to build professional sand castles that you can live in", 15, 5);
INSERT INTO Tag VALUES (3, "fun");
INSERT INTO Image (pid, url) VALUES (3, "products/03_01.jpg");
INSERT INTO Image (pid, url) VALUES (3, "products/03_02.jpg");
INSERT INTO Image (pid, url) VALUES (3, "products/03_03.jpg");

INSERT INTO Product (name, price, description, discount, inventory) VALUES ("Wedding Dress", 999, "Made by hand with pure silk", 10, 2);
INSERT INTO Tag VALUES (4, "clothing");
INSERT INTO Tag VALUES (4, "decoration");
INSERT INTO Tag VALUES (4, "wedding");
INSERT INTO Image (pid, url) VALUES (4, "products/04_01.jpg");

INSERT INTO Product (name, price, description, discount, inventory) VALUES ("Stabilo Pens", 35, "All available colours come included", 10, 0);
INSERT INTO Tag VALUES (5, "art");
INSERT INTO Tag VALUES (5, "decoration");
INSERT INTO Image (pid, url) VALUES (5, "products/05_01.jpg");
INSERT INTO Image (pid, url) VALUES (5, "products/05_02.jpg");
INSERT INTO Image (pid, url) VALUES (5, "products/05_03.jpg");
INSERT INTO Image (pid, url) VALUES (5, "products/05_04.jpg");
INSERT INTO Image (pid, url) VALUES (5, "products/05_05.jpg");

INSERT INTO Product (name, price, description, discount, inventory) VALUES ("Matcha Tea Set", 42, "Includes ceremonial matcha tea, bowl and whisk", 10, 800);
INSERT INTO Tag VALUES (6, "nature");
INSERT INTO Tag VALUES (6, "tea");
INSERT INTO Image (pid, url) VALUES (6, "products/06_01.jpg");
INSERT INTO Image (pid, url) VALUES (6, "products/06_02.jpg");
