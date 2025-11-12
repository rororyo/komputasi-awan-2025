CREATE TABLE IF NOT EXISTS visitors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ip_address VARCHAR(45) NOT NULL,
    visit_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    page_visited VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products (name, price, stock) VALUES 
('Laptop Dell XPS', 15000000, 10),
('Mouse Logitech', 250000, 50),
('Keyboard Mechanical', 750000, 30),
('Monitor 24 inch', 2500000, 15),
('Webcam HD', 500000, 25);
