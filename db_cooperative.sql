CREATE DATABASE IF NOT EXISTS db_cooperative;
USE db_cooperative;

CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_code VARCHAR(10) NOT NULL UNIQUE,
    product_name VARCHAR(100) NOT NULL,
    category ENUM('Food','Drink','Stationery','Uniform') NOT NULL,
    unit ENUM('Pcs','Pack','Bottle') NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL,
    entry_date DATE NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS suppliers (
    supplier_id INT AUTO_INCREMENT PRIMARY KEY,
    supplier_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    product_types VARCHAR(100) NOT NULL,
    partnership_date DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS employees (
    employee_id INT AUTO_INCREMENT PRIMARY KEY,
    employee_number VARCHAR(10) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    gender ENUM('M','F') NOT NULL,
    birth_date DATE NOT NULL,
    position ENUM('Cashier','Warehouse Staff','Admin') NOT NULL,
    salary DECIMAL(12,2) NOT NULL
);
