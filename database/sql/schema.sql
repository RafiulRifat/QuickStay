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

