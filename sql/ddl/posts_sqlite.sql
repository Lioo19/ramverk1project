--
-- Creating a Posts table.
-- THIRD



--
-- Table Posts
--
DROP TABLE IF EXISTS Posts;
CREATE TABLE Posts (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "title" TEXT UNIQUE NOT NULL,
    "body" TEXT NOT NULL,
    "created" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    "deleted" TIMESTAMP,
    "tags" TEXT,
    "ownerid" INTEGER,
    "ownerusername" TEXT,
    "parentid" INTEGER,
    "acceptedanswer" TEXT,
    FOREIGN KEY ("ownerid") REFERENCES "User"("id")
);
