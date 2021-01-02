--
-- Creating a Posttags table.
-- FIFTH



--
-- Table Posttags
--
DROP TABLE IF EXISTS Posttags;
CREATE TABLE Posttags (
    "id" INTEGER PRIMARY KEY NOT NULL, -- is this really neccessary? And if so, c/should it be auto? 
    "postid" INTEGER NOT NULL, -- maps to id of Post-table
    "tagid" INTEGER NOT NULL, -- maps to id of Tags-table
    FOREIGN KEY("postid") REFERENCES "Posts"("id"),
    FOREIGN KEY("tagid") REFERENCES "Tags"("id")
);
