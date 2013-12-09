CREATE TABLE `listings` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`address` VARCHAR( 64 ) NOT NULL ,
`zip` INT UNSIGNED NOT NULL ,
`num_bedrooms` TINYINT UNSIGNED NOT NULL DEFAULT '0',
`num_baths` FLOAT( 3, 1 ) UNSIGNED NOT NULL DEFAULT '0',
`square_feet` INT UNSIGNED NULL ,
`asking_price` FLOAT( 11, 2 ) NOT NULL ,
`year_built` YEAR NULL ,
`is_lakefront` ENUM( 'y', 'n' ) NOT NULL DEFAULT 'n',
`status` ENUM( 'listed', 'pending', 'sold', 'unlisted' ) NOT NULL DEFAULT 'listed',
`description` TEXT NULL
) ENGINE = MYISAM ;

INSERT INTO `listings` (`id` ,`address` ,`zip` ,`num_bedrooms` ,`num_baths` ,`square_feet` ,`asking_price` ,`year_built` ,`is_lakefront` ,`status` ,`description`) VALUES (
NULL , '123 Main Street', '52340', '3', '1.5', '1800', '230900', '1953', 'n', 'listed', 'Gorgeous Custom Brick Home On 2 Acres Of Land. This Home Has Great Use Of Space And Has All The Necessary Rooms For Entertainment And Family Living. The Living Room Has Cathedral Ceilings And Fireplace With Custom Mantle. A Beautiful Formal Study With French Doors And Bay Window Awaits Your Private Office. You Will Enjoy The Formal Dining Room With Elegant Crown And Chair Rail Molding.The Gourmet Hardwood Floored Kitchen Comes With Cherry Cabinets, Granite Counter Tops'
);
INSERT INTO `listings` (`id` ,`address` ,`zip` ,`num_bedrooms` ,`num_baths` ,`square_feet` ,`asking_price` ,`year_built` ,`is_lakefront` ,`status` ,`description`) VALUES (
NULL , '1094 Viking Drive', '43215', '3', '3', '2300', '270600', '1953', 'n', 'listed', 'Pride of ownership shows in this well-maintained single owner home that\'s better than new! Classic colonial ﬂoor plan with living and dining rooms and large study. Kitchen with dual Jenn-air ovens, Merrilat cabinets and granite c-tops opens to spacious family room with FP. Large windows ﬂood home with light. Master and 3 addtl well-sized BRs all upstairs. Deck off kitchen overlooks lovely large backyard with mature landscaping providing natural privacy fence. Finished lower level provides 2nd kitchen/bar, large rec area with FP and full bath. This is the one you have been waiting for!'
);
INSERT INTO `listings` (`id` ,`address` ,`zip` ,`num_bedrooms` ,`num_baths` ,`square_feet` ,`asking_price` ,`year_built` ,`is_lakefront` ,`status` ,`description`) VALUES (
NULL , '3942 Stonepot Road', '08876', '2', '1.5', '1400', '199900', '2003', 'n', 'listed', 'Peaceful Wooded View From This Condo Located On The Par 3 Third Green Of This Award Winning Golf Course. Open Floor Plan Was Designed W/ The View In Mind. Living Room Has Cathedral Ceiling W/ Windows To The Peak To Take In The Beautiful Surroundings. Fireplace Has Hand Crafted Mantle & Surround. Study Has Custom Built Desk. Kitchen Is Open To Living Room, Eating Area, & Private Deck. Spacious Master Suite W/ California Shower In Bath. Full Finished Basement. So Much More.'
);
INSERT INTO `listings` (`id` ,`address` ,`zip` ,`num_bedrooms` ,`num_baths` ,`square_feet` ,`asking_price` ,`year_built` ,`is_lakefront` ,`status` ,`description`) VALUES (
NULL , '1418 Milford Street', '03820', '5', '4', '4000', '367800', '1913', 'y', 'listed', 'Beautiful Ranch located in HIGHLY desireable Sub! Tastefully decorated 3 bedroom, 2 full baths! FINISHED WALKOUT BASE w/Rec Rm. HUGE utility room, Full Bath, Bedrm & tons of storage! Convenient Breezeway that leads to a full patio w/brick pavers, DOUBLE DECK & Mature Yard! Updates include Appliances, Gorgeous Hardwood floors, vinyl windows, & Carpet. Bring your fussiest buyers & Hurry-Wont last long!'
);
INSERT INTO `listings` (`id` ,`address` ,`zip` ,`num_bedrooms` ,`num_baths` ,`square_feet` ,`asking_price` ,`year_built` ,`is_lakefront` ,`status` ,`description`) VALUES (
NULL , '2026 Brown Bear Drive', '92507', '3', '2', '3600', '250000', '1997', 'y', 'listed', 'Absolutely fabulous property, meticulously maintained and updated. Quality kitchens and baths, with extensive tiling. Too many other new features to list. Existing lease tenants would like to stay but unit could be a financially rewarding owner-occupier property at lease end. Great location is convenient to main roads. Quiet, mature neighborhood.'
);
INSERT INTO `listings` (`id` ,`address` ,`zip` ,`num_bedrooms` ,`num_baths` ,`square_feet` ,`asking_price` ,`year_built` ,`is_lakefront` ,`status` ,`description`) VALUES (
NULL , '3858 Pine Street', '15219', '3', '3.5', '5000', '277900', '1993', 'n', 'pending', 'This Fantastic Ranch Features Almost 5,000 Sq Ft Of Finished Space. 4 Large Bedrooms And An Amazing Master Bedroom With Shower, Jacuzzi Tub, And Ceramic Tile With Double Doors That Open To An Expansive Cedar Deck With Views Of Peach Mountain. Whether You Want To Spend Time Inside Or Out This House Has It All. The Fully Finished Walkout Basement Has A Theatre Area With Built In Speakers, Full Bathroom, Bar Area And Pellet Stove. New Siding,Chimney,Doors,Driveway,Pines,Sprinklers & Lawn. Perfect!'
);
INSERT INTO `listings` (`id` ,`address` ,`zip` ,`num_bedrooms` ,`num_baths` ,`square_feet` ,`asking_price` ,`year_built` ,`is_lakefront` ,`status` ,`description`) VALUES (
NULL , '4161 Melrose Street', '98846', '4', '1.5', '1630', '150000', '2001', 'n', 'listed', 'Contemporary Home Nestled In The Pines. Side Entry Garage, Wood Floors From Foyer Through Kitchen. Extremely Large Dining And Living Room Perfect If You Like To Entertain. '
);
INSERT INTO `listings` (`id` ,`address` ,`zip` ,`num_bedrooms` ,`num_baths` ,`square_feet` ,`asking_price` ,`year_built` ,`is_lakefront` ,`status` ,`description`) VALUES (
NULL , '2805 Sunset Drive', '72501', '1', '1', '800', '57000', '1961', 'n', 'listed', 'Energy Efficient 1 Bedroom Ranch style home meticulously maintained on 1 stunning landscaped acres - with hundreds of acres of State Land directly Road. Newer deck, 2 1/2 car gargage, full basement painted, brand new furnace, newer windows, decking & roof.'
);
INSERT INTO `listings` (`id` ,`address` ,`zip` ,`num_bedrooms` ,`num_baths` ,`square_feet` ,`asking_price` ,`year_built` ,`is_lakefront` ,`status` ,`description`) VALUES (
NULL , '2033 Grand Avenue', '32803', '3', '1.5', '3200', '190000', '1901', 'n', 'pending', 'Lovely Colonial Is A Very Popular Classic Design. Great Floorplan With Kitchen And Dinette Opening To The Familyroom W/ Brick Hearth Fireplace. Both Formal Livingroom & Diningroom Have Recent Slate Flooring. 1st Floor Mudroom For Convenience Just Off Of The 3 Car Side Load Garage. 3 Spacious Bedrooms & 2nd Floor Laundry. Professionally Finished Lower Level For A Familyroom, Theater Space & Craft Room. Entertain Guests On The Enormous Deck Or Enjoy The Open Yard. There Is Even A Pooch Palace For Your Pet! Great Sub!'
);
INSERT INTO `listings` (`id` ,`address` ,`zip` ,`num_bedrooms` ,`num_baths` ,`square_feet` ,`asking_price` ,`year_built` ,`is_lakefront` ,`status` ,`description`) VALUES (
NULL , '4355 Reeves Street', '54234', '4', '2', '4650', '500100', '1945', 'n', 'listed', 'Perfectly Updated Ranch Sitting On Just Under 2 Acres. Spacious Great Room With Vaulted Ceilings And First Floor Master Bedroom And Master Bath. Wonderful Home Featuring And Additional Detached Garage, Screened In Porch, Deck And A Walk-out Basement.'
);
INSERT INTO `listings` (`id` ,`address` ,`zip` ,`num_bedrooms` ,`num_baths` ,`square_feet` ,`asking_price` ,`year_built` ,`is_lakefront` ,`status` ,`description`) VALUES (
NULL , '3163 Green Gate Lane', '21122', '7', '5', '8200', '890000', '1965', 'n', 'listed', 'Custom designed ranch on quiet cul-desac in much desired Community. Open floor plan, easy access to expressways. Hardwood flooring in kitchen and informal dining area. Family & living rm have vaulted ceilings, dual-sided fireplace & lg Angular Windows allowing ample natural light. Large master suite features a sunning slate master bath with temperature controlled flooring. Screened in porch and a custom Patio, mature trees add privacy.'
);
INSERT INTO `listings` (`id` ,`address` ,`zip` ,`num_bedrooms` ,`num_baths` ,`square_feet` ,`asking_price` ,`year_built` ,`is_lakefront` ,`status` ,`description`) VALUES (
NULL , '3895 Capitol Avenue', '46225', '3', '2.5', '3000', '175000', '1920', 'n', 'listed', 'Pack Your Bags, Light And Bright Move-in Condition Home Is Ready For You. Freshly Painted, New Carpet, New Granite Counter Tops And Under Mount Sinks In Kitchen And Baths. New Stainless Steel Stove, Refrigerator, Dishwasher And Microwave. Family Rm Has Cathedral Ceiling, New Ceiling Fan And Wood Burning Fire Place. New French Doors To Paver Patio. Enjoy Park Like Well Landscaped Yard. Master Bedrm Has Direct Access To Common Bath. Two Bedrms Have Walk In Closets. New Central Air. Shiny Hardwood Floors In Foyer And Kitchen.'
);
INSERT INTO `listings` (`id` ,`address` ,`zip` ,`num_bedrooms` ,`num_baths` ,`square_feet` ,`asking_price` ,`year_built` ,`is_lakefront` ,`status` ,`description`) VALUES (
NULL , '4014 University Drive', '60606', '3', '2', '3200', '299000', '1889', 'y', 'sold', 'Farmhouse Perfection! Bring Your Chickens, Goats, Horses, Pigs, Cows - Plenty Of Room For All! Condition/Upgrades Surpass Typical 1890 Era. Xxl Vaulted Family Room Addition Over 2+ Car att Garage, & Room To Expand To Walkup 3rd Floor. Many Original Details. Walk-in Pantry, Granite Kitchen. Wood Stove In Family Room; Gas Stove In Parlor. Jetted Tub In 2nd Bath. Generous Rooms, Loads Of Closets/Storage. Huge, Dry Ll, Part Fin W/ High Ceilings.'
);
INSERT INTO `listings` (`id` ,`address` ,`zip` ,`num_bedrooms` ,`num_baths` ,`square_feet` ,`asking_price` ,`year_built` ,`is_lakefront` ,`status` ,`description`) VALUES (
NULL , '3491 Sherwood Circle', '70506', '3', '2', '2500', '214900', '1980', 'n', 'listed', 'All Bedrooms Have Walk-in Closets And Plenty Of Space. Great Room Features 2 Story Windows Offering Plenty Of Sunshine.1st Floor Master, Marble Counter Tops In Kitchen, Time Floor & Large Deck. This Is A One Of A Kind Home With Plenty Of Upgrades Located In York Place.'
);
INSERT INTO `listings` (`id` ,`address` ,`zip` ,`num_bedrooms` ,`num_baths` ,`square_feet` ,`asking_price` ,`year_built` ,`is_lakefront` ,`status` ,`description`) VALUES (
NULL , '4564 Hewes Avenue', '21228', '5', '4.5', '6850', '44900', '2004', 'n', 'listed', 'Welcome Home! This Lovely 5 Bedroom Colonial Is Ready For Your Buyer To Move Right In. They Will Love The Expansive Lot As The Home Sits On Over One-half Acre. Features Include Desireable Family Floor Plan With Kitchen Open To The Family Room, As Well As Study/ Office Space For Privacy When Desired. A Partially Finished Basement Boasts An Additional Full Bath, Bringing The Total In The Home To 4.5.'
);








