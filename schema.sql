CREATE TABLE users(
    id int PRIMARY KEY AUTO_INCREMENT,
    username varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    wins int(11)  DEFAULT 0,
    losses int(11)  DEFAULT 0
);

CREATE TABLE deck(
    title varchar(3)
);

INSERT INTO deck(title) VALUES ('AC'), ('AD'), ('AH'), ('AS'), ('2C'), ('2D'), ('2H'), ('2S'), ('3C'), ('3D'), ('3H'), ('3S'), ('4C'), ('4D'), ('4H'), ('4S'), ('5C'), ('5D'), ('5H'), ('5S'), ('6C'), ('6D'), ('6H'), ('6S'), ('7C'), ('7D'), ('7H'), ('7S'), ('8C'), ('8D'), ('8H'), ('8S'), ('9C'), ('9D'), ('9H'), ('9S'), ('10C'), ('10D'), ('10H'), ('10S'), ('KS'); 

