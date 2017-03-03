USE rental_cars;

#insert into authorisation via sp_insert_authorisation procedure 
CALL sp_insert_authorisation("system manager");
CALL sp_insert_authorisation("city manager");
CALL sp_insert_authorisation("branch manager");
CALL sp_insert_authorisation("customer");

#insert into system_manager via sp_insert_system_manager procedure
CALL sp_insert_system_manager("sm1", "bfd59291e825b5f2bbf1eb76569f8fe7", "sm1@gmail.com", "sm1", "sm1", "system manager");
CALL sp_insert_system_manager("sm2", "bfd59291e825b5f2bbf1eb76569f8fe7", "sm2@gmail.com", "sm2", "sm2", "system manager");
CALL sp_insert_system_manager("sm3", "bfd59291e825b5f2bbf1eb76569f8fe7", "sm3@gmail.com", "sm3", "sm3", "system manager");
CALL sp_insert_system_manager("sm4", "bfd59291e825b5f2bbf1eb76569f8fe7", "sm4@gmail.com", "sm4", "sm4", "system manager");
CALL sp_insert_system_manager("sm5", "bfd59291e825b5f2bbf1eb76569f8fe7", "sm5@gmail.com", "sm5", "sm5", "system manager");
CALL sp_insert_system_manager("sm6", "bfd59291e825b5f2bbf1eb76569f8fe7", "sm6@gmail.com", "sm6", "sm6", "system manager");
CALL sp_insert_system_manager("sm7", "bfd59291e825b5f2bbf1eb76569f8fe7", "sm7@gmail.com", "sm7", "sm7", "system manager");
CALL sp_insert_system_manager("sm8", "bfd59291e825b5f2bbf1eb76569f8fe7", "sm8@gmail.com", "sm8", "sm8", "system manager");
CALL sp_insert_system_manager("sm9", "bfd59291e825b5f2bbf1eb76569f8fe7", "sm9@gmail.com", "sm9", "sm9", "system manager");
CALL sp_insert_system_manager("sm10", "bfd59291e825b5f2bbf1eb76569f8fe7", "sm10@gmail.com", "sm10", "sm10", "system manager");

#insert into city via sp_insert_city
CALL sp_insert_city("Ankara");
CALL sp_insert_city("Istanbul");
CALL sp_insert_city("Izmir");
CALL sp_insert_city("Antalya");
CALL sp_insert_city("Adana");
CALL sp_insert_city("Trabzon");
CALL sp_insert_city("Van");
CALL sp_insert_city("Gaziantep");
CALL sp_insert_city("Kayseri");
CALL sp_insert_city("Bayburt");

#insert into city_manager via sp_insert_city_manager procedure
CALL sp_insert_city_manager("cm1", "bfd59291e825b5f2bbf1eb76569f8fe7", "cm1@gmail.com", "cm1", "cm1", "city manager", "Ankara");
CALL sp_insert_city_manager("cm2", "bfd59291e825b5f2bbf1eb76569f8fe7", "cm2@gmail.com", "cm2", "cm2", "city manager", "İstanbul");
CALL sp_insert_city_manager("cm3", "bfd59291e825b5f2bbf1eb76569f8fe7", "cm3@gmail.com", "cm3", "cm3", "city manager", "İzmir");
CALL sp_insert_city_manager("cm4", "bfd59291e825b5f2bbf1eb76569f8fe7", "cm4@gmail.com", "cm4", "cm4", "city manager", "Antalya");
CALL sp_insert_city_manager("cm5", "bfd59291e825b5f2bbf1eb76569f8fe7", "cm5@gmail.com", "cm5", "cm5", "city manager", "Adana");
CALL sp_insert_city_manager("cm6", "bfd59291e825b5f2bbf1eb76569f8fe7", "cm6@gmail.com", "cm6", "cm6", "city manager", "Trabzon");
CALL sp_insert_city_manager("cm7", "bfd59291e825b5f2bbf1eb76569f8fe7", "cm7@gmail.com", "cm7", "cm7", "city manager", "Van");
CALL sp_insert_city_manager("cm8", "bfd59291e825b5f2bbf1eb76569f8fe7", "cm8@gmail.com", "cm8", "cm8", "city manager", "Gaziantep");
CALL sp_insert_city_manager("cm9", "bfd59291e825b5f2bbf1eb76569f8fe7", "cm9@gmail.com", "cm9", "cm9", "city manager", "Kayseri");
CALL sp_insert_city_manager("cm10", "bfd59291e825b5f2bbf1eb76569f8fe7", "cm10@gmail.com", "cm10", "cm10", "city manager", "Bayburt");

#insert into branch via sp_insert_branch procedure
CALL sp_insert_branch("Ankara", "AnkaraBranch1", "0312 330 33 55", "Ankara Yenimahalle");
CALL sp_insert_branch("Ankara", "AnkaraBranch2", "0312 330 44 66", "Ankara Bahcelievler");
CALL sp_insert_branch("Ankara", "AnkaraBranch3", "0312 330 55 77", "Ankara Kecioren");
CALL sp_insert_branch("Istanbul", "IstanbulBranch1", "0212 330 33 55", "Istanbul Fatih");
CALL sp_insert_branch("Istanbul", "IstanbulBranch2", "0212 330 44 66", "Istanbul Uskudar");
CALL sp_insert_branch("Istanbul", "IstanbulBranch3", "0212 330 55 77", "Istanbul Beykoz");
CALL sp_insert_branch("Izmir", "IzmirBranch1", "0412 330 44 66", "Izmir Kemalpasa");
CALL sp_insert_branch("Izmir", "IzmirBranch2", "0412 330 55 77", "Izmir Buca");
CALL sp_insert_branch("Antalya", "AntalyaBranch1", "0512 330 44 66", "Antalya Alanya");
CALL sp_insert_branch("Antalya", "AntalyaBranch2", "0512 330 55 77", "Antalya Konyaaltı");
CALL sp_insert_branch("Adana", "AdanaBranch1", "0612 330 55 77", "Adana Ceyhan");
CALL sp_insert_branch("Trabzon", "TrabzonBranch1", "0712 330 55 77", "Trabzon Akcaabat");
CALL sp_insert_branch("Van", "VanBranch1", "0812 330 55 77", "Van Çaldıran");
CALL sp_insert_branch("Gaziantep", "GaziantepBranch1", "0912 330 55 77", "Gaziantep Sahinbey");
CALL sp_insert_branch("Kayseri", "KayseriBranch1", "0112 330 55 77", "Kayseri Develi");
CALL sp_insert_branch("Bayburt", "BayburtBranch1", "0012 330 55 77", "Bayburt");

#insert into branch_manager via sp_insert_branch_manager procedure
CALL sp_insert_branch_manager("bm1", "bfd59291e825b5f2bbf1eb76569f8fe7", "bm1@gmail.com", "bm1", "bm1", "branch manager", "AnkaraBranch1");
CALL sp_insert_branch_manager("bm2", "bfd59291e825b5f2bbf1eb76569f8fe7", "bm2@gmail.com", "bm2", "bm2", "branch manager", "AnkaraBranch2");
CALL sp_insert_branch_manager("bm3", "bfd59291e825b5f2bbf1eb76569f8fe7", "bm3@gmail.com", "bm3", "bm3", "branch manager", "AnkaraBranch3");
CALL sp_insert_branch_manager("bm4", "bfd59291e825b5f2bbf1eb76569f8fe7", "bm4@gmail.com", "bm4", "bm4", "branch manager", "İstanbulBranch1");
CALL sp_insert_branch_manager("bm5", "bfd59291e825b5f2bbf1eb76569f8fe7", "bm5@gmail.com", "bm5", "bm5", "branch manager", "İstanbulBranch2");
CALL sp_insert_branch_manager("bm6", "bfd59291e825b5f2bbf1eb76569f8fe7", "bm6@gmail.com", "bm6", "bm6", "branch manager", "İstanbulBranch3");
CALL sp_insert_branch_manager("bm7", "bfd59291e825b5f2bbf1eb76569f8fe7", "bm7@gmail.com", "bm7", "bm7", "branch manager", "İzmirBranch1");
CALL sp_insert_branch_manager("bm8", "bfd59291e825b5f2bbf1eb76569f8fe7", "bm8@gmail.com", "bm8", "bm8", "branch manager", "İzmirBranch2");
CALL sp_insert_branch_manager("bm9", "bfd59291e825b5f2bbf1eb76569f8fe7", "bm9@gmail.com", "bm9", "bm9", "branch manager", "AntalyaBranch1");
CALL sp_insert_branch_manager("bm10", "bfd59291e825b5f2bbf1eb76569f8fe7", "bm10@gmail.com", "bm10", "bm10", "branch manager", "AntalyaBranch2");
CALL sp_insert_branch_manager("bm11", "bfd59291e825b5f2bbf1eb76569f8fe7", "bm11@gmail.com", "bm11", "bm11", "branch manager", "AdanaBranch1");
CALL sp_insert_branch_manager("bm12", "bfd59291e825b5f2bbf1eb76569f8fe7", "bm12@gmail.com", "bm12", "bm12", "branch manager", "TrabzonBranch1");
CALL sp_insert_branch_manager("bm13", "bfd59291e825b5f2bbf1eb76569f8fe7", "bm13@gmail.com", "bm13", "bm13", "branch manager", "VanBranch1");
CALL sp_insert_branch_manager("bm14", "bfd59291e825b5f2bbf1eb76569f8fe7", "bm14@gmail.com", "bm14", "bm14", "branch manager", "GaziantepBranch1");
CALL sp_insert_branch_manager("bm15", "bfd59291e825b5f2bbf1eb76569f8fe7", "bm15@gmail.com", "bm15", "bm15", "branch manager", "KayseriBranch1");
CALL sp_insert_branch_manager("bm16", "bfd59291e825b5f2bbf1eb76569f8fe7", "bm16@gmail.com", "bm16", "bm16", "branch manager", "BayburtBranch1");

#insert into customer via sp_insert_customer procedure
CALL sp_insert_customer("customer1", "bfd59291e825b5f2bbf1eb76569f8fe7", "customer1@gmail.com", "customer1", "customer1", "customer", "05551234567", "22", "", "100");
CALL sp_insert_customer("customer2", "bfd59291e825b5f2bbf1eb76569f8fe7", "customer2@gmail.com", "customer2", "customer2", "customer", "05551234567", "29", "", "200");
CALL sp_insert_customer("customer3", "bfd59291e825b5f2bbf1eb76569f8fe7", "customer3@gmail.com", "customer3", "customer3", "customer", "05551234567", "27", "", "300");
CALL sp_insert_customer("customer4", "bfd59291e825b5f2bbf1eb76569f8fe7", "customer4@gmail.com", "customer4", "customer4", "customer", "05551234567", "32", "", "400");
CALL sp_insert_customer("customer5", "bfd59291e825b5f2bbf1eb76569f8fe7", "customer5@gmail.com", "customer5", "customer5", "customer", "05551234567", "55", "", "500");
CALL sp_insert_customer("customer6", "bfd59291e825b5f2bbf1eb76569f8fe7", "customer6@gmail.com", "customer6", "customer6", "customer", "05551234567", "45", "", "600");
CALL sp_insert_customer("customer7", "bfd59291e825b5f2bbf1eb76569f8fe7", "customer7@gmail.com", "customer7", "customer7", "customer", "05551234567", "39", "", "700");
CALL sp_insert_customer("customer8", "bfd59291e825b5f2bbf1eb76569f8fe7", "customer8@gmail.com", "customer8", "customer8", "customer", "05551234567", "19", "", "800");
CALL sp_insert_customer("customer9", "bfd59291e825b5f2bbf1eb76569f8fe7", "customer9@gmail.com", "customer9", "customer9", "customer", "05551234567", "38", "", "900");
CALL sp_insert_customer("customer10", "bfd59291e825b5f2bbf1eb76569f8fe7", "customer10@gmail.com", "customer10", "customer10", "customer", "05551234567", "62", "", "1000");

#insert into car_official_website via sp_insert_car_official_website procedure
CALL sp_insert_car_official_website("http://www.alfaromeo.com.tr");
CALL sp_insert_car_official_website("http://www.audi.com.tr");
CALL sp_insert_car_official_website("http://www.bmw.com.tr");
CALL sp_insert_car_official_website("http://www.dacia.com.tr");
CALL sp_insert_car_official_website("http://www.renault.com.tr");
CALL sp_insert_car_official_website("http://www.ford.com.tr");
CALL sp_insert_car_official_website("http://www.honda.com.tr");
CALL sp_insert_car_official_website("http://www.opel.com.tr");
CALL sp_insert_car_official_website("http://www.nissan.com.tr");
CALL sp_insert_car_official_website("http://www.vw.com.tr");


#insert into car_model via sp_insert_car_model procedure
CALL sp_insert_car_model("Alfa Romeo", "156", 2004, "http://www.alfaromeo.com.tr");
CALL sp_insert_car_model("Alfa Romeo", "Giulietta", 2011, "http://www.alfaromeo.com.tr");
CALL sp_insert_car_model("Alfa Romeo", "2.0 TS", 1996, "http://www.alfaromeo.com.tr");
CALL sp_insert_car_model("Audi", "1.8 T", 2004, "http://www.audi.com.tr");
CALL sp_insert_car_model("Audi", "1.8 T", 1999, "http://www.audi.com.tr");
CALL sp_insert_car_model("Audi", "R5", 2011, "http://www.audi.com.tr");
CALL sp_insert_car_model("BMW", "330Ci", 2001, "http://www.bmw.com.tr");
CALL sp_insert_car_model("BMW", "520d", 2011, "http://www.bmw.com.tr");
CALL sp_insert_car_model("BMW", "30d xDrive", 2008, "http://www.bmw.com.tr");
CALL sp_insert_car_model("Dacia", "Duster", 2013, "http://www.dacia.com.tr");
CALL sp_insert_car_model("Dacia", "Duster", 2011, "http://www.dacia.com.tr");
CALL sp_insert_car_model("Dacia", "Duster", 2015, "http://www.dacia.com.tr");
CALL sp_insert_car_model("Renault", "Fluence", 2012, "http://www.renault.com.tr");
CALL sp_insert_car_model("Renault", "Clio", 2013, "http://www.renault.com.tr");
CALL sp_insert_car_model("Renault", "Megane", 2008, "http://www.renault.com.tr");
CALL sp_insert_car_model("Ford", "Ranger", 2011, "http://www.ford.com.tr");
CALL sp_insert_car_model("Ford", "Ranger", 2015, "http://www.ford.com.tr");
CALL sp_insert_car_model("Ford", "Ranger", 2008, "http://www.ford.com.tr");
CALL sp_insert_car_model("Honda", "Civic", 2008, "http://www.honda.com.tr");
CALL sp_insert_car_model("Honda", "Civic", 2002, "http://www.honda.com.tr");
CALL sp_insert_car_model("Honda", "Type-R", 2015, "http://www.honda.com.tr");
CALL sp_insert_car_model("Opel", "Astra", 2006, "http://www.opel.com.tr");
CALL sp_insert_car_model("Opel", "Vectra", 1999, "http://www.opel.com.tr");
CALL sp_insert_car_model("Nissan", "Qashqai", 2015, "http://www.nissan.com.tr");
CALL sp_insert_car_model("Nissan", "Qashqai+2", 2016, "http://www.nissan.com.tr");
CALL sp_insert_car_model("Volkswagen", "Passat", 2016, "http://www.vw.com.tr");
CALL sp_insert_car_model("Volkswagen", "VW CC", 2014, "http://www.vw.com.tr");

#insert into car_type via sp_insert_car_type procedure
CALL sp_insert_car_type("Sedan",5);
CALL sp_insert_car_type("Hatchback", 5);
CALL sp_insert_car_type("Hatchback",2);
CALL sp_insert_car_type("Copue", 2);
CALL sp_insert_car_type("Copue", 5);
CALL sp_insert_car_type("Cabrio",2);
CALL sp_insert_car_type("Cabrio",5);
CALL sp_insert_car_type("Station Wagon", 5);
CALL sp_insert_car_type("Station Wagon", 7);
CALL sp_insert_car_type("SUV", 5);
CALL sp_insert_car_type("SUV", 7);
CALL sp_insert_car_type("Pick-up", 5);
CALL sp_insert_car_type("Pick-up", 2);

#insert into car_fuel via sp_insert_car_fuel procedure
CALL sp_insert_car_fuel("Gasoline", 5.0);
CALL sp_insert_car_fuel("Gasoline", 6.2);
CALL sp_insert_car_fuel("Gasoline", 7.0);
CALL sp_insert_car_fuel("Gasoline", 8.0);
CALL sp_insert_car_fuel("Diesel", 3.5);
CALL sp_insert_car_fuel("Diesel", 3.9);
CALL sp_insert_car_fuel("Diesel", 4.5);
CALL sp_insert_car_fuel("Diesel", 6.2);
CALL sp_insert_car_fuel("Gasoline-Gas", 6.0);
CALL sp_insert_car_fuel("Gasoline-Gas", 7.0);
CALL sp_insert_car_fuel("Gasoline-Gas", 8.1);
CALL sp_insert_car_fuel("Hybrid", 2.0);
CALL sp_insert_car_fuel("Hybrid", 3.0);
CALL sp_insert_car_fuel("Hybrid", 4.0);
CALL sp_insert_car_fuel("electric", 1.0);

#insert into price_information via sp_insert_price_information procedure
CALL sp_insert_price_information(50, 300);
CALL sp_insert_price_information(55, 330);
CALL sp_insert_price_information(60, 350);
CALL sp_insert_price_information(70, 400);
CALL sp_insert_price_information(80, 500);
CALL sp_insert_price_information(90, 550);
CALL sp_insert_price_information(100, 600);
CALL sp_insert_price_information(110, 650);
CALL sp_insert_price_information(120, 700);
CALL sp_insert_price_information(130, 800);

#insert into car_gear via sp_insert_car_gear procedure
CALL sp_insert_car_gear("Manuel", 4);
CALL sp_insert_car_gear("Manuel", 5);
CALL sp_insert_car_gear("Manuel", 6);
CALL sp_insert_car_gear("semi-automatic ", 5);
CALL sp_insert_car_gear("semi-automatic ", 6);
CALL sp_insert_car_gear("semi-automatic ", 7);
CALL sp_insert_car_gear("automatic", 5);
CALL sp_insert_car_gear("automatic", 6);
CALL sp_insert_car_gear("automatic", 7);
CALL sp_insert_car_gear("automatic", 8);
CALL sp_insert_car_gear("automatic", 9);
CALL sp_insert_car_gear("gear for four-wheel drive", 5);

#insert into car_technical_specification via sp_insert_car_technical_specification procedure
CALL sp_insert_car_technical_specification("ABS");
CALL sp_insert_car_technical_specification("ESP");
CALL sp_insert_car_technical_specification("ASR");
CALL sp_insert_car_technical_specification("ESL");
CALL sp_insert_car_technical_specification("EBD");
CALL sp_insert_car_technical_specification("driver’s air bag");
CALL sp_insert_car_technical_specification("passenger air bag");
CALL sp_insert_car_technical_specification("rear side air bag");
CALL sp_insert_car_technical_specification("curtain airbag/cushion");
CALL sp_insert_car_technical_specification("roof air bag ");
CALL sp_insert_car_technical_specification("Airmatic");
CALL sp_insert_car_technical_specification("Isofix");

#insert into car via sp_insert_car procedure
CALL sp_insert_car(1, 1, 2, 3, 1, 2, "red", "information about car");
CALL sp_insert_car(1, 1, 2, 3, 1, 2, "black", "information about car");
CALL sp_insert_car(1, 1, 2, 3, 1, 2, "grey", "information about car");
CALL sp_insert_car(2, 2, 8, 8, 1, 8, "black", "information about car");
CALL sp_insert_car(3, 1, 4, 9, 1, 4, "grey", "information about car");
CALL sp_insert_car(13, 1, 5, 4, 1, 2, "white", "information about car");
CALL sp_insert_car(13, 1, 12, 1, 3, 4, "black", "information about car");
CALL sp_insert_car(26, 1, 8, 7, 4, 2, "black", "information about car");
CALL sp_insert_car(26, 1, 14, 6, 5, 8, "white", "information about car");
CALL sp_insert_car(10, 10, 6, 6, 9, 1, "white", "information about car");
CALL sp_insert_car(11, 10, 6, 5, 10, 1, "white", "information about car");
CALL sp_insert_car(7, 6, 7, 8, 7, 7, "black", "information about car");
CALL sp_insert_car(8, 1, 7, 9, 7, 7, "dark-blue", "information about car");
CALL sp_insert_car(14, 2, 1, 3, 4, 1, "white", "information about car");
CALL sp_insert_car(14, 2, 5, 4, 4, 4, "red", "information about car");


#insert into car_has_car_technical_specification via sp_insert_car_has_car_technical_specification procedure
CALL sp_insert_car_has_car_technical_specification(1, 1);
CALL sp_insert_car_has_car_technical_specification(1, 2);
CALL sp_insert_car_has_car_technical_specification(1, 3);
CALL sp_insert_car_has_car_technical_specification(1, 5);
CALL sp_insert_car_has_car_technical_specification(1, 6);
CALL sp_insert_car_has_car_technical_specification(2, 1);
CALL sp_insert_car_has_car_technical_specification(2, 2);
CALL sp_insert_car_has_car_technical_specification(2, 3);
CALL sp_insert_car_has_car_technical_specification(2, 5);
CALL sp_insert_car_has_car_technical_specification(2, 6);
CALL sp_insert_car_has_car_technical_specification(3, 1);
CALL sp_insert_car_has_car_technical_specification(3, 2);
CALL sp_insert_car_has_car_technical_specification(3, 3);
CALL sp_insert_car_has_car_technical_specification(3, 5);
CALL sp_insert_car_has_car_technical_specification(3, 6);
CALL sp_insert_car_has_car_technical_specification(4, 1);
CALL sp_insert_car_has_car_technical_specification(4, 2);
CALL sp_insert_car_has_car_technical_specification(4, 3);
CALL sp_insert_car_has_car_technical_specification(4, 4);
CALL sp_insert_car_has_car_technical_specification(4, 6);
CALL sp_insert_car_has_car_technical_specification(4, 7);
CALL sp_insert_car_has_car_technical_specification(4, 8);
CALL sp_insert_car_has_car_technical_specification(5, 1);
CALL sp_insert_car_has_car_technical_specification(5, 2);
CALL sp_insert_car_has_car_technical_specification(5, 3);
CALL sp_insert_car_has_car_technical_specification(5, 4);
CALL sp_insert_car_has_car_technical_specification(5, 6);
CALL sp_insert_car_has_car_technical_specification(5, 7);
CALL sp_insert_car_has_car_technical_specification(5, 8);
CALL sp_insert_car_has_car_technical_specification(5, 9);
CALL sp_insert_car_has_car_technical_specification(5, 10);
CALL sp_insert_car_has_car_technical_specification(6, 1);
CALL sp_insert_car_has_car_technical_specification(6, 3);
CALL sp_insert_car_has_car_technical_specification(6, 4);
CALL sp_insert_car_has_car_technical_specification(6, 5);
CALL sp_insert_car_has_car_technical_specification(6, 8);
CALL sp_insert_car_has_car_technical_specification(7, 1);
CALL sp_insert_car_has_car_technical_specification(7, 2);
CALL sp_insert_car_has_car_technical_specification(7, 3);
CALL sp_insert_car_has_car_technical_specification(7, 5);
CALL sp_insert_car_has_car_technical_specification(7, 7);
CALL sp_insert_car_has_car_technical_specification(7, 8);
CALL sp_insert_car_has_car_technical_specification(8, 7);
CALL sp_insert_car_has_car_technical_specification(8, 8);
CALL sp_insert_car_has_car_technical_specification(8, 9);
CALL sp_insert_car_has_car_technical_specification(9, 1);
CALL sp_insert_car_has_car_technical_specification(9, 2);
CALL sp_insert_car_has_car_technical_specification(9, 3);
CALL sp_insert_car_has_car_technical_specification(9, 4);
CALL sp_insert_car_has_car_technical_specification(9, 5);
CALL sp_insert_car_has_car_technical_specification(9, 6);
CALL sp_insert_car_has_car_technical_specification(9, 7);
CALL sp_insert_car_has_car_technical_specification(10, 1);
CALL sp_insert_car_has_car_technical_specification(10, 2);
CALL sp_insert_car_has_car_technical_specification(10, 4);
CALL sp_insert_car_has_car_technical_specification(10, 5);
CALL sp_insert_car_has_car_technical_specification(11, 3);
CALL sp_insert_car_has_car_technical_specification(11, 4);
CALL sp_insert_car_has_car_technical_specification(11, 5);
CALL sp_insert_car_has_car_technical_specification(11, 7);
CALL sp_insert_car_has_car_technical_specification(11, 8);
CALL sp_insert_car_has_car_technical_specification(12, 1);
CALL sp_insert_car_has_car_technical_specification(12, 2);
CALL sp_insert_car_has_car_technical_specification(12, 3);
CALL sp_insert_car_has_car_technical_specification(12, 4);
CALL sp_insert_car_has_car_technical_specification(12, 5);
CALL sp_insert_car_has_car_technical_specification(12, 7);
CALL sp_insert_car_has_car_technical_specification(13, 2);
CALL sp_insert_car_has_car_technical_specification(13, 4);
CALL sp_insert_car_has_car_technical_specification(13, 5);
CALL sp_insert_car_has_car_technical_specification(13, 8);
CALL sp_insert_car_has_car_technical_specification(13, 9);
CALL sp_insert_car_has_car_technical_specification(13, 10);
CALL sp_insert_car_has_car_technical_specification(14, 1);
CALL sp_insert_car_has_car_technical_specification(14, 2);
CALL sp_insert_car_has_car_technical_specification(14, 3);
CALL sp_insert_car_has_car_technical_specification(14, 4);
CALL sp_insert_car_has_car_technical_specification(15, 1);
CALL sp_insert_car_has_car_technical_specification(15, 2);
CALL sp_insert_car_has_car_technical_specification(15, 3);
CALL sp_insert_car_has_car_technical_specification(15, 4);
CALL sp_insert_car_has_car_technical_specification(15, 5);
CALL sp_insert_car_has_car_technical_specification(15, 6);
CALL sp_insert_car_has_car_technical_specification(15, 7);
CALL sp_insert_car_has_car_technical_specification(15, 8);
CALL sp_insert_car_has_car_technical_specification(15, 9);
CALL sp_insert_car_has_car_technical_specification(15, 10);

#insert into rented_car via sp_insert_rented_car procedure
CALL sp_insert_rented_car(1, 37, "2017-01-03", "2017-01-05");
CALL sp_insert_rented_car(2, 37, "2017-01-02", "2017-01-03");
CALL sp_insert_rented_car(3, 37, "2017-01-01", "2017-01-02");
CALL sp_insert_rented_car(4, 38, "2016-12-03", "2016-12-05");
CALL sp_insert_rented_car(5, 38, "2016-12-07", "2016-12-09");
CALL sp_insert_rented_car(6, 38, "2016-12-12", "2016-12-15");
CALL sp_insert_rented_car(7, 39, "2016-12-19", "2017-01-22");
CALL sp_insert_rented_car(8, 39, "2016-12-25", "2017-01-26");
CALL sp_insert_rented_car(9, 40, "2017-01-03", "2017-01-09");
CALL sp_insert_rented_car(10, 40, "2017-01-10", "2017-01-13");
CALL sp_insert_rented_car(11, 41, "2017-01-13", "2017-01-15");

#insert into car_photo via sp_insert_car_photo procedure

CALL sp_insert_car_photo(1, "/pictures/001.jpg");
CALL sp_insert_car_photo(1, "/pictures/001-2.jpg");
CALL sp_insert_car_photo(1, "/pictures/001-3.jpg");
CALL sp_insert_car_photo(1, "/pictures/001-4.jpg");
CALL sp_insert_car_photo(1, "/pictures/001-5.jpg");
CALL sp_insert_car_photo(2, "/pictures/002.jpg");
CALL sp_insert_car_photo(2, "/pictures/002-2.jpg");
CALL sp_insert_car_photo(2, "/pictures/002-3.jpg");
CALL sp_insert_car_photo(2, "/pictures/002-4.jpg");
CALL sp_insert_car_photo(2, "/pictures/002-5.jpg");
CALL sp_insert_car_photo(3, "/pictures/003.jpg");
CALL sp_insert_car_photo(3, "/pictures/003-2.jpg");
CALL sp_insert_car_photo(3, "/pictures/003-3.jpg");
CALL sp_insert_car_photo(3, "/pictures/003-4.jpg");
CALL sp_insert_car_photo(4, "/pictures/004.jpg");
CALL sp_insert_car_photo(4, "/pictures/004-2.jpg");
CALL sp_insert_car_photo(4, "/pictures/004-3.jpg");
CALL sp_insert_car_photo(5, "/pictures/005.jpg");
CALL sp_insert_car_photo(6, "/pictures/006.jpg");
CALL sp_insert_car_photo(6, "/pictures/006-2.jpg");
CALL sp_insert_car_photo(7, "/pictures/007.jpg");
CALL sp_insert_car_photo(7, "/pictures/007-2.jpg");
CALL sp_insert_car_photo(7, "/pictures/007-3.jpg");
CALL sp_insert_car_photo(8, "/pictures/008.jpg");
CALL sp_insert_car_photo(8, "/pictures/008-2.jpg");
CALL sp_insert_car_photo(8, "/pictures/008-3.jpg");
CALL sp_insert_car_photo(9, "/pictures/009.jpg");
CALL sp_insert_car_photo(10, "/pictures/010.jpg");
CALL sp_insert_car_photo(10, "/pictures/010-2.jpg");
CALL sp_insert_car_photo(10, "/pictures/010-3.jpg");
CALL sp_insert_car_photo(11, "/pictures/011.jpg");
CALL sp_insert_car_photo(11, "/pictures/011-2.jpg");
CALL sp_insert_car_photo(12, "/pictures/012.jpg");
CALL sp_insert_car_photo(12, "/pictures/012-2.jpg");
CALL sp_insert_car_photo(13, "/pictures/013.jpg");
CALL sp_insert_car_photo(13, "/pictures/013-2.jpg");
CALL sp_insert_car_photo(14, "/pictures/014.jpg");
CALL sp_insert_car_photo(14, "/pictures/014-2.jpg");
CALL sp_insert_car_photo(15, "/pictures/015.jpg");
CALL sp_insert_car_photo(15, "/pictures/015-2.jpg");
CALL sp_insert_car_photo(15, "/pictures/015-3.jpg");


