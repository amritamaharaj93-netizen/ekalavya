CREATE TABLE IF NOT EXISTS home_banners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    section VARCHAR(50) NOT NULL,
    image VARCHAR(255) NOT NULL,
    link VARCHAR(255) DEFAULT '',
    display_order INT DEFAULT 0,
    status TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO home_banners (section, image, link, display_order, status) VALUES 
('hero', 'home banner1.png', 'scholarship', 1, 1),
('hero', 'home banner4.png', 'course-detail.php?slug=nurture-jee-11', 2, 1),
('hero', 'home banner3.png', 'course-detail.php?slug=seed-jee-9', 3, 1),
('form', 'form image1.png', '', 1, 1),
('form', 'form image2.png', '', 2, 1),
('form', 'form image3.png', '', 3, 1);
