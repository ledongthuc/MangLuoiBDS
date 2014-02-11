DROP TABLE IF EXISTS `#__googlemap`;

CREATE TABLE `#__googlemap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `greeting` varchar(500) NOT NULL,
  `apiKey` varchar(200) NOT NULL,
  `mapHeight` int(4) NOT NULL,
  `mapWidth` int(4) NOT NULL,
  `mapEmail` varchar(250) NOT NULL,
  `mapFax` varchar(35) NOT NULL,
  `mapTp` varchar(35) NOT NULL,
  `mapPhone` varchar(35) NOT NULL,
  `mapAddress` text NOT NULL,
  `mapLatitude` varchar(35) NOT NULL,
  `mapLongitude` varchar(35) NOT NULL,  
  `mapViewHeight` varchar(35) NOT NULL,
  `mapView` varchar(35) NOT NULL,
  `mapPointImg` varchar(400) NOT NULL,
  `companyVideoProfile` varchar(100) NOT NULL,
  `companySpamcheck` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `#__googlemap` (`id`, `greeting`, `apiKey`, `mapHeight`, `mapWidth`, `mapEmail`, `mapFax`, `mapTp`, `mapPhone`, `mapAddress`) VALUES
(1, 'My company name', '', 350, 350, 'inetlankapvt@gmail.com', '53425345', '345346436', '543253425435', 'dfas fa\r\nafaslf');
