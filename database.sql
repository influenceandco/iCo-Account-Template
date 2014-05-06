-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `clearance_level` int(11) NOT NULL COMMENT '0 - user, 1 - admin, 2 - super admin',
  `author` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `clearance_level`, `date_created`, `date_updated`, `author`) VALUES
(1, 'Sample', 'User', 'sample@influenceandco.com', 'bd1cd8c2851657bec78555cae7784dee', 2, NOW(), NOW(), 1);

-- Email: super@influenceandco.com Password: Password1