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

