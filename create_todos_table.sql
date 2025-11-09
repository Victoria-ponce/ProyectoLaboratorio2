CREATE DATABASE IF NOT EXISTS `u4_p1_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `u4_p1_db`;

CREATE TABLE `todos` (
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `task` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `completed` TINYINT(1) DEFAULT 0,
    `priority` ENUM('low', 'medium', 'high') DEFAULT 'medium',
    `created_at` DATETIME NOT NULL,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `subtasks` (
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `todo_id` BIGINT NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `completed` TINYINT(1) DEFAULT 0,
    `created_at` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`todo_id`) REFERENCES `todos`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `todos` (`task`, `description`, `priority`, `created_at`) VALUES
('Aprender el framework', 'Estudiar la estructura MVC del proyecto', 'high', NOW()),
('Crear todo list', 'Implementar funcionalidad completa', 'medium', NOW()),
('Documentar código', 'Crear README con flujo de aplicación', 'low', NOW());

INSERT INTO `subtasks` (`todo_id`, `title`, `completed`, `created_at`) VALUES
(1, 'Leer documentación del framework', 1, NOW()),
(1, 'Entender el patrón MVC', 1, NOW()),
(1, 'Probar ejemplos prácticos', 0, NOW()),
(2, 'Crear base de datos', 1, NOW()),
(2, 'Diseñar modelos', 1, NOW()),
(2, 'Crear controladores', 0, NOW()),
(2, 'Diseñar vistas', 0, NOW()),
(3, 'Escribir README', 0, NOW()),
(3, 'Documentar funciones principales', 0, NOW());