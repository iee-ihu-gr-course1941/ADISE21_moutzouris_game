CREATE TABLE users(
    id int PRIMARY KEY AUTO_INCREMENT,
    username varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    wins int(11)  DEFAULT 0,
    losses int(11)  DEFAULT 0,
    loggedIn enum('0','1') DEFAULT '0'
);

CREATE TABLE `board` (
   `game_id` INT NOT NULL AUTO_INCREMENT , 
   `p1_hand` varchar(255) DEFAULT NULL , 
   `p1_id` INT DEFAULT NULL , 
   `p2_hand` varchar(255) DEFAULT NULL , 
   `p2_id` INT DEFAULT NULL , 
   `result` INT DEFAULT NULL , 
   PRIMARY KEY (`game_id`)) ENGINE = InnoDB;  

