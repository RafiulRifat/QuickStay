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
