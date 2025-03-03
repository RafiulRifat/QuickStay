CREATE TABLE `users` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
    `password` VARCHAR(255) NOT NULL,
    `photo` VARCHAR(255) DEFAULT NULL,
    `phone` VARCHAR(255) DEFAULT NULL,
    `address` TEXT DEFAULT NULL,
    `role` ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    `remember_token` VARCHAR(100) DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


INSERT INTO users (name, email, password, role, status) VALUES 
('Admin', 'admin@gmail.com', '$2y$10$avQex.zXqq.6HGMNzSbO1OoeKjPZXXFzzSjZlI9zQNrpyhS4Wrpoy', 'admin', 'active'),
('User', 'user@gmail.com', '$2y$10$avQex.zXqq.6HGMNzSbO1OoeKjPZXXFzzSjZlI9zQNrpyhS4Wrpoy', 'user', 'active');







CREATE TABLE `password_reset_tokens` (
    `email` VARCHAR(255) NOT NULL PRIMARY KEY,
    `token` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL
);


CREATE TABLE `failed_jobs` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `uuid` VARCHAR(255) NOT NULL UNIQUE,
    `connection` TEXT NOT NULL,
    `queue` TEXT NOT NULL,
    `payload` LONGTEXT NOT NULL,
    `exception` LONGTEXT NOT NULL,
    `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE `personal_access_tokens` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `tokenable_id` BIGINT UNSIGNED NOT NULL,
    `tokenable_type` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `token` VARCHAR(64) NOT NULL UNIQUE,
    `abilities` TEXT DEFAULT NULL,
    `last_used_at` TIMESTAMP NULL DEFAULT NULL,
    `expires_at` TIMESTAMP NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `tokenable_index` (`tokenable_id`, `tokenable_type`)
);

CREATE TABLE teams (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    facebook VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- Insert sample data for `teams`
INSERT INTO teams (name, position, facebook, image) VALUES
('John Doe', 'Manager', 'https://facebook.com/johndoe', 'upload/team/johndoe.jpg'),
('Jane Smith', 'Assistant Manager', 'https://facebook.com/janesmith', 'upload/team/janesmith.jpg');


CREATE TABLE book_areas (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255) DEFAULT NULL,
    short_title VARCHAR(255) DEFAULT NULL,
    main_title VARCHAR(255) DEFAULT NULL,
    short_desc TEXT DEFAULT NULL,
    link_url VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- Insert sample data for `book_areas`
INSERT INTO book_areas (short_title, main_title, short_desc, link_url, image) VALUES
('Exclusive Offers', 'Book Your Stay Now', 'Get the best deals on premium rooms.', 'https://example.com/book', 'upload/bookarea/offer.jpg');


CREATE TABLE room_types (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);













-- Create Rooms Table
CREATE TABLE rooms (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    roomtype_id INT NOT NULL,
    total_adult VARCHAR(255) NULL,
    total_child VARCHAR(255) NULL,
    room_capacity VARCHAR(255) NULL,
    image VARCHAR(255) NULL,
    price VARCHAR(255) NULL,
    size VARCHAR(255) NULL,
    view VARCHAR(255) NULL,
    bed_style VARCHAR(255) NULL,
    discount INT DEFAULT 0,
    short_desc TEXT NULL,
    description TEXT NULL,
    status INT DEFAULT 0,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);


-- Create Facilities Table
CREATE TABLE facilities (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    rooms_id INT NOT NULL,
    facility_name VARCHAR(255) NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);


-- Create MultiImage Table
CREATE TABLE multi_images (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    rooms_id INT NOT NULL,
    multi_img VARCHAR(255) NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);


-- Get the last inserted ID
SET @roomtype_id = LAST_INSERT_ID();

-- Insert into rooms table using the fetched roomtype_id
INSERT INTO rooms (roomtype_id) 
VALUES (@roomtype_id);



-- Fetch Room Details for Editing
SELECT * FROM facilities WHERE rooms_id = ?;
SELECT * FROM multi_images WHERE rooms_id = ?;
SELECT * FROM rooms WHERE id = ?;


-- Fetch Room Details for Editing

UPDATE rooms 
SET 
    roomtype_id = ?, 
    total_adult = ?, 
    total_child = ?, 
    room_capacity = ?, 
    price = ?, 
    size = ?, 
    view = ?, 
    bed_style = ?, 
    discount = ?, 
    short_desc = ?, 
    description = ?, 
    image = ?
WHERE id = ?;


-- Update Facilities
--(Delete Existing Facilities

DELETE FROM facilities WHERE rooms_id = ?;


--(Insert New Facilities)

INSERT INTO facilities (rooms_id, facility_name) VALUES (?, ?);

--Update Multi-Images
-- (Delete Existing Images)

SELECT * FROM multi_images WHERE rooms_id = ?;
DELETE FROM multi_images WHERE rooms_id = ?;

-- (Insert New Images)
INSERT INTO multi_images (rooms_id, multi_img) VALUES (?, ?);


--Delete a Multi-Image
SELECT * FROM multi_images WHERE id = ?;
DELETE FROM multi_images WHERE id = ?;

--Delete Room
--(Delete Main Image & Sub-Images)

SELECT * FROM rooms WHERE id = ?;
SELECT * FROM multi_images WHERE rooms_id = ?;
DELETE FROM room_types WHERE id = ?;
DELETE FROM multi_images WHERE rooms_id = ?;
DELETE FROM facilities WHERE rooms_id = ?;
DELETE FROM rooms WHERE id = ?;
















