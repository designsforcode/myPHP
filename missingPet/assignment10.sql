CREATE TABLE `a10_pets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `petName` varchar(64) NOT NULL,
  `species` varchar(24) NOT NULL,
  `missingFrom` varchar(24) DEFAULT NULL,
  `dateMissing` date DEFAULT NULL,
  `reward` float(7,2) DEFAULT NULL,
  `isDangerous` enum('n','y') NOT NULL DEFAULT 'n',
  `description` text,
  `contactPhone` varchar(16) DEFAULT NULL,
  `contactEmail` varchar(24) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `a10_pets` VALUES (4,'Fred','Llama','Briarwood Mall','2013-02-24',200.00,'y','Fred wandered off at the mall. We miss him.','(734) 555-5555','wheresfred@lostllama.com'),(5,'Tasha','Dog','Central Park','2012-12-15',0.00,'n','Collie with red bandana around neck. Very friendly','(303) 999-9999',''),(6,'Barry','Rabbit','','2013-03-10',99.00,'n','White rabbit, disappeared during magic act, never reappeared.','','sample@domain.com');