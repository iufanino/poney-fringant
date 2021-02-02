-- On crée une base de donnée 'poney_fringant' mais si elle existe déjà d'abord on la supprime.

DROP DATABASE IF EXISTS poney_fringant; 
CREATE DATABASE poney_fringant; 
USE poney_fringant; 

--On crée un utilisateur de base de données

CREATE USER IF NOT EXISTS iufanino@localhost IDENTIFIED BY 'iufaiufa';

--On donne l'accès à la base poney_fringant et et toutes ses tables à l'utilisateur iufanino, et on lui donne tous les droits

GRANT ALL ON poney_fringant.* TO iufanino@localhost; 


-- On crée la table 'adherents' dans notre base de donnée (database) 'poney_fringant', si elle n'existe pas

CREATE TABLE IF NOT EXISTS `adherents`(
  `id_adherent` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `nom` VARCHAR(50) NOT NULL,
  `prenom` VARCHAR(50) NOT NULL,
  `pseudo` VARCHAR(25) UNIQUE NOT NULL,
  `email` VARCHAR(50) UNIQUE  NOT NULL,
  `tel` VARCHAR(14)  NOT NULL,
  `numero_adherent` INT(10) UNIQUE NULL,
  `password` VARCHAR(125) NOT NULL,
  `adresse` VARCHAR(125) NULL,
  `code_postal` INT(5) NULL,
  `ville` VARCHAR(25) NULL,
  `date_adhesion` DATE DEFAULT (NOW()) NOT NULL,
   INDEX (numero_adherent)
) ENGINE=InnoDB;

-- On crée la table 'profils' dans notre base de donnée (database) 'poney_fringant', si elle n'existe pas

CREATE TABLE IF NOT EXISTS `profils`(
  `id_profil` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `titre` VARCHAR(50) NOT NULL,
  `photo`  VARCHAR(50) NULL,
  `description` TEXT NOT NULL,
  `id_adherent` INT NOT NULL,
  CONSTRAINT `contrainte_cle_etrangere_adherents_FK` FOREIGN KEY (`id_adherent`) REFERENCES `adherents` (`id_adherent`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- On crée la table 'interets' dans notre base de donnée (database) 'poney_fringant', si elle n'existe pas

CREATE TABLE IF NOT EXISTS `interets`(
  `id_interet` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `nom` VARCHAR(25) UNIQUE NOT NULL
) ENGINE=InnoDB;

-- On crée la table 'interet-adherent' dans notre base de donnée (database) 'poney_fringant', si elle n'existe pas

CREATE TABLE IF NOT EXISTS `interet_adherent`(
  `id_centre_interet` INT NOT NULL,
  `id_adherent` INT NOT NULL,
  PRIMARY KEY(id_centre_interet, id_adherent),
  CONSTRAINT `contrainte_cle_etrangere_adherent_FK` FOREIGN KEY (`id_adherent`) REFERENCES `adherents` (`id_adherent`),
  CONSTRAINT `contrainte_cle_etrangere_centre_interet_FK` FOREIGN KEY (`id_centre_interet`) REFERENCES `interets` (`id_interet`)
) ENGINE=InnoDB;


