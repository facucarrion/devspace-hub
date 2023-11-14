CREATE TABLE `users` (
  `id_user` int PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(40) UNIQUE,
  `display_name` varchar(50),
  `email` varchar(50) UNIQUE,
  `avatar` varchar(80),
  `password` varchar(72),
  `created_at` datetime
);

CREATE TABLE `projects` (
  `id_project` int PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(40),
  `description` varchar(255),
  `url` varchar(80),
  `logo` varchar(80),
  `image` varchar(80),
  `created_at` datetime
);

CREATE TABLE `roles` (
  `id_rol` int PRIMARY KEY AUTO_INCREMENT,
  `rol` varchar(40)
);

CREATE TABLE `follows` (
  `id_follow` int PRIMARY KEY AUTO_INCREMENT,
  `id_user_followed` int,
  `id_user_follower` int,
  `created_at` datetime
);

CREATE TABLE `tags` (
  `id_tag` int PRIMARY KEY AUTO_INCREMENT,
  `tag` varchar(20)
);

CREATE TABLE `project_users` (
  `id_project_user` int PRIMARY KEY AUTO_INCREMENT,
  `id_rol` int,
  `id_project` int,
  `id_user` int,
  `is_editor` tinyint(1),
  `upvote` tinyint(1)
);

CREATE TABLE `project_tags` (
  `id_project_tag` int PRIMARY KEY AUTO_INCREMENT,
  `id_project` int,
  `id_tag` int
);

CREATE TABLE `project_links` (
  `id_project_link` int PRIMARY KEY AUTO_INCREMENT,
  `id_project` int,
  `link` varchar(60)
);

CREATE TABLE `user_links` (
  `id_user_link` int PRIMARY KEY AUTO_INCREMENT,
  `id_user` int,
  `link` varchar(60)
);

ALTER TABLE `follows` ADD FOREIGN KEY (`id_user_followed`) REFERENCES `users` (`id_user`);

ALTER TABLE `follows` ADD FOREIGN KEY (`id_user_following`) REFERENCES `users` (`id_user`);

ALTER TABLE `project_users` ADD FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);

ALTER TABLE `project_users` ADD FOREIGN KEY (`id_project`) REFERENCES `projects` (`id_project`);

ALTER TABLE `project_users` ADD FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

ALTER TABLE `project_tags` ADD FOREIGN KEY (`id_project`) REFERENCES `projects` (`id_project`);

ALTER TABLE `project_tags` ADD FOREIGN KEY (`id_tag`) REFERENCES `tags` (`id_tag`);

ALTER TABLE `project_links` ADD FOREIGN KEY (`id_project`) REFERENCES `projects` (`id_project`);

ALTER TABLE `user_links` ADD FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
