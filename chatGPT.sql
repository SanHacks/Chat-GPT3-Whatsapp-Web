CREATE TABLE IF NOT EXISTS `gptChats` (
  `id` int(11) NOT NULL,
  `message` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `message_type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;