CREATE DATABASE `mvcify`;

CREATE TABLE `mvcify`.`user` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `mvcify`.`user` (`id`, `name`, `location`, `email`) VALUES
(2, 'Bhushan', 'Mumbai', 'bhushan@example.com'),
(4, 'Kavyan', 'Delhi', 'kavyan@example.com');
