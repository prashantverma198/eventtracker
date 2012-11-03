<?php
/**
 * Copyright (c) 2012 AD2C INDIA PVT. LTD
 *	
 *
 * @package       AD2CAMPAIGN
 * @copyright     AD2C INDIA PVT. LTD
 * @author        Alok Pabalkar <alok@ad2c.co>
 * @license       Proprietary
 * @Description   ad2campaign Stats Table Structure Definition
 * 
 */
 
define('LEAD_STATS_TABLE',
"CREATE TABLE `%s`.`lead_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessionid` varchar(45) DEFAULT NULL,
  `publisher` varchar(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `msisdn` varchar(12) DEFAULT NULL,
  `lead_data` varchar(512) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `weekno` int(11) DEFAULT NULL, 
  `remote_addr` varchar(20) DEFAULT NULL,
  `referer` varchar(1024) DEFAULT NULL,
  `ua_make` varchar(45) DEFAULT NULL,
  `ua_model` varchar(45) DEFAULT NULL,
  `ua_screensize` varchar(45) DEFAULT NULL,
  `ua_os` varchar(45) DEFAULT NULL,
  `ua_string` varchar(1024) DEFAULT NULL,
  `timespent` int(11) DEFAULT NULL,
  `uniquevisitor` int(11) DEFAULT NULL,
  `uniqueVisitorCookie` varchar(45) NOT NULL,
  `operator` varchar(45) DEFAULT NULL,
  `circle` varchar(45) DEFAULT NULL,
  `params` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`uniqueVisitorCookie`,`publisher`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;"
);
																												
define('PAGE_STATS_TABLE',  "
CREATE TABLE `%s`.`page_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessionid` varchar(45) DEFAULT NULL,
  `publisher` varchar(45) NOT NULL,
  `page` varchar(45) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `msisdn` varchar(12) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `weekno` int(11) DEFAULT NULL,
  `remote_addr` varchar(20) DEFAULT NULL,
  `referer` varchar(1024) DEFAULT NULL,
  `ua_make` varchar(45) DEFAULT NULL,
  `ua_model` varchar(45) DEFAULT NULL,
  `ua_screensize` varchar(45) DEFAULT NULL,
  `ua_os` varchar(45) DEFAULT NULL,
  `ua_string` varchar(1024) DEFAULT NULL,
  `timespent` int(11) DEFAULT NULL,
  `uniquevisitor` int(11) DEFAULT NULL,
  `uniqueVisitorCookie` varchar(45) NOT NULL,
  `operator` varchar(45) DEFAULT NULL,
  `circle` varchar(45) DEFAULT NULL,
  `params` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`uniqueVisitorCookie`,`publisher`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;"
);

define('TRACKER_STATS_TABLE',  "
CREATE TABLE `%s`.`tracker_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessionid` varchar(45) DEFAULT NULL,
  `publisher` varchar(45) NOT NULL,
  `page` varchar(45) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `msisdn` varchar(12) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `weekno` int(11) DEFAULT NULL,
  `remote_addr` varchar(20) DEFAULT NULL,
  `referer` varchar(1024) DEFAULT NULL,
  `ua_make` varchar(45) DEFAULT NULL,
  `ua_model` varchar(45) DEFAULT NULL,
  `ua_screensize` varchar(45) DEFAULT NULL,
  `ua_os` varchar(45) DEFAULT NULL,
  `ua_string` varchar(1024) DEFAULT NULL,
  `timespent` int(11) DEFAULT NULL,
  `uniquevisitor` int(11) DEFAULT NULL,
  `uniqueVisitorCookie` varchar(45) NOT NULL,
  `operator` varchar(45) DEFAULT NULL,
  `circle` varchar(45) DEFAULT NULL,
  `params` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`uniqueVisitorCookie`,`publisher`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;"
);

define('DOWNLOAD_STATS_TABLE', "
CREATE TABLE `%s`.`download_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessionid_pid` varchar(45) DEFAULT NULL,
  `publisher` varchar(45) NOT NULL,
  `msisdn` varchar(45) DEFAULT NULL,
  `content_type` varchar(255) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `status_code` varchar(45) DEFAULT NULL,
  `status_desc` varchar(45) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `weekno` int(11) DEFAULT NULL,
  `remote_addr` varchar(20) DEFAULT NULL,
  `referer` varchar(1024) DEFAULT NULL,
  `ua_make` varchar(45) DEFAULT NULL,
  `ua_model` varchar(45) DEFAULT NULL,
  `ua_screensize` varchar(45) DEFAULT NULL,
  `ua_os` varchar(45) DEFAULT NULL,
  `ua_string` varchar(1024) DEFAULT NULL,
  `timespent` int(11) DEFAULT NULL,
  `uniquevisitor` int(11) DEFAULT NULL,
  `uniqueVisitorCookie` varchar(45) NOT NULL,
  `operator` varchar(45) DEFAULT NULL,
  `circle` varchar(45) DEFAULT NULL,
  `params` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`publisher`,`uniqueVisitorCookie`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;"
);		
																													
define('PUBLISHER_STATS_TABLE' , 
"CREATE TABLE `%s`.`publisher_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publisher` varchar(45) NOT NULL,
  `date` date DEFAULT NULL,
  `impressions` int(11) DEFAULT NULL,
  `clicks` int(11) DEFAULT NULL,
  `spends` varchar(45) DEFAULT NULL,
  `eCPM` varchar(45) DEFAULT NULL,
  `eCPC` varchar(45) DEFAULT NULL,
  `ctr` varchar(45) DEFAULT NULL,
  `weekno` int(11) DEFAULT NULL,
  `modifyDate` date DEFAULT NULL,
  PRIMARY KEY (`id`,`publisher`)
) ENGINE=MyISAM AUTO_INCREMENT=334 DEFAULT CHARSET=utf8;"
);	

//For Windows XAMPP Platform
define('CREATE_USER', "insert into mysql.user values('%s','%s',password('%s'),'Y','Y','Y','Y','Y','Y','N','N','N','N','N','N','N','Y','N','N','N','N','N','N','N','N','N','N','N','N','N','N','','','','',0,0,0,0,0,'','');");

//For Mac, Linux Platform																															
//define('CREATE_USER', "insert into mysql.user values('%s','%s',password('%s'),'Y','Y','Y','Y','Y','Y','N','N','N','N','N','N','N','Y','N','N','N','N','N','N','N','N','N','N','N','N','N','N','','','','',0,0,0,0);");

define('FLUSH_PRIVILEGES', "FLUSH PRIVILEGES");
//define('GRANT_PERMISSIONS', "grant INSERT,UPDATE,SELECT on %s.* to %s@'%s'");
define('SET_PASSOWRD', 'set password for %s = password("%s")');
define('HOST', 'localhost');																																																																																				

/*ARRAY OF STAT TABLES*/
$CAMPAIGN_TABLE_ARR = array(
LEAD_STATS_TABLE,
PAGE_STATS_TABLE,
TRACKER_STATS_TABLE,
DOWNLOAD_STATS_TABLE,
PUBLISHER_STATS_TABLE
);				
?>