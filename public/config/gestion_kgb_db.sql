CREATE DATABASE IF NOT EXISTS gestion_kgb_db;

USE gestion_kgb_db;

CREATE TABLE Agent (
    CodeID CHAR(36) PRIMARY KEY,
    Nom VARCHAR(255),
    Prénom VARCHAR(255),
    DateNaissance DATE,
    Nationalité VARCHAR(255)
);

CREATE TABLE Cible (
    NomCode CHAR(36) PRIMARY KEY,
    Nom VARCHAR(255),
    Prénom VARCHAR(255),
    DateNaissance DATE,
    Nationalité VARCHAR(255)
);

CREATE TABLE Contact (
    NomCode CHAR(36) PRIMARY KEY,
    Nom VARCHAR(255),
    Prénom VARCHAR(255),
    DateNaissance DATE,
    Nationalité VARCHAR(255)
);

CREATE TABLE Planque (
    Code CHAR(36) PRIMARY KEY,
    Adresse VARCHAR(255),
    Pays VARCHAR(255),
    Type VARCHAR(255)
);

CREATE TABLE Spécialité (
    Nom VARCHAR(255) PRIMARY KEY
);

CREATE TABLE Administrateur (
    AdresseMail VARCHAR(255) PRIMARY KEY,
    Nom VARCHAR(255),
    Prénom VARCHAR(255),
    MotDePasse VARCHAR(255),
    DateCréation DATE
);

CREATE TABLE Mission (
    NomCode CHAR(36) PRIMARY KEY,
    Titre VARCHAR(255),
    Description TEXT,
    Pays VARCHAR(255),
    TypeMission VARCHAR(255),
    Statut VARCHAR(255),
    SpécialitéRequise VARCHAR(255),
    DateDébut DATE,
    DateFin DATE,
    FOREIGN KEY (SpécialitéRequise) REFERENCES Spécialité(Nom)
);


CREATE TABLE Mission_Agent (
    MissionNomCode CHAR(36),
    AgentCodeID CHAR(36),
    PRIMARY KEY (MissionNomCode, AgentCodeID),
    FOREIGN KEY (MissionNomCode) REFERENCES Mission(NomCode),
    FOREIGN KEY (AgentCodeID) REFERENCES Agent(CodeID)
);

CREATE TABLE Mission_Contact (
    MissionNomCode CHAR(36),
    ContactNomCode CHAR(36),
    PRIMARY KEY (MissionNomCode, ContactNomCode),
    FOREIGN KEY (MissionNomCode) REFERENCES Mission(NomCode),
    FOREIGN KEY (ContactNomCode) REFERENCES Contact(NomCode)
);

CREATE TABLE Mission_Cible (
    MissionNomCode CHAR(36),
    CibleNomCode CHAR(36),
    PRIMARY KEY (MissionNomCode, CibleNomCode),
    FOREIGN KEY (MissionNomCode) REFERENCES Mission(NomCode),
    FOREIGN KEY (CibleNomCode) REFERENCES Cible(NomCode)
);

CREATE TABLE Mission_Planque (
    MissionNomCode CHAR(36),
    PlanqueCode CHAR(36),
    PRIMARY KEY (MissionNomCode, PlanqueCode),
    FOREIGN KEY (MissionNomCode) REFERENCES Mission(NomCode),
    FOREIGN KEY (PlanqueCode) REFERENCES Planque(Code)
);

CREATE TABLE Agent_Spécialité (
    AgentCodeID CHAR(36),
    SpécialitéNom VARCHAR(255),
    PRIMARY KEY (AgentCodeID, SpécialitéNom),
    FOREIGN KEY (AgentCodeID) REFERENCES Agent(CodeID),
    FOREIGN KEY (SpécialitéNom) REFERENCES Spécialité(Nom)
);
