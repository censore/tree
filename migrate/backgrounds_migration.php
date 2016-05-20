<?php


/*-----Migration table `backgrounds`------*/




$queryCreate["backgrounds"] = <<<QUERY
CREATE TABLE `backgrounds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8

QUERY;




/*-----Migration table `backgrounds` END------*/