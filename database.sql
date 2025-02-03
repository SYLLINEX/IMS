CREATE DATABASE item_management;

USE item_management;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(255) NOT NULL,
    item_desc VARCHAR(255) NOT NULL,
    item_category VARCHAR(255) NOT NULL,
    item_quantity INT NOT NULL,
    date_added DATE DEFAULT CURRENT_DATE
);

