#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: utilisateur
#------------------------------------------------------------

CREATE TABLE utilisateur(
        id     Int  Auto_increment  NOT NULL ,
        nom    Varchar (20) NOT NULL ,
        prenom Varchar (200) NOT NULL ,
        date   Date NOT NULL ,
        email  Varchar (200) NOT NULL ,
        mdp    Varchar (200) NOT NULL ,
        role   Char (200) NOT NULL
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
        statut         Datetime NOT NULL ,
        id_panier      Int NOT NULL ,
        id_utilisateur Int NOT NULL
	,CONSTRAINT reservation_AK UNIQUE (id_panier)
	,CONSTRAINT reservation_PK PRIMARY KEY (id)

	,CONSTRAINT reservation_utilisateur_FK FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: panier
#------------------------------------------------------------

CREATE TABLE panier(
        id             Int  Auto_increment  NOT NULL ,
        heure_debut    Time NOT NULL ,
        heure_fin      Time NOT NULL ,
        id_reservation Int NOT NULL ,
        id_materiel    Int NOT NULL
	,CONSTRAINT panier_AK UNIQUE (id_reservation,id_materiel)
	,CONSTRAINT panier_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: qualiter
#------------------------------------------------------------

CREATE TABLE qualiter(
        id       Int  Auto_increment  NOT NULL ,
        quantite Int NOT NULL
	,CONSTRAINT qualiter_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Concerner
#------------------------------------------------------------

CREATE TABLE Concerner(
        id        Int NOT NULL ,
        id_panier Int NOT NULL
	,CONSTRAINT Concerner_PK PRIMARY KEY (id,id_panier)

	,CONSTRAINT Concerner_materiel_FK FOREIGN KEY (id) REFERENCES materiel(id)
	,CONSTRAINT Concerner_panier0_FK FOREIGN KEY (id_panier) REFERENCES panier(id)
)ENGINE=InnoDB;

