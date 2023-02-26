CREATE DATABASE `candy`;

CREATE TABLE `candy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(45) NOT NULL DEFAULT 'plush',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(45) NOT NULL DEFAULT 'customer',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(255) NOT NULL,
  `itemid` int(11) NOT NULL,
  `dateordered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `price` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `candy`.`candy` (`name`,`price`,`image`,`quantity`,`description`,`category`) VALUES ('Minnie Plush', '29.99', 'minnie.jpg', '1', 'Nullam mollis felis dolor, eget lobortis lacus eleifend ut. Morbi condimentum ligula nec nisl tristique, vitae accumsan nisi auctor. Aliquam est justo, consequat ullamcorper pulvinar nec, sagittis id odio. Morbi auctor vitae ante vitae bibendum.','plush');
INSERT INTO `candy`.`candy` (`name`,`price`,`image`,`quantity`,`description`,`category`) VALUES ('Mickey Plush', '29.99', 'mickey.jpg', '2', 'Nullam mollis felis dolor, eget lobortis lacus eleifend ut. Morbi condimentum ligula nec nisl tristique, vitae accumsan nisi auctor. Aliquam est justo, consequat ullamcorper pulvinar nec, sagittis id odio. Morbi auctor vitae ante vitae bibendum.','plush');
INSERT INTO `candy`.`candy` (`name`,`price`,`image`,`quantity`,`description`,`category`) VALUES ('Eevee Plush', '19.99', 'eevee.jpg', '3', 'Nullam mollis felis dolor, eget lobortis lacus eleifend ut. Morbi condimentum ligula nec nisl tristique, vitae accumsan nisi auctor. Aliquam est justo, consequat ullamcorper pulvinar nec, sagittis id odio. Morbi auctor vitae ante vitae bibendum.','candy');
INSERT INTO `candy`.`candy` (`name`,`price`,`image`,`quantity`,`description`,`category`) VALUES ('Plush Bundle', '59.99', 'bundle.jpg', '4', 'Nullam mollis felis dolor, eget lobortis lacus eleifend ut. Morbi condimentum ligula nec nisl tristique, vitae accumsan nisi auctor. Aliquam est justo, consequat ullamcorper pulvinar nec, sagittis id odio. Morbi auctor vitae ante vitae bibendum.','candy');
INSERT INTO `candy`.`candy` (`name`,`price`,`image`,`quantity`,`description`,`category`) VALUES ('Pikachu Plush', '24.99', 'pikachu.jpg', '5', 'Nullam mollis felis dolor, eget lobortis lacus eleifend ut. Morbi condimentum ligula nec nisl tristique, vitae accumsan nisi auctor. Aliquam est justo, consequat ullamcorper pulvinar nec, sagittis id odio. Morbi auctor vitae ante vitae bibendum.','toy');
INSERT INTO `candy`.`candy` (`name`,`price`,`image`,`quantity`,`description`,`category`) VALUES ('Pokemon Plush', '24.99', 'pokemon.jpg', '6', 'Nullam mollis felis dolor, eget lobortis lacus eleifend ut. Morbi condimentum ligula nec nisl tristique, vitae accumsan nisi auctor. Aliquam est justo, consequat ullamcorper pulvinar nec, sagittis id odio. Morbi auctor vitae ante vitae bibendum.','plush');

