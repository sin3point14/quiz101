# quizlol
A php based quizzing web app

place contents in a folder called quizlol in the root directory of server
run thte following sql commands- 
```
create table users (uid integer, username varchar(50), pass varchar(255), display varchar(50), points integer);
create table ques (qid integer, title varchar(255),q varchar(255),o1 varchar(255),o2 varchar(255),o3 varchar(255),o4 varchar(255),answer integer,points integer);
create table answered (uid integer, qid integer,points integer, status integer);
```
Create an account with username admin to get admin priviliges
