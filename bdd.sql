#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: utilisateur
#------------------------------------------------------------

CREATE TABLE utilisateur(
        id     Int NOT NULL ,
        nom    Varchar (20) NOT NULL ,
        prenom Varchar (20) NOT NULL ,
        date   Date NOT NULL ,
        email  Varchar (200) NOT NULL ,
        mdp    Varchar (200) NOT NULL ,
        role   Char (5) NOT NULL
	,CONSTRAINT utilisateur_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: demande
#------------------------------------------------------------

CREATE TABLE demande(
        id         Int NOT NULL ,
        dateD      Date NOT NULL ,
        dateF      Date NOT NULL ,
        statut     Varchar (20) NOT NULL ,
        materielId Int NOT NULL
	,CONSTRAINT demande_AK UNIQUE (materielId)
	,CONSTRAINT demande_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: materiel
#------------------------------------------------------------

CREATE TABLE materiel(
        id          Int NOT NULL ,
        nom         Varchar (20) NOT NULL ,
        type        Varchar (20) NOT NULL ,
        reference   Varchar (20) NOT NULL ,
        description Varchar (200) NOT NULL ,
        id_demande  Int NOT NULL
	,CONSTRAINT materiel_PK PRIMARY KEY (id)

	,CONSTRAINT materiel_demande_FK FOREIGN KEY (id_demande) REFERENCES demande(id)
)ENGINE=InnoDB;

