alter table ayangw_order add number int after endTime;
update ayangw_config set ayangw_k = 'epay_id' where ayangw_k = 'xq_id';
update ayangw_config set ayangw_k = 'epay_key' where ayangw_k = 'xq_key';
update ayangw_config set ayangw_k = 'payapi' where ayangw_k = 'paiapi';
DROP TABLE IF EXISTS `ayangw_blacklist`;
CREATE TABLE `ayangw_blacklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `data` varchar(200) DEFAULT NULL,
  `remarks` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `ayangw_syslog`;
CREATE TABLE `ayangw_syslog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_name` varchar(20) DEFAULT NULL,
  `log_time` datetime DEFAULT NULL,
  `log_txt` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;