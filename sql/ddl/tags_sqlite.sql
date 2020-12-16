--
-- Creating a Tags table.
-- SECOND



--
-- Table Tags
--
DROP TABLE IF EXISTS Tags;
CREATE TABLE Tags (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "tagname" TEXT UNIQUE NOT NULL,
    "count" INTEGER DEFAULT 0
);
