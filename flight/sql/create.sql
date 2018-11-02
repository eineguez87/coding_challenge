CREATE DATABASE `coding_challenge1`;

CREATE TABLE `comments` (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(255) NOT NULL,
  comment text NOT NULL,
  parent_id int(11) DEFAULT NULL,
  inserted timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);