CREATE DATABASE doctorWho;
USE doctorWho;

-- Create the patients table
CREATE TABLE patients (
    patient_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    address VARCHAR(100),
    age INT,
    gender VARCHAR(10),
    marital_status VARCHAR(20),
    phone VARCHAR(15)
);

-- Create the admins table for admin authentication
CREATE TABLE admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Grant privileges to the assistant user
GRANT ALL PRIVILEGES ON doctorWho.* TO 'helper'@'localhost' IDENTIFIED BY 'feelBetter';
FLUSH PRIVILEGES;

-- (Optional) Insert at least five sample records into patients
INSERT INTO patients (first_name, last_name, address, age, gender, marital_status, phone)
VALUES 
('John', 'Doe', '123 Main St', 35, 'Male', 'Single', '555-1234'),
('Jane', 'Smith', '456 Oak St', 28, 'Female', 'Married', '555-5678'),
('Bob', 'Brown', '789 Pine St', 42, 'Male', 'Married', '555-9012'),
('Alice', 'Jones', '101 Maple St', 30, 'Female', 'Single', '555-3456'),
('Charlie', 'Davis', '202 Cedar St', 37, 'Male', 'Divorced', '555-7890');
