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
    -desc
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
    id SERIAL,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    displayName VARCHAR(100) NULL,
    email VARCHAR(50) NOT NULL,
    password CHAR(64) NOT NULL,
    permission INTEGER,

    PRIMARY KEY(id)
);

CREATE TABLE travel (
    id SERIAL,
    ownerId INTEGER NOT NULL,
    desc VARCHAR(500) DEFAULT '',
    createdDate DATE DEFAULT CURRENT_DATE,
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
    userId INTEGER NOT NULL,
    travelId INTEGER NOT NULL,
    price INTEGER NOT NULL CHECK(price > 0),
    orderedDate DATE DEFAULT CURRENT_DATE,

    FOREIGN KEY(userId) REFERENCES user(id),
    FOREIGN KEY(travelId) REFERENCES travel(id)
);