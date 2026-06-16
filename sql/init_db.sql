 CREATE TABLE IF NOT EXISTS `events` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `date_start` DATETIME NOT NULL,
    `date_end` DATETIME NULL,
    `location` VARCHAR(150),
    `format` ENUM('presentiel', 'online', 'hybride') NOT NULL DEFAULT 'online',
    `themes` VARCHAR(255),
    `link` VARCHAR(500),
    `image` VARCHAR(500),
    `organizer` VARCHAR(100),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;