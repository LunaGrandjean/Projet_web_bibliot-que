-- Table Auteur
CREATE TABLE Auteur (
    Num INT PRIMARY KEY,
    Nom VARCHAR(255),
    Prenom VARCHAR(255),
    DateNaissance DATE,
    Nationalite VARCHAR(255)
);

-- Table Livre
CREATE TABLE Livre (
    ISSN INT PRIMARY KEY,
    Titre VARCHAR(255),
    Resume TEXT,
    Nbpages INT,
    Domaine VARCHAR(255)
);

-- Table Ecrit
CREATE TABLE Ecrit (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Auteur_Num INT,
    Livre_ISSN INT,
    FOREIGN KEY (Auteur_Num) REFERENCES Auteur(Num),
    FOREIGN KEY (Livre_ISSN) REFERENCES Livre(ISSN)
);

-- Table Admin
CREATE TABLE Admin (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(255),
    Prenom VARCHAR(255),
    Mail VARCHAR(255),
    Password VARCHAR(255),
    Tel VARCHAR(20)
);
