#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: utilisateur
#------------------------------------------------------------

CREATE TABLE utilisateur(
        id     Int  Auto_increment  NOT NULL ,
        nom    Varchar (200) NOT NULL ,
        prenom Varchar (200) NOT NULL ,
        date   Date NOT NULL ,
        email  Varchar (200) NOT NULL ,
        mdp    Varchar (200) NOT NULL ,
        role   Varchar (200) NOT NULL
	,CONSTRAINT utilisateur_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: materiel
#------------------------------------------------------------

CREATE TABLE materiel(
        id          Int  Auto_increment  NOT NULL ,
        nom         Varchar (200) NOT NULL ,
        type        Varchar (200) NOT NULL ,
        reference   Varchar (200) NOT NULL ,
        description Varchar (200) NOT NULL
	,CONSTRAINT materiel_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: reservation
#------------------------------------------------------------

CREATE TABLE reservation(
        id             Int  Auto_increment  NOT NULL ,
        date           Date NOT NULL ,
        horraire_debut Time NOT NULL ,
        horraire_fin   Time NOT NULL ,
        statut         Varchar (200) NOT NULL ,
        id_utilisateur Int NOT NULL ,
        id_materiel    Int NOT NULL
	,CONSTRAINT reservation_PK PRIMARY KEY (id)

	,CONSTRAINT reservation_utilisateur_FK FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id)
	,CONSTRAINT reservation_materiel0_FK FOREIGN KEY (id_materiel) REFERENCES materiel(id)
	,CONSTRAINT reservation_materiel_AK UNIQUE (id_materiel)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: quantité
#------------------------------------------------------------

CREATE TABLE quantite(
        id          Int  Auto_increment  NOT NULL ,
        quantite    Int NOT NULL ,
        id_materiel Int NOT NULL
	,CONSTRAINT quantite_PK PRIMARY KEY (id)

	,CONSTRAINT quantite_materiel_FK FOREIGN KEY (id_materiel) REFERENCES materiel(id)
	,CONSTRAINT quantite_materiel_AK UNIQUE (id_materiel)
)ENGINE=InnoDB;
INSERT INTO `materiel` (`id`, `nom`, `type`, `reference`, `description`) VALUES
(1, 'camera', 'cameraa', 'camera', 'balbla'),
(2, 'x1', 'camera', 'ref1', 'description'),
(3, 'x2', 'camera', 'ref2', 'description'),
(4, 'x3', 'camera', 'ref3', 'description'),
(5, 'x4', 'camera', 'ref4', 'description'),
(6, 'x5', 'camera', 'ref5', 'description');


INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `date`, `email`, `mdp`, `role`) VALUES
(1, 'the', 'admin', '2023-04-12', 'admin@gmail.com', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'admin'),
(2, 'hamelin', 'remy', '2023-04-19', 'remy@gmail.com', '215ff2f0dcba41ff7d75d56cf1fe51e7a0f803787902ceaee453303713576c93', 'utilisateur');

--