#DISCLAIMER
Nobody should run this code on anything close to a production system it is hacked buggy and my first "real" 
website in php. So pardon my mess.


# Installing
- git clone 
- Install lamp stack + the right php extensions.
- Edit php.ini settings for bigger file support
- Edit dbconnection.php with the mysql username data base name and password.
- Go to website.tld/addtable.php It should tell you that it made 2 tables in your db.
- Go to website.tld/addfirstuser.php add your first user here.
- Now you can go to website.tld and login as that user and add entry.

# Description
A simple FAQ-system with categories. These categories
can be divided into subcategories. The entries can be created and be deleted by users.
Entries consist of a question and answer and can contain media, such as a image or a video.
A user has a username and password.



# todo list
- [x] Added a git repo to work in.
- [X] Make a basic system where I can add questions and answers in a database.
- [X] Display those q&a in the website.
- [X] remove questions and answers.
- [X] Make sure we sanitize those answers and questions on scripting an mysql queries (NO NASTY SHIT ON MY WATCH)
- [X] Add categories to the database and to the qa
- [X] Sort Q & A by categories and use harmonica menus
- [X] Adding users and the Hashed (maybe also salted) passwords to the database
- [X] Login system where only logged in users can edit, add, delete the questions or the users
- [X] Make sure we cant do "evil" stuff with the login system.
- [X] Add upload function to the website for media and a way to link those to the questions and show them in there.
- [X] Documentation and code comments.
- [ ] Refactor the code.
- [ ] We should present a nice install script.(maybe docker container, linux packages or something else)
