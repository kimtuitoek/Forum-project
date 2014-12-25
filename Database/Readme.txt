The schema in this folder can be used to create a test database for use with our website. You should run the additional query bellow to prepare the site for use. After that you may want to use the sample query provided to set your user as an admin after you have created your database.

Mandatory forum creation query

INSERT 	INTO	Topic (	Name,
        				Creator_id,
						Date) 
		VALUES(	'Forum'
				(Your user id),
				NOW());


User promotion query

UPDATE	User
SET		Priviledge = 2
WHERE	User_id = (Your user id);


You could also create your sample database by ussing mysql's reverse enginering feature. The database in question can be found at 
$username = "eric"; 
$password = "root"; 
$host = "75.155.72.50:4000"; 