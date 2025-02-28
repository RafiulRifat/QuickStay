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

-- Insert into room_types table and get the last inserted ID
INSERT INTO room_types (name, created_at) 
VALUES ('Your Room Type Name', NOW());

-- Get the last inserted ID
SET @roomtype_id = LAST_INSERT_ID();

-- Insert into rooms table using the fetched roomtype_id
INSERT INTO rooms (roomtype_id) 
VALUES (@roomtype_id);





-- Fetch all rooms linked to a specific room type
SELECT r.*, rt.name AS roomtype_name, 
       CASE 
           WHEN r.image IS NOT NULL THEN CONCAT('upload/roomimg/', r.image)
           ELSE 'upload/no_image.jpg' 
       END AS image_path
FROM rooms r
JOIN room_types rt ON r.roomtype_id = rt.id
WHERE r.roomtype_id = 1; -- Change '1' to your desired roomtype_id
