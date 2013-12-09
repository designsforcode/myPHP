
CREATE TABLE IF NOT EXISTS `a8_items` (
  `itemID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `price` float(7,2) NOT NULL,
  `type` enum('entree','pizza','drink') NOT NULL,
  PRIMARY KEY (`itemID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `a8_items`
--


-- --------------------------------------------------------

--
-- Table structure for table `a8_item_toppings`
--

CREATE TABLE IF NOT EXISTS `a8_item_toppings` (
  `itemID` int(10) unsigned NOT NULL,
  `toppingID` int(10) unsigned NOT NULL,
  KEY `itemID` (`itemID`,`toppingID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a8_item_toppings`
--


-- --------------------------------------------------------

--
-- Table structure for table `a8_toppings`
--

CREATE TABLE IF NOT EXISTS `a8_toppings` (
  `toppingID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `toppingName` varchar(16) NOT NULL,
  `price` float(7,2) NOT NULL,
  PRIMARY KEY (`toppingID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `a8_toppings`
--

INSERT INTO `a8_toppings` (`toppingID`, `toppingName`, `price`) VALUES
(1, 'Pepperoni', 1.79),
(2, 'Mushrooms', 0.59),
(3, 'Green Peppers', 1.79),
(4, 'Olives', 1.59),
(5, 'Bacon', 0.90),
(6, 'Tomatoes', 0.79),
(7, 'Sausage', 2.09),
(8, 'Pineapple', 0.79),
(9, 'Feta', 0.77),
(10, 'Ham', 1.09),
(11, 'Onions', 0.12),
(12, 'Extra Cheese', 1.00);
