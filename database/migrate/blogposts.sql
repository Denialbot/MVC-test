CREATE TABLE `blogposts` (
  `id` int(11) NOT NULL,
  `post` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `blogposts`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `blogposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1240;
