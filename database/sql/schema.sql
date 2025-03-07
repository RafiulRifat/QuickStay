-- ================= UpDate BOOk Area Table =================
CREATE TABLE `book_areas` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `image` VARCHAR(255) NULL,
    `short_title` VARCHAR(255) NULL,
    `main_title` VARCHAR(255) NULL,
    `short_desc` TEXT NULL,
    `link_url` VARCHAR(255) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);



-- ================= Insert Data =================
INSERT INTO `book_areas` 
(`short_title`, `main_title`, `short_desc`, `link_url`, `image`, `created_at`, `updated_at`) 
VALUES 
('Example Short Title', 'Example Main Title', 'This is a short description of the book area.', 'http://example.com', 'image/path/to/image.jpg', NOW(), NOW());




-- ================= Update Data =================
UPDATE `book_areas`
SET 
    `short_title` = 'Updated Short Title',
    `main_title` = 'Updated Main Title',
    `short_desc` = 'Updated description of the book area.',
    `link_url` = 'http://updatedlink.com',
    `image` = 'new/image/path.jpg',
    `updated_at` = NOW()
WHERE `id` = 1;


INSERT INTO users (name, email, password, role, status) VALUES 
('Admin', 'admin@gmail.com', '$2y$10$avQex.zXqq.6HGMNzSbO1OoeKjPZXXFzzSjZlI9zQNrpyhS4Wrpoy', 'admin', 'active'),
('User', 'user@gmail.com', '$2y$10$avQex.zXqq.6HGMNzSbO1OoeKjPZXXFzzSjZlI9zQNrpyhS4Wrpoy', 'user', 'active');






CREATE TABLE teams (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    facebook VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);



-- Insert sample data for teams
INSERT INTO teams (name, position, facebook, image) VALUES
('John Doe', 'Manager', 'https://facebook.com/johndoe', 'upload/team/johndoe.jpg'),
('Jane Smith', 'Assistant Manager', 'https://facebook.com/janesmith', 'upload/team/janesmith.jpg');








CREATE TABLE password_reset_tokens (
    email VARCHAR(255) NOT NULL PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL
);




CREATE TABLE personal_access_tokens (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tokenable_id BIGINT UNSIGNED NOT NULL,
    tokenable_type VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    token VARCHAR(64) NOT NULL UNIQUE,
    abilities TEXT DEFAULT NULL,
    last_used_at TIMESTAMP NULL DEFAULT NULL,
    expires_at TIMESTAMP NULL DEFAULT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX tokenable_index (tokenable_id, tokenable_type)
);




CREATE TABLE bookings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    rooms_id INT NULL,
    user_id INT NULL,
    check_in VARCHAR(255) NULL,
    check_out VARCHAR(255) NULL,
    persion VARCHAR(255) NULL,
    number_of_rooms VARCHAR(255) NULL,
    
    total_night FLOAT DEFAULT 0,
    actual_price FLOAT DEFAULT 0,
    subtotal FLOAT DEFAULT 0,
    discount INT DEFAULT 0,
    total_price FLOAT DEFAULT 0,

    payment_method VARCHAR(255) NULL,
    transation_id VARCHAR(255) NULL,
    payment_status VARCHAR(255) NULL,

    name VARCHAR(255) NULL,
    email VARCHAR(255) NULL,
    phone VARCHAR(255) NULL,
    country VARCHAR(255) NULL,
    state VARCHAR(255) NULL,
    zip_code VARCHAR(255) NULL,
    address VARCHAR(255) NULL,

    code VARCHAR(255) NULL,
    status INT DEFAULT 1,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);


CREATE TABLE room_booked_dates (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NULL,
    room_id INT NULL,
    book_date DATE NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);



CREATE TABLE booking_room_lists (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NULL,
    room_id INT NULL,
    room_number_id INT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);







-- ================= CHECK IF ROOM EXISTS =================
SELECT * FROM rooms WHERE id = {id};

-- ================= UPDATE ROOM DETAILS =================
UPDATE rooms 
SET 
    roomtype_id = {roomtype_id},
    total_adult = {total_adult},
    total_child = {total_child},
    room_capacity = {room_capacity},
    price = {price},
    size = '{size}',
    view = '{view}',
    bed_style = '{bed_style}',
    discount = {discount},
    short_desc = '{short_desc}',
    description = '{description}'
WHERE id = {id};

-- ================= UPDATE ROOM IMAGE IF UPLOADED =================
UPDATE rooms 
SET image = '{image_filename}'
WHERE id = {id} AND '{image_filename}' IS NOT NULL;

-- ================= DELETE EXISTING FACILITIES FOR THE ROOM =================
DELETE FROM facilities WHERE rooms_id = {id};

-- ================= INSERT NEW FACILITIES =================
INSERT INTO facilities (rooms_id, facility_name)
VALUES 
    ({id}, '{facility_name_1}'),
    ({id}, '{facility_name_2}'),
    ({id}, '{facility_name_3}');
-- Repeat for all provided facility names

-- ================= DELETE OLD MULTI-IMAGES FOR THE ROOM =================
DELETE FROM multi_images WHERE rooms_id = {id};

-- ================= INSERT NEW MULTI-IMAGES =================
INSERT INTO multi_images (rooms_id, multi_img)
VALUES 
    ({id}, '{multi_img_1}'),
    ({id}, '{multi_img_2}'),
    ({id}, '{multi_img_3}');
-- Repeat for all uploaded images

-- ================= RETRIEVE ROOM WITH FACILITIES & IMAGES =================
SELECT 
    r.id AS room_id, 
    r.roomtype_id, 
    r.total_adult, 
    r.total_child, 
    r.room_capacity, 
    r.price, 
    r.size, 
    r.view, 
    r.bed_style, 
    r.discount, 
    r.short_desc, 
    r.description, 
    r.image AS room_image, 
    COALESCE(GROUP_CONCAT(DISTINCT f.facility_name SEPARATOR ', '), '') AS facilities, 
    COALESCE(GROUP_CONCAT(DISTINCT m.multi_img SEPARATOR ', '), '') AS multi_images
FROM rooms r
LEFT JOIN facilities f ON r.id = f.rooms_id
LEFT JOIN multi_images m ON r.id = m.rooms_id
WHERE r.id = {id}
GROUP BY r.id, r.roomtype_id, r.total_adult, r.total_child, r.room_capacity, r.price, 
         r.size, r.view, r.bed_style, r.discount, r.short_desc, r.description, r.image;

-- ================= TRIGGER TO AUTO-DELETE RELATED DATA WHEN ROOM IS DELETED =================
DELIMITER //
CREATE TRIGGER delete_room_related_data
BEFORE DELETE ON rooms
FOR EACH ROW
BEGIN
    DELETE FROM facilities WHERE rooms_id = OLD.id;
    DELETE FROM multi_images WHERE rooms_id = OLD.id;
END;
//
DELIMITER ;

-- ================= TRIGGER TO AUTO-INSERT DEFAULT FACILITIES WHEN A ROOM IS CREATED =================
DELIMITER //
CREATE TRIGGER insert_default_facilities
AFTER INSERT ON rooms
FOR EACH ROW
BEGIN
    INSERT INTO facilities (rooms_id, facility_name) 
    VALUES 
    (NEW.id, 'Complimentary Breakfast'),
    (NEW.id, 'Free Wi-Fi'),
    (NEW.id, 'Safety Box');
END;
//
DELIMITER ;

-- ================= TRIGGER TO UPDATE MULTI-IMAGES IF ROOM IMAGE CHANGES =================
DELIMITER //
CREATE TRIGGER update_multi_images
AFTER UPDATE ON rooms
FOR EACH ROW
BEGIN
    IF OLD.image <> NEW.image THEN
        UPDATE multi_images 
        SET multi_img = CONCAT('updated_', multi_img) 
        WHERE rooms_id = NEW.id;
    END IF;
END;
//
DELIMITER ;