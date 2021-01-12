--
-- Creating a Votes table.
-- use command
-- sqlite3 data/db.sqlite < sql/ddl/votes_sqlite.sql
-- SIXTH


--
-- Table Votes
--
DROP TABLE IF EXISTS Votes;
CREATE TABLE Votes (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "userid" INTEGER NOT NULL,
    "postid" INTEGER,
    "commentid" INTEGER,
    "count" INTEGER DEFAULT 0,
    FOREIGN KEY ("postid") REFERENCES "Posts"("id"),
    FOREIGN KEY ("commentid") REFERENCES "Comments"("id"),
    FOREIGN KEY ("userid") REFERENCES "User"("id")
);
