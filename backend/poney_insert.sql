USE poney_fringant; 

-- Table adherents

INSERT INTO adherents (nom, prenom, pseudo, email, tel, numero_adherent, password, adresse, code_postal, ville) 
VALUES ("totonom", "totoprenom", "toto", "toto@mail.com", 0987654321, 1234567890, "$$2y$10$Nofbv9BwK5o7PXbywqLCn.7vI/7O1wDNcCWnCzw8PXwc/bwkVb5IG", null, 13000, null);

INSERT INTO adherents (nom, prenom, pseudo, email, tel, numero_adherent, password, adresse, code_postal, ville) 
VALUES ("jojonom", "jojoprenom", "jojo", "jojo@mail.com", 0987654321, 0123456789, "$2y$10$gpnY5oPMMALk365cnMah..mMOTf1Gh.nm9HAaBOz/kOf2vxvy/ABm", null, 13000, null);

-- Table interets

INSERT INTO interets (nom) 
VALUES ("Animaux"), ("Licornes"), ("Jeux vidéos"), ("Sport"), ("Musique"), ("Sorties"), ('Lecture'), ('Informatique'), 
       ('Cuisine'), ('Aviation'), ('Mécanique'), ('Joaillerie'), ('Agriculture'), ('Cinéma'), ('Politique'), ('Couture'),
       ('Science'), ('Histoire'), ('Taxidermie'), ('Philatélie'), ('Physique-chimie'), ('SVT');
