
CREATE TABLE IF NOT EXISTS `entries` (
  `primary_key` varchar(32) NOT NULL,
  `foreign_key` varchar(32) DEFAULT NULL,
  `type` varchar(16) NOT NULL,
  `author` text,
  `category` text,
  `content` text,
  `contributor` text,
  `control` text,
  `edited` datetime DEFAULT NULL,
  `id` varchar(64) NOT NULL,
  `link` text,
  `published` datetime DEFAULT NULL,
  `rights` text,
  `source` text,
  `summary` text,
  `text` text,
  `title` text,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`primary_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;