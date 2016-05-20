<?php


/*-----Migration table `blocks`------*/




$queryCreate["blocks"] = <<<QUERY
CREATE TABLE `blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8

QUERY;




/*-----Migration table `blocks` END------*/