--
-- Creating a Votes table.
-- SECOND



--
-- Table Votes
--
DROP TABLE IF EXISTS Votes;
CREATE TABLE Votes (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "postid" INTEGER UNIQUE NOT NULL,
    "userid" INTEGER NOT NULL,
    "count" INTEGER DEFAULT 0,
    FOREIGN KEY ("postid") REFERENCES "Posts"("id"),
    FOREIGN KEY ("userid") REFERENCES "User"("id")
);
