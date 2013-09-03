SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS pcounter_save ( save_name varchar(10) NOT NULL, save_value int(10) unsigned NOT NULL ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO pcounter_save (save_name, save_value) VALUES ('day_time', 2455527), ('max_count', 0), ('max_time', 2455527), ('counter', 0), ('yesterday', 0);

CREATE TABLE IF NOT EXISTS pcounter_users ( user_ip varchar(39) NOT NULL, user_time int(10) unsigned NOT NULL, UNIQUE KEY user_ip (user_ip) ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO pcounter_users (user_ip, user_time) VALUES ('''127.0.0.1''', 1290821670);
