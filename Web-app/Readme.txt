The contents of this folder should be dropped directly into the root of the testers’ server. The user should then open the file common and set it as appropriate for their test case. This involves setting the location of the test database and its login credentials. The sample bellow is to be used with our test database

common.php test database settintgs
$username = "eric"; 
$password = "root"; 
$host = "75.155.72.50:4000"; 
$dbname = "cpsc471project";

To access the test site prepared for you enter the following into you browser. You will obviously need port 8080 open.

75.155.72.50:8080

This should automatically forward you to the index of our site. If not you may attempt.

75.155.72.50:8080/index.php

For our test server you can use the credentials

user:thewafflehouse@gmail.com
pass:neo

for admin access