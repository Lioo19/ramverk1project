--
-- Creating a Tags table.
-- sqlite3 data/db.sqlite < sql/ddl/tags_sqlite.sql
-- SECOND



--
-- Table Tags
--
DROP TABLE IF EXISTS Tags;
CREATE TABLE Tags (
    "id" INTEGER PRIMARY KEY NOT NULL ,
    "tagname" TEXT UNIQUE NOT NULL,
    "count" INTEGER DEFAULT 1
);
