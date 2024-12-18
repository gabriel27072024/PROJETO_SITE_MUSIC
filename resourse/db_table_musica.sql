-- site_music.musica definição

CREATE TABLE `musica` (
  `id_musica` int(11) NOT NULL AUTO_INCREMENT,
  `musica` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_musica`),
  UNIQUE KEY `musica` (`musica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;