-- Tạo database cho quán cà phê
CREATE DATABASE IF NOT EXISTS `hangtho` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `hangtho`;

-- Tạo bảng account
CREATE TABLE IF NOT EXISTS `account` (
    `id` int NOT NULL AUTO_INCREMENT,
    `username` varchar(255) NOT NULL,
    `fullname` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `role` enum('admin','user') DEFAULT 'user',
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Tạo bảng category
CREATE TABLE IF NOT EXISTS category (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  description TEXT,
  image VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Tạo bảng product
CREATE TABLE IF NOT EXISTS product (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  description TEXT,
  price DECIMAL(15,2) NOT NULL,
  image VARCHAR(255) DEFAULT NULL,
  category_id INT DEFAULT NULL,
  PRIMARY KEY (id),
  KEY category_id (category_id),
  CONSTRAINT product_ibfk_1 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Tạo bảng orders
CREATE TABLE IF NOT EXISTS orders (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  phone VARCHAR(15) NOT NULL,
  address TEXT NOT NULL,
  total_price DECIMAL(15,2) NOT NULL DEFAULT '0.00',
  status ENUM('pending','processing','shipped','completed','cancelled') NOT NULL DEFAULT 'pending',
  created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  deleted_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Tạo bảng order_details
CREATE TABLE IF NOT EXISTS order_details (
  id INT NOT NULL AUTO_INCREMENT,
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  quantity INT NOT NULL,
  unit_price DECIMAL(15,2) NOT NULL,
  subtotal DECIMAL(15,2) GENERATED ALWAYS AS ((quantity * unit_price)) STORED,
  created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  deleted_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  KEY order_id (order_id),
  KEY product_id (product_id),
  CONSTRAINT order_details_ibfk_1 FOREIGN KEY (order_id) REFERENCES orders (id) ON DELETE CASCADE,
  CONSTRAINT order_details_ibfk_2 FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE,
  CONSTRAINT order_details_chk_1 CHECK ((quantity > 0))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dữ liệu cho bảng category
INSERT INTO category (id, name, description, image) VALUES
  (1, 'Coffee series', 'Dòng cà phê đậm đà, nguyên chất, phù hợp cho mọi tín đồ cà phê.', 'uploads/coffee_series/Coffee_series.jpg'),
  (2, 'Tea and Milktea series', 'Các loại trà và trà sữa mát lạnh, thanh tao.', 'uploads/tea_milktea_series/Tea_series.jpg'),
  (3, 'Machiato series', 'Machiato với các phiên bản nóng, lạnh, đậm đà.', 'uploads/machiato_series/Machiato_series.jpg'),
  (4, 'Hot coffee', 'Các loại cà phê nóng, đậm đà và nóng hổi.', 'uploads/hot_coffee_series/Hot_coffee.jpg'),
  (5, 'Topping', 'Các loại topping cho đồ uống như trân châu, thạch, pudding.', 'uploads/topping/Topping.jpg'),
  (6, 'Cake', 'Bánh ngọt với nhiều hương vị khác nhau, từ bánh trung thu đến bánh macaron.', 'uploads/cake/Cake.jpg');

-- Dữ liệu cho bảng product
INSERT INTO product (id, name, description, price, image, category_id) VALUES
  (1, 'Espresso', 'Cà phê Espresso đậm đà và nguyên chất.', 50000.00, 'uploads/coffee_series/Espresso.jpg', 1),
  (2, 'Latte', 'Cà phê Latte nhẹ nhàng, hòa quyện với sữa tươi.', 55000.00, 'uploads/coffee_series/Latte.jpg', 1),
  (3, 'Cappuccino', 'Cà phê Cappuccino bọt sữa mịn màng, thơm ngon.', 60000.00, 'uploads/coffee_series/Cappuccino.jpg', 1),
  (4, 'Americano', 'Cà phê Americano đậm vị, thích hợp cho người yêu thích cà phê nguyên chất.', 50000.00, 'uploads/coffee_series/Americano.jpg', 1),
  (5, 'Mocha', 'Cà phê Mocha hòa quyện giữa cà phê và sô cô la.', 65000.00, 'uploads/coffee_series/Mocha.jpg', 1),
  (6, 'Trà sữa truyền thống', 'Trà sữa thơm ngon, ngọt ngào với trân châu đen.', 48000.00, 'uploads/tea_milktea_series/Milktea.jpg', 2),
  (7, 'Trà đào', 'Trà đào ngọt ngào, thanh mát, thích hợp cho mùa hè.', 55000.00, 'uploads/tea_milktea_series/Tra_Dao.jpg', 2),
  (8, 'Trà ô long', 'Trà ô long hương thơm nhẹ nhàng, thanh mát.', 50000.00, 'uploads/tea_milktea_series/Olong_tea.jpg', 2),
  (9, 'Trà xanh', 'Trà xanh tươi mát, giải khát tuyệt vời.', 50000.00, 'uploads/tea_milktea_series/Tra_xanh.jpg', 2),
  (10, 'Trà sữa matcha', 'Trà sữa matcha đậm đà, bùi béo.', 65000.00, 'uploads/tea_milktea_series/Trasua_matcha.jpg', 2),
  (11, 'Latte Machiato', 'Machiato nóng đậm vị cà phê với lớp crema dày.', 55000.00, 'uploads/machiato_series/latte_machiato.jpg', 3),
  (12, 'Machiato oreo', 'Machiato lạnh kết hợp oreo, mát lạnh và sảng khoái.', 60000.00, 'uploads/machiato_series/Machiato_oreo.jpg', 3),
  (13, 'Machiato caramel', 'Machiato với hương caramel thơm ngon.', 65000.00, 'uploads/machiato_series/Machiato_caramel.jpg', 3),
  (14, 'Machiato socola', 'Machiato kết hợp với socola ngọt ngào.', 65000.00, 'uploads/machiato_series/Machiato_socola.jpg', 3),
  (15, 'Machiato matcha', 'Machiato hòa quyện với matcha thơm lừng.', 70000.00, 'uploads/machiato_series/Machiato_matcha.jpg', 3),
  (16, 'Cà phê đen nóng', 'Cà phê đen đậm đà, không đường, dành cho tín đồ yêu thích cà phê nguyên chất.', 50000.00, 'uploads/hot_coffee_series/hot_espresso.jpg', 4),
  (17, 'Cà phê sữa nóng', 'Cà phê sữa nóng, thích hợp cho mùa đông.', 55000.00, 'uploads/hot_coffee_series/Vietnamese_coffee.jpg', 4),
  (18, 'Latte nóng', 'Cà phê sữa nóng, thích hợp cho mùa đông.', 60000.00, 'uploads/hot_coffee_series/Hot_Latte.jpg', 4),
  (19, 'Cà phê dừa', 'Cà phê sữa dừa đậm đà, thơm ngon.', 65000.00, 'uploads/coffee_series/coconut_coffee.jpg', 4),
  (20, 'Trân châu đường đen', 'Hạt trân châu dai, ngon, kết hợp vị đường đen ngọt thanh.', 15000.00, 'uploads/topping/tc_den.jpg', 5),
  (21, 'Konjac Ball', 'Hạt trân châu trắng giòn, kết hợp được với mọi thức uống.', 10000.00, 'uploads/topping/konjac_ball.jpg', 5),
  (22, 'Trân châu phô mai', 'Trân châu dai bên trong nhân phô mai con bò cười, béo ngậy tan chảy trong miệng.', 15000.00, 'uploads/topping/tc_phomai.jpg', 5),
  (23, 'Bánh croissant vị matcha', 'Lớp vỏ giòn tan, nhân matcha mịn màng, đậm đà.', 85000.00, 'uploads/cake/croissant_matcha.jpg', 6),
  (24, 'Bánh sinh nhật vị dâu', 'Bánh sinh nhật dâu tươi, ngọt ngào và tươi mới.', 205000.00, 'uploads/cake/banh_dau.jpg', 6),
  (25, 'Bánh tart trứng', 'Bánh tart trứng mềm mịn, vỏ giòn, ngọt béo.', 15000.00, 'uploads/cake/tart_egg.jpg', 6);

-- Thêm người dùng mẫu
INSERT INTO account (username, fullname, password, role) VALUES
('admin', 'Administrator', 'hashed_password', 'admin'),
('user', 'Regular User', 'hashed_password', 'user');

SELECT * FROM ACCOUNT;
