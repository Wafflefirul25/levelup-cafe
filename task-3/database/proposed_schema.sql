-- PROPOSED integration schema: Task 3 must review, own and document final design.
CREATE DATABASE IF NOT EXISTS levelup_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE levelup_db;
CREATE TABLE IF NOT EXISTS admins (
 id INT AUTO_INCREMENT PRIMARY KEY,
 username VARCHAR(100) NOT NULL UNIQUE,
 password_hash VARCHAR(255) NOT NULL
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS customers (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100) NOT NULL,
 email VARCHAR(190) NOT NULL UNIQUE
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS seats (
 id INT AUTO_INCREMENT PRIMARY KEY,
 label VARCHAR(50) NOT NULL UNIQUE,
 category ENUM('Standard','Premium') NOT NULL,
 hourly_rate DECIMAL(7,2) NOT NULL,
 active TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS bookings (
 id INT AUTO_INCREMENT PRIMARY KEY,
 customer_id INT NOT NULL,
 seat_id INT NOT NULL,
 start_at DATETIME NOT NULL,
 end_at DATETIME NOT NULL,
 total DECIMAL(9,2) NOT NULL,
 status ENUM('confirmed','cancelled') NOT NULL DEFAULT 'confirmed',
 created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(customer_id) REFERENCES customers(id),
 FOREIGN KEY(seat_id) REFERENCES seats(id),
 INDEX seat_time (seat_id,status,start_at,end_at)
) ENGINE=InnoDB;
INSERT IGNORE INTO seats(id,label,category,hourly_rate) VALUES
(1,'PC-01','Standard',3.00),(2,'PC-02','Standard',3.00),(3,'PC-03','Premium',5.00),(4,'PC-04','Premium',5.00);
-- Admin creation uses PHP password_hash; never insert a plain-text password.
