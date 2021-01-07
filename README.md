# Final project for Ramverk1
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Lioo19/ramverk1project/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/Lioo19/ramverk1project/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/Lioo19/ramverk1project/badges/build.png?b=main)](https://scrutinizer-ci.com/g/Lioo19/ramverk1project/build-status/main)
[![CircleCI](https://circleci.com/gh/circleci/circleci-docs.svg?style=svg)](https://circleci.com/gh/Lioo19/ramverk1project)


### About this Project
This project if the final examination in the course "Web based frameworks and design patterns" (Webbaserade Ramverk och designmönster) given at [Blekinge Institute of Technology](https://www.bth.se/eng) during autumn 2020.

If you're curious about the code, you've come to the right place! Basically all code neccessary is located here on github. The project is built on Anax, which is a framework for php, and is created with an sqlite-database.

### Installation

1. Begin by cloning or downloading the project from github.

2. make sure that composer is installed and then run `make install`.

3. To use an SQLite database, you need to run following commands in the root of the project:
```
chmod 777 data
sqlite3 data/db.sqlite #And then a random command before exiting with ctrl-d
chmod 666 data/db.sqlite
```
Then fill the database with the files from `sql/ddl` in the following order:
```
1. sqlite3 data/db.sqlite < sql/ddl/user_sqlite.sql
2. sqlite3 data/db.sqlite < sql/ddl/tags_sqlite.sql
3. sqlite3 data/db.sqlite < sql/ddl/posts_sqlite.sql
4. sqlite3 data/db.sqlite < sql/ddl/comments_sqlite.sql
5. sqlite3 data/db.sqlite < sql/ddl/posttag_sqlite.sql
6. sqlite3 data/db.sqlite < sql/ddl/votes_sqlite.sql
```

4. Don't forget to run `composer install` and `chmod 777 cache/*`.

### Dependency
This is an Anax module and its usage is primarly intended to be together with the Anax framework.

You can install an instance on anax/anax and run this module inside it, to try it out for testing and development.
