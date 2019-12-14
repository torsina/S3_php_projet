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
                      permission INTEGER NOT NULL DEFAULT 0,

                      PRIMARY KEY(id)
);

CREATE TABLE sessions (
                          sessionId CHAR(26) NOT NULL,
                          userId CHAR(36) NOT NULL,
                          expireTime DATETIME NOT NULL,

                          PRIMARY KEY(sessionId),
                          FOREIGN KEY(userId) REFERENCES user(id)
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
                          id CHAR(36) NOT NULL, -- size of uuid string
                          userId CHAR(36) NOT NULL, -- size of uuid string
                          travelId CHAR(36) NOT NULL, -- size of uuid string
                          price INTEGER NOT NULL CHECK(price > 0),
                          orderedDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                          PRIMARY KEY(id),
                          FOREIGN KEY(userId) REFERENCES user(id),
                          FOREIGN KEY(travelId) REFERENCES travel(id)
);

INSERT INTO user (id, firstName, lastName, displayName, email, password, permission) VALUES
('f03c4a5a-7954-4f6f-b628-4bc2454e9888', 'foo', 'bar', 'foo bar', 'foo@bar.com', '2ef07ac905d9f5a314495a36e95e3c2a8a3cbeca8b907fe54f848d0a55f84e07218123c329d6fd5556ba257870a977f1319b93c64f80fb4e2fd2e47778e7f6d5', 0),
('c523337c-2c7d-45a3-9e6f-797ca5e5e91c', 'root', 'root', 'I am groot', 'root@root.com', '76c1bf61cb145fa2fa29bd38cd4a123bcac431d44a319b41e573fe4f5b85af8b783f40b528a4165d92c3a9bc65da09d1bf9921c92bfc83c9227d4c96b01c38e4', 10);

INSERT INTO travel (id, ownerId, name, image, description, createdDate, startDate, endDate, price, location, capacity, sold) VALUES
('e0d5e6ff-df7c-4bf8-9fb6-d4a4e212a60f', 'c523337c-2c7d-45a3-9e6f-797ca5e5e91c', 'A title', 'paris_1.jpg', 'A trip to Paris', '2019-10-18 16:41:46', '2019-11-19 16:41:46', '2019-12-19 16:41:46', 250, 'Paris', 100, 5);

INSERT INTO travel (id, ownerId, name, image,description, createdDate, startDate, endDate, price, location, capacity, sold) VALUES
('eafda211-4c89-42c4-94e5-a29c51ed9aa8', 'c523337c-2c7d-45a3-9e6f-797ca5e5e91c', 'B title', 'paris_1.jpg', 'A trip to Paris', '2019-10-18 16:41:46', '2019-11-19 16:41:46', '2019-12-19 16:41:46', 250, 'Paris', 100, 5);

INSERT INTO traveler (id, userId, travelId, price) VALUES
('4d63e465-4a19-485e-b5a5-d7ed3f637723', 'f03c4a5a-7954-4f6f-b628-4bc2454e9888', 'ea4da211-4c89-42c4-94e5-a29c51ed9aa8', 50),
('0e675738-da71-4de1-8cc7-fe53644fcb20', 'c523337c-2c7d-45a3-9e6f-797ca5e5e91c', 'eafda211-4c89-42c4-94e5-a29c51ed9aa8', 150);
