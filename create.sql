#create rental_cars database

CREATE DATABASE rental_cars CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE rental_cars;

-- START OF CREATING TABLE SECTION --

CREATE TABLE authorisation(
	authorisation_id INT NOT NULL,
	authorisation_type VARCHAR(20) NOT NULL,
	PRIMARY KEY ( authorisation_id )

);

CREATE TABLE user(
	user_id INT NOT NULL,
   	username VARCHAR(100) NOT NULL,
   	password VARCHAR(100) NOT NULL,
   	mail_address VARCHAR(150) NOT NULL,
   	first_name VARCHAR(50) NOT NULL,
   	last_name VARCHAR(50) NOT NULL,
   	authorisation_id INT NOT NULL,
    PRIMARY KEY ( user_id ),
    FOREIGN KEY ( authorisation_id ) REFERENCES authorisation( authorisation_id )
);

CREATE TABLE city(
	city_id INT NOT NULL,
	name VARCHAR(50) NOT NULL,
	PRIMARY KEY ( city_id )
);

CREATE TABLE branch(
	branch_id INT NOT NULL,
	city_id INT NOT NULL,
	name VARCHAR(100) NOT NULL,
	phone VARCHAR(20) NOT NULL,
	address VARCHAR(150) NOT NULL,
	PRIMARY KEY ( branch_id ),
	FOREIGN KEY ( city_id ) REFERENCES city( city_id )
);

CREATE TABLE system_manager(
	user_id INT NOT NULL,
	PRIMARY KEY ( user_id ),
	FOREIGN KEY ( user_id ) REFERENCES user( user_id )
);

CREATE TABLE city_manager(
	user_id INT NOT NULL,
	city_id INT NOT NULL,
	PRIMARY KEY ( user_id ),
	FOREIGN KEY ( user_id ) REFERENCES user( user_id ),
	FOREIGN KEY ( city_id ) REFERENCES city( city_id )
);

CREATE TABLE branch_manager(
	user_id INT NOT NULL,
	branch_id INT NOT NULL,
	PRIMARY KEY ( user_id ),
	FOREIGN KEY ( user_id ) REFERENCES user( user_id ),
	FOREIGN KEY ( branch_id ) REFERENCES branch( branch_id )
);

CREATE TABLE customer(
	user_id INT NOT NULL,
	phone VARCHAR(20) NOT NULL,
	age INT NOT NULL,
	address VARCHAR(100),
	balance INT NOT NULL,
	PRIMARY KEY ( user_id ),
	FOREIGN KEY ( user_id ) REFERENCES user( user_id )
);

CREATE TABLE car_technical_specification(
	car_technical_specification_id INT NOT NULL,
	technical_specification VARCHAR(50) NOT NULL,
	PRIMARY KEY ( car_technical_specification_id )
);

CREATE TABLE car_official_website(
	car_official_website_id INT NOT NULL,
	url VARCHAR(255) NOT NULL,
	PRIMARY KEY ( car_official_website_id )
);

CREATE TABLE car_model(
	car_model_id INT NOT NULL,
	car_official_website_id INT NOT NULL,
	brand_name VARCHAR(50) NOT NULL,
	model_name VARCHAR(50) NOT NULL,
	model_year INT,
	PRIMARY KEY ( car_model_id ),
	FOREIGN KEY ( car_official_website_id ) REFERENCES car_official_website( car_official_website_id )
);

CREATE TABLE car_type(
	car_type_id INT NOT NULL,
	type_name VARCHAR(50) NOT NULL,
	seat_number INT,
	PRIMARY KEY ( car_type_id )
);

CREATE TABLE car_fuel(
	car_fuel_id INT NOT NULL,
	fuel_type VARCHAR(50) NOT NULL,
	average_fuel FLOAT,
	PRIMARY KEY (car_fuel_id )
);

CREATE TABLE price_information(
	price_information_id INT NOT NULL,
	daily_price INT NOT NULL,
	weekly_price INT,
	PRIMARY KEY ( price_information_id )
);

CREATE TABLE car_gear(
	car_gear_id INT NOT NULL,
	gear_type VARCHAR(50) NOT NULL,
	gear_number INT NOT NULL,
	PRIMARY KEY ( car_gear_id )
);

CREATE TABLE car(
	car_id INT NOT NULL,
	car_model_id INT NOT NULL,
	car_type_id INT NOT NULL,
	car_fuel_id INT NOT NULL,
	price_information_id INT NOT NULL,
	branch_id INT NOT NULL,
	car_gear_id INT NOT NULL,
	color VARCHAR(30) NOT NULL,
	about VARCHAR(500) NOT NULL,
	PRIMARY KEY ( car_id ),
	FOREIGN KEY ( car_model_id ) REFERENCES car_model( car_model_id ),
	FOREIGN KEY ( car_type_id ) REFERENCES car_type( car_type_id ),
	FOREIGN KEY ( car_fuel_id ) REFERENCES car_fuel( car_fuel_id ),
	FOREIGN KEY ( price_information_id ) REFERENCES price_information( price_information_id ),
	FOREIGN KEY ( branch_id ) REFERENCES branch( branch_id ),
	FOREIGN KEY ( car_gear_id ) REFERENCES car_gear( car_gear_id )
);

CREATE TABLE car_has_car_technical_specification(
	car_id INT NOT NULL,
	car_technical_specification_id INT NOT NULL,
	PRIMARY KEY ( car_id, car_technical_specification_id ),
	FOREIGN KEY ( car_id ) REFERENCES car( car_id ),
	FOREIGN KEY ( car_technical_specification_id ) REFERENCES car_technical_specification( car_technical_specification_id )
);

CREATE TABLE rented_car(
	rented_car_id INT NOT NULL,
	car_id INT NOT NULL,
	user_id INT NOT NULL,
	start_date VARCHAR(50) NOT NULL,
	end_date VARCHAR(50) NOT NULL,
	PRIMARY KEY ( rented_car_id ),
	FOREIGN KEY ( car_id ) REFERENCES car( car_id ),
	FOREIGN KEY ( user_id ) REFERENCES customer( user_id )
);

CREATE TABLE car_photo(
	car_photo_id INT NOT NULL,
	car_id INT NOT NULL,
	url VARCHAR(300),
	PRIMARY KEY ( car_photo_id ),
	FOREIGN KEY ( car_id ) REFERENCES car( car_id )
);

CREATE TABLE last_10_login(
	last_10_login_id INT NOT NULL,
	user_id INT NOT NULL,
	login_date VARCHAR(100),
	PRIMARY KEY ( last_10_login_id ),
	FOREIGN KEY ( user_id ) REFERENCES user( user_id )
);

-- END OF CREATING TABLE SECTION --




-- START OF CREATING STORED PROCEDURE SECTION --

DELIMITER $

#insert stored procedures

$
CREATE PROCEDURE sp_insert_authorisation(
 	IN p_authorisation_type varchar(20)
)
BEGIN
    INSERT INTO authorisation
    	( authorisation_id, authorisation_type ) 
    	VALUES ( authorisation_id, p_authorisation_type );
END
$


$
CREATE PROCEDURE sp_insert_system_manager(
   	IN p_username VARCHAR(100),
   	IN p_password VARCHAR(100),
   	IN p_mail_address VARCHAR(150),
   	IN p_first_name VARCHAR(50),
   	IN p_last_name VARCHAR(50),
   	IN p_authorisation_type VARCHAR(20)
)
BEGIN
	DECLARE p_authorisation_id INT;
	SET p_authorisation_id = ( SELECT authorisation_id FROM authorisation WHERE authorisation_type = p_authorisation_type LIMIT 1 );

    INSERT INTO user
    	( user_id, username, password, mail_address, first_name, last_name, authorisation_id ) 
    	VALUES ( user_id, p_username, p_password, p_mail_address, p_first_name, p_last_name, p_authorisation_id );
   	
   	INSERT INTO system_manager
    	( user_id ) 
    	VALUES ( (SELECT MAX(user_id) FROM user LIMIT 1) );
END
$



$
CREATE PROCEDURE sp_insert_city_manager(
   	IN p_username VARCHAR(100),
   	IN p_password VARCHAR(100),
   	IN p_mail_address VARCHAR(150),
   	IN p_first_name VARCHAR(50),
   	IN p_last_name VARCHAR(50),
   	IN p_authorisation_type VARCHAR(20),
   	IN p_city_name VARCHAR(50)
)
BEGIN
	DECLARE p_authorisation_id INT;
	SET p_authorisation_id = ( SELECT authorisation_id FROM authorisation WHERE authorisation_type = p_authorisation_type LIMIT 1 );

    INSERT INTO user
    	( user_id, username, password, mail_address, first_name, last_name, authorisation_id ) 
    	VALUES ( user_id, p_username, p_password, p_mail_address, p_first_name, p_last_name, p_authorisation_id );
   	
   	INSERT INTO city_manager
    	( user_id, city_id ) 
    	VALUES ( (SELECT MAX(user_id) FROM user LIMIT 1),
    	 		 (SELECT city_id FROM city WHERE name = p_city_name LIMIT 1)
    	 	   );
END
$



$
CREATE PROCEDURE sp_insert_branch_manager(
   	IN p_username VARCHAR(100),
   	IN p_password VARCHAR(100),
   	IN p_mail_address VARCHAR(150),
   	IN p_first_name VARCHAR(50),
   	IN p_last_name VARCHAR(50),
   	IN p_authorisation_type VARCHAR(20),
   	IN p_branch_name VARCHAR(50)
)
BEGIN
	DECLARE p_authorisation_id INT;
	SET p_authorisation_id = ( SELECT authorisation_id FROM authorisation WHERE authorisation_type = p_authorisation_type LIMIT 1 );

    INSERT INTO user
    	( user_id, username, password, mail_address, first_name, last_name, authorisation_id ) 
    	VALUES ( user_id, p_username, p_password, p_mail_address, p_first_name, p_last_name, p_authorisation_id );
   	
   	INSERT INTO branch_manager
    	( user_id, branch_id ) 
    	VALUES ( (SELECT MAX(user_id) FROM user LIMIT 1),
    	 		 (SELECT branch_id FROM branch WHERE name = p_branch_name LIMIT 1)
    	 	   );
END
$



$
CREATE PROCEDURE sp_insert_customer(
   	IN p_username VARCHAR(100),
   	IN p_password VARCHAR(100),
   	IN p_mail_address VARCHAR(150),
   	IN p_first_name VARCHAR(50),
   	IN p_last_name VARCHAR(50),
   	IN p_authorisation_type VARCHAR(20),
   	IN p_phone VARCHAR(50),
   	IN p_age INT,
   	IN p_address VARCHAR(100),
   	IN p_balance INT
)
BEGIN
	DECLARE p_authorisation_id INT;
	SET p_authorisation_id = ( SELECT authorisation_id FROM authorisation WHERE authorisation_type = p_authorisation_type LIMIT 1 );

    INSERT INTO user
    	( user_id, username, password, mail_address, first_name, last_name, authorisation_id ) 
    	VALUES ( user_id, p_username, p_password, p_mail_address, p_first_name, p_last_name, p_authorisation_id );
   	
   	INSERT INTO customer
    	( user_id, phone, age, address, balance ) 
    	VALUES ( (SELECT MAX(user_id) FROM user LIMIT 1),
    	 		 p_phone, p_age, p_address, p_balance
    	 	   );
END
$


$
CREATE PROCEDURE sp_insert_city(
 	IN p_city_name varchar(50)
)
BEGIN
    INSERT INTO city
    	( city_id, name )
    	VALUES ( city_id, p_city_name );
END
$


$
CREATE PROCEDURE sp_insert_branch(
 	IN p_city_name VARCHAR(50),
 	IN p_branch_name varchar(50),
 	IN p_phone VARCHAR(50),
 	IN p_address VARCHAR(250)
)
BEGIN
    INSERT INTO branch
    	( branch_id, city_id, name, phone, address )
    	VALUES ( branch_id, (SELECT city_id FROM city WHERE name = p_city_name LIMIT 1),
    			 p_branch_name, p_phone, p_address );
END
$


$
CREATE PROCEDURE sp_insert_car_official_website(
	IN p_link VARCHAR(250)
)
BEGIN
	INSERT INTO car_official_website
		( car_official_website_id, url )
		VALUES( car_official_website_id, p_link );
END
$


$
CREATE PROCEDURE sp_insert_car_model(
	IN p_brand_name VARCHAR(50),
	IN p_model_name VARCHAR(50),
	IN p_model_year INT,
	IN p_car_official_website_url VARCHAR(300)
)
BEGIN
	INSERT INTO car_model
		( car_model_id, brand_name, model_name, model_year, car_official_website_id )
		VALUES( car_model_id, p_brand_name, p_model_name, p_model_year,
				(SELECT car_official_website_id FROM car_official_website WHERE url=p_car_official_website_url LIMIT 1) );
END
$


$
CREATE PROCEDURE sp_insert_car_type(
	IN p_type_name VARCHAR(50),
	IN p_seat_number INT
)
BEGIN
	INSERT INTO car_type
		( car_type_id, type_name, seat_number )
		VALUES( car_type_id, p_type_name, p_seat_number );
END
$


$
CREATE PROCEDURE sp_insert_car_fuel(
	IN p_fuel_type VARCHAR(80),
	IN p_average_fuel FLOAT
)
BEGIN
	INSERT INTO car_fuel
		( car_fuel_id, fuel_type, average_fuel )
		VALUES( car_fuel_id, p_fuel_type, p_average_fuel );
END
$


$
CREATE PROCEDURE sp_insert_price_information(
	IN p_daily_price INT,
	IN p_weekly_price INT
)
BEGIN
	INSERT INTO price_information
		( price_information_id, daily_price, weekly_price )
		VALUES( price_information_id, p_daily_price, p_weekly_price );
END
$


$
CREATE PROCEDURE sp_insert_car_gear(
	IN p_gear_type VARCHAR(50),
	IN p_gear_number INT
)
BEGIN
	INSERT INTO car_gear
		( car_gear_id, gear_type, gear_number )
		VALUES( car_gear_id, p_gear_type, p_gear_number );
END
$


$
CREATE PROCEDURE sp_insert_car_technical_specification(
	IN p_technical_specification VARCHAR(50)
)
BEGIN
	INSERT INTO car_technical_specification
		( car_technical_specification_id, technical_specification )
		VALUES( car_technical_specification_id, p_technical_specification );
END
$


$
CREATE PROCEDURE sp_insert_car(
	IN p_car_model_id INT,
	IN p_car_type_id INT,
	IN p_car_fuel_id INT,
	IN p_price_information_id INT,
	IN p_branch_id INT,
	IN p_car_gear_id INT,
	IN p_color VARCHAR(50),
	IN p_about VARCHAR(500)
)
BEGIN
	INSERT INTO car
		( car_id, car_model_id, car_type_id, car_fuel_id, price_information_id, branch_id, car_gear_id, color, about )
		VALUES( car_id, p_car_model_id, p_car_type_id, p_car_fuel_id, p_price_information_id, p_branch_id, p_car_gear_id, p_color, p_about );
END
$


$
CREATE PROCEDURE sp_insert_car_has_car_technical_specification(
	IN p_car_id INT,
	IN p_car_technical_specification_id INT
)
BEGIN
	INSERT INTO car_has_car_technical_specification
		( car_id, car_technical_specification_id )
		VALUES( p_car_id, p_car_technical_specification_id );
END
$


$
CREATE PROCEDURE sp_insert_rented_car(
	IN p_car_id INT,
	IN p_user_id INT,
	IN p_start_date VARCHAR(50),
	IN p_end_date VARCHAR(50)
)
BEGIN
	INSERT INTO rented_car
		( rented_car_id, car_id, user_id, start_date, end_date )
		VALUES( rented_car_id, p_car_id, p_user_id, p_start_date, p_end_date );
END
$


$
CREATE PROCEDURE sp_insert_car_photo(
	IN p_car_id INT,
	IN p_url VARCHAR(300)
)
BEGIN
	INSERT INTO car_photo
	( car_photo_id, car_id, url )
	VALUES( car_photo_id, p_car_id, p_url );
END
$


$
CREATE PROCEDURE sp_insert_last_10_login(
	IN p_user_id INT,
	IN p_login_date VARCHAR(100)
)
BEGIN
	INSERT INTO last_10_login
	( last_10_login_id, user_id, login_date )
	VALUES( last_10_login_id, p_user_id, p_login_date );
END
$




#update stored procedures


$
CREATE PROCEDURE sp_update_authorisation_by_authorisation_id(
	IN p_authorisation_id INT,
	IN p_authorisation_type VARCHAR(20)
)
BEGIN
	UPDATE authorisation
	SET authorisation_type = p_authorisation_type
	WHERE authorisation_id = p_authorisation_id;
END
$


$
CREATE PROCEDURE sp_update_system_manager(
	IN p_user_id INT,
	IN p_username VARCHAR(100),
   	IN p_password VARCHAR(100),
   	IN p_mail_address VARCHAR(150),
   	IN p_first_name VARCHAR(50),
   	IN p_last_name VARCHAR(50)
)
BEGIN
	UPDATE user
	SET username = p_username,
		password = p_password,
		mail_address = p_mail_address,
		first_name = p_first_name,
		last_name = p_last_name
	WHERE user_id = p_user_id;
END
$


$
CREATE PROCEDURE sp_update_city_manager(
	IN p_user_id INT,
	IN p_username VARCHAR(100),
   	IN p_password VARCHAR(100),
   	IN p_mail_address VARCHAR(150),
   	IN p_first_name VARCHAR(50),
   	IN p_last_name VARCHAR(50),
   	IN p_city_name VARCHAR(50)
)
BEGIN
	DECLARE p_city_id INT;
	SET p_city_id = ( SELECT city_id FROM city WHERE name = p_city_name LIMIT 1 );

	UPDATE user
	SET username = p_username,
		password = p_password,
		mail_address = p_mail_address,
		first_name = p_first_name,
		last_name = p_last_name
	WHERE user_id = p_user_id;

	UPDATE city_manager
	SET city_id = p_city_id
	WHERE user_id = p_user_id;
END
$


$
CREATE PROCEDURE sp_update_branch_manager(
	IN p_user_id INT,
	IN p_username VARCHAR(100),
   	IN p_password VARCHAR(100),
   	IN p_mail_address VARCHAR(150),
   	IN p_first_name VARCHAR(50),
   	IN p_last_name VARCHAR(50),
   	IN p_branch_name VARCHAR(50)
)
BEGIN
	DECLARE p_branch_id INT;
	SET p_branch_id = (SELECT branch_id FROM branch WHERE name = p_branch_name LIMIT 1);

	UPDATE user
	SET username = p_username,
		password = p_password,
		mail_address = p_mail_address,
		first_name = p_first_name,
		last_name = p_last_name
	WHERE user_id = p_user_id;
	
	UPDATE branch_manager
	SET branch_id = p_branch_id
	WHERE user_id = p_user_id;
END
$


$
CREATE PROCEDURE sp_update_customer(
	IN p_user_id INT,
	IN p_username VARCHAR(100),
   	IN p_password VARCHAR(100),
   	IN p_mail_address VARCHAR(150),
   	IN p_first_name VARCHAR(50),
   	IN p_last_name VARCHAR(50),
   	IN p_phone VARCHAR(50),
   	IN p_age INT,
   	IN p_address VARCHAR(250),
   	IN p_balance INT
)
BEGIN
	UPDATE user
	SET username = p_username,
		password = p_password,
		mail_address = p_mail_address,
		first_name = p_first_name,
		last_name = p_last_name
	WHERE user_id = p_user_id;

	UPDATE customer
	SET phone = p_phone,
		age = p_age,
		address = p_address,
		balance = p_balance
	WHERE user_id = p_user_id;
END
$


$
CREATE PROCEDURE sp_update_city(
	IN p_city_id INT,
	IN p_city_name VARCHAR(50)
)
BEGIN
	UPDATE city
	SET name = p_city_name
	WHERE city_id = p_city_id;
END
$


$
CREATE PROCEDURE sp_update_branch(
	IN p_branch_id INT,
	IN p_city_name VARCHAR(50),
	IN p_branch_name VARCHAR(50),
	IN p_branch_phone VARCHAR(50),
	IN p_branch_address VARCHAR(250)
)
BEGIN
	DECLARE p_city_id INT;
	SET p_city_id = (SELECT city_id FROM city WHERE name = p_city_name LIMIT 1);
	UPDATE branch
	SET name = p_branch_name,
		phone = p_branch_phone,
		address = p_branch_address,
		city_id = p_city_id
	WHERE branch_id = p_branch_id;
END
$


$
CREATE PROCEDURE sp_update_car_official_website(
	IN p_car_official_website_id INT,
	IN p_url VARCHAR(300)
)
BEGIN
	UPDATE car_official_website
	SET url = p_url
	WHERE car_official_website_id = p_car_official_website_id;
END
$


$
CREATE PROCEDURE sp_update_car_model(
	IN p_car_model_id INT,
	IN p_brand_name VARCHAR(50),
	IN p_model_name VARCHAR(50),
	IN p_car_official_website_id INT
)
BEGIN
	UPDATE car_model
	SET brand_name = p_brand_name,
		model_name = p_model_name,
		model_year = p_model_year,
		car_official_website_id = p_car_official_website_id
	WHERE car_model_id = p_car_model_id;
END
$


$
CREATE PROCEDURE sp_update_car_type(
	IN p_car_type_id INT,
	IN p_type_name VARCHAR(50),
	IN p_seat_number INT
)
BEGIN
	UPDATE car_fuel
	SET type_name = p_type_name,
		seat_number = p_seat_number
	WHERE car_type_id = p_car_type_id;
END
$


$
CREATE PROCEDURE sp_update_car_fuel(
	IN p_car_fuel_id INT,
	IN p_fuel_type VARCHAR(50),
	IN p_average_fuel FLOAT
)
BEGIN
	UPDATE car_fuel
	SET fuel_type = p_fuel_type,
		average_fuel = p_average_fuel
	WHERE car_fuel_id = p_car_fuel_id;
END
$


$
CREATE PROCEDURE sp_update_price_information(
	IN p_price_information_id INT,
	IN p_daily_price INT,
	IN p_weekly_price INT
)
BEGIN
	UPDATE price_information
	SET daily_price = p_daily_price,
		weekly_price = p_weekly_price
	WHERE price_information_id = p_price_information_id;
END
$


$
CREATE PROCEDURE sp_update_car_gear(
	IN p_car_gear_id INT,
	IN p_gear_type INT,
	IN p_gear_number INT
)
BEGIN
	UPDATE car_gear
	SET gear_type = p_gear_type,
		gear_number = p_gear_number
	WHERE car_gear_id = p_car_gear_id;
END
$


$
CREATE PROCEDURE sp_update_car_technical_specification(
	IN p_car_technical_specification_id INT,
	IN p_technical_specification VARCHAR(50)
)
BEGIN
	UPDATE car_technical_specification
	SET technical_specification = p_technical_specification
	WHERE car_technical_specification_id = p_car_technical_specification_id;
END
$


$
CREATE PROCEDURE sp_update_car(
	IN p_car_id INT,
	IN p_car_model_id INT,
	IN p_car_type_id INT,
	IN p_car_fuel_id INT,
	IN p_price_information_id INT,
	IN p_color VARCHAR(50),
	IN p_about VARCHAR(500),
	IN branch_id INT,
	IN car_gear_id INT
)
BEGIN
	UPDATE car
	SET car_model_id = p_car_model_id,
		car_type_id = p_car_type_id,
		car_fuel_id = p_car_fuel_id,
		price_information_id = p_price_information_id,
		color = p_color,
		about = p_about,
		branch_id = p_branch_id,
		car_gear_id = p_car_gear_id
	WHERE car_id = p_car_id;
END
$


$
CREATE PROCEDURE sp_update_car_photo(
	IN p_car_photo_id INT,
	IN p_car_id INT,
	IN p_url VARCHAR(300)
)
BEGIN
	UPDATE car_photo
	SET car_id = p_car_id,
		url = p_url
	WHERE car_photo_id = p_car_photo_id;
END
$


$
CREATE PROCEDURE sp_update_car_has_car_technical_specification(
	IN p_car_id INT,
	IN p_car_technical_specification_id INT
)
BEGIN
	UPDATE car_has_car_technical_specification
	SET car_id = p_car_id,
		car_technical_specification_id = p_car_technical_specification_id
	WHERE car_id = p_car_id AND car_technical_specification_id = p_car_technical_specification_id;
END
$


$
CREATE PROCEDURE sp_update_rented_car(
	IN p_rented_car_id INT,
	IN p_car_id INT,
	IN p_user_id INT,
	IN p_start_date VARCHAR(50),
	IN p_end_date VARCHAR(50)
)
BEGIN
	UPDATE rented_car
	SET car_id = p_car_id,
		user_id = p_user_id,
		start_date = p_start_date,
		end_date = p_end_date
	WHERE rented_car_id = p_rented_car_id;
END
$





#delete stored procedures

$
CREATE PROCEDURE sp_delete_authorisation_by_authorisation_id(
	IN p_authorisation_id INT
)
BEGIN
	DELETE FROM authorisation
	WHERE authorisation_id = p_authorisation_id;
END
$


$
CREATE PROCEDURE sp_delete_system_manager(
	IN p_user_id INT
)
BEGIN
	DELETE FROM system_manager
	WHERE user_id = p_user_id;

	DELETE FROM user
	WHERE user_id = p_user_id;
END
$


$
CREATE PROCEDURE sp_delete_city_manager(
	IN p_user_id INT
)
BEGIN
	DELETE FROM city_manager
	WHERE user_id = p_user_id;

	DELETE FROM user
	WHERE user_id = p_user_id;
END
$


$
CREATE PROCEDURE sp_delete_branch_manager(
	IN p_user_id INT
)
BEGIN
	DELETE FROM branch_manager
	WHERE user_id = p_user_id;
	
	DELETE FROM user
	WHERE user_id = p_user_id;
END
$


$
CREATE PROCEDURE sp_delete_customer(
	IN p_user_id INT
)
BEGIN
	DELETE FROM customer
	WHERE user_id = p_user_id;
	
	DELETE FROM user
	WHERE user_id = p_user_id;
END
$


$
CREATE PROCEDURE sp_delete_city(
	IN p_city_id INT
)
BEGIN
	DECLARE p_user_id INT;
	SET p_user_id = (SELECT user_id FROM city_manager WHERE city_id = p_city_id LIMIT 1);

	DELETE FROM user
	WHERE user_id = p_user_id;

	DELETE FROM city_manager
	WHERE city_id = p_city_id;

	#not branchın FK olduğu diğer tablolarda silinecek

	DELETE FROM branch
	WHERE city_id = p_city_id;
	
	DELETE FROM city
	WHERE city_id = p_city_id;
END
$


$
CREATE PROCEDURE sp_delete_branch(
	IN p_branch_id INT
)
BEGIN
	DELETE FROM branch
	WHERE branc_id = p_branch_id;
END
$


$
CREATE PROCEDURE sp_delete_car_official_website(
	IN p_car_official_website_id INT
)
BEGIN
	DELETE FROM car_official_website
	WHERE car_official_website_id = p_car_official_website_id;
END
$


$
CREATE PROCEDURE sp_delete_car_model(
	IN p_car_model_id INT
)
BEGIN
	DELETE FROM car_model
	WHERE car_model_id = p_car_model_id;
END
$


$
CREATE PROCEDURE sp_delete_car_type(
	IN p_car_type_id INT
)
BEGIN
	DELETE FROM car_type
	WHERE car_type_id = p_car_type_id;
END
$


$
CREATE PROCEDURE sp_delete_car_fuel(
	IN p_car_fuel_id INT
)
BEGIN
	DELETE FROM car_fuel
	WHERE car_fuel_id = p_car_fuel_id;
END
$


$
CREATE PROCEDURE sp_delete_price_information(
	IN p_price_information_id INT
)
BEGIN
	DELETE FROM price_information
	WHERE price_information_id = p_price_information_id;
END
$


$
CREATE PROCEDURE sp_delete_car_gear(
	IN p_car_gear_id INT
)
BEGIN
	DELETE FROM car_gear
	WHERE car_gear_id = p_car_gear_id;
END
$


$
CREATE PROCEDURE sp_delete_car_photo(
	IN p_car_photo_id INT
)
BEGIN
	DELETE FROM car_photo
	WHERE car_photo_id = p_car_photo_id;
END
$


$
CREATE PROCEDURE sp_delete_rented_car(
	IN p_rented_car_id INT
)
BEGIN
	DELETE FROM rented_car
	WHERE rented_car_id = p_rented_car_id;
END
$


$
CREATE PROCEDURE sp_delete_car(
	IN p_car_id INT
)
BEGIN
	DELETE FROM car
	WHERE car_id = p_car_id;
END
$


$
CREATE PROCEDURE sp_delete_last_10_login(

)
BEGIN
	DECLARE id INT;
	SET id = (SELECT min(last_10_login_id) FROM last_10_login);

	DELETE FROM last_10_login
	WHERE last_10_login_id = id;
END
$


-- END OF CREATING STORED PROCEDURE SECTION --





-- START OF CREATING TRIGGER SECTION --

$
CREATE TRIGGER tr_authorisation BEFORE INSERT ON authorisation
FOR EACH ROW
BEGIN
    SET NEW.authorisation_id = ( SELECT IFNULL(MAX(authorisation_id), 0) + 1 FROM authorisation );
END
$


$
CREATE TRIGGER tr_user BEFORE INSERT ON user
FOR EACH ROW
BEGIN
    SET NEW.user_id = ( SELECT IFNULL(MAX(user_id), 0) + 1 FROM user );
END
$


$
CREATE TRIGGER tr_city BEFORE INSERT ON city
FOR EACH ROW
BEGIN
    SET NEW.city_id = ( SELECT IFNULL(MAX(city_id), 0) + 1 FROM city );      
END
$


$
CREATE TRIGGER tr_branch BEFORE INSERT ON branch
FOR EACH ROW
BEGIN
    SET NEW.branch_id = ( SELECT IFNULL(MAX(branch_id), 0) + 1 FROM branch );
END
$


$
CREATE TRIGGER tr_car_official_website BEFORE INSERT ON car_official_website
FOR EACH ROW
BEGIN
    SET NEW.car_official_website_id = ( SELECT IFNULL(MAX(car_official_website_id), 0) + 1 FROM car_official_website );
END
$


$
CREATE TRIGGER tr_car_model BEFORE INSERT ON car_model
FOR EACH ROW
BEGIN
    SET NEW.car_model_id = ( SELECT IFNULL(MAX(car_model_id), 0) + 1 FROM car_model );
END
$


$
CREATE TRIGGER tr_car_type BEFORE INSERT ON car_type
FOR EACH ROW
BEGIN
    SET NEW.car_type_id = ( SELECT IFNULL(MAX(car_type_id), 0) + 1 FROM car_type );
END
$


$
CREATE TRIGGER tr_car_fuel BEFORE INSERT ON car_fuel
FOR EACH ROW
BEGIN
    SET NEW.car_fuel_id = ( SELECT IFNULL(MAX(car_fuel_id), 0) + 1 FROM car_fuel );
END
$


$
CREATE TRIGGER tr_price_information BEFORE INSERT ON price_information
FOR EACH ROW
BEGIN
    SET NEW.price_information_id = ( SELECT IFNULL(MAX(price_information_id), 0) + 1 FROM price_information );
END
$


$
CREATE TRIGGER tr_car_gear BEFORE INSERT ON car_gear
FOR EACH ROW
BEGIN
    SET NEW.car_gear_id = ( SELECT IFNULL(MAX(car_gear_id), 0) + 1 FROM car_gear );
END
$


$
CREATE TRIGGER tr_car_technical_specification BEFORE INSERT ON car_technical_specification
FOR EACH ROW
BEGIN
    SET NEW.car_technical_specification_id = ( SELECT IFNULL(MAX(car_technical_specification_id), 0) + 1 FROM car_technical_specification );
END
$


$
CREATE TRIGGER tr_car BEFORE INSERT ON car
FOR EACH ROW
BEGIN
    SET NEW.car_id = ( SELECT IFNULL(MAX(car_id), 0) + 1 FROM car );
END
$


$
CREATE TRIGGER tr_rented_car BEFORE INSERT ON rented_car
FOR EACH ROW
BEGIN
    SET NEW.rented_car_id = ( SELECT IFNULL(MAX(rented_car_id), 0) + 1 FROM rented_car );
END
$


$
CREATE TRIGGER tr_car_photo BEFORE INSERT ON car_photo
FOR EACH ROW
BEGIN
    SET NEW.car_photo_id = ( SELECT IFNULL(MAX(car_photo_id), 0) + 1 FROM car_photo );
END
$


$
CREATE TRIGGER tr_last_10_login BEFORE INSERT ON last_10_login
FOR EACH ROW
BEGIN
    SET NEW.last_10_login_id = ( SELECT IFNULL(MAX(last_10_login_id), 0) + 1 FROM last_10_login );
END
$

-- END OF CREATING TRIGGER SECTION --


