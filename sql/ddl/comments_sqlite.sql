--
-- Creating a Comments table.
-- FOURTH



--
-- Table Comments
--
DROP TABLE IF EXISTS Comments;
CREATE TABLE Comments (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "postid" INTEGER NOT NULL,
    "score" INTEGER,
    "body" TEXT NOT NULL,
    "created" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    "deleted" TIMESTAMP,
    "username" TEXT,
    "userid" INT DEFAULT 0,
    FOREIGN KEY ("postid") REFERENCES "Posts"("id")
);
