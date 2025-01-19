CREATE TABLE client(
   id_client INT,
   nom_client VARCHAR(100) NOT NULL,
   email VARCHAR(100) NOT NULL,
   telephone VARCHAR(12) NOT NULL,
   adresse VARCHAR(100) NOT NULL,
   date_naissance DATE NOT NULL,
   photo_profil VARCHAR(100) NOT NULL,
   PRIMARY KEY(id_client)
);

CREATE TABLE personnel(
   id_perso INT,
   nom_perso VARCHAR(100) NOT NULL,
   date_naissance DATE NOT NULL,
   email VARCHAR(100) NOT NULL,
   telephone VARCHAR(12) NOT NULL,
   password VARCHAR(50) NOT NULL,
   adresse VARCHAR(100) NOT NULL,
   photo VARCHAR(100) NOT NULL,
   poste VARCHAR(100) NOT NULL,
   PRIMARY KEY(id_perso)
);

CREATE TABLE utilisateurs(
   id_u INT,
   nom_u VARCHAR(100) NOT NULL,
   ddn_u DATE NOT NULL,
   email_u VARCHAR(100) NOT NULL,
   add_u VARCHAR(150) NOT NULL,
   pp VARCHAR(200) NOT NULL,
   pw VARCHAR(50) NOT NULL,
   droit VARCHAR(200) NOT NULL,
   PRIMARY KEY(id_u)
);

CREATE TABLE activite(
   date DATETIME,
   desc_a VARCHAR(250) NOT NULL,
   acteur VARCHAR(50) NOT NULL,
   id_perso INT NOT NULL,
   id_u INT NOT NULL,
   PRIMARY KEY(_date),
   FOREIGN KEY(id_perso) REFERENCES personnel(id_perso),
   FOREIGN KEY(id_u) REFERENCES utilisateurs(id_u)
);

CREATE TABLE projet(
   id_pro INT,
   n_pro VARCHAR(100) NOT NULL,
   d_deb_pro DATE NOT NULL,
   d_fin_pro DATE NOT NULL,
   avan INT NOT NULL,
   stat VARCHAR(25) NOT NULL,
   bud_pro INT NOT NULL,
   fd INT NOT NULL,
   id_client INT NOT NULL,
   PRIMARY KEY(id_pro),
   FOREIGN KEY(id_client) REFERENCES client(id_client) ON DELETE RESTRICT,
);

CREATE TABLE tache(
   id_tache INT,
   nom_tache VARCHAR(100) NOT NULL,
   description VARCHAR(150) NOT NULL,
   date_debut DATE NOT NULL,
   date_fin DATE NOT NULL,
   statut VARCHAR(12) NOT NULL,
   id_perso INT NOT NULL,
   id_pro INT NOT NULL,
   PRIMARY KEY(id_tache),
   FOREIGN KEY(id_perso) REFERENCES personnel(id_perso) ,
   FOREIGN KEY(id_pro) REFERENCES projet(id_pro) 
);

CREATE TABLE fichier(
   id_fic INT,
   nom_fic VARCHAR(100),
   path VARCHAR(150),
   id_tache INT NOT NULL,
   PRIMARY KEY(id_fic),
   UNIQUE(id_tache),
   FOREIGN KEY(id_tache) REFERENCES tache(id_tache)
);

CREATE TABLE versement(
   id_ver INT,
   nom_ver VARCHAR(100) NOT NULL,
   montant INT NOT NULL,
   id_pro INT NOT NULL,
   PRIMARY KEY(id_ver),
   FOREIGN KEY(id_pro) REFERENCES projet(id_pro) 
);
