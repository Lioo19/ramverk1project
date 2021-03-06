--
-- Creating a User table.
-- use command
-- sqlite3 data/db.sqlite < sql/ddl/user_sqlite.sql
-- FIRST



--
-- Table User
--
DROP TABLE IF EXISTS User;
CREATE TABLE User (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "username" TEXT UNIQUE NOT NULL,
    "email" TEXT UNIQUE NOT NULL,
    "password" TEXT NOT NULL,
    "created" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    "info" TEXT,
    "reputation" INT DEFAULT 0,
    "votes" INT DEFAULT 0
);
