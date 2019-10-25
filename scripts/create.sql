/**
user:
    -id
    -first name
    -last name
    -display name
    -email
    -password
    -permission
travel:
    -id
    -ownerId
    -description
    -createdDate
    -startDate
    -endDate
    -price
    -location
    -capacity
    -sold
traveler:
    -userId
    -travelId
    -
    -date
 */
DROP DATABASE IF EXISTS website;
CREATE DATABASE website CHARACTER SET utf8 COLLATE utf8_general_ci;

USE website;

CREATE TABLE user (
    id CHAR(36) NOT NULL, -- size of uuid string
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    displayName VARCHAR(100) NULL,
    email VARCHAR(50) NOT NULL,
    password CHAR(128) NOT NULL, -- size of sha512 hash
    permission INTEGER,

    PRIMARY KEY(id)
);

CREATE TABLE travel (
    id CHAR(36) NOT NULL, -- size of uuid string
    ownerId CHAR(36) NOT NULL, -- size of uuid string
    name VARCHAR(50) NOT NULL,
    image VARCHAR(50) NOT NULL,
    description VARCHAR(500) DEFAULT '',
    createdDate DATETIME NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL,
    price INTEGER NOT NULL,
    location VARCHAR(100) NOT NULL,
    capacity INTEGER NOT NULL,
    sold INTEGER DEFAULT 0,

    PRIMARY KEY(id),
    FOREIGN KEY(ownerId) REFERENCES user(id)
);

CREATE TABLE traveler (
    userId CHAR(36) NOT NULL, -- size of uuid string
    travelId CHAR(36) NOT NULL, -- size of uuid string
    price INTEGER NOT NULL CHECK(price > 0),
    orderedDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY(userId) REFERENCES user(id),
    FOREIGN KEY(travelId) REFERENCES travel(id)
);

INSERT INTO user (id, firstName, lastName, displayName, email, password, permission) VALUES
('f03c4a5a-7954-4f6f-b628-4bc2454e9888', 'foo', 'bar', 'foo bar', 'foo@bar.com', '309ecc489c12d6eb4cc40f50c902f2b4d0ed77ee511a7c7a9bcd3ca86d4cd86f989dd35bc5ff499670da34255b45b0cfd830e81f605dcf7dc5542e93ae9cd76f', 2);

INSERT INTO travel (id, ownerId, name, image, description, createdDate, startDate, endDate, price, location, capacity, sold) VALUES
('ea4da211-4c89-42c4-94e5-a29c51ed9aa8', 'f03c4a5a-7954-4f6f-b628-4bc2454e9888', 'A title', 'paris_1.jpg', 'A trip to Paris', '2019-10-18 16:41:46', '2019-11-19 16:41:46', '2019-12-19 16:41:46', 250, 'Paris', 100, 5);

INSERT INTO travel (id, ownerId, description, createdDate, startDate, endDate, price, location, capacity, sold) VALUES
('eafda211-4c89-42c4-94e5-a29c51ed9aa8', 'f03c4a5a-7954-4f6f-b628-4bc2454e9888', 'B title', 'paris_1.jpg', 'A trip to Paris', '2019-10-18 16:41:46', '2019-11-19 16:41:46', '2019-12-19 16:41:46', 250, 'Paris', 100, 5);