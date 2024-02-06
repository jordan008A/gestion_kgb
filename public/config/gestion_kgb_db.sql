CREATE DATABASE IF NOT EXISTS gestion_kgb_db;

USE gestion_kgb_db;

CREATE TABLE agents (
    CodeID CHAR(36) PRIMARY KEY,
    Nom VARCHAR(255),
    Prenom VARCHAR(255),
    DateNaissance DATE,
    Nationalite VARCHAR(255)
);

CREATE TABLE cibles (
    NomCode CHAR(36) PRIMARY KEY,
    Nom VARCHAR(255),
    Prenom VARCHAR(255),
    DateNaissance DATE,
    Nationalite VARCHAR(255)
);

CREATE TABLE contacts (
    NomCode CHAR(36) PRIMARY KEY,
    Nom VARCHAR(255),
    Prenom VARCHAR(255),
    DateNaissance DATE,
    Nationalite VARCHAR(255)
);

CREATE TABLE planques (
    Code CHAR(36) PRIMARY KEY,
    Adresse VARCHAR(255),
    Pays VARCHAR(255),
    Type VARCHAR(255)
);

CREATE TABLE specialites (
    Nom VARCHAR(255) PRIMARY KEY
);

CREATE TABLE administrateurs (
    AdresseMail VARCHAR(255) PRIMARY KEY,
    Nom VARCHAR(255),
    Prenom VARCHAR(255),
    MotDePasse VARCHAR(255),
    DateCreation DATE
);

CREATE TABLE missions (
    NomCode CHAR(36) PRIMARY KEY,
    Titre VARCHAR(255),
    Description TEXT,
    Pays VARCHAR(255),
    TypeMission VARCHAR(255),
    Statut VARCHAR(255),
    SpecialiteRequise VARCHAR(255),
    DateDebut DATE,
    DateFin DATE,
    FOREIGN KEY (SpecialiteRequise) REFERENCES Specialite(Nom)
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

CREATE TABLE Agent_Specialite (
    AgentCodeID CHAR(36),
    SpecialiteNom VARCHAR(255),
    PRIMARY KEY (AgentCodeID, SpecialiteNom),
    FOREIGN KEY (AgentCodeID) REFERENCES Agent(CodeID),
    FOREIGN KEY (SpecialiteNom) REFERENCES Specialite(Nom)
);
