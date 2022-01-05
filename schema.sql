CREATE TABLE users(
    id int PRIMARY KEY AUTO_INCREMENT,
    username varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    wins int(11)  DEFAULT 0,
    losses int(11)  DEFAULT 0,
    loggedIn enum('0','1') DEFAULT '0'
);

CREATE TABLE board(
  round int PRIMARY KEY,
  p1_hand varchar(255),
  p2_hand varchar(255),
  doubles varchar(255)
);

CREATE TABLE game_status(
    status enum('not active','initialized','started','ended','aborded') NOT NULL DEFAULT 'not active',
    p_turn enum('1','2') DEFAULT NULL,
  result enum ('1','2','D') DEFAULT NULL,
  last_change timestamp NULL DEFAULT NULL
);
