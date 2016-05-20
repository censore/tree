<?php


/*-----Migration table `tree_settings`------*/




$queryCreate["tree_settings"] = <<<QUERY
CREATE TABLE `tree_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tree_id` int(11) DEFAULT NULL,
  `top` int(11) DEFAULT NULL,
  `left` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8

QUERY;




/*-----Migration table `tree_settings` END------*/