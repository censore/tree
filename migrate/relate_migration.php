<?php


/*-----Migration table `relate`------*/




$queryCreate["relate"] = <<<QUERY
CREATE TABLE `relate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `human_id` int(11) NOT NULL DEFAULT '0',
  `relate_to` int(11) NOT NULL DEFAULT '0',
  `description` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8

QUERY;




/*-----Migration table `relate` END------*/