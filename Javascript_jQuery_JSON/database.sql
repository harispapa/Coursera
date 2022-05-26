CREATE DATABASE misc;
USE misc;

CREATE TABLE users (
    user_id INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(128),
    email VARCHAR(128),
    password VARCHAR(128),
PRIMARY KEY(user_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE users ADD INDEX(email);
ALTER TABLE users ADD INDEX(password);

INSERT INTO users (name,email,password)
VALUES ('UMSI','umsi@umich.edu','1a52e17fa899cf40fb04cfc42e6352f1');

CREATE TABLE Profile (
    profile_id INTEGER NOT NULL AUTO_INCREMENT,
    user_id INTEGER NOT NULL,
    first_name TEXT,
    last_name TEXT,
    email TEXT,
    headline TEXT,
    summary TEXT,
    PRIMARY KEY(profile_id),
    CONSTRAINT profile_ibfk_2 FOREIGN KEY (user_id)
    REFERENCES users (user_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE Position (
     position_id INTEGER NOT NULL AUTO_INCREMENT,
     profile_id INTEGER,
    `rank` INTEGER,
    year INTEGER,
    description TEXT,
    PRIMARY KEY (position_id),
    CONSTRAINT position_ibfk_1 FOREIGN KEY (profile_id)
    REFERENCES Profile (profile_id)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


