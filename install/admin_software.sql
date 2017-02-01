

CREATE TABLE IF NOT EXISTS `mpg_categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `mpg_comment` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `com_img_id` int(11) NOT NULL DEFAULT '0',
  `com_poster_name` varchar(255) NOT NULL DEFAULT '',
  `com_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `com_message` text NOT NULL,
  `com_poster_ip` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`com_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `mpg_images` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `img_name` varchar(255) NOT NULL,
  `img_cat` int(11) NOT NULL DEFAULT '0',
  `img_desc` text NOT NULL,
  `img_date` date NOT NULL,
  `img_uploader` varchar(255) NOT NULL,
  `img_upl_ip` varchar(15) NOT NULL,
  `img_filename` varchar(255) NOT NULL,
  `img_filesize` int(11) NOT NULL DEFAULT '0',
  `img_resolution` varchar(11) NOT NULL DEFAULT '0x0',
  `img_votes` int(11) NOT NULL DEFAULT '0',
  `img_points` int(11) NOT NULL DEFAULT '0',
  `img_active` int(11) NOT NULL DEFAULT '0',
  `img_views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `mpg_settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `installed` int(1) NOT NULL DEFAULT '1',
  `pagename` varchar(255) NOT NULL DEFAULT '',
  `slogan` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `script_url` varchar(255) NOT NULL,
  `total_votes` int(11) NOT NULL,
  `total_points` int(11) NOT NULL,
  `total_img_views` int(11) NOT NULL DEFAULT '0',
  `hitcounter` int(1) NOT NULL DEFAULT '1',
  `hitcounterimg` varchar(255) NOT NULL,
  `template` text NOT NULL,
  `max_filesize` int(11) NOT NULL,
  `max_width` int(5) NOT NULL,
  `max_height` int(5) NOT NULL,
  `thumb_size` int(3) NOT NULL,
  `normal_size` int(4) NOT NULL,
  `thumb_cells` int(2) NOT NULL,
  `thumb_rows` int(11) NOT NULL,
  `thumb_on_page` int(11) NOT NULL,
  `search_suggestions` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;



INSERT INTO `mpg_settings` (`id`, `installed`, `pagename`, `slogan`, `email`, `script_url`, `total_votes`, `total_points`, `total_img_views`, `hitcounter`, `hitcounterimg`, `template`, `max_filesize`, `max_width`, `max_height`, `thumb_size`, `normal_size`, `thumb_cells`, `thumb_rows`, `thumb_on_page`, `search_suggestions`) VALUES
(1, 1, 'My Photo Gallery', 'My beautiful pictures', 'your@email.com', 'http://software.friendsinwar.com/test/My%20Photo%20Gallery/', 3, 24, 13, 45, 'bbldotg', 'basic.css', 732319, 2560, 1920, 115, 650, 4, 3, 7, 7);



CREATE TABLE IF NOT EXISTS `mpg_users` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(65) NOT NULL DEFAULT '',
  `password` varchar(65) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL,
  `user_level` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;



INSERT INTO `mpg_users` (`id`, `username`, `password`, `email`, `ip`, `user_level`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'your@email.com', '0.0.0.0', 9);



CREATE TABLE IF NOT EXISTS `mpg_votes` (
  `vote_id` int(11) NOT NULL AUTO_INCREMENT,
  `vote_ip` tinytext NOT NULL,
  `vote_date` date NOT NULL DEFAULT '0000-00-00',
  `vote_image_id` int(11) NOT NULL DEFAULT '0',
  `vote_points` decimal(11,1) NOT NULL DEFAULT '0.0',
  PRIMARY KEY (`vote_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



