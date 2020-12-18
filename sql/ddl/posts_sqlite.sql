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
    "ownerid" INTEGER NOT NULL,
    "ownerusername" TEXT NOT NULL,
    "parentid" INTEGER DEFAULT NULL,
    "acceptedanswer" TEXT DEFAULT NULL,
    FOREIGN KEY ("ownerid") REFERENCES "User"("id"),
    FOREIGN KEY ("ownerusername") REFERENCES "User"("username")
);
