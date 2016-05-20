<?php


/*-----Migration table `sexes`------*/




$queryCreate["sexes"] = <<<QUERY
CREATE TABLE `sexes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(10) DEFAULT NULL,
  `short` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8

QUERY;




/*-----Migration table `sexes` END------*/