<?php


/*-----Migration table `tries`------*/




$queryCreate["tries"] = <<<QUERY
CREATE TABLE `tries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(50) DEFAULT NULL,
  `block_style_id` int(11) DEFAULT NULL,
  `background_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

QUERY;




/*-----Migration table `tries` END------*/