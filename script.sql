-- creazioe database
create database stagione_concertistica;
use stagione_concertistica;

-- Creazione delle tabelle
CREATE TABLE Sale (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(255) NOT NULL,
    Capienza INT NOT NULL
);

CREATE TABLE Persona (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(255) NOT NULL,
    Cognome VARCHAR(255) NOT NULL
);

CREATE TABLE Autori (
    IdPersona INT PRIMARY KEY,
    FOREIGN KEY (IdPersona) REFERENCES Persona(Id)
);

CREATE VIEW InfoAutori(Id, Nome, Cognome) as
select Persona.Id, Persona.Nome, Persona.Cognome
from Autori
join Persona on (Persona.Id = Autori.IdPersona);

CREATE TABLE Direttori (
    IdPersona INT PRIMARY KEY,
    FOREIGN KEY (IdPersona) REFERENCES Persona(Id)
);

CREATE VIEW InfoDirettori(Id, Nome, Cognome) as
select Persona.Id, Persona.Nome, Persona.Cognome
from Direttori
join Persona on (Persona.Id = Direttori.IdPersona);

CREATE TABLE Orchestrali (
    IdPersona INT PRIMARY KEY,
    FOREIGN KEY (IdPersona) REFERENCES Persona(Id)
);

CREATE VIEW InfoOrchestrali(Id, Nome, Cognome) as
select Persona.Id, Persona.Nome, Persona.Cognome
from Orchestrali
join Persona on (Persona.Id = Orchestrali.IdPersona);

CREATE TABLE Orchestre (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(255) NOT NULL,
    Direttore INT,
    FOREIGN KEY (Direttore) REFERENCES Direttori(IdPersona)
);

CREATE TABLE Concerti (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Descrizione TEXT,
    Titolo VARCHAR(255) NOT NULL,
    Data DATE NOT NULL,
    IdSala INT,
    IdOrchestra INT,
    FOREIGN KEY (IdSala) REFERENCES Sale(Id),
    FOREIGN KEY (IdOrchestra) REFERENCES Orchestre(Id)
);

CREATE TABLE PezziMusicali (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Titolo VARCHAR(255) NOT NULL,
    Durata TIME NOT NULL,
    Anno INT NOT NULL
);

CREATE TABLE Concerti_PezziMusicali (
    Concerto INT,
    IdPezzoMusicale INT,
    PRIMARY KEY (Concerto, IdPezzoMusicale),
    FOREIGN KEY (Concerto) REFERENCES Concerti(Id),
    FOREIGN KEY (IdPezzoMusicale) REFERENCES PezziMusicali(Id)
);





CREATE TABLE Strumenti (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(255) NOT NULL,
    Tipo VARCHAR(255) NOT NULL
);

CREATE TABLE Autori_PezziMusicali ( 
    IdAutore INT,
    IdPezzoMusicale INT,
    PRIMARY KEY (IdAutore, IdPezzoMusicale),
    FOREIGN KEY (IdAutore) REFERENCES Autori(IdPersona),
    FOREIGN KEY (IdPezzoMusicale) REFERENCES PezziMusicali(Id)
);

CREATE TABLE Orchestre_Orchestrali (
    IdOrchestra INT,
    IdOrchestrale INT,
    PRIMARY KEY (IdOrchestra, IdOrchestrale),
    FOREIGN KEY (IdOrchestra) REFERENCES Orchestre(Id),
    FOREIGN KEY (IdOrchestrale) REFERENCES Orchestrali(IdPersona)
);

CREATE TABLE Strumenti_Orchestrali (
    IdStrumento INT,
    IdOrchestrale INT,
    PRIMARY KEY (IdStrumento, IdOrchestrale),
    FOREIGN KEY (IdStrumento) REFERENCES Strumenti(Id),
    FOREIGN KEY (IdOrchestrale) REFERENCES Orchestrali(IdPersona)
);

CREATE TABLE Utenti (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR (80) NOT NULL,
    password VARCHAR (80) NOT NULL
);


-- Popolazione tabelle
INSERT INTO Sale (Nome, Capienza) VALUES
    ("Teatro alla Scala", 2000),
    ("Auditorium Parco della Musica", 2700),
    ("Teatro La Fenice", 1000),
    ("Arena di Verona", 15000),
    ("Teatro Regio di Parma", 1200),
    ("Palazzo dei Congressi", 1800),
    ("Teatro Comunale di Bologna", 1034),
    ("Teatro San Carlo", 1386),
    ("Teatro Massimo", 1350),
    ("Teatro Verdi", 1200);

INSERT INTO Persona (Nome, Cognome) VALUES
    ("Ludwig", "Beethoven"),
    ("Wolfgang", "Mozart"),
    ("Johann", "Bach"),
    ("Antonio", "Vivaldi"),
    ("Franz", "Schubert"),
    ("Richard", "Wagner"),
    ("Giuseppe", "Verdi"),
    ("Gustav", "Mahler"),
    ("Igor", "Stravinsky"),
    ("Claude", "Debussy"),
    ("Niccolò", "Paganini"),
    ("Johannes", "Brahms"),
    ("Felix", "Mendelssohn"),
    ("Hector", "Berlioz"),
    ("Robert", "Schumann");

INSERT INTO Autori (IdPersona) VALUES (1), (2), (3), (4), (5), (6), (7), (8), (9), (10);

INSERT INTO Direttori (IdPersona) VALUES (1), (2), (3), (4), (5), (6), (7), (8), (9), (10);

INSERT INTO Orchestrali (IdPersona) VALUES (11), (12), (13), (14), (15), (1), (2), (3), (4), (5);

INSERT INTO Orchestre (Nome, Direttore) VALUES
    ("Filarmonica della Scala", 1),
    ("Orchestra dell'Accademia di Santa Cecilia", 2),
    ("Orchestra del Teatro La Fenice", 3),
    ("Orchestra dell'Arena di Verona", 4),
    ("Orchestra del Teatro Regio", 5),
    ("Orchestra Sinfonica di Milano", 6),
    ("Orchestra del Teatro San Carlo", 7),
    ("Orchestra del Maggio Musicale Fiorentino", 8),
    ("Orchestra del Teatro Massimo", 9),
    ("Orchestra del Teatro Verdi", 10);

INSERT INTO Concerti (Descrizione, Titolo, Data, IdSala, IdOrchestra) VALUES
    ("Concerto di Capodanno", "Sinfonie di Beethoven", "2025-01-01", 1, 1),
    ("Concerto estivo", "Mozart e il classicismo", "2025-06-15", 2, 2),
    ("Omaggio a Bach", "Il barocco in musica", "2025-09-10", 3, 3),
    ("Opera sotto le stelle", "Vivaldi e il romanticismo", "2025-07-20", 4, 4),
    ("Sinfonie celebri", "Mahler e le sue opere", "2025-10-05", 5, 5),
    ("Notte d'estate", "Debussy e l'impressionismo", "2025-08-12", 6, 6),
    ("Romanticismo sinfonico", "Schubert e il Lied", "2025-11-25", 7, 7),
    ("Melodie d'autunno", "Verdi e il melodramma", "2025-09-30", 8, 8),
    ("Armonie moderne", "Stravinsky e il neoclassicismo", "2025-12-10", 9, 9),
    ("Concerto di primavera", "Wagner e il mito", "2025-04-18", 10, 10);

INSERT INTO PezziMusicali (Titolo, Durata, Anno) VALUES
    ("Sinfonia n.5", "00:30:00", 1808),
    ("Eine kleine Nachtmusik", "00:20:00", 1787),
    ("Toccata e fuga", "00:15:00", 1707),
    ("Le quattro stagioni", "00:40:00", 1723),
    ("Sinfonia Incompiuta", "00:25:00", 1822),
    ("Tristano e Isotta", "00:50:00", 1859),
    ("Aida", "01:10:00", 1871),
    ("Sinfonia n.5", "00:45:00", 1902),
    ("Sagra della primavera", "00:35:00", 1913),
    ("Clair de Lune", "00:05:00", 1890);

INSERT INTO Concerti_PezziMusicali (Concerto, IdPezzoMusicale) VALUES
    (1,1), (2,2), (3,3), (4,4), (5,5), (6,6), (7,7), (8,8), (9,9), (10,10);

INSERT INTO Strumenti (Nome, Tipo) VALUES
    ("Violino", "Corde"),
    ("Pianoforte", "Tastiera"),
    ("Flauto", "Fiato"),
    ("Oboe", "Fiato"),
    ("Clarinetto", "Fiato"),
    ("Tromba", "Ottoni"),
    ("Trombone", "Ottoni"),
    ("Arpa", "Corde"),
    ("Viola", "Corde"),
    ("Contrabbasso", "Corde");

INSERT INTO Autori_PezziMusicali (IdAutore, IdPezzoMusicale) VALUES
    (1,1), (2,2), (3,3), (4,4), (5,5), (6,6), (7,7), (8,8), (9,9), (10,10);

INSERT INTO Orchestre_Orchestrali (IdOrchestra, IdOrchestrale) VALUES
    (1, 11), (1, 1), (1, 4), (1, 5),
    (2, 13), (2, 14), (2, 15), (2, 11),
    (3, 3), (3, 4), (3, 15), (3, 11),
    (4, 1), (4, 14), (4, 2), (4, 11),
    (5, 4), (5, 13), (5, 3), (5, 15),
    (6, 3), (6, 2), (6, 5), (6, 13),
    (7, 13), (7, 15), (7, 5), (7, 3),
    (8, 12), (8, 13), (8, 1), (8, 5);

INSERT INTO Strumenti_Orchestrali (IdStrumento, IdOrchestrale) VALUES
    (1, 11), (2, 12), (3, 13), (4, 14), (5, 15), (6, 1), (7, 2), (8, 3), (9, 4), (10, 5);
    
INSERT INTO Utenti (username, password) VALUES
	("king_di_informatica", "password_difficile")