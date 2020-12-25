CREATE TABLE  `jos_mycomponent_foobars` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `foo` varchar(100) NOT NULL,
  `bar` varchar(100),
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) unsigned NOT NULL default '0',
  `published` tinyint(1) unsigned NOT NULL default '0',
  `hits` int(11) unsigned NOT NULL default '0',
  `catid` int(11) unsigned NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY  (`id`)
) AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;
  
INSERT INTO `jos_mycomponent_foobars` (`id`, `foo`, `bar`, `checked_out`, `checked_out_time`, `ordering`, `published`, `hits`, `catid`, `params`) VALUES
(100, '', NULL, 0, '0000-00-00 00:00:00', 4, 1, 13, 1, ''),
(101, 'Lorem', NULL, 0, '0000-00-00 00:00:00', 3, 1, 43, 1, ''),
(102, 'ipsum', NULL, 0, '0000-00-00 00:00:00', 1, 1, 72, 1, ''),
(103, 'dolor', NULL, 62, '2009-03-11 11:18:32', 2, 1, 55, 1, ''),
(104, 'sit', NULL, 0, '0000-00-00 00:00:00', 1, 0, 0, 2, ''),
(105, 'amet', NULL, 0, '0000-00-00 00:00:00', 2, 1, 49, 2, '');
