

CREATE TABLE `api_cache` (
  `cacheKey` varchar(40) NOT NULL,
  `cacheValue` mediumtext NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`cacheKey`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `api_states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stateName` varchar(16) NOT NULL,
  `stateAbbrev` varchar(2) NOT NULL,
  `latitude` float(9,4) NOT NULL,
  `longitude` float(9,4) NOT NULL,
  `locX` int(11) NOT NULL,
  `locY` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;



INSERT INTO `api_states` VALUES (2,'Alabama','AL',32.7990,-86.8073,348,216),(3,'Arkansas','AR',34.9513,-92.3809,289,197),(4,'Arizona','AZ',33.7712,-111.3877,105,193),(5,'California','CA',36.1700,-119.7462,35,143),(6,'Colorado','CO',39.0646,-105.3272,169,144),(7,'Connecticut','CT',41.5834,-72.7622,457,91),(8,'Washington DC','DC',38.8964,-77.0262,427,134),(9,'Delaware','DE',39.3498,-75.5148,440,128),(10,'Florida','FL',27.8333,-81.7170,406,262),(11,'Georgia','GA',32.9866,-83.6487,383,217),(12,'Iowa','IA',42.0046,-93.2140,278,112),(13,'Idaho','ID',44.2394,-114.5103,99,78),(14,'Illinois','IL',40.3363,-89.0022,317,133),(15,'Indiana','IN',39.8647,-86.2604,343,131),(16,'Kansas','KS',38.5111,-96.8005,236,154),(17,'Kentucky','KY',37.6690,-84.6514,356,160),(18,'Louisiana','LA',31.1801,-91.8749,293,240),(19,'Massachusetts','MA',42.2373,-71.5314,461,79),(20,'Maryland','MD',39.0724,-76.7902,426,126),(21,'Maine','ME',44.6074,-69.3977,475,39),(22,'Michigan','MI',43.3504,-84.5603,353,95),(23,'Minnesota','MN',45.7326,-93.9196,267,64),(24,'Missouri','MO',38.4623,-92.3020,288,154),(25,'Mississippi','MS',32.7673,-89.6812,319,219),(26,'Montana','MT',46.9048,-110.3261,144,45),(27,'North Carolina','NC',35.6411,-79.8431,411,174),(28,'North Dakota','ND',47.5362,-99.7930,219,48),(29,'Nebraska','NE',41.1289,-98.2883,222,116),(30,'New Hampshire','NH',43.4108,-71.5653,461,66),(31,'New Jersey','NJ',40.3140,-74.5089,445,108),(32,'New Mexico','NM',34.8375,-106.2371,159,200),(33,'Nevada','NV',38.4199,-117.1219,68,127),(34,'New York','NY',42.1497,-74.9384,432,77),(35,'Ohio','OH',40.3736,-82.7755,372,124),(36,'Oklahoma','OK',35.5376,-96.9247,245,191),(37,'Oregon','OR',44.5672,-122.1269,48,65),(38,'Pennsylvania','PA',40.5773,-77.2640,415,109),(39,'Rhode Island','RI',41.6772,-71.5101,468,88),(40,'South Carolina','SC',33.8191,-80.9066,404,195),(41,'South Dakota','SD',44.2853,-99.4632,220,83),(42,'Tennessee','TN',35.7449,-86.7489,346,180),(43,'Texas','TX',31.1060,-97.6475,224,236),(44,'Utah','UT',40.1135,-111.8535,116,134),(45,'Virginia','VA',37.7680,-78.2057,417,148),(46,'Vermont','VT',44.0407,-72.7093,450,62),(47,'Washington','WA',47.3917,-121.5708,59,26),(48,'Wisconsin','WI',44.2563,-89.6385,309,80),(49,'West Virginia','WV',38.4680,-80.9696,394,141),(50,'Wyoming','WY',42.7475,-107.2085,155,95);


