<?php


/*-----Migration table `humans`------*/




$queryCreate["humans"] = <<<QUERY
CREATE TABLE `humans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tree_id` int(11) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `ripdate` date DEFAULT NULL,
  `sex` int(11) DEFAULT NULL,
  `photo` int(11) DEFAULT NULL,
  `description` int(11) DEFAULT NULL,
  `coordinate` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8

QUERY;




/*-----Migration table `humans` END------*/