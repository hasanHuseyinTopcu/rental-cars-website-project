##views

#view which get all cars
CREATE VIEW all_car_list AS
SELECT c.car_id, c.color, c.about, c.car_model_id, c.car_type_id, c.car_fuel_id, c.price_information_id, c.branch_id, c.car_gear_id, 
	   c_m.model_name, c_m.brand_name, c_m.model_year, c_t.type_name, c_t.seat_number, c_f.fuel_type, c_f.average_fuel,
	   p_i.daily_price, p_i.weekly_price, b.city_id, b.name as branch_name, b.phone, b.address, cty.name as city_name,
	   c_g.gear_type, c_g.gear_number, c_o_w.url as website_url
	   FROM car AS c
	   INNER JOIN car_model AS c_m ON c_m.car_model_id = c.car_model_id
	   INNER JOIN car_official_website AS c_o_w ON c_o_w.car_official_website_id = c_m.car_official_website_id
 	   INNER JOIN car_type AS c_t ON c_t.car_type_id = c.car_type_id
	   INNER JOIN car_fuel AS c_f ON c_f.car_fuel_id = c.car_fuel_id
	   INNER JOIN price_information AS p_i ON p_i.price_information_id = c.price_information_id
	   INNER JOIN branch AS b ON b.branch_id = c.branch_id
	   INNER JOIN city AS cty ON cty.city_id = b.city_id
	   INNER JOIN car_gear AS c_g ON c_g.car_gear_id = c.car_gear_id;


#view which get economically priced cars these daily price below average daily price
CREATE VIEW all_economically_car_list AS
SELECT c.car_id, c.color, c.about, c.car_model_id, c.car_type_id, c.car_fuel_id, c.price_information_id, c.branch_id, c.car_gear_id, 
	   c_m.model_name, c_m.brand_name, c_m.model_year, c_t.type_name, c_t.seat_number, c_f.fuel_type, c_f.average_fuel,
	   p_i.daily_price, p_i.weekly_price, b.city_id, b.name as branch_name, b.phone, b.address, cty.name as city_name,
	   c_g.gear_type, c_g.gear_number, c_o_w.url as website_url
	   FROM car AS c
	   INNER JOIN car_model AS c_m ON c_m.car_model_id = c.car_model_id
	   INNER JOIN car_official_website AS c_o_w ON c_o_w.car_official_website_id = c_m.car_official_website_id
 	   INNER JOIN car_type AS c_t ON c_t.car_type_id = c.car_type_id
	   INNER JOIN car_fuel AS c_f ON c_f.car_fuel_id = c.car_fuel_id
	   INNER JOIN price_information AS p_i ON p_i.price_information_id = c.price_information_id
	   INNER JOIN branch AS b ON b.branch_id = c.branch_id
	   INNER JOIN city AS cty ON cty.city_id = b.city_id
	   INNER JOIN car_gear AS c_g ON c_g.car_gear_id = c.car_gear_id
	   WHERE p_i.daily_price <= (SELECT avg(daily_price) FROM car natural join price_information LIMIT 1);


#view which get all automatic_or_semi_automatic_gearbox_car_list
CREATE VIEW all_automatic_or_semi_automatic_gearbox_car_list AS
SELECT c.car_id, c.color, c.about, c.car_model_id, c.car_type_id, c.car_fuel_id, c.price_information_id, c.branch_id, c.car_gear_id, 
	   c_m.model_name, c_m.brand_name, c_m.model_year, c_t.type_name, c_t.seat_number, c_f.fuel_type, c_f.average_fuel,
	   p_i.daily_price, p_i.weekly_price, b.city_id, b.name as branch_name, b.phone, b.address, cty.name as city_name,
	   c_g.gear_type, c_g.gear_number, c_o_w.url as website_url
	   FROM car AS c
	   INNER JOIN car_model AS c_m ON c_m.car_model_id = c.car_model_id
	   INNER JOIN car_official_website AS c_o_w ON c_o_w.car_official_website_id = c_m.car_official_website_id
 	   INNER JOIN car_type AS c_t ON c_t.car_type_id = c.car_type_id
	   INNER JOIN car_fuel AS c_f ON c_f.car_fuel_id = c.car_fuel_id
	   INNER JOIN price_information AS p_i ON p_i.price_information_id = c.price_information_id
	   INNER JOIN branch AS b ON b.branch_id = c.branch_id
	   INNER JOIN city AS cty ON cty.city_id = b.city_id
	   INNER JOIN car_gear AS c_g ON c_g.car_gear_id = c.car_gear_id
	   WHERE c_g.gear_type="automatic" OR c_g.gear_type="semi-automatic";



#view which get cars these suv or pick up
CREATE VIEW all_SUV_or_pickp_up_car_list AS
SELECT c.car_id, c.color, c.about, c.car_model_id, c.car_type_id, c.car_fuel_id, c.price_information_id, c.branch_id, c.car_gear_id, 
	   c_m.model_name, c_m.brand_name, c_m.model_year, c_t.type_name, c_t.seat_number, c_f.fuel_type, c_f.average_fuel,
	   p_i.daily_price, p_i.weekly_price, b.city_id, b.name as branch_name, b.phone, b.address, cty.name as city_name,
	   c_g.gear_type, c_g.gear_number, c_o_w.url as website_url
	   FROM car AS c
	   INNER JOIN car_model AS c_m ON c_m.car_model_id = c.car_model_id
	   INNER JOIN car_official_website AS c_o_w ON c_o_w.car_official_website_id = c_m.car_official_website_id
 	   INNER JOIN car_type AS c_t ON c_t.car_type_id = c.car_type_id
	   INNER JOIN car_fuel AS c_f ON c_f.car_fuel_id = c.car_fuel_id
	   INNER JOIN price_information AS p_i ON p_i.price_information_id = c.price_information_id
	   INNER JOIN branch AS b ON b.branch_id = c.branch_id
	   INNER JOIN city AS cty ON cty.city_id = b.city_id
	   INNER JOIN car_gear AS c_g ON c_g.car_gear_id = c.car_gear_id
	   WHERE c_t.type_name="SUV" OR c_t.type_name="Pick-up";


#view which get car with all information about it
CREATE VIEW car_detail AS
SELECT c.car_id, c.color, c.about, c.car_model_id, c.car_type_id, c.car_fuel_id, c.price_information_id, c.branch_id, c.car_gear_id, 
	   c_m.model_name, c_m.brand_name, c_m.model_year, c_t.type_name, c_t.seat_number, c_f.fuel_type, c_f.average_fuel,
	   p_i.daily_price, p_i.weekly_price, b.city_id, b.name as branch_name, b.phone, b.address, cty.name as city_name,
	   c_g.gear_type, c_g.gear_number, c_o_w.url as website_url, c_p.car_photo_id, c_p.url as photo_url, c_t_s.technical_specification,
	   r_c.rented_car_id, r_c.user_id as customer_id, r_c.start_date, r_c.end_date
	   FROM car AS c
	   INNER JOIN car_model AS c_m ON c_m.car_model_id = c.car_model_id
	   INNER JOIN car_official_website AS c_o_w ON c_o_w.car_official_website_id = c_m.car_official_website_id
 	   INNER JOIN car_type AS c_t ON c_t.car_type_id = c.car_type_id
	   INNER JOIN car_fuel AS c_f ON c_f.car_fuel_id = c.car_fuel_id
	   INNER JOIN price_information AS p_i ON p_i.price_information_id = c.price_information_id
	   INNER JOIN branch AS b ON b.branch_id = c.branch_id
	   INNER JOIN city AS cty ON cty.city_id = b.city_id
	   LEFT JOIN car_photo AS c_p ON c_p.car_id = c.car_id
	   INNER JOIN car_gear AS c_g ON c_g.car_gear_id = c.car_gear_id
	   LEFT JOIN car_has_car_technical_specification AS c_h_c_t_s ON c_h_c_t_s.car_id = c.car_id
	   LEFT JOIN car_technical_specification AS c_t_s ON c_t_s.car_technical_specification_id = c_h_c_t_s.car_technical_specification_id
	   LEFT JOIN rented_car AS r_c ON r_c.car_id = c.car_id;

